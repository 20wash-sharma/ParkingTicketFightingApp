<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller
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
            var_dump($session_data);
            $this->data['page_title'] = 'Parking Ticket Fighting Mobile Application - Profile';
            $this->data['Vehicles'] = $this->Vehicles_model->all();;
            $this->render('administrator/profile_view');
        }
        else
        {
          //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
}