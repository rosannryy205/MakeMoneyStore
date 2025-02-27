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
        $sql = "SELECT c.status as trangthai, c.id as id_cart, c.*, u.*,cd.product_id,cd.product_sizes_id,p.name AS name_product,p.price,pi.image_show
                FROM carts c 
                INNER JOIN users u ON c.user_id = u.id
                INNER JOIN cart_detail cd ON c.id = cd.id
                INNER JOIN products p ON cd.product_id = p.id
                LEFT JOIN product_images pi ON p.id = pi.product_id
                AND (pi.image_show IS NOT NULL AND pi.image_show <> '')
                WHERE c.status <> 'gio-hang'
                ";

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

            $sqlDelete = "DELETE FROM carts WHERE id = ?";
            return $this->db->update($sqlDelete, [$cart_id]);  
        }

        return false;
    }


   



}
