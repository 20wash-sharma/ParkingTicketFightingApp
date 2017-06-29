<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Role_model');
        $this->load->library('Datatables');
        $this->load->library('table');
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
                                'rolegrid.js'            
                            );
            $this->render('administrator/role_view');
        }
        else
        {
          //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    
    public function all(){
        $session_data = $this->session->userdata('logged_in');
        $roleLevel = $this->User_model->getLevelByUserID($session_data['id']);
        
        $roleAll = $this->Role_model->all($roleLevel);
        echo json_encode($roleAll);
    }
    
    public function allrole(){
        $session_data = $this->session->userdata('logged_in');
        $roleLevel = $this->User_model->getLevelByUserID($session_data['id']);
        
        $roleAll = $this->Role_model->all($roleLevel);
        echo json_encode(array('status'=>'1','data'=>$roleAll));
    }
    
    public function allrolejson(){
        $session_data = $this->session->userdata('logged_in');
        $roleLevel = $this->User_model->getLevelByUserID($session_data['id']);
        
        $roleAll = $this->Role_model->all($roleLevel);
        $index = 0;
        $count = 1;
        foreach($roleAll as $item):
            $deleteCheckBox = '<input type="checkbox" class="checkboxDel" name="deleteRole" value="' . $item->RoleID . '">';
            //$deleteCheckBox = '<input name="deleteRole" type="checkbox" class="icheckbox" value="' . $item->RoleID . '"/>';
            $statushtml = "";
            if($item->RoleStatus == 1):
                $statushtml = '<span class="label label-success">Active</span>';
            else:
                $statushtml = '<span class="label label-warning">Not Active</span>';
            endif;
            $userData = $this->session->userdataall;
            $roleID = $userData[0]->Role_roleID;
            $permission = $this->Permission_model->getPermissionsByRole($roleID);
            $editRole = checkPermission('Role','Edit', $permission);
            $deleteRole = checkPermission('Role','Delete', $permission);
            $editPermission = checkPermission('Permission','View', $permission);
            
            $actionhtml = "";
            if($editRole)
                $actionhtml .= '<button class="edit btn btn-default btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#modal_basic" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Role" data-roleID="' . $item->RoleID . '"><span class="fa fa-pencil"></span></button>';
            if($deleteRole)
                $actionhtml .= '<button class="delete btn btn-danger btn-rounded btn-condensed btn-sm" data-roleID="' . $item->RoleID . '" onClick="delete_row(\'trow_' . $count . ',' . $item->RoleID . '"><span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Role" data-roleID="' . $item->RoleID . '"></span></button>';
            if($editPermission)
                $actionhtml .= '<button class="permission btn btn-default btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#modal_permission" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Permission" data-roleID="' . $item->RoleID . '"><span class="fa fa fa-wrench"></span></button>';
            //if($actionhtml != ""):
            //    $roleArray[$index] = array($deleteCheckBox,$count, $item->name, $item->description, $statushtml, $item->level, date('Y-m-d',strtotime($item->creationtime)),$actionhtml);
            //else:
            //    $roleArray[$index] = array($deleteCheckBox,$count, $item->name, $item->description, $statushtml, $item->level, date('Y-m-d',strtotime($item->creationtime)));
            //endif;
            $position = 0;
            if($deleteRole):
                $roleArray[$index][$position] = $deleteCheckBox;
                $position++;
            endif;
            $roleArray[$index][$position] = $count;
            $position++;
            $roleArray[$index][$position] = $item->name;
            $position++;
            $roleArray[$index][$position] = $item->description;
            $position++;
            $roleArray[$index][$position] = $statushtml;
            $position++;
            $roleArray[$index][$position] = $item->level;
            $position++;
            $roleArray[$index][$position] = date('Y-m-d',strtotime($item->creationtime));
            $position++;
            if($actionhtml != ""):
                $roleArray[$index][$position] = $actionhtml;
            endif;
            $index++;
            $count++;
        endforeach;
        
        echo json_encode(array('status'=>'1','data'=>$roleArray));
    }
    
    public function addedit(){
        $roleID = $this->input->post('roleID');
        $data = array(
            'name' => $this->input->post('role'),
            'RoleStatus' => $this->input->post('status'),
            'level' => $this->input->post('level'),
            'description' => $this->input->post('description'),
            'creationtime' => date('Y-m-d')
        );
        $ret = NULL;
        if($roleID > 0):
            $ret = $this->Role_model->update($data, $roleID);
        else:
            $ret = $this->Role_model->insert($data);
        endif;
        
        if($ret == null)
            $ret = array('status'=>'0','msg'=>'There is problem adding role.');
        echo json_encode($ret);
    }

    public function single(){
        $roleId = $this->input->post('roleID');
        $ret = $this->Role_model->single($roleId);
        echo json_encode($ret);
    }
    
    public function delete(){
        $roleId = $this->input->post('roleID');
        $ret = $this->Role_model->delete($roleId);
        echo json_encode($ret);
    }
    
    public function deleteselected(){
        $roleIds = $this->input->post('roleIDs');
        $ret = $this->Role_model->delete($roleIds);
        echo json_encode($ret);
    }
}