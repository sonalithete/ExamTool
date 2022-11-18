<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($_SESSION['user_mail']) && !isset($_SESSION['user_name'])){
	redirect('user_login','refresh');
}
?>
    
   <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="panel panel-default" style="margin-top: 20px;">
            <div class="panel-heading"><h4>Exam Topics</h4></div>
           	 <div class="panel-body">

							<div class="row">
								<div class="col-lg-12 col-md-12">
									<table class="table table-bordered">
										<tr>				
										<th>Exam Title</th>					
										<th>Duration (Minute)</th>
										<th>Total Question</th>
										<th>R/Q Mark</th>
										<th>W/Q Mark</th>					
										</tr>
										<?php  

										$exam_list = $this->db->get('exam_subject_details');
										foreach ($exam_list->result() as $exam_data) 
										{ ?>
										
										<tr>
											<td><?php echo $exam_data->exam_title; ?></td>
											<td><?php echo $exam_data->total_questions; ?></td>
											<td><?php echo $exam_data->duration; ?></td>
											<td><?php echo $exam_data->marks_per_right_ans; ?></td>
											<td><?php echo $exam_data->marks_per_wrong_ans; ?></td>
											<td><a href="<?php echo base_url(); ?>Exam_list/process_exam/<?php echo $exam_data->exam_title; ?>/<?php echo $exam_data->exam_id; ?>/<?php echo $exam_data->duration;?>" class="btn btn-info btn-xs btn-block">Take Test</a></td>

										<?php }

										?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
			