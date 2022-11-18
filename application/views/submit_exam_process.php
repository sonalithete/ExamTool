<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($_SESSION['user_mail']) && !isset($_SESSION['user_name'])){
  redirect('user_login','refresh');
}

$exam_id = $this->uri->segment(3);
$user_id = $this->uri->segment(4);

$user_mail = $_SESSION['user_mail'];
$user_name = $_SESSION['user_name'];
?>
    
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="panel panel-default" style="margin-top: 20px;">
            <div class="panel-heading"><h4><b>Your Result</b></h4></div>
            <div class="panel-body">
                <div class="row col-lg-12 col-md-12">
                  <?php

                  $questions_details = $this->db->get_where('exam_subject_details', array('exam_id'=>$exam_id));

                  foreach ($questions_details->result() as $questions_detail_key => $questions_detail_value)
                  { 
                    $total_no_of_questions = $questions_detail_value->total_questions;

                    $total_no_of_marks = $questions_detail_value->marks_per_right_ans * $total_no_of_questions;
                  }

                  $user_ans_details = $this->db->get_where('exam_user_question_ans', array('user_id' => $user_id,'exam_id' => $exam_id));

                  $total_obtained_marks = 0;
                  $total_attempted_questions = 0;

                  foreach ($user_ans_details->result() as $ans_detail_key => $ans_detail_value)
                  {
                    $total_obtained_marks += $ans_detail_value->marks;
                    $total_attempted_questions += 1;
                  }

                   $obtained_percentage = ($total_obtained_marks/$total_no_of_marks) * 100;

                  ?>
                  <h5><b>User Name : <?php echo $user_name; ?></b></h5> 
                  <h5><b>User Email : <?php echo $user_mail; ?></b></h5> 
                  <h5><b>Total Questions : <?php echo $total_no_of_questions; ?></b></h5> 
                  <h5><b>Attempted Question : <?php echo $total_attempted_questions; ?></b></h5> 
                  <h5><b>Your Score : </b><b><span style="color: green"><?php echo $obtained_percentage; ?>%</span></b>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>