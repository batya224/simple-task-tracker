<?php

/**
 * Database class
 */
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $db_name = DB_NAME;

    private $db_handler;
    private $statement;
    private $error;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->db_handler = new PDO($dsn, $this->user, $this->password, $options);

        } catch (PDOException $e) {
            //throw $e;
            $this->error = $e->getMessage();
            echo ($this->error);
        }
    }

    public function query($sql, $fetch, $bind = false)
    {
        $prepared = $this->db_handler->prepare($sql);

        if (!$bind) {

            if ($fetch == 'execute') {
                return $prepared->execute();
            }
            $prepared->execute();
            return $prepared->$fetch(PDO::FETCH_OBJ);
        }


        if ($fetch == 'execute') {
            return $prepared->execute($bind);
        }

        $prepared->execute($bind);
        return $prepared->$fetch(PDO::FETCH_OBJ);

    }


    public function fetch_all($values = false)
    {

        if ($values != false) {
            $this->statement->execute($values);
        } else {
            $this->statement->execute();
        }

        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function fetch_single($values)
    {
        if ($values != false) {
            $this->statement->execute($values);
        } else {
            $this->statement->execute();
        }
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    public function row_count()
    {
        return $this->statement->rowCount();
    }
}
