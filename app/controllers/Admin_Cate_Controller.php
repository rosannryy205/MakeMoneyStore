<?php
require "./core/Controller.php";

class Admin_Cate_Controller extends Controller
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
        $this->data['content'] = 'admin/index';

        // Thêm nhiều sub_content
        $this->data['sub_content'] = [];

        $this->render('layout/admin', $this->data);
    }
    public function category()
    {
        $cate = $this->admin_cate_model->getAllCate();
        $this->data['content'] = 'admin/admin_cate';
        $this->data['sub_content'] = ['cate' => $cate];
        $this->render('layout/admin', $this->data);
    }

    public function product()
    {
        $pros = $this->admin_cate_model->getAllPro();
        $this->data['content'] = 'admin/admin_product';
        $this->data['sub_content'] = ['pros' => $pros];
        $this->render('layout/admin', $this->data);
    }

    public function user()
    {
        $users = $this->admin_cate_model->getAllUser();
        $this->data['content'] = 'admin/admin_user';
        $this->data['sub_content'] = ['users' => $users];
        $this->render('layout/admin', $this->data);
    }

    public function order()
    {
        $this->data['content'] = 'admin/admin_order';
        $this->data['sub_content'] = [];
        $this->render('layout/admin', $this->data);
    }

    public function edit_cate($id)
    {
        $cate = $this->admin_cate_model->getOneCate($id);

        $this->data['page_title'] = 'Trang chủ Admin';
        $this->data['content'] = 'admin/edit_cate';

        // Thêm nhiều sub_content
        $this->data['sub_content'] = [
            'cate' => $cate,
        ];

        $this->render('layout/admin', $this->data);
    }

    public function update_cate($id)
    {
        $error = [];
        $cate = [];

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $cate = $this->admin_cate_model->getOneCate($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');

            if (empty($name)) {
                $error[] = "Vui lòng điền tên của danh mục.";
            }

            if (empty($error)) {
             
                $this->admin_cate_model->setId($id);
                $this->admin_cate_model->setName($name);
                $this->admin_cate_model->updateCate($this->admin_cate_model);
                header("Location: " . _WEB_ROOT_ . "/admin/category");
                exit;
            }

            $cate = ['id' => $id, 'name' => $name];
        }

        $this->data['page_title'] = 'Chỉnh sửa danh mục';
        $this->data['content'] = 'admin/edit_cate';
        $this->data['sub_content'] = [
            'cate' => $cate,
            'errors' => $error
        ];

        $this->render('layout/admin', $this->data);
    }
    
    public function delete_cate($id){
        $check = $this -> admin_cate_model -> checkCate($id);
        if($check){
            $_SESSION['error'] = "Không thể xóa danh mục vì có sản phẩm nằm trong danh mục";
            header("Location: " . _WEB_ROOT_ . "/admin/category");
            exit;
        }else{
            $this -> admin_cate_model -> deleteCate($id);
            $_SESSION['success'] = "Xóa danh mục thành công";
            header("Location: " . _WEB_ROOT_ . "/admin/category");
            exit;
        }
    }

    public function insert_cate_page(){
        $this->data['content'] = 'admin/insert_cate';
        $this->data['sub_content'] = [];
        $this->render('layout/admin', $this->data);
    }

    public function insert_cate(){
        $error=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $name = $_POST['name'] ?? '';
            if(empty($name)){
                 $error[]='Vui lòng không để trống thông tin';
            }else{
                $this -> admin_cate_model -> setName($name);
                $this -> admin_cate_model -> insertCate($this->admin_cate_model);
                header('location:' ._WEB_ROOT_. '/admin/category');
                exit;
            }
        }
        $this->data['content'] = 'admin/insert_cate';
        $this->data['sub_content'] = [
            'errors' => $error
        ];
        $this->render('layout/admin', $this->data);
    }



}
