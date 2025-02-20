<?php
require "./core/Model.php";

class AuthModel extends Model
{
    private $id;
    private $image = null;
    private $name;
    private $email;
    private $password;
    private $phone;
    private $address;
    private $role = 0;

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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function insert_user(AuthModel $user)
    {
        $name = $user->getName();
        $phone = $user->getPhone();
        $email = $user->getEmail();
        $image = $user->getImage() !== null ? $user->getImage() : null;
        $password = $user->getPassword();
        $address = $user->getAddress() !== null ? $user->getAddress() : null;
        $sql = "INSERT INTO users (image, name, email, password, phone, address) VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $image,
            $name,
            $email,
            $password,
            $phone,
            $address,
        ];
        return $this->db->insert($sql, $params);
    }


    public function getUserEmail(string $email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        return $this->db->getOne($sql, [$email]);
    }

    public function login(AuthModel $user)
    {
        $sql = "SELECT * FROM users WHERE email = :email AND status = 0 LIMIT 1";
        $db_user = $this->db->getOne($sql, ['email' => $user->getEmail()]);


        if ($db_user) {

            if ($db_user['status'] != 1 && trim($user->getPassword()) === trim($db_user['password'])) {
                return $db_user;
            }

        }

        return false;
    }




    public function update_profile(AuthModel $user){
        $id = $user -> getId();
        $name = $user -> getName();
        $phone = $user -> getPhone();
        $email = $user -> getEmail();
        $image = $user -> getImage() !== null ? $user -> getImage() : null ; 
        $password = $user -> getPassword();
        $address = $user -> getAddress() !== null ? $user -> getAddress() : null;
        $sql = "UPDATE users SET image = ?, name = ?, email = ?, password = ?, phone = ?, address = ? WHERE id = ?";
        $params = [
            $image,
            $name,
            $email,
            $password,
            $phone,
            $address,
            $id
        ];
        return $this -> db -> update($sql, $params);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $params = ['id' => $id];
        return $this->db->getOne($sql, $params);
    }

    public function updatePass( AuthModel $user)
    {
        $email = $user -> getEmail();
        $password = $user -> getPassword();
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $params = [
            $password,
            $email
        ];

        return $this -> db -> update($sql, $params);
    }
}
