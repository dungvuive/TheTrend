<?php 
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/CategoryController.php';

// Require toàn bộ file Models
require_once 'models/Category.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Dashboards
    '/' => (new DashboardController())->index(),

    // Quan ly danh muc san pham
    'categories' => (new CategoryController())->index(),
    'form_add_category' => (new CategoryController())->create(),
    'add_category' => (new CategoryController())->add(),
    'form_edit_category' => (new CategoryController())->edit(),
    'update_category' => (new CategoryController())->update(),
    'delete_category' => (new CategoryController())->delete(),

    // Quan ly san pham

};