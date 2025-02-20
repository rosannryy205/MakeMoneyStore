<?php
require "./core/Controller.php";

class Admin_Product_Controller extends Controller
{

    public $admin_product_model;
    public $data = [];

    public function __construct()
    {
        $this->admin_product_model = $this->model('Admin_Product_Model');
    }

    public function index()
    {

        $pros = $this->admin_product_model->getAllPro();

        $this->data['page_title'] = 'Trang chủ Admin';
        $this->data['content'] = 'admin/index';

        // Thêm nhiều sub_content
        $this->data['sub_content'] = [
            'pros' => $pros,
        ];

        $this->render('layout/admin', $this->data);
    }
    public function product()
    {
        $pros = $this->admin_product_model->getAllPro();
        $this->data['content'] = 'admin/admin_product';
        $this->data['sub_content'] = ['pros' => $pros];
        $this->render('layout/admin', $this->data);
    }
    public function image_product()
    {
        $imgae = $this->admin_product_model->getAllImagePro();
        $this->data['content'] = 'admin/admin_image_pro';
        $this->data['sub_content'] = ['imgae' => $imgae];
        $this->render('layout/admin', $this->data);
    }
    public function insert()
    {
        $cate = $this -> admin_product_model -> getAllCate();
        $this->data['content'] = 'admin/insert_product';
        $this->data['sub_content'] = [
            'cate' => $cate,
        ];
        $this->render('layout/admin', $this->data);
    }
    
}
