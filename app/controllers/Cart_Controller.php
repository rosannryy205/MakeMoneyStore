<?php
require "./core/Controller.php";

class Cart_Controller extends Controller
{

    public $cart_model;
    public $data = [];
    public $errorMessage = null;
    public $successMessage = null;

    public function __construct()
    {
        $this->cart_model = $this->model('CartModel');
    }

    public function index()
    {
        $order = $this->cart_model = $this->model('CartModel');
        $cart = [];

        if (isset($_SESSION['user'])) {
            $cart = $order->getProductInCart($_SESSION['user']['id']) ?? [];
        }
        $this->data['page_title'] = 'Theo dõi đơn hàng';
        $this->data['content'] = 'cart/index';
        $this->data['sub_content'] = [
            'cart' => $cart,
        ];
        $this->render('layout/client', $this->data);

        
    }

    public function order_tracking()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Bạn cần đăng nhập để xem đơn hàng";
            header("Location:" . _WEB_ROOT_ . "/dang-nhap");
            exit;
        }

        $order = $this->cart_model->getAllOrderByUser($_SESSION['user']['id']);
        $this->data['page_title'] = 'Theo dõi đơn hàng';
        $this->data['content'] = 'cart/order_tracking';
        $this->data['sub_content'] = [
            'order' => $order,
        ];
        $this->render('layout/client', $this->data);
    }


    public function add_to_cart()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
            $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
            $size_id    = isset($_POST['size_id'])    ? $_POST['size_id']    : null;

            if (!isset($_SESSION['user'])) {
                $_SESSION['error'] = "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!";
                header("Location: " . _WEB_ROOT_ . "/dang-nhap");
                exit;
            }

            if (!isset($size_id)) {
                $_SESSION['error'] = "Bạn cần chọn size cho sản phẩm !";
                header("Location: " . _WEB_ROOT_ . "/chi-tiet-san-pham/" . $product_id);
                exit;
            }

            if (isset($_SESSION['user'])) {
                $user_id = $_SESSION['user']['id'];
                $order = $this->cart_model = $this->model('CartModel');
                $cart = $this->cart_model->getCartByUser($user_id);
                if (!$cart) {
                    $order->addCart($user_id);
                    $cart = $this->cart_model->getCartByUser($user_id);
                
                }
                $result = $order->addProduct($cart['id'], $product_id, $size_id, $quantity);

                if ($result === false) {
                    $_SESSION['error'] = "Bạn cần chọn size cho sản phẩm !!";
                    header("Location: " . _WEB_ROOT_ . "/chi-tiet-san-pham/" . $product_id);
                    exit;
                }
            }
            header("location: " . _WEB_ROOT_ . "/gio-hang");
        } 
    }


    public function delete($id,$product_id,$size_id)
    {
        if ($this->cart_model->deleteCartItem($id, $product_id, $size_id)) {
            $_SESSION['success'] = "Xóa sản phẩm khỏi giỏ hàng thành công!";
        } else {
            $_SESSION['error'] = "Không thể xóa sản phẩm!";
        }

        header("Location: " . _WEB_ROOT_ . "/gio-hang");
        exit();
    }

    public function cartItem($id, $product_id, $loai)
    {
        $this->cart_model = $this->model('CartModel'); // Load model đúng cách
        if (!$this->cart_model) {
            die("Lỗi: Không thể tải model CartModel");
        }

        if ($loai == 'more') {
            $this->cart_model->increaseItem($id, $product_id);
        } else {
            $this->cart_model->decreaseItem($id, $product_id);
        }

        header("Location: " . _WEB_ROOT_ . "/gio-hang");
    }


    
}
