<?php
class user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'my_helper']);
        $this->load->library(array('session', 'Render', 'form_validation', 'ion_auth'));

        // for inputdb
        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('familyname', 'Family Name', 'required');
        $this->form_validation->set_rules('sex', 'sex', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('telephonenumber', 'Telephone Number(without hyphen)', 'required');
        $this->form_validation->set_rules('emailaddress', 'E-Mail Address', 'required');
        $this->load->model("User_Model");
    }

    public function inputdb()
    {
        if ($this->form_validation->run() == FALSE) {
            $this->render->view("form_pi_failed");
        } else {
            $firstname = $this->db->escape($_POST['firstname']);
            $familyname = $this->db->escape($_POST['familyname']);
            $sex = $this->db->escape($_POST['sex']);
            $address = $this->db->escape($_POST['address']);
            $telephonenumber = $this->db->escape($_POST['telephonenumber']);
            $emailaddress = $this->db->escape($_POST['emailaddress']);
            $array = array(
                "firstname" => $firstname,
                "familyname" => $familyname,
                "sex" => $sex,
                "address" => $address,
                "telephonenumber" => $telephonenumber,
                "emailaddress" => $emailaddress
            );
            $res = $this->User_Model->inputdb($array);
            if ($res) {
                $this->render->view("form_pi_success", $array);
            } else {
                $this->render->view("form_pi_failed");
            }
        }
    }
}
