<?php
require "./core/Controller.php";

class Auth_Controller extends Controller
{

    public $auth_model;
    public $data = [];

    public function __construct()
    {
        $this->auth_model = $this->model('AuthModel');
    }

    public function index()
    {
        $this->data['page_title'] = 'Trang đăng nhập và đăng ký';
        $this->data['content'] = 'auth/index';
        $this->data['sub_content'] = [];
        $this->render('layout/client', $this->data);
    }
    public function profile()
    {
        $this->data['page_title'] = 'Trang cá nhân';
        $this->data['content'] = 'auth/profile';
        $this->data['sub_content'] = [];
        $this->render('layout/client', $this->data);
    }
    public function update_profile()
    {
        $this->data['page_title'] = 'Chỉnh sửa trang cá nhân';
        $this->data['content'] = 'auth/update_profile';
        $this->data['sub_content'] = [];
        $this->render('layout/client', $this->data);
    }
    //Quên mật khẩu
    public function forget_pass()
    {
        $this->data['page_title'] = 'Quên mật khẩu';
        $this->data['content'] = 'auth/forget_pass';
        $this->data['sub_content'] = [];
        $this->render('layout/client', $this->data);
    }

    public function verify()
    {
        $this->data['page_title'] = 'Trang xác nhận';
        $this->data['content'] = 'auth/verify';
        $this->data['sub_content'] = [];
        $this->render('layout/client', $this->data);
    }

    public function reset_pass()
    {
        $this->data['page_title'] = 'Đổi mật khẩu';
        $this->data['content'] = 'auth/reset_pass';
        $this->data['sub_content'] = [];
        $this->render('layout/client', $this->data);
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $email = $_POST['email'] ?? '';
            $image = $_FILES['image'] ?? null;
            $password = $_POST['password'] ?? '';
            $address = $_POST['address'] ?? null;

            $validation = $this->checkFormRegister($name, $phone, $email, $password);
            if ($validation !== true) {
                $_SESSION['error'] = $validation;
            } else {
                $user = new AuthModel();
                $user->setEmail($email);
                if ($this->auth_model->getUserEmail($email)) {
                    $_SESSION['error'] = 'Email đã được đăng ký.';
                } else {
                    if (empty($image['name'])) {
                        $file_name = 'avatar-trang-4.jpg';
                    } else {
                        $target_dir = dirname(__DIR__, 2) . "/public/image_user/";
                        $unique_name = time() . '_' . basename($image["name"]);
                        $target_file = $target_dir . $unique_name;
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $check = getimagesize($image["tmp_name"]);

                        if ($check === false) {
                            $_SESSION['error'] = 'File không phải là ảnh.';
                        } elseif ($image["size"] > 500000) {
                            $_SESSION['error'] = 'File ảnh quá lớn.';
                        } elseif (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                            $_SESSION['error'] = 'Chỉ chấp nhận các định dạng JPG, JPEG, PNG, GIF.';
                        } else {
                            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                                $file_name = $unique_name;
                            } else {
                                $_SESSION['error'] = 'Có lỗi xảy ra khi upload file.';
                            }
                        }
                    }

                    if (empty($_SESSION['error'])) {
                        try {

                            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                            $this->auth_model->setName($name);
                            $this->auth_model->setPhone($phone);
                            $this->auth_model->setEmail($email);
                            $this->auth_model->setImage($file_name);
                            $this->auth_model->setPassword($password);
                            $this->auth_model->setAddress($address);
                            $this->auth_model->insert_user($this->auth_model);
                            $_SESSION['success'] = 'Đăng ký thành công!';
                        } catch (Exception $e) {
                            $_SESSION['error'] = 'Có lỗi xảy ra! Vui lòng thử lại.';
                        }
                    }
                }
            }

