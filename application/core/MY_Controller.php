<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller
{
  protected $data = array();
  protected $permission = array();
  
    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Parking Ticket Fighting Mobile Application';
        $this->data['before_head'] = '';
        $this->data['before_body'] = '';
    }
 
    protected function render($the_view = NULL, $template = 'master')
    {
        if($template == 'json' || $this->input->is_ajax_request())
        {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        else
        {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);;
            $this->load->view('templates/'.$template.'_view', $this->data);
        }
    }
}
 
class Admin_Controller extends MY_Controller
{
 
  function __construct()
  {
    parent::__construct();
    $this->load->model('administrator/User_model');
    $this->load->model('administrator/Permission_model');
    $this->data['page_title'] = 'Parking Ticket Fighting Mobile Application';
    $session_data = $this->session->userdata('logged_in');
    $userId = $session_data['id'];
    if($this->session->userdataall != null):
        $userData = $this->session->userdataall;
    else:
        $userData = $this->User_model->single($userId);
        $this->session->userdataall = $userData;
    endif;
    
    $this->data['userData'] = $userData;
    if($userData != null && count($userData) > 0):
        $roleID = $userData[0]->Role_roleID;
    
        if($this->session->permission != null):
            $permission = $this->session->permission;
        else:
            $permission = $this->Permission_model->getPermissionsByRole($roleID);
            $permission = $this->session->permission = $permission;
        endif;
        $this->data['permission'] = $permission;
    else:
        $this->data['permission'] = NULL;
    endif;
  }
 
  protected function render($the_view = NULL, $template = 'admin_master')
  {
    parent::render($the_view, $template);
  }
}
 
class Public_Controller extends MY_Controller
{
 
  function __construct()
  {
    parent::__construct();
  }
}