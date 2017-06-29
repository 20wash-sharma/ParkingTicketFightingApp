<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Platetype extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Platetype_model');
    }

    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            if($this->session->permission != null):
                $this->permission = $this->session->permission;
            endif;
            
            if(!checkPermission('Plate Types','View', $this->permission)):
                redirect('administrator', 'refresh');
            endif;
            
            $this->data['scriptsfiles'] = array(
                                'plugins/datatables/jquery.dataTables.min.js',
                                'platetypegrid.js'            
                            );
            $this->render('administrator/platetype_view');
        }
        else
        {
          //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    public function all()
    {
        $plateTypeAll = $this->Platetype_model->all();
        
        $index = 0;
        $count = 1;
        
        $userData = $this->session->userdataall;
        $roleID = $userData[0]->Role_roleID;
        $permission = $this->Permission_model->getPermissionsByRole($roleID);
        
        $editPlateType = checkPermission('Plate Types','Edit', $permission);
        $deletePlateType = checkPermission('Plate Types','Delete', $permission);
        
        foreach($plateTypeAll as $plateTypeSingle):
            $deleteCheckBox = '<input type="checkbox" class="checkboxDel" name="deletePlateType" value="' . $plateTypeSingle->PlatetypesID . '">';
            
            $actionhtml = "";
            if($editPlateType)
                $actionhtml .= '<button class="edit btn btn-default btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#modal_PlateType" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Plate Type" data-plateTypeID="' . $plateTypeSingle->PlatetypesID . '"><span class="fa fa-pencil"></span></button>';
            if($deletePlateType)
                $actionhtml .= '<button class="delete btn btn-danger btn-rounded btn-condensed btn-sm" data-plateTypeID="' . $plateTypeSingle->PlatetypesID . '" onClick="delete_row(\'trow_' . $count . ',' . $plateTypeSingle->PlatetypesID . '"><span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Plate Type" data-plateTypeID="' . $plateTypeSingle->PlatetypesID . '"></span></button>';
            $position = 0;
            if($deletePlateType):
                $plateTypeArray[$index][$position] = $deleteCheckBox;
                $position++;
            endif;
            $plateTypeArray[$index][$position] = $count;
            $position++;
            $plateTypeArray[$index][$position] = $plateTypeSingle->platetype;
            $position++;
            $plateTypeArray[$index][$position] = $plateTypeSingle->platetypesdesc;
            $position++;
            if($actionhtml != ""):
                $plateTypeArray[$index][$position] = $actionhtml;
            endif;
            $index++;
            $count++;
        endforeach;
        echo json_encode(array('status'=>'1','data'=>$plateTypeArray));
    }
    
    public function addedit(){
        $plateTypeID = $this->input->post('plateTypeID');
        $data = array(
            'platetype' => $this->input->post('platetype'),
            'platetypesdesc' => $this->input->post('description')
        );
        $ret = NULL;
        if($plateTypeID > 0):
            $ret = $this->Platetype_model->update($data, $plateTypeID);
        else:
            $ret = $this->Platetype_model->insert($data);
        endif;
        
        if($ret == null)
            $ret = array('status'=>'0','msg'=>'There is problem adding plate type.');
        echo json_encode($ret);
    }

    public function single(){
        $plateTypeId = $this->input->post('plateTypeID');
        $ret = $this->Platetype_model->single($plateTypeId);
        echo json_encode($ret);
    }
    
    public function delete(){
        $plateTypeId = $this->input->post('plateTypeID');
        $ret = $this->Platetype_model->delete($plateTypeId);
        echo json_encode($ret);
    }
    
    public function deleteselected(){
        $plateTypeIds = $this->input->post('plateTypeIDs');
        $ret = $this->Platetype_model->delete($plateTypeIds);
        echo json_encode($ret);
    }
}