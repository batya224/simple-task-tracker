<?php

/**
 * undocumented class
 */
class Task
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function get_tasks($request_params = [])
    {
        $sql = "SELECT * FROM tasks";
        $sql_total = "SELECT * FROM tasks";

        $sort_order = isset($request_params['sort_order']) ? $request_params['sort_order'] : 'ASC';
        if (isset($request_params['sort_by'])) {
            $sql = $sql . ' ORDER BY ' . $request_params['sort_by'] . ' ' . $sort_order;
        }


        $page_size = isset($request_params['page_size']) ? $request_params['page_size'] : 3;
        $current_page = isset($request_params['page']) ? $request_params['page'] : 1;
        $offset = ($current_page - 1) * $page_size;
        $sql = $sql . " LIMIT $offset, $page_size";


        $execute = array();
        $result = $this->db->query($sql, 'fetchAll', $execute);
        $total = $this->db->query($sql_total, 'rowCount', $execute);

        return [
            'list' => $result,
            'total' => $total
        ];
    }


    public function get_task($column, $value)
    {

        $sql = "SELECT *, tasks.ID as taskID FROM tasks WHERE tasks.{$column} = :val";
        $execute = array(':val' => $value);

        $result = $this->db->query($sql, 'fetchAll', $execute);

        if (!empty($result)) {
            return $result;
        }

        return false;
    }

    public function add_task($data)
    {
//        $task_author = get_user_id();

        $sql = "INSERT INTO tasks (username,email,description,status) VALUES (:username,:email,:description,:status)";
        $execute = array(
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':description' => $data['description'],
            ':status' => 0,
        );

        $result = $this->db->query($sql, 'execute', $execute);

        if ($result) {
            return true;
        }
        return false;
    }

    public function update_task($data)
    {
        $modified_user_id = get_user_id();
        $sql = "UPDATE tasks SET username = :username, email= :email , description= :description, status= :status, modified_user_id= :modified_user_id, modified_time=:modified_time WHERE id = :id";
        $execute = array(
            ':id' => $data['id'],
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':description' => $data['description'],
            ':status' => $data['status'],
            ':modified_user_id' => $modified_user_id,
            ':modified_time' => $data['modified_time'],
        );

        $result = $this->db->query($sql, 'execute', $execute);

        if ($result) {
            return true;
        }
        return false;
    }

    public function delete_task($id)
    {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $execute = array(
            ':id' => $id,
        );

        $result = $this->db->query($sql, 'execute', $execute);

        if ($result) {
            return true;
        }
        return false;
    }
}
