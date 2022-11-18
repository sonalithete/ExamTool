<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam_list extends CI_Controller {

	public function index()
	{
		$this->load->view('inc/header');
		$this->load->view('exam_list');
		$this->load->view('inc/footer');	
	}

	public function process_exam( $exam_id )
	{
		$this->load->view('inc/header');
		$this->load->view('process_exam', $exam_id);
		$this->load->view('inc/footer');
	}
}
