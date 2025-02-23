<?php
require "./core/Controller.php";

class Admin_Order_Controller extends Controller
{

    public $admin_cate_model;
    public $data = [];

    public function __construct()
    {
        $this->admin_cate_model = $this->model('Admin_Cate_Model');
    }

    public function index()
    {
        $this->data['page_title'] = 'Trang chủ Admin';
        $this->data['content'] = 'admin/admin_order';

        // Thêm nhiều sub_content
        $this->data['sub_content'] = [];

        $this->render('layout/admin', $this->data);
    }

}
