<?php
require "./core/Model.php";

class Admin_Cate_Model extends Model
{
    private $id;
    private $name;

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getAllCate(){
        $sql = "SELECT * FROM categories ";
        return $this -> db -> getAll($sql);
    }


    public function getOneCate(string $id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        return $this->db->getOne($sql, [$id]);
    }

    public function updateCate(Admin_Cate_Model $admin)
    {
        $id = $admin -> getId();
        $name = $admin -> getName();
        $sql = "UPDATE categories SET name = ? WHERE id = ?";
        $params = [
            $name,
            $id,
        ];
        return $this->db->update($sql,$params);
    }

    public function checkCate($id){
        $sql = "SELECT COUNT(*) as total FROM products WHERE category_id = ?";
        $params = [$id];
        $result = $this->db->getAll($sql, $params);
        return $result[0]['total'] > 0;
    }
    
    public function deleteCate($id)
    {
        $sql = "DELETE FROM categories WHERE id = ?";
        $params = [$id];
        return $this->db->update($sql, $params);
    }
    public function insertCate(Admin_Cate_Model $admin)
    {   
        $name = $admin -> getName();
        $sql = "INSERT INTO categories(name) VALUES (?)";
        $params = [$name];
        return $this->db->update($sql, $params);
    }

    function getOrderStatistics($db)
    {
        $sql = "SELECT 
                (SELECT COUNT(*) FROM products) AS total_products,
                (SELECT COUNT(*) FROM categories) AS total_categories,
                (SELECT COUNT(*) FROM users WHERE role != 1) AS total_users,
                SUM(CASE WHEN status = 'gio-hang' THEN 1 ELSE 0 END) AS gio_hang,
                SUM(CASE WHEN status = 'cho-xac-nhan' THEN 1 ELSE 0 END) AS cho_xac_nhan,
                SUM(CASE WHEN status = 'dang-chuan-bi' THEN 1 ELSE 0 END) AS dang_chuan_bi,
                SUM(CASE WHEN status = 'dang-giao-hang' THEN 1 ELSE 0 END) AS dang_giao_hang,
                SUM(CASE WHEN status = 'hoan-tat-don-hang' THEN 1 ELSE 0 END) AS hoan_tat_don_hang,
                SUM(CASE WHEN status = 'huy-don' THEN 1 ELSE 0 END) AS huy_don
            FROM carts";

        return $db->getOne($sql);
    }


}
