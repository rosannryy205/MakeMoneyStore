<?php
require "./core/Controller.php";

class Product_Controller extends Controller
{

    public $product_model;
    public $cart_model;
    public $data = [];
    public $errorMessage = null;

    public function __construct()
    {
        $this->product_model = $this->model('ProductModel');
    }

    public function index()
    {
        $pros = $this->product_model->getProducts();
        $this->data['page_title'] = 'Trang sản phẩm';
        $this->data['content'] = 'product/index';
        $this->data['sub_content']['pros'] = $pros;
        $this->render('layout/client', $this->data);
    }

    public function detail_pro($id)
    {
        $prosRelated = $this->product_model->getRelatedProduct();
        $detail = $this->product_model->getOneProduct($id);
        $productImages = $this ->product_model->getProductImages($id);
        $productSizes = $this ->product_model->getProductSizes($id);
        $fav_ids = [];
        if (isset($_SESSION['user']['id'])) {
            $user_id = $_SESSION['user']['id'];
            $fav = $this->product_model->getAllFav($user_id);
            $fav_ids = array_column($fav, 'product_id');
        }
        $this->data['page_title'] = 'Trang chi tiết';
        $this->data['content'] = 'product/product_detail';
        $this->data['sub_content']['detail'] = $detail;
        $this->data['sub_content']['prosRelated'] = $prosRelated;
        $this->data['sub_content']['productImages'] = $productImages;
        $this->data['sub_content']['productSizes'] = $productSizes;
        $this->data['sub_content']['fav_ids'] = $fav_ids;
        $this->render('layout/client', $this->data);
    }

    public function search($keyword = '')
    {
        // Nếu từ khóa tìm kiếm không có trong POST, lấy giá trị từ URL hoặc mặc định là ''
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : $keyword;

        // Nếu không có từ khóa tìm kiếm
        if (empty($keyword)) {
            $this->errorMessage = 'Vui lòng nhập từ khóa tìm kiếm.';
            header("Location: " . _WEB_ROOT_ . "/san-pham");
            exit();
        }

        // Lấy danh sách sản phẩm từ model
        $products = $this->product_model->searchProduct($keyword);

        // Kiểm tra xem có sản phẩm nào không
        if (empty($products)) {
            $this->errorMessage = 'Không tìm thấy sản phẩm phù hợp với từ khóa của bạn.';
        }

        // Truyền dữ liệu cho view
        $this->data['error'] = $this->errorMessage ?? '';
        $this->data['sub_content']['products'] = $products;
        $this->data['page_title'] = 'Kết quả tìm kiếm';
        $this->data['content'] = 'product/search'; // View chứa kết quả tìm kiếm
        $this->render('layout/client', $this->data);
    }


}
