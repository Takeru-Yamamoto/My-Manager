<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url', 'my_helper']);
		$this->load->library(array('session', 'Render', 'form_validation', 'ion_auth'));
	}

	public function index()
	{
		$this->render->view("interface");
	}
}
