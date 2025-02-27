<?php
require "./core/Controller.php";

class Home_Controller extends Controller
{

    public $product_model;
    public $data = [];

    public function __construct()
    {
        $this-> product_model = $this -> model('ProductModel');
    }

    public function index()
    {
        $pros = $this->product_model -> getSales();
        $this->data['page_title'] = 'Trang chủ';
        $this->data['content'] = 'home/index';
        $this->data['sub_content']['pros'] = $pros;
        $this->render('layout/client', $this->data);
    }

    public function fav()
    {
        if (!isset($_SESSION['user']['id'])) {
            $_SESSION['error'] = "Bạn cần đăng nhập để xem danh sách yêu thích!";
            header("Location: " . _WEB_ROOT_ . "/dang-nhap");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $fav = $this->product_model->getAllFav($user_id);
        
        $this->data = [
            'page_title' => 'Danh sách yêu thích',
            'content' => 'fav/index', 
            'sub_content' => [
                'fav' => $fav, 
            ]
        ];

        $this->render('layout/client', $this->data);
    }



    public function addfav($id)
    {
        if (!isset($_SESSION['user']['id'])) {
            $_SESSION['error'] = "Bạn cần đăng nhập để thêm sản phẩm vào yêu thích!";
            header("Location: " . _WEB_ROOT_ . "/dang-nhap");
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        if ($this->product_model->getFavProById($user_id, $id)) {
            $_SESSION['error'] = "Sản phẩm này đã có trong danh sách yêu thích!";
            header("Location: " . _WEB_ROOT_ . "/chi-tiet-san-pham/" . $id);
            exit;
        } else {
            $this->product_model->addfav($id, $user_id);
        }


        header("Location: " . _WEB_ROOT_ . "/trang-yeu-thich");
        exit;
    }
    public function deletefav($id)
    {
        
        $user_id = $_SESSION['user']['id'];

        if ($this->product_model->getFavProById($user_id, $id)) {
            $this->product_model->deleteFav($user_id,$id);
            header("Location: " . _WEB_ROOT_ . "/chi-tiet-san-pham/" . $id);
            exit;
        } 


        header("Location: " . _WEB_ROOT_ . "/trang-yeu-thich");
        exit;
    }



   
}
