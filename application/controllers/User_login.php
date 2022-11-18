 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users');
	}

	public function index()
	{
		$this->load->view('inc/header');
		$this->load->view('user_login');
		$this->load->view('inc/footer');
	}

	public function login_process()
	{

		if( $this->input->post('u_login') ){

			$u_name = $this->input->post('u_name');
			$u_email = $this->input->post('u_email');
			$created_time = date("Y-m-d H:i:s", time());

			$user_data = array(
				'user_name'	=> $u_name,
				'user_mail'	=> $u_email,
				'user_created'	=> $created_time
			);

			$users_list = $this->db->get_where('users', array( 'user_mail' => $user_data['user_mail'] ));

			if(sizeof($users_list->result()) > 0)
			{
				$_SESSION['user_name'] = $user_data['user_name'];
				$_SESSION['user_mail'] = $user_data['user_mail'];

				redirect('exam_list','refresh');
			}
			else
			{
			 	$this->Users->insert_user( $user_data );

				$_SESSION['user_name'] = $user_data['user_name'];
				$_SESSION['user_mail'] = $user_data['user_mail'];

				redirect('exam_list','refresh');
			}

		}else{
			redirect('user_login','refresh');
		}
	}

}
