<?php
defined('BASEPATH') or exit('No direct script access allowed');

class task extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'my_helper', 'form']);
        $this->load->library(array('session', 'Render', 'form_validation', 'ion_auth'));
        $this->load->model("Task_Model");
    }

    function index()
    {
        $res = $this->Task_Model->index();
        $this->render->view("task", $res);
    }

    function registration()
    {
        $this->render->view("task_registration");
    }

    function edit_and_delete()
    {
        $res = $this->Task_Model->edit_and_delete();
        $this->render->view("task_edit_and_delete", $res);
    }

    function create()
    {
        $posts = $this->input->post();
        $config = array(
            array(
                'field' => 'date',
                'label' => 'Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'genre',
                'label' => 'Task Genre',
                'rules' => 'required'
            ),
            array(
                'field' => 'task_c',
                'label' => 'Task Content',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            $this->render->view("task_registration");
        } elseif ($this->task_check($posts)) {
            $res = $this->Task_Model->create($posts);
            if ($res == false) {
                $this->render->view("task_registration_failed");
            } else {
                $this->render->view("task_registration_success", $posts);
            }
        } else {
            $this->render->view("task_registration_failed");
        }
    }

    function task_check($posts)
    {
        $res = $this->Task_Model->comparison_date();
        foreach ($res as $row) {
            if ($row["date"] == $posts["date"]&&$row["genre"] == $posts["genre"]) {
                return false;
                break;
            }
        }
        return true;
    }

    function edit_input()
    {
        $id = $this->uri->segment(3);
        $res = $this->Task_Model->edit_input($id);
        $this->render->view("task_edit", $res);
    }

    function edit()
    {
        $posts = $this->input->post();
        $res = $this->Task_Model->edit($posts);
        if ($res == false) {
            $this->render->view("task_edit_failed");
        } else {
            $this->render->view("task_edit_success", $posts);
        }
    }

    function delete()
    {
        $id = $this->uri->segment(3);
        $date = $this->uri->segment(4);
        $res = $this->Task_Model->delete($id, $date);
        if ($res == false) {
            $this->render->view("task_delete_failed");
        } else {
            $this->render->view("task_delete_success");
        }
    }
}
