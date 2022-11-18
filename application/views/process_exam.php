<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($_SESSION['user_mail']) && !isset($_SESSION['user_name'])){
  redirect('user_login','refresh');
}

$exam_title = $this->uri->segment(3);
$exam_id = $this->uri->segment(4);
$exam_duration = $this->uri->segment(5);

?>
   <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="panel panel-default" style="margin-top: 20px;">
            <div class="panel-heading"><h4><?php echo urldecode($exam_title); ?></h4></div>
             <div class="panel-heading" id="exam_duration"></div>
            <div class="panel-body">
						<div class="row" id="exam_<?php echo $exam_id;?>">
              <?php  

              $user_mail = $_SESSION['user_mail'];
              $user_name = $_SESSION['user_name'];

              $users_details = $this->db->get_where('users', array('user_mail' => $user_mail,'user_name' => $user_name));

              foreach ($users_details->result() as $users_detail_key => $users_detail_value) 
              { 
                $user_id = $users_detail_value->user_id;
              }
      
              $question_details_array = array();

              $questions_details = $this->db->get_where('exam_questions', array('exam_id'=>$exam_id));

              foreach ($questions_details->result() as $questions) 
              { 

                $exam_question_id = $questions->exam_question_id;

                 $question_array = array();

                 $question_array['exam_question_id'] = $questions->exam_question_id;
                 $question_array['question'] = $questions->question;

                 $question_options_array = array();

                 $question_option_details = $this->db->get_where('exam_quetion_options', array('exam_question_id'=>$exam_question_id));

                 foreach ($question_option_details->result() as $option_details) 
                  { 
                 
                    $option_number = $option_details->exam_option;

                    $question_options_array[$option_number] = $option_details->title;

                    $question_array['options'] = $question_options_array;

                  }

                  $question_details_array[] = $question_array;         
               }
                ?>
                <?php
                 foreach($question_details_array as $question_key => $question_value)
                 {
                  $question_number = $question_key + 1;

                  if($question_number != 1)
                  {
                    $display_class = "display:none";
                  }
                  else
                  {
                    $display_class = "display:block";
                  }
                 ?>

                  <div class ="col-lg-12 col-md-12" id="question_<?php echo $question_key; ?>" style="<?php echo $display_class;?>" >

                  <h5><?php echo $question_number.". ".$question_value['question']; ?></h5>
                    <hr />

                    <ol start="1">
                    <?php

                   foreach ($question_value['options'] as $option_key => $option_value) 
                    { 
                    ?>
                     <li>
                      <div class="radio">
                        <label><h5><input type="radio" class="answer_option" name="question_<?php echo $question_value['exam_question_id']; ?>_option" value="<?php echo $option_key;?>" data-question_id="<?php echo $question_value['exam_question_id'];?>"/>&nbsp;<?php echo $option_value;?></h5></label>
                      </div>
                     </li>
                    <?php
                      }
                      ?>
                    </ol>
                      <?php

                    $exam_question_id = $question_value['exam_question_id'];;

                    $previous_query = $this->db->get_where('exam_questions', array('exam_id' => $exam_id, 'exam_question_id <' => $exam_question_id));
               
                    if(sizeof($previous_query->result()) > 0)
                    {
                      ?>
                      <input type="button" class="btn btn-success btn-sm" onClick="click_to_previous(this, '<?php echo $question_key; ?>', '<?php echo $exam_id; ?>');" value="Previous">
                      <?php
                    }

                    $next_query = $this->db->get_where('exam_questions', array('exam_id' => $exam_id, 'exam_question_id >' => $exam_question_id));

                    if(sizeof($next_query->result()) > 0)
                    {                    
                       ?>
                     
                       <input type="button" class="btn btn-success btn-sm" onClick="click_to_next(this, '<?php echo $question_key; ?>','<?php echo $exam_id; ?>', '<?php echo $question_value['exam_question_id']; ?>','<?php echo $user_id;?>');" value="Skip / Confirm">

                    <?php
                    }
                    else
                    {
                      ?>
                        <input type="button" class="btn btn-success btn-sm" onClick="click_to_next(this, '<?php echo $question_key; ?>','<?php echo $exam_id; ?>', '<?php echo $question_value['exam_question_id'];?>','<?php echo $user_id;?>','true');" value="Submit Exam">
                      <?php
                    }
                    ?>

                    <br /><br />
                  </div>
                 <?php
                 }
                ?>
          </div>
          </div>
        </div>
      </div>
    </div>
 </div>
</div>

    <script>

      $(document).ready(function () {

        var exam_id = <?php echo $exam_id; ?>;
        var user_id = <?php echo $user_id; ?>;

       var time = <?php echo $exam_duration; ?> * 60;
        callsetTimeOut();

        function callsetTimeOut() {
          setTimeout(function() {
            if (time) {
              time--;
              var min = Math.floor(time / 60),
                sec = Math.round(time % 60);
              document.getElementById("exam_duration").innerHTML = "<h5>Time Remaining :"+ min + ":" + sec + " min left</h5>";

              callsetTimeOut();
            }  
            else
            {
              window.location.href = "<?php echo base_url(); ?>Exam_submit/submit_exam_process/"+ exam_id + "/"+ user_id;
            }

          }, 1000);
        }
        
      });


      function click_to_next(obj, question_key, exam_id, exam_question_id, user_id, submit=false)
      {
        var ele_radio = document.getElementsByName("question_"+ exam_question_id +"_option");
  
        for(i = 0; i < ele_radio.length; i++) 
        {
            if(ele_radio[i].checked)
            {
              var selected_value = ele_radio[i].value;
            }
        } 

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/Exam_submit/submit_answers/",
            data: {"exam_id": exam_id, "exam_question_id": exam_question_id, "user_id":user_id, "selected_value": selected_value},

            success: function(data) 
            {
              if(submit)
              {
                  window.location.href = "<?php echo base_url(); ?>Exam_submit/submit_exam_process/"+ exam_id + "/"+ user_id;
              }
              else
              {
                var current_div = "question_"+question_key;

                var question_no  = parseInt(question_key) + 1;
                var next_div = "question_"+question_no;

                document.getElementById(current_div).style.display = "none";
                document.getElementById(next_div).style.display = "block";
              }

            }
        });
      }

      function click_to_previous(obj, question_key, exam_id)
      {
        var current_div = "question_"+question_key;

        var question_no  = parseInt(question_key) - 1;
        var prev_div = "question_"+question_no;

        document.getElementById(current_div).style.display = "none";
        document.getElementById(prev_div).style.display = "block";
      }

    </script>
 