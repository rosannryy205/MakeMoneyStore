<?php
require "./core/Model.php";

class CartModel extends Model
{
    private $id;
    private $user_id;
    private $product_id;
    private $quantity;
    private $total_amount;

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

    public function addProduct($id, $product_id, $product_sizes_id, $quantity)
    {
        if (empty($product_sizes_id)) {
            return false;
        }

        $kq = $this -> hasCart($id, $product_id, $product_sizes_id);
        if($kq){
            $sql = "UPDATE cart_detail SET quantity = quantity + ?  WHERE id = ? AND product_id = ? AND product_sizes_id = ?";
            $params = [
                $quantity,
                $id,
                $product_id,
                $product_sizes_id
            ];
            return $this -> db -> update($sql, $params);
        } else {
            $sql = "INSERT INTO cart_detail(`id`, `product_id` , `product_sizes_id` , `quantity`) VALUES (?,?,?,?)";
            $params = [
                $id,
                $product_id,
                $product_sizes_id,
                $quantity,
            ];
            return $this->db->insert($sql,$params);
        }

    }

    public function hasCart($id, $product_id, $product_sizes_id){
        $sql = "SELECT * FROM cart_detail WHERE id = ? AND product_id = ? AND product_sizes_id = ? ";
        $params = [
            $id,
            $product_id,
            $product_sizes_id
        ];
        return $this->db->getOne($sql, $params);
    }

    public function getProductInCart($user_id){
            $sql = "SELECT 
                c.id,
                p.id AS product_id,
                p.name AS product_name,
                p.price,
                cd.quantity,
                cd.product_sizes_id,
                s.size_name,
                (
                    SELECT pi.image_show 
                    FROM product_images pi 
                    WHERE pi.product_id = p.id 
                    ORDER BY pi.id ASC
                    LIMIT 1
                ) AS image_show
            FROM carts c 
            INNER JOIN cart_detail cd ON c.id = cd.id
            INNER JOIN products p ON p.id = cd.product_id
            INNER JOIN product_sizes ps ON ps.id = cd.product_sizes_id  
            INNER JOIN sizes s ON s.id = ps.size_id  
            WHERE c.user_id = :user_id
            AND c.status = 'gio-hang' 
            LIMIT 0, 25;
            ;
                    ";

        return $this -> db -> getAll($sql, [':user_id' => $user_id]);

    }

    public function getOneProduct($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        return $this->db->getOne($sql, [':id' => $id]);
    }

    public function deleteCartItem($id, $product_id, $size_id)
    {
        $sql = "DELETE FROM cart_detail WHERE id = ? AND product_id = ? AND size_id = ?";
        $params = [
            $id,
            $product_id,
            $size_id
        ];
        return $this -> db -> delete($sql, $params);
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

    public function addOrder($id, $soluong, $tongtien)
    {
        $dateTime = date("Y-m-d H:i:s"); 
        $sql = "UPDATE carts SET quantity = ?, total_amount = ?, create_at = ?, status = 'cho-xac-nhan' WHERE id = ?";
        $params = [
            $soluong,
            $tongtien,
            $dateTime,
            $id
        ];
        $this->db->update($sql, $params);

        $sql2 ="UPDATE cart_detail cd SET price = (
                SELECT price FROM products p WHERE cd.product_id = p.id
        ) WHERE id = ?";
        $params2 = [
            $id
        ];
        return $this->db->update($sql2, $params2);
    }

    public function getAllOrderByUser($id)
    {
        $sql = "SELECT c.status as trangthai, c.id as id_cart, c.*, u.*,cd.product_id,cd.product_sizes_id,p.name AS name_product,p.price,pi.image_show,s.size_name
                FROM carts c 
                INNER JOIN users u ON c.user_id = u.id
                INNER JOIN cart_detail cd ON c.id = cd.id
                INNER JOIN products p ON cd.product_id = p.id
                INNER JOIN product_sizes ps ON cd.product_sizes_id = ps.id
                INNER JOIN sizes s ON ps.size_id = s.id
                LEFT JOIN product_images pi ON p.id = pi.product_id
                AND (pi.image_show IS NOT NULL AND pi.image_show <> '')
                WHERE c.status <> 'gio-hang' AND user_id = ?
                ";

                $params = [
                    $id
                ];

        return $this->db->getAll($sql,$params);
    }




}
