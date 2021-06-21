<?php
defined('BASEPATH') or exit('No direct script access allowed');

class attendance extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'my_helper', 'form']);
        $this->load->library(array('session', 'Render', 'form_validation', 'ion_auth'));
        $this->load->model("Attendance_Model");
    }

    function index()
    {
        $res = $this->Attendance_Model->index();
        $this->render->view("attendance", $res);
    }

    function page_sort()
    {
        $posts = $this->input->post();
        $res = $this->Attendance_Model->page_sort($posts);
        $res["page_sort"] = $posts["page_sort"];
        $this->render->view("attendance_page_sort", $res);
    }

    function registration()
    {
        $this->render->view("attendance_registration");
    }

    function edit_input()
    {
        $id = $this->uri->segment(3);
        $res = $this->Attendance_Model->edit_input($id);
        $this->render->view("attendance_edit", $res);
    }

    function edit()
    {
        $posts = $this->input->post();
        $res = $this->Attendance_Model->edit($posts);
        if ($res == false) {
            $this->render->view("attendante_edit_failed");
        } else {
            $this->render->view("attendance_edit_success", $posts);
        }
    }

    function delete()
    {
        $id = $this->uri->segment(3);
        $date = $this->uri->segment(4);
        $res = $this->Attendance_Model->delete($id, $date);
        if ($res == false) {
            $this->render->view("attendante_delete_failed");
        } else {
            $this->render->view("attendance_delete_success");
        }
    }

    function time_check($data)
    {
        $posts = $this->input->post();
        $res = $this->Attendance_Model->comparison_date();
        foreach ($res as $row) {
            if ($row["date"] == $data) {
                $this->form_validation->set_message('time_check', 'Error:Attendance Data of ' . $data . ' is already registered.');
                return false;
            }
        }
        if ($posts["end_w"] < $posts["start_w"]) {
            $this->form_validation->set_message('time_check', 'Error:The work start time is after the work end time.');
            return false;
        } elseif ($posts["end_b"] < $posts["start_b"]) {
            $this->form_validation->set_message('time_check', 'Error:The break start time is after the break end time.');
            return false;
        } elseif ($posts["start_b"] < $posts["start_w"]) {
            $this->form_validation->set_message('time_check', 'Error:The work start time is after the break start time.');
            return false;
        } elseif ($posts["end_w"] < $posts["end_b"]) {
            $this->form_validation->set_message('time_check', 'Error:The end time of work comes before the end time of the break.');
            return false;
        } else {
            return true;
        }
    }

    function create()
    {
        $posts = $this->input->post();
        $config = array(
            array(
                'field' => 'date',
                'label' => 'Date',
                'rules' => 'required|callback_time_check'
            ),
            array(
                'field' => 'start_w',
                'label' => 'Work Start Time',
                'rules' => 'required'
            ),
            array(
                'field' => 'end_w',
                'label' => 'Work End Time',
                'rules' => 'required'
            ),
            array(
                'field' => 'start_b',
                'label' => 'Break Start Time',
                'rules' => 'required'
            ),
            array(
                'field' => 'end_b',
                'label' => 'Break End Time',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            $this->render->view("attendance_registration");
        } else {
            $res = $this->Attendance_Model->create($posts);
            if ($res == false) {
                $this->render->view("attendance_registration_failed");
            } else {
                $this->render->view("attendance_registration_success", $posts);
            }
        }
    }

    function work_start()
    {
        $res = $this->Attendance_Model->work_start();
        if ($res == false) {
            $this->render->view("attendance_error");
        } else {
            $this->render->view("interface");
        }
    }

    function work_end()
    {
        $res = $this->Attendance_Model->work_end();
        if ($res == false) {
            $this->render->view("attendance_error");
        } else {
            $this->render->view("interface");
        }
    }

    function break_start()
    {
        $res = $this->Attendance_Model->break_start();
        if ($res == false) {
            $this->render->view("attendance_error");
        } else {
            $this->render->view("interface");
        }
    }

    function break_end()
    {
        $res = $this->Attendance_Model->break_end();
        if ($res == false) {
            $this->render->view("attendance_error");
        } else {
            $this->render->view("interface");
        }
    }

    function payroll()
    {
        $res = $this->Attendance_Model->payroll();
        $this->render->view("payroll", $res);
    }

    function payroll_update()
    {
        $posts = $this->input->post();
        $res = $this->Attendance_Model->payroll_update($posts);
        if ($res == false) {
            $this->render->view("attendance_error");
        } else {
            $res = $this->Attendance_Model->payroll();
            $this->render->view("payroll", $res);
        }
    }
}
