<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/State_model');
    }

    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            if($this->session->permission != null):
                $this->permission = $this->session->permission;
            endif;
            
            if(!checkPermission('States','View', $this->permission)):
                redirect('administrator', 'refresh');
            endif;
            
            $this->data['scriptsfiles'] = array(
                                'plugins/datatables/jquery.dataTables.min.js',
                                'stategrid.js'            
                            );
            $this->render('administrator/state_view');
        }
        else
        {
          //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    public function all()
    {
        $stateAll = $this->State_model->all();
        
        $index = 0;
        $count = 1;
        
        $userData = $this->session->userdataall;
        $roleID = $userData[0]->Role_roleID;
        $permission = $this->Permission_model->getPermissionsByRole($roleID);
        
        $editState = checkPermission('States','Edit', $permission);
        $deleteState = checkPermission('States','Delete', $permission);
        
        foreach($stateAll as $stateSingle):
            $deleteCheckBox = '<input type="checkbox" class="checkboxDel" name="deleteState" value="' . $stateSingle->StateID . '">';
            
            $actionhtml = "";
            if($editState)
                $actionhtml .= '<button class="edit btn btn-default btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#modal_State" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit State" data-stateID="' . $stateSingle->StateID . '"><span class="fa fa-pencil"></span></button>';
            if($deleteState)
                $actionhtml .= '<button class="delete btn btn-danger btn-rounded btn-condensed btn-sm" data-stateID="' . $stateSingle->StateID . '" onClick="delete_row(\'trow_' . $count . ',' . $stateSingle->StateID . '"><span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete State" data-stateID="' . $stateSingle->StateID . '"></span></button>';
            $position = 0;
            if($deleteState):
                $stateArray[$index][$position] = $deleteCheckBox;
                $position++;
            endif;
            $stateArray[$index][$position] = $count;
            $position++;
            $stateArray[$index][$position] = $stateSingle->StateShortName;
            $position++;
            $stateArray[$index][$position] = $stateSingle->StateName;
            $position++;
            if($actionhtml != ""):
                $stateArray[$index][$position] = $actionhtml;
            endif;
            $index++;
            $count++;
        endforeach;
        echo json_encode(array('status'=>'1','data'=>$stateArray));
    }
    
    public function addedit(){
        $stateID = $this->input->post('stateID');
        $data = array(
            'StateName' => $this->input->post('statename'),
            'StateShortName' => $this->input->post('stateshortname')
        );
        $ret = NULL;
        if($stateID > 0):
            $ret = $this->State_model->update($data, $stateID);
        else:
            $ret = $this->State_model->insert($data);
        endif;
        
        if($ret == null)
            $ret = array('status'=>'0','msg'=>'There is problem adding state.');
        echo json_encode($ret);
    }

    public function single(){
        $stateId = $this->input->post('stateID');
        $ret = $this->State_model->single($stateId);
        echo json_encode($ret);
    }
    
    public function delete(){
        $stateId = $this->input->post('stateID');
        $ret = $this->State_model->delete($stateId);
        echo json_encode($ret);
    }
    
    public function deleteselected(){
        $stateIds = $this->input->post('stateIDs');
        $ret = $this->State_model->delete($stateIds);
        echo json_encode($ret);
    }
}