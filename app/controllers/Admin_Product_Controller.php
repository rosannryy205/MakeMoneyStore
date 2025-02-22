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
    
    public function insert_product(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $name = $_POST['name'];
            $image = '';
            $price = $_POST['price'];
            $sale_percent = $_POST['sale_percent'];
            $description = $_POST['description'];
            $cate = $_POST['cate'];

            if(empty($name)  || empty($price) || empty($sale_percent) || empty($description) || empty($cate)){
                $_SESSION['error']="Vui lòng điền đầy đủ thông tin";
                header("location:"._WEB_ROOT_. "/admin/insert_product_page");
                exit;
            }
            if(isset($_FILES['image'])&&$_FILES['image']['error']===UPLOAD_ERR_OK){
                $uploadDir = "public/image_product/";
                $fileName = time().'-'. basename($_FILES['image']['name']);
                $targetFile = $uploadDir . $fileName;
            }
            if(move_uploaded_file($_FILES['image']['tmp_name'],$targetFile)){
                $image = $fileName;
            } else {
                $_SESSION['error'] ="Thêm ảnh thất bại";
            }

            if(empty($_SESSION['error'])){
                $this -> admin_product_model -> setName($name);
                $this -> admin_product_model -> setImageUrl($image);
                $this -> admin_product_model -> setPrice($price);
                $this -> admin_product_model -> setSalepercent($sale_percent);
                $this -> admin_product_model -> setDescription($description);
                $this -> admin_product_model -> setCategoryId($cate);
                $this -> admin_product_model -> insertProduct($this->admin_product_model);
                header("location:"._WEB_ROOT_."/admin/product");
                exit;
            }

        } else {
            $_SESSION['error'] = "Thêm sản phẩm thất bại";
        }
        $this->data['content'] = 'admin/insert_product';
        $this->data['sub_content'] = [];
        $this->render('layout/admin', $this->data);
    }

    public function delete($id)
    {
        // Lấy thông tin sản phẩm trước khi xóa
        $product = $this->admin_product_model->getProductById($id);
        $productName = $product['name']; 

        if ($this->admin_product_model->deleteProduct($id)) {
            $_SESSION['success'] = "Xóa sản phẩm '" . $productName . "' thành công";
            header("Location: " . _WEB_ROOT_ . "/admin/product");
            exit;
        } else {
            $_SESSION['error'] = "Xóa sản phẩm '" . $productName . "' thất bại";
            header("Location: " . _WEB_ROOT_ . "/admin/product");
            exit;
        }

        $this->data['content'] = 'admin/product';
        $this->data['sub_content'] = [];
        $this->render('layout/admin', $this->data);
    }

    
}
