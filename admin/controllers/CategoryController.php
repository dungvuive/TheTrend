<?php

class CategoryController
{
    // ham ket noi den Model
    public $modelCategory;

    public function __construct()
    {
        $this->modelCategory = new Category();
    }

    // ham hien thi danh sach
    public function index()
    {
        // lay ra toan bo danh muc
        $categories = $this->modelCategory->getAllCategory();
        var_dump($categories);

        // dua du lieu ra view
        require_once './views/category/list_category.php';
    }

//   Ham hien thi form them danh muc
    public function create()
    {
        require_once './views/category/add_category.php';
    }

//    Ham xu ly them vao CSDL
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $category_name = $_POST['category_name'];
            $category_status = $_POST['category_status'];

            // validate
            $errors = [];
            if (empty($category_name)) {
                $errors['category_name'] = "Tên danh mục là bắt buộc";
            }
            if (empty($category_status)) {
                $errors['category_status'] = "Trạng thái là bắt buộc";
            }

            // them du lieu
            if (empty($errors)) {
                // neu khong co loi thi them du lieu
                // them vao CSDL
                $this->modelCategory->postData($category_name, $category_status);
                unset($_SESSION['errors']);
                header('Location: ?act=categories');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=form_add_category');
                exit();
            }
        } else {

        }
    }

    // Ham hien thi form sua
    public function edit()
    {
        // lay id
        $id = $_GET['category_ID'];
        // lay thong tin chi tiet cua danh muc
        $category = $this->modelCategory->getDetailData($id);

        // do du lieu ra form
        require_once './views/category/edit_category.php';
    }

    // Ham xu ly cap nhat du lieu vao CSDL
    public function update()
    {
//        error_log("update item");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lay ra du lieu
            $id = $_POST['id'];
            $category_name = $_POST['category_name'];
            $category_status = $_POST['category_status'];

//            die($category_status  );
            // validate
            $errors = [];
            if (empty($category_name)) {
                $errors['category_name'] = "Tên danh mục là bắt buộc";
            }
            if (empty($category_status)) {
                $errors['category_status'] = "Trạng thái là bắt buộc";
            }

            // Cap nhat du lieu
            if (empty($errors)) {
                // Neu khong co loi thi them du lieu
                // Them vao CSDL
                $this->modelCategory->updateData($id, $category_name, $category_status);
                unset($_SESSION['errors']);
                header('Location: ?act=categories');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=form_edit_category');
                exit();
            }
        } else {

        }
    }

//   Ham xoa du lieu trong CSDL
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['category_ID'];
            $this->modelCategory->deleteData($id);
            header('Location: ?act=categories');
            exit();
        }
    }
}