            // Truyền biến lỗi tới view
            $this->data['page_title'] = 'Trang đăng nhập và đăng ký';
            $this->data['content'] = 'auth/index';
            $this->render('layout/client', $this->data);
        }
    }



    public function checkFormRegister($name, $phone, $email, $password)
    {
        if (empty(trim($name))) {
            echo 'Họ và tên không được để trống.';
            return false;
        }
        if (empty(trim($phone))) {
            echo 'Số điện thoại không được để trống.';
            return false;
        } elseif (!preg_match('/^[0-9]{10,11}$/', $phone)) {
            echo 'Số điện thoại không hợp lệ. Phải là 10-11 chữ số.';
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Email không hợp lệ. Email phải chứa @.';
            return false;
        }

        $uppercase = preg_match('/[A-Z]/', $password);
        $specialChar = preg_match('/[\W_]/', $password);
        $hasNumber = preg_match('/\d/', $password);
        $minLength = strlen($password) >= 8;

        if (!$uppercase || !$specialChar || !$hasNumber || !$minLength) {
            echo 'Mật khẩu phải có ít nhất 8 ký tự, chứa ít nhất 1 chữ in hoa, 1 ký tự đặc biệt.';
            return false;
        }

        return true;
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
              $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin.';
            } else {
                $user = new AuthModel();
                $user->setEmail($email);
                $user->setPassword($password);


                $loggedInUser = $this->auth_model->login($user);

                if ($loggedInUser) {
                    $_SESSION['user'] = $loggedInUser;

                    if ($loggedInUser['role'] == 0) {
                        header('Location: ' . _WEB_ROOT_ . '/');
                    } else {
                        header('Location: ' . _WEB_ROOT_ . '/dashboard');
                    }
                    exit();
                } else {
                  $_SESSION['error'] = 'Email hoặc mật khẩu không chính xác hoặc tài khoản đã bị chặn!';
                }
            }
        }
        $layout = (isset($_SESSION['user'])&&$_SESSION['user']['role']== 1) ? "layout/admin" : "layout/client";

        $this->data['page_title'] = 'Đăng nhập';
        $this->data['content'] = 'auth/index';
        $this->render($layout, $this->data);
    }






    public function logout()
    {
        session_start();
        session_destroy();
        unset($_SERVER['user']);
        header('location: ' . _WEB_ROOT_ . '/');
        exit();
    }

    public function update_profile_user()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $userID = $_SESSION['user']['id'];
            $name = $_POST['name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $password_new = $_POST['password_new'] ?? '';
            $address = $_POST['address'] ?? '';

            $user = $this -> auth_model -> getUserById($userID);
            if(!$user){
               $_SESSION['error'] = "Không tìm thấy người dùng";
                header("Location: " . _WEB_ROOT_ . "/chinh-sua-trang-ca-nhan");
                exit();
            } else {
                if (!empty($password) && !empty($user['password']) && $password !== $user['password']){
                  $_SESSION['error'] = "Mật khẩu cũ không chính xác, không thể thay đổi mật khẩu";
                    header("Location: " . _WEB_ROOT_ . "/chinh-sua-trang-ca-nhan");
                    exit();
                } else {
                    if(!empty($password_new)){
                        $uppercase = preg_match('/[A-Z]/', $password_new);
                        $specialChar = preg_match('/[\W_]/', $password_new);
                        $hasNumber = preg_match('/\d/', $password_new);
                        $minLength = strlen($password_new) >= 8;

                        if (!$uppercase || !$specialChar || !$hasNumber || !$minLength) {
                           $_SESSION['error'] = "Mật khẩu mới phải có ít nhất 8 ký tự, chứa ít nhất 1 chữ in hoa, 1 ký tự đặc biệt, và 1 chữ số.";
                            header("Location: " . _WEB_ROOT_ . "/chinh-sua-trang-ca-nhan");
                            exit();
                        }
                    }
                    if (empty($this->errorMessage)) {
                        $imagePath = $user['image'];
                        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                            $fileType = $_FILES['image']['type'];
                            if (in_array($fileType, $allowedTypes)) {
                                if ($_FILES['image']['size'] <= 500000) {
                                    $uniqueName = time() . '_' . basename($_FILES['image']['name']);
                                    $targetDir = dirname(__DIR__, 2) . "/public/image_user/";
                                    $targetFile = $targetDir . $uniqueName;
                                    if (!is_dir($targetDir)) {
                                        mkdir($targetDir, 0777, true);
                                    }
                                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                                        $imagePath = $uniqueName;
                                    } else {
                                       $_SESSION['error'] = "Lỗi khi tải ảnh lên.";
                                        header("Location: " . _WEB_ROOT_ . "/chinh-sua-trang-ca-nhan");
                                        exit();
                                    }
                                } else {
                                  $_SESSION['error'] = "Ảnh quá lớn. Vui lòng chọn ảnh có dung lượng nhỏ hơn 500KB.";
                                    header("Location: " . _WEB_ROOT_ . "/chinh-sua-trang-ca-nhan");
                                    exit();
                                }
                            } else {
                              $_SESSION['error'] = "Chỉ chấp nhận ảnh JPG, PNG, JPEG, GIF.";
                                header("Location: " . _WEB_ROOT_ . "/chinh-sua-trang-ca-nhan");
                                exit();
                            }
                        }

                        if (empty($this->errorMessage)) {
                            $this->auth_model->setId($userID);
                            $this->auth_model->setName($name ?: $user['name']);
                            $this->auth_model->setPhone($phone ?: $user['phone']);
                            $this->auth_model->setEmail($email ?: $user['email']);
                            $this->auth_model->setAddress($address ?: $user['address']);
                            $this->auth_model->setImage($imagePath);

                            if (!empty($password_new)) {
                                $this->auth_model->setPassword($password_new);
                            } else {
                                $this->auth_model->setPassword($user['password']);
                            }

                            $this->auth_model->update_profile($this->auth_model);
                            $updatedUser = $this->auth_model->getUserById($userID);
                            $_SESSION['user'] = $updatedUser;
                           $_SESSION['error'] = "Cập nhật thông tin thành công.";
                            header('Location: ' . _WEB_ROOT_ . '/trang-ca-nhan');
                            exit;
                        }
                    }
                }
            }
            // Truyền lỗi vào view

            // Truyền thông tin vào view
            $this->data['page_title'] = 'Trang cá nhân';
            $this->data['content'] = 'auth/update_profile';
            $this->render('layout/client', $this->data);
        }
    }

    //forget_password
    // public function forget_password()
    // {
    //     require_once '' ._DIR_ROOT . '/mail/mailer.php';
    //     $mail = new Mailer();
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //         $email = $_POST['email'] ?? '';

    //         if (empty($email)){
    //            $_SESSION['error'] = "Email không được để trống.";
    //             header ('Location :' ._WEB_ROOT_. '/quen-mat-khau');
    //             exit();
    //         }

    //         if (empty($this->errorMessage)){
    //             $user = new AuthModel();
    //             $user -> setEmail($email);
    //             $result = $this -> auth_model -> getUserEmail($email);

    //             if ($result){
    //                 $code = substr(rand(0, 999999), 0 ,6); //Tạo mã xác nhận 6 số
    //                 $title = "Quên mật khẩu";
    //                 $content = "Mã xác nhận của bạn là: <span style ='color: #f10909'>" . $code ."</span>";

    //                 $mail = new Mailer();
    //                 $userEmail = $result['email'];

    //                 if ($mail -> sendAcessToken($title, $content, $userEmail)){
    //                     $_SESSION['email'] = $userEmail;
    //                     $_SESSION['code'] = $code;

    //                     header('Location: ' . _WEB_ROOT_ . '/trang-xac-nhan');
    //                     exit;
    //                 } else {
    //                    $_SESSION['error'] = "Không thể gửi email, vui lòng thử lại";
    //                     header('Location: ' . _WEB_ROOT_ . '/quen-mat-khau');
    //                     exit;
    //                 }
    //             } else {
    //               $_SESSION['error'] = "Email không tồn tạitại";
    //                 header('Location: ' . _WEB_ROOT_ . '/quen-mat-khau');
    //                 exit;
    //             }
    //         }
    //     }
    //     $this->data['page_title'] = 'Quên mật khẩu';
    //     $this->data['content'] = 'auth/forget_pass';
    //     $this->render('layout/client', $this->data);
    // }

    // public function check_verify()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $text = $_POST['text'] ?? '';
    //         if ($text != $_SESSION['code']) {
    //            $_SESSION['error'] = "Mã xác nhận không hợp lệ";
    //             header('Location: ' . _WEB_ROOT_ . '/trang-xac-nhan');
    //             exit;
    //         } else {
    //             header('Location: ' . _WEB_ROOT_ . '/doi-mat-khau');
    //             exit;
    //         }
    //     }

    //     // Cài đặt thông tin cho view
    //     $this->data['page_title'] = 'Mã xác nhận';
    //     $this->data['content'] = 'auth/verify';
    //     $this->render('layout/client', $this->data);
    // }
    public function forget_password()
    {
        require_once '' . _DIR_ROOT . '/mail/mailer.php';
        $mail = new Mailer();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            if (empty($email)) {
                $_SESSION['error'] = "Email không được để trống.";
                header('Location: ' . _WEB_ROOT_ . '/quen-mat-khau');
                exit();
            }

            if (empty($this->errorMessage)) {
                $user = new AuthModel();
                $user->setEmail($email);
                $result = $this->auth_model->getUserEmail($email);

                if ($result) {
                    // Tạo mã xác nhận 6 số
                    $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                    $title = "Quên mật khẩu";
                    $content = "Mã xác nhận của bạn là: <span style='color: #f10909'>" . $code . "</span>";

                    $mail = new Mailer();
                    $userEmail = $result['email'];

                    if ($mail->sendAcessToken($title, $content, $userEmail)) {
                        $_SESSION['email'] = $userEmail;
                        // Thiết lập cookie 'verify_code' tồn tại trong 60 giây
                        setcookie('verify_code', $code, time() + 60, "/");
                        header('Location: ' . _WEB_ROOT_ . '/trang-xac-nhan');
                        exit;
                    } else {
                        $_SESSION['error'] = "Không thể gửi email, vui lòng thử lại";
                        header('Location: ' . _WEB_ROOT_ . '/quen-mat-khau');
                        exit;
                    }
                } else {
                    $_SESSION['error'] = "Email không tồn tại";
                    header('Location: ' . _WEB_ROOT_ . '/quen-mat-khau');
                    exit;
                }
            }
        }
        $this->data['page_title'] = 'Quên mật khẩu';
        $this->data['content'] = 'auth/forget_pass';
        $this->render('layout/client', $this->data);
    }


    public function check_verify()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $text = $_POST['text'] ?? '';
            // Lấy mã xác nhận từ cookie
            $cookieCode = $_COOKIE['verify_code'] ?? '';
            if ($text != $cookieCode) {
                $_SESSION['error'] = "Mã xác nhận không hợp lệ";
                header('Location: ' . _WEB_ROOT_ . '/trang-xac-nhan');
                exit;
            } else {
                header('Location: ' . _WEB_ROOT_ . '/doi-mat-khau');
                exit;
            }
        }

        // Cài đặt thông tin cho view
        $this->data['page_title'] = 'Mã xác nhận';
        $this->data['content'] = 'auth/verify';
        $this->render('layout/client', $this->data);
    }


    public function reset_password()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_SESSION['email'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (empty($new_password) || empty($confirm_password)) {
              $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin.';
            } else if ($new_password !== $confirm_password) {
              $_SESSION['error'] = "Mật khẩu mới và xác nhận mật khẩu không trùng khớp.";
                header('Location: ' . _WEB_ROOT_ . '/doi-mat-khau');
                exit;
            } else {
                $uppercase = preg_match('/[A-Z]/', $new_password);
                $specialChar = preg_match('/[\W_]/', $new_password);
                $hasNumber = preg_match('/\d/', $new_password);
                $minLength = strlen($new_password) >= 8;

                if (!$uppercase || !$specialChar || !$hasNumber || !$minLength) {
                   $_SESSION['error'] = "Mật khẩu mới phải có ít nhất 8 ký tự, chứa ít nhất 1 chữ in hoa, 1 ký tự đặc biệt và 1 chữ số. ";
                    header('Location: ' . _WEB_ROOT_ . '/doi-mat-khau');
                    exit;
                } else {
                    $user = new AuthModel();
                    $user->setEmail($email);

                    if ($this->auth_model->getUserEmail($email)) {
                        $user->setPassword($new_password);
                        $this->auth_model->updatePass($user);
                       $_SESSION['success'] = "Cập nhật mật khẩu thành công ! ";
                        header('Location: ' . _WEB_ROOT_ . '/dang-nhap');
                        exit;
                    } else {
                       $_SESSION['error'] = "Cập nhật mật khẩu không thành công, vui lòng thử lại. ";
                        header('Location: ' . _WEB_ROOT_ . '/doi-mat-khau');
                        exit;
                    }
                }
            }
            // Truyền lỗi vào view
        }
        // Cài đặt thông tin cho view
        $this->data['page_title'] = 'Đổi mật khẩu';
        $this->data['content'] = 'auth/reset_pass';
        $this->render('layout/client', $this->data);
    }
}
