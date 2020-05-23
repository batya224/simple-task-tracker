<?php

class Tasks extends Controller
{
    public $data;
    public $tasks_model;
    public $url;
    public $db;
    public $page_size = 3;

    function __construct($data = null, $task = null)
    {
        $this->data = $data;
        $this->tasks_model = $this->model('Task');
        $this->db = new Database;
        $this->url = get_url();
    }

    public function index()
    {
        $request_params = $_GET;
        if (!isset($request_params['page_size']))
            $request_params['page_size'] = $this->page_size;


        $result = $this->tasks_model->get_tasks($request_params);
        if (isset($result['total'])) {
            $totalCount = $result['total'] < 0 ? 0 : (int)$result['total'];
            $result['pagecount'] = (int)(($totalCount + $this->page_size - 1) / $this->page_size);
        } else {
            $result['pagecount'] = 1;
        }
        $result['page'] = isset($_GET['page']) ? $_GET['page'] : 1;


        $this->view('tasks/index', $result);
    }

    public function add()
    {
//        if (!is_logged_in()) {
//            redirect('users/login');
//        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $this->data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'description' => trim($_POST['description']),
                'username_error' => '',
                'email_error' => '',
                'description_error' => '',
                'status_error' => '',
            ];

            if (empty($this->data['username'])) {
                $this->data['username_error'] = 'Please enter task assignee';
            }

            if (empty($this->data['email'])) {
                $this->data['email_error'] = 'Please enter email';
            }

            if (isset($this->data['email']) && !filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->data['email_error'] = 'Please enter valid email';
            }


            if (empty($this->data['description'])) {
                $this->data['description_error'] = 'Please enter description for task';
            }

            //Make sure errors are not empty
            if (empty($this->data['email_error']) && empty($this->data['username_error']) && empty($this->data['description_error'])) {

                $added_tasks = $this->tasks_model->add_task($this->data);

                if ($added_tasks) {
                    set_alert_message('task_message', 'Task was successfully added', 'alert-success');
                    redirect('tasks');
                }
            }
        } else {

            $this->data = [
                'username' => '',
                'email' => '',
                'description' => '',
                'status' => '',
                'username_error' => '',
                'email_error' => '',
                'description_error' => '',
                'status_error' => '',
            ];
        }

        $this->view('tasks/add', $this->data);
    }

    public function edit($id = null)
    {
        if (!is_logged_in()) {
            redirect('users/login');
        }

        if ($id == null) {
            redirect('tasks');
        }
        $task = $this->tasks_model->get_task('id', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($task[0])) {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $this->data = [
                'id' => $id,
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'description' => trim($_POST['description']),
                'status' => trim($_POST['status']),
                'modified_time' => $task[0]->modified_time,
                'email_error' => '',
                'username_error' => '',
                'description_error' => '',
                'status_error' => '',
            ];

            if (empty($this->data['username'])) {
                $this->data['username_error'] = 'Please enter task assignee';
            }

            if (empty($this->data['email'])) {
                $this->data['email_error'] = 'Please enter email';
            }

            if (isset($this->data['email']) && !filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->data['email_error'] = 'Please enter valid email';
            }


            if (empty($this->data['description'])) {
                $this->data['description_error'] = 'Please enter description for task';
            } else {
                if (strcmp($task[0]->description, $this->data['description']) != 0) {
                    $this->data['modified_time'] = date('Y-m-d H:i:s');
                }
            }


            if (empty($this->data['email_error']) && empty($this->data['username_error']) && empty($this->data['description_error'])) {
                $added_tasks = $this->tasks_model->update_task($this->data);

                if ($added_tasks) {
                    set_alert_message('task_message', 'Task was successfully updated', 'alert-success');
                    redirect('tasks');
                }
            } else {
                set_alert_message('task_message', 'Not all fields are correct', 'alert-danger');
            }

        } else {

            if (!isset($task[0])) {
                set_alert_message('task_message', 'Task not found', 'alert-danger');
                redirect('tasks');
            }

            $this->data = [
                'id' => $id,
                'username' => $task[0]->username,
                'email' => $task[0]->email,
                'description' => $task[0]->description,
                'status' => $task[0]->status,
                'username_error' => '',
                'email_error' => '',
                'description_error' => '',
                'status_error' => '',
            ];
        }

        $this->view('tasks/edit', $this->data);
    }

    public function delete($id = null)
    {
        if ($id == null) {
            redirect('tasks');
        }

        $task = $this->tasks_model->get_task('id', $id);

        if (isset($task)) {
            $deleted = $this->tasks_model->delete_task($id);

            if ($deleted) {
                set_alert_message('task_message', 'Task was successfully deleted', 'alert-success');
            } else {
                set_alert_message('task_message', 'Task was not deleted', 'alert-danger');
            }
        }

        redirect('tasks');

    }
}
