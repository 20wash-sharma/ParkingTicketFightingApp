<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiclemake extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Vehiclemake_model');
    }

    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            if($this->session->permission != null):
                $this->permission = $this->session->permission;
            endif;
            
            if(!checkPermission('Role','View', $this->permission)):
                redirect('administrator', 'refresh');
            endif;
            
            $this->data['scriptsfiles'] = array(
                                'plugins/datatables/jquery.dataTables.min.js',
                                'vehiclemakegrid.js'            
                            );
            $this->render('administrator/vechiclemake_view');
        }
        else
        {
          //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    public function all()
    {
        $vehicleMakeAll = $this->Vehiclemake_model->all();
        
        $index = 0;
        $count = 1;
        
        $userData = $this->session->userdataall;
        $roleID = $userData[0]->Role_roleID;
        $permission = $this->Permission_model->getPermissionsByRole($roleID);
        $editMake = checkPermission('Vehicle Make','Edit', $permission);
        $deleteMake = checkPermission('Vehicle Make','Delete', $permission);
        
        foreach($vehicleMakeAll as $vehicleSingle):
            $deleteCheckBox = '<input type="checkbox" class="checkboxDel" name="deleteMake" value="' . $vehicleSingle->VehiclemakeID . '">';
            
            $actionhtml = "";
            if($editMake)
                $actionhtml .= '<button class="edit btn btn-default btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#modal_VehicleMake" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Vehicle Make" data-makeID="' . $vehicleSingle->VehiclemakeID . '"><span class="fa fa-pencil"></span></button>';
            if($deleteMake)
                $actionhtml .= '<button class="delete btn btn-danger btn-rounded btn-condensed btn-sm" data-makeID="' . $vehicleSingle->VehiclemakeID . '" onClick="delete_row(\'trow_' . $count . ',' . $vehicleSingle->VehiclemakeID . '"><span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Vehicle Make" data-makeID="' . $vehicleSingle->VehiclemakeID . '"></span></button>';
            $position = 0;
            if($deleteMake):
                $makeArray[$index][$position] = $deleteCheckBox;
                $position++;
            endif;
            $makeArray[$index][$position] = $count;
            $position++;
            $makeArray[$index][$position] = $vehicleSingle->vehiclemake;
            $position++;
            $makeArray[$index][$position] = $vehicleSingle->description;
            $position++;
            if($actionhtml != ""):
                $makeArray[$index][$position] = $actionhtml;
            endif;
            $index++;
            $count++;
        endforeach;
        echo json_encode(array('status'=>'1','data'=>$makeArray));
    }
    
    public function addedit(){
        $makeID = $this->input->post('makeID');
        $data = array(
            'vehiclemake' => $this->input->post('make'),
            'description' => $this->input->post('description')
        );
        $ret = NULL;
        if($makeID > 0):
            $ret = $this->Vehiclemake_model->update($data, $makeID);
        else:
            $ret = $this->Vehiclemake_model->insert($data);
        endif;
        
        if($ret == null)
            $ret = array('status'=>'0','msg'=>'There is problem adding role.');
        echo json_encode($ret);
    }

    public function single(){
        $makeId = $this->input->post('makeID');
        $ret = $this->Vehiclemake_model->single($makeId);
        echo json_encode($ret);
    }
    
    public function delete(){
        $makeId = $this->input->post('makeID');
        $ret = $this->Vehiclemake_model->delete($makeId);
        echo json_encode($ret);
    }
    
    public function deleteselected(){
        $makeIds = $this->input->post('makeIDs');
        $ret = $this->Vehiclemake_model->delete($makeIds);
        echo json_encode($ret);
    }
}