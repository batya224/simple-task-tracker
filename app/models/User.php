<?php

/**
 * undocumented class
 */
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //Find user by username

    public function get_user($column, $value)
    {
        $sql = "SELECT * FROM users WHERE {$column} = :val";
        $execute = array(':val' => $value);
        $result = $this->db->query($sql, 'fetch', $execute);

        if (!empty($result)) {
            return $result;
        }

        return false;
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = :username ";
        $execute = array(
            ':username' => $username,
        );

        $result = $this->db->query($sql, 'fetch', $execute);

        if ($result) {

            $hashed_password = $result->password;

            if (password_verify($password, $hashed_password)) {
                return $result;
            }

            return false;
        }
    }

    public function register($data)
    {
        $sql = "INSERT INTO users (name,username,password) VALUES (:name,:username,:password)";
        $execute = array(
            ':name' => $data['name'],
            ':username' => $data['username'],
            ':password' => $data['password']
        );
        $result = $this->db->query($sql, 'execute', $execute);
        if ($result) {
            return true;
        }
        return false;
    }

}
