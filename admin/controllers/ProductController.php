<?php
 class ProductController
 {
     public $modelProduct;

     public function __construct() {
         $this->modelProduct = new Product();
     }

     // ham hien thi danh sach
     public function index() {
         // lay ra toan bo san pham
         $products = $this->modelProduct->getAllProduct();

         // hien thi du lieu ra view
         require_once './views/product/list_product.php';
     }

     public function create() {
         require_once './views/product/add_product.php';
     }

     public function add() {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             // lay ra du lieu
             $image = $_POST['image'];
             $product_name = $_POST['product_name'];
             $description = $_POST['description'];
             $price = $_POST['price'];
             $stock = $_POST['stock'];

             // validate
             $errors = [];
             if (empty($product_name)) {
                 $errors['product_name'] = "Tên sản phẩm là bắt buộc";
             }
             if (empty($price)) {
                 $errors['price'] = "Giá là bắt buộc";
             }
             if (empty($stock)) {
                 $errors['stock'] = "Số lượng hàng trong kho là bắt buộc";
             }

             // them du lieu
             if (empty($errors)) {
                 // neu khong co loi thi them du lieu
                 // them vao CSDL
                 $this->modelProduct->postData($product_name, $image, $description, $price, $stock);
                 unset($_SESSION['errors']);
                 header('Location: ?act=products');
                 exit();
             } else {
                 $_SESSION['errors'] = $errors;
                 header('Location: ?act=form_add_product');
                 exit();
             }
         } else {

         }
     }




     public function delete()
     {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $id = $_POST['product_ID'];
             $this->modelProduct->deleteData($id);
             header('Location: ?act=products');
             exit();
         }
     }
 }