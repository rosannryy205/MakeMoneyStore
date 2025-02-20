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

}
