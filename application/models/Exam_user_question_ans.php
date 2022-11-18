<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam_user_question_ans extends CI_Model {

	public function insert_user_ans( $user_data )
	{
		$this->db->insert('exam_user_question_ans', $user_data);
	}
}
