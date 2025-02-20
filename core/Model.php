<?php

require_once 'Database.php'; // Đường dẫn đến tệp Database
class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database(); // Gọi lớp Database
    }
}
