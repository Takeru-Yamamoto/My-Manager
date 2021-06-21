<?php
defined('BASEPATH') or exit('No direct script access allowed');

class deliverytime extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'my_helper', 'form']);
        $this->load->library(array('session', 'Render', 'form_validation', 'ion_auth'));
        $this->load->model("Deliverytime_Model");
    }

    function index()
    {
        $res = $this->Deliverytime_Model->index();
        $this->render->view("deliverytime", $res);
    }

    function registration()
    {
        $res = array("content"=>null);
        $this->render->view("deliverytime_registration");
    }

    function edit_and_delete()
    {
        $res = $this->Deliverytime_Model->edit_and_delete();
        $this->render->view("deliverytime_edit_and_delete",$res);
    }

    function create()
    {
        $posts = $this->input->post();
        $config = array(
            array(
                'field' => 'date',
                'label' => 'Delivery Time',
                'rules' => 'required|callback_deliverytime_check'
            ),
            array(
                'field' => 'content',
                'label' => 'Content',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            $this->render->view("deliverytime_registration");
        } else {
            $res = $this->Deliverytime_Model->create($posts);
            if ($res == false) {
                $this->render->view("deliverytime_registration_failed");
            } else {
                $this->render->view("deliverytime_registration_success", $posts);
            }
        }
    }

    function deliverytime_check($data)
    {
        $res = $this->Deliverytime_Model->comparison_date();
        foreach ($res as $row) {
            if ($row["date"] == $data) {
                $this->form_validation->set_message('deliverytime_check', 'Error:Delivery Time Data of ' . $data . ' is already registered.');
                return false;
                break;
            } 
        }
        return true;
    }

    function edit_input()
    {
        $id = $this->uri->segment(3);
        $res = $this->Deliverytime_Model->edit_input($id);
        $this->render->view("deliverytime_edit", $res);
    }

    function edit()
    {
        $posts = $this->input->post();
        $res = $this->Deliverytime_Model->edit($posts);
        if ($res == false) {
            $this->render->view("deliverytime_edit_failed");
        } else {
            $this->render->view("deliverytime_edit_success", $posts);
        }
    }

    function delete()
    {
        $id = $this->uri->segment(3);
        $date = $this->uri->segment(4);
        $res = $this->Deliverytime_Model->delete($id, $date);
        if ($res == false) {
            $this->render->view("deliverytime_delete_failed");
        } else {
            $this->render->view("deliverytime_delete_success");
        }
    }
}
