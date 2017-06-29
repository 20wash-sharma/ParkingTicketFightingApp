<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $this->render('administrator/dashboard_view');
        }
        else
        {
          //If no session, redirect to login page
          redirect('login', 'refresh');
        }
    }
    
    public function lockscreen()
    {
        $this->load->view('administrator/lockscreen_view');
    }
}