<?php
session_start();

// Autoload để tự động load class từ thư mục `app/controllers/`
spl_autoload_register(function ($className) {
  $classPath = __DIR__ . "/app/controllers/" . $className . ".php";
  if (file_exists($classPath)) {
    require $classPath;
  }
});

$link = str_replace('\\', '/', __DIR__);
define('_DIR_ROOT', $link);

// Xử lý http root
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

// Chuyển đổi DOCUMENT_ROOT thành chữ hoa
$web_root .= str_replace(strtoupper($_SERVER['DOCUMENT_ROOT']), '', strtoupper(_DIR_ROOT));

define('_WEB_ROOT_', $web_root);



include_once "./router.php";

use \Framework\Router as R;

$router = new R();
//Đăng nhập
$router->add("/", ["controller" => "home", "action" => "index"]);
$router->add("/dang-nhap", ["controller" => "auth", "action" => "index"]);
$router->add("/dang-xuat", ["controller" => "auth", "action" => "logout"]);
$router->add("/quen-mat-khau", ["controller" => "auth", "action" => "forget_pass"]);
$router->add("/auth/forget_password", ["controller" => "auth", "action" => "forget_password"]);
$router->add("/trang-xac-nhan", ["controller" => "auth", "action" => "verify"]);
$router->add("/auth/check_verify", ["controller" => "auth", "action" => "check_verify"]);
$router->add("/doi-mat-khau", ["controller" => "auth", "action" => "reset_pass"]);
$router->add("/auth/reset_password", ["controller" => "auth", "action" => "reset_password"]);

    

//Trang user
$router->add("/trang-ca-nhan", ["controller" => "auth", "action" => "profile"]);
$router->add("/chinh-sua-trang-ca-nhan", ["controller" => "auth", "action" => "update_profile"]);
$router->add("/cap-nhat-trang-ca-nhan", ["controller" => "auth", "action" => "update_profile_user"]);
$router->add("/san-pham", ["controller" => "product", "action" => "index"]);
$router->add("/chi-tiet-san-pham/{id}", ["controller" => "product", "action" => "detail_pro"]);
$router->add("/dang-ky-tai-khoan", ["controller" => "auth", "action" => "register"]);
$router->add("/dang-nhap-tai-khoan", ["controller" => "auth", "action" => "login"]);
$router->add("/tim-kiem", ["controller" => "product", "action" => "search"]);
$router->add("/gio-hang", ["controller" => "cart", "action" => "index"]);
$router->add("/them-san-pham", ["controller" => "cart", "action" => "add_to_cart"]);
$router->add("/cart/delete/{id}/{product_id}/{size_id}", ["controller" => "cart", "action" => "delete"]);
$router->add("/tang_giam_so_luong/{id}/{product_id}/{loai}", ["controller" =>"cart", "action"=>"cartItem"]);
$router->add("/order/addOrder", ["controller" =>"order", "action"=> "addOrder"]);

//Trang Admin
$router->add("/dashboard", ["controller" => "Admin_Cate", "action" => "index"]);
$router->add("/admin/category", ["controller" => "Admin_Cate", "action" => "category"]);
$router->add("/admin/product", ["controller" => "Admin_Product", "action" => "product"]);
$router->add("/admin/insert_product_page", ["controller" => "Admin_Product", "action" => "insert"]);
$router->add("/admin/them-san-pham", ["controller" => "Admin_Product", "action" => "insert_product"]);
$router->add("/admin/xoa-san-pham/{id}", ["controller" => "Admin_Product", "action" => "delete"]);
$router->add("/admin/cap-nhat-san-pham/{id}", ["controller" => "Admin_Product", "action" => "edit_product"]);
$router->add("/admin/update_product/{id}", ["controller" => "Admin_Product", "action" => "update_product"]);
$router->add("/tim-kiem-admin", ["controller" => "Admin_Product", "action" => "search"]);





$router->add("/admin/user", ["controller" => "Admin_User", "action" => "user"]);
$router->add("/admin/edit_user/{id}", ["controller" => "Admin_User", "action" => "edit_user"]);
$router->add("/admin/update_user/{id}", ["controller" => "Admin_User", "action" => "update_user"]);



$router->add("/admin/order", ["controller" => "Admin_Order", "action" => "index"]);
$router->add("/admin/update_order", ["controller" => "Admin_Order", "action" => "update_status"]);
$router->add("/admin/delete_order", ["controller" => "Admin_Order", "action" => "delete_status"]);
$router->add("/admin/edit_order/{id}", ["controller" => "Admin_Order", "action" => "edit"]);
$router->add("/admin/delete_order/{id}", ["controller" => "Admin_Order", "action" => "delete"]);


$router->add("/admin/edit_cate/{id}", ["controller" => "Admin_Cate", "action" => "edit_cate"]);
$router->add("/admin/update_cate/{id}", ["controller" => "Admin_Cate", "action" => "update_cate"]);
$router->add("/admin/delete_cate/{id}", ["controller" => "Admin_Cate", "action" => "delete_cate"]);
$router->add("/admin/insert_cate_page", ["controller" => "Admin_Cate", "action" => "insert_cate_page"]);
$router->add("/admin/insert_cate", ["controller" => "Admin_Cate", "action" => "insert_cate"]);








// Xử lý URL request
$request_uri = $_SERVER['REQUEST_URI'];
$path = str_replace('/MAKE_MONEY', '', $request_uri);

$params = $router->match($path);
if ($params === false) {
  exit("404 - Not Found!");
}

// Lấy thông tin Controller & Action
$controller = ucfirst($params['controller']) . "_Controller";
$controllerFile = "./app/controllers/" . $controller . ".php";
$action = $params['action'] ?? "index";

// Kiểm tra Controller có tồn tại không
if (!file_exists($controllerFile)) {
  exit("Lỗi: Không tìm thấy controller $controller");
}

// Load Controller
require_once $controllerFile;
$controller_object = new $controller();

// Xóa `controller` và `action` khỏi `$params` trước khi truyền vào method
unset($params['controller'], $params['action']);

// Chuyển `$params` thành array values để truyền tham số động
$args = array_values($params);

// Gọi phương thức trong Controller và truyền các tham số động
call_user_func_array([$controller_object, $action], $args);