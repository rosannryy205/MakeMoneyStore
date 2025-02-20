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


   
}
