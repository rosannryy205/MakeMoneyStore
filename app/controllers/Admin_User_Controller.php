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

}
