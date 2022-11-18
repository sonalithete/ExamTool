<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam_submit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Exam_user_question_ans');
	}

	public function submit_answers()
	{		
		if(isset($_POST['selected_value']) && $_POST['selected_value'] != '')
		{
			$exam_id = $_POST['exam_id'];
		    $exam_question_id = $_POST['exam_question_id'];
		    $user_id = $_POST['user_id'];
		    $selected_value = $_POST['selected_value'];

			$this->db->select('*');    
			$this->db->from('exam_questions');
			$this->db->join('exam_subject_details', 'exam_subject_details.exam_id = exam_questions.exam_id');
			$this->db->where('exam_question_id', $exam_question_id);
		
			$question_details = $this->db->get();

			foreach ($question_details->result() as $question_detail_key => $question_detail_value) 
            {
            	$question_ans = $question_detail_value->answer;
            	$correct_ans_marks = $question_detail_value->marks_per_right_ans;
            	$wrong_question_ans = $question_detail_value->marks_per_wrong_ans;

            	if($question_ans == $selected_value)
	            {
	            	$user_marks = $correct_ans_marks;
	            }
	            else
	            {
	            	$user_marks = $wrong_question_ans;
	            }
            }

            $user_ans_details = $this->db->get_where('exam_user_question_ans', array('user_id' => $user_id,'exam_id' => $exam_id,'exam_question_id' => $exam_question_id ));

            	if(sizeof($user_ans_details->result()) > 0 )
            	{
            		foreach ($user_ans_details->result() as $ans_detail_key => $ans_detail_value)
            		{ 
	           			$exam_question_ans_id = $ans_detail_value->exam_question_ans_id;

	            		$user_data = array(
	            			'user_ans_option' => $selected_value,
							'marks' => $user_marks
						);

						$this->db->where('exam_question_ans_id', $exam_question_ans_id);
						$this->db->update('exam_user_question_ans', $user_data);
					}

            	}
            	else
            	{
					$user_data = array(
					'user_id' => $user_id,
					'exam_id' => $exam_id,
					'exam_question_id'=> $exam_question_id,
					'user_ans_option' => $selected_value,
					'marks' => $user_marks
					);

					$this->Exam_user_question_ans->insert_user_ans( $user_data );
            	}
		}
	}

	public function submit_exam_process()
	{
		$this->load->view('inc/header');
		$this->load->view('submit_exam_process');
		$this->load->view('inc/footer');
		
		session_destroy();
	}
}
