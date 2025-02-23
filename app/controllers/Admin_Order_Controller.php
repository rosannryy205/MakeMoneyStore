<?php
require "./core/Controller.php";

class Admin_Order_Controller extends Controller
{

    public $admin_order_model;
    public $data = [];

    public function __construct()
    {
        $this->admin_order_model = $this->model('Admin_Order_Model');
    }

    public function index()
    {
        $order = $this -> admin_order_model -> getAllOrder();
        $this->data['page_title'] = 'Trang chủ Admin';
        $this->data['content'] = 'admin/admin_order';

        // Thêm nhiều sub_content
        $this->data['sub_content'] = [
            'order' => $order 
        ];

        $this->render('layout/admin', $this->data);
    }
    public function edit($id)
    {
        $order = $this -> admin_order_model -> getOrderById($id);
        $this->data['page_title'] = 'Trang chủ Admin';
        $this->data['content'] = 'admin/edit_order';

        // Thêm nhiều sub_content
        $this->data['sub_content'] = [
            'order' => $order 
        ];

        $this->render('layout/admin', $this->data);
    }
    public function delete($id)
    {
        $order = $this -> admin_order_model -> getOrderById($id);
        $this->data['page_title'] = 'Trang chủ Admin';
        $this->data['content'] = 'admin/delete_order';

        // Thêm nhiều sub_content
        $this->data['sub_content'] = [
            'order' => $order 
        ];

        $this->render('layout/admin', $this->data);
    }


    public function update_status()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cart_id = $_POST['cart_id'];
            $result = $this->admin_order_model->updateOrderStatus($cart_id);
            if ($result) {
                $_SESSION['success'] = "Cập nhật trạng thái thành công!";
                header('Location: ' . _WEB_ROOT_ . '/admin/order');
                exit;
            } else {
                $_SESSION['error'] = "Cập nhật trạng thái thất bại!";
                header('Location: ' . _WEB_ROOT_ . '/admin/order');
                exit;
            }
        }
    }
    public function delete_status()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cart_id = $_POST['cart_id'];
            $result = $this->admin_order_model->deleteCartIfCancelable($cart_id);
            if ($result) {
                $_SESSION['success'] = "Đơn hàng hủy thành công !";
                header('Location: ' . _WEB_ROOT_ . '/admin/order');
                exit;
            } else {
                $_SESSION['error'] = "Không thể hủy đơn hàng!";
                header('Location: ' . _WEB_ROOT_ . '/admin/order');
                exit;
            }
        }
    }



}
