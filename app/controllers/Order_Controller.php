<?php
require "./core/Controller.php";

class Order_Controller extends Controller
{

    public $cart_model;
    public $data = [];
    public $errorMessage = null;
    public $successMessage = null;

    public function __construct()
    {
        $this->cart_model = $this->model('CartModel');
    }

    public function addOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cart_id = $_POST['cart_id'];
            $tongtien = $_POST['tong_tien'];
            $soluong = $_POST['so_luong'];
            $this->cart_model->addOrder($cart_id, $soluong, $tongtien);
            header('location:'._WEB_ROOT_.'/');
            exit;
           
        }
    }


}
