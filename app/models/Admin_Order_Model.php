<?php
require "./core/Model.php";

class Admin_Order_Model extends Model
{
    private $id;
    private $user_id;
    private $quantity;
    private $total_amount;
    private $status;

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getTotalAmount()
    {
        return $this->total_amount;
    }
    public function setTotalAmount($total_amount)
    {
        $this->total_amount = $total_amount;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getAllOrder(){
        $sql = "SELECT c.status as trangthai, c.id as id_cart, c.*, u.* FROM carts c INNER JOIN users u ON c.user_id = u.id";
        return $this ->db->getAll($sql);
    }

    public function getOrderById($id){
        $sql = "SELECT c.status as trangthai, c.id as id_cart, c.*, u.* FROM carts c INNER JOIN users u ON c.user_id = u.id WHERE c.id = ?";
        return $this ->db->getOne($sql,[$id]);
    }


    public function updateOrderStatus($cart_id)
    {
        $sql = "UPDATE carts 
            SET status = CASE status
                WHEN 'cho-xac-nhan' THEN 'dang-chuan-bi'
                WHEN 'dang-chuan-bi' THEN 'dang-giao-hang'
                WHEN 'dang-giao-hang' THEN 'hoan-tat-don-hang'
                ELSE status
            END
            WHERE id = ?";
        $params = [$cart_id];
        return $this->db->update($sql, $params);
    }

    public function deleteCartIfCancelable($cart_id)
    {
    
        $sqlSelect = "SELECT status FROM carts WHERE id = ?";
        $current = $this->db->getOne($sqlSelect, [$cart_id]);
        $currentStatus = is_array($current) && isset($current['status']) ? $current['status'] : $current;

        $cancelable = ['gio-hang', 'cho-xac-nhan', 'dang-chuan-bi'];

        if (in_array($currentStatus, $cancelable)) {
            // Nếu status cho phép hủy, thực hiện xóa
            $sqlDelete = "DELETE FROM carts WHERE id = ?";
            return $this->db->update($sqlDelete, [$cart_id]);  // Giả sử update() thực thi query DELETE
        }

        return false;
    }


   



}
