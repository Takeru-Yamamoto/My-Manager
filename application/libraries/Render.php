<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Render
{
    private $_ci;

    public function __construct(){
        $this -> _ci = & get_instance();
    }

	public function view($template,$data=array())
	{
		$this->_ci->load->view('templates/header',$data);
		$this->_ci->load->view($template,['data'=>$data]);
		$this->_ci->load->view('templates/footer',$data);
	}
}