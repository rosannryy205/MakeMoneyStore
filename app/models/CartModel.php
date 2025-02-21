<?php
require "./core/Model.php";

class CartModel extends Model
{
    private $id;
    private $user_id;
    private $product_id;
    private $size_id;
    private $quantity;

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Getter & Setter cho id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter & Setter cho user_id
    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    // Getter & Setter cho product_id
    public function getProductId()
    {
        return $this->product_id;
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    // Getter & Setter cho size_id
    public function getSizeId()
    {
        return $this->size_id;
    }

    public function setSizeId($size_id)
    {
        $this->size_id = $size_id;
    }

    // Getter & Setter cho quantity
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getCartByUser($user_id){
        $sql = "SELECT * FROM carts WHERE user_id = :user_id AND status = 'gio-hang'";
        return $this -> db -> getOne($sql, [':user_id' => $user_id]);
    }

    public function addCart($user_id){
        $sql = "INSERT INTO carts(`user_id`) VALUE (:user_id)";
        return $this -> db -> insert($sql, [':user_id' => $user_id]);

    }

    public function addProduct($id, $product_id)
    {
        $kq = $this -> hasCart($id, $product_id);
        if($kq){
            $sql = "UPDATE cart_detail SET quantity = quantity + 1 WHERE id = :id AND product_id = :product_id";
            return $this -> db -> update($sql, [':id' => $id, ':product_id' => $product_id]);
        } else {
            $sql = "INSERT INTO cart_detail(`id`, `product_id`) VALUES (:id, :product_id)";
            return $this->db->insert($sql, [':id' => $id, ':product_id' => $product_id]);
        }

    }

    public function hasCart($id, $product_id){
        $sql = "SELECT * FROM cart_detail WHERE id = :id AND product_id = :product_id";
        return $this->db->getOne($sql, [':id' => $id, ':product_id' => $product_id]);
    }

    public function getProductInCart($user_id){
        $sql = "SELECT c.id, p.id AS product_id, p.name, p.image, p.price, cd.quantity 
        FROM carts c 
        INNER JOIN cart_detail cd ON c.id = cd.id 
        INNER JOIN products p ON p.id = cd.product_id 
        WHERE c.user_id = :user_id AND c.status = 'gio-hang'";

        return $this -> db -> getAll($sql, [':user_id' => $user_id]);

    }

    public function getOneProduct($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        return $this->db->getOne($sql, [':id' => $id]);
    }

    public function deleteCartItem($id, $product_id)
    {
        $sql = "DELETE FROM cart_detail WHERE id = :id AND product_id = :product_id";
        return $this -> db -> delete($sql, [':id' => $id, ':product_id' => $product_id]);
    }
    
    public function increaseItem($id, $product_id){
        $sql = "UPDATE cart_detail SET quantity = quantity + 1 WHERE $id = :id AND product_id = :product_id";
        return $this -> db -> update($sql, [':id'=>$id,':product_id'=>$product_id]);   
    }
    public function decreaseItem($id, $product_id)
    {
        $sql_check = "SELECT quantity FROM cart_detail WHERE id = :id AND product_id = :product_id";
        $currentQuantity = $this->db->getOne($sql_check, [':id' => $id, ':product_id' => $product_id]);

        if ($currentQuantity && $currentQuantity['quantity'] > 1) {

            $sql_update = "UPDATE cart_detail SET quantity = quantity - 1 WHERE id = :id AND product_id = :product_id";
            return $this->db->update($sql_update, [':id' => $id, ':product_id' => $product_id]);

        } else {

            $sql_delete = "DELETE FROM cart_detail WHERE id = :id AND product_id = :product_id";
            return $this->db->delete($sql_delete, [':id' => $id, ':product_id' => $product_id]);
        }
    }


}
