<?php
require "./core/Controller.php";

class Admin_User_Controller extends Controller
{

    public $admin_user_model;
    public $data = [];

    public function __construct()
    {
        $this->admin_user_model = $this->model('Admin_User_Model');
    }

    public function index()
    {
       

        $this->data['page_title'] = 'Trang chủ Admin';
        $this->data['content'] = 'admin/index';

        // Thêm nhiều sub_content
        $this->data['sub_content'] = [];

        $this->render('layout/admin', $this->data);
    }
   
    public function user()
    {
        $users = $this->admin_user_model->getAllUser();
        $this->data['content'] = 'admin/admin_user';
        $this->data['sub_content'] = ['users' => $users];
        $this->render('layout/admin', $this->data);
    }
    public function edit_user($id)
    {
        $user = $this->admin_user_model->getUserById($id);
        $this->data['content'] = 'admin/edit_user';
        $this->data['sub_content'] = ['user' => $user];
        $this->render('layout/admin', $this->data);
    }

    public function update_user($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? '';

            if (!in_array($status, ['active', 'block'])) {
                $_SESSION['error'] = "Trạng thái không hợp lệ! Chỉ chấp nhận active hoặc block";
                header('Location: ' . _WEB_ROOT_ . '/admin/edit_user/' . $id);
                exit;
            }

            $this->admin_user_model->setID($id);
            $this->admin_user_model->setStatus($status);
            if ($this->admin_user_model->updateUser($this->admin_user_model)) {
                $_SESSION['success'] = "Cập nhật thành công!";
            } else {
                $_SESSION['error'] = "Cập nhật thất bại!";
            }
            header('Location: ' . _WEB_ROOT_ . '/admin/user');
            exit;
        }

        $this->data['content'] = 'admin/edit_user';
        $this->data['sub_content'] = [];
        $this->render('layout/admin', $this->data);
    }


}
