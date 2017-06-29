<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Tickets_model');
    }
    
    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            if($this->session->permission != null):
                $this->permission = $this->session->permission;
            endif;
            
            if(!checkPermission('Tickets','View', $this->permission)):
                redirect('administrator', 'refresh');
            endif;
            
            $this->data['scriptsfiles'] = array(
                                'plugins/datatables/jquery.dataTables.min.js',
                                'ticketsgrid.js'            
                            );
            $this->render('administrator/tickets_view');
        }
        else
        {
          //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    public function all(){
        $ticketsAll = $this->Tickets_model->all();
        
        $index = 0;
        $count = 1;
        foreach($ticketsAll as $item):
            $position = 0;
            $userArray[$index][$position] = $count;
            $position++;
            $userArray[$index][$position] = $item->firstname . ' ' . $item->lastname;
            $position++;
            $userArray[$index][$position] = $item->username;
            $position++;
            $userArray[$index][$position] = $item->Ticketnumber;
            $position++;
            $userArray[$index][$position] = date('Y-m-d',strtotime($item->issueddatetime));
            $position++;
            $userArray[$index][$position] = $item->status;
            $position++;
            $userArray[$index][$position] = $item->violationcode;
            $position++;
            $userArray[$index][$position] = date('Y-m-d',strtotime($item->currentduedate));
            
            $index++;
            $count++;
        endforeach;
        
        echo json_encode(array('status'=>'1','data'=>$ticketsAll));
    }
}