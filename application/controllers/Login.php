<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
        function __construct()
        {
            parent::__construct();
            $this->load->model('administrator/User_model');
        }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            if($this->session->userdata('logged_in'))
            {
                redirect('administrator', 'refresh');
            }
            else
            {
                //If no session, redirect to login page
                $this->load->view('login_view');
            }
	}
        
        public function check()
        {
            $userName = $this->input->post('username');
            $password = $this->input->post('password');
            $role = '';
            $username = '';
            $ret = $this->User_model->checkLogin($userName,  md5($password));
            //$ret = $this->User_model->checkLogin($userName,  $password);
            if($ret['status'] == 1):
                $sess_array = array();
                //var_dump($ret['data']);
                foreach($ret['data'] as $row)
                {
                    $sess_array = array(
                        'id' => $row->UserID,
                        'username' => $row->username
                    );
                    $this->session->set_userdata('logged_in', $sess_array);
                    $this->User_model->updateLastLogin($userName);
                    $role = $row->name;
                    $username = $row->username;
                }
                $url = '';
                if($role == 'User'):
                    $url = base_url().'index.php/administrator/user/profile/' . $username;
                else:
                    $url = base_url().'index.php/administrator';
                endif;
                echo json_encode(array('status'=>'1','redirect'=>$url));
            else:
                echo json_encode($ret);
            endif;
        }
        
        function logout()
        {
            $this->session->unset_userdata('logged_in');
            session_destroy();
            redirect('login', 'refresh');
        }
        
        public function activateaccount()
        {
            $activationCode = $this->uri->segment(3);
            $ret = $this->User_model->checkactivationcode($activationCode);
            $this->load->view('activate_view',$ret);
        }
        
        public function createpassword()
        {
            $password = $this->input->post('password');
            $userID = $this->input->post('userID');
            $ret = $this->User_model->createpassword($userID, $password);
            if($ret['status'] == 1):
                echo json_encode(array('status'=>'1','redirect'=>base_url().'index.php/login'));
            else:
                echo json_encode($ret);
            endif;
        }
}
