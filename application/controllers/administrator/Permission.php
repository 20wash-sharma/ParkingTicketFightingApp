<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Role_model');
        $this->load->model('administrator/Permission_model');
    }

    public function index()
    {
        
    }
    
    public function all(){
        $roleID = $this->input->post('roleID');
        $permissionAll = $this->Permission_model->all($roleID);
        
        if($this->session->permission != null):
            $this->permission = $this->session->permission;
        endif;
        
        $editPermission = '';
        if(checkPermission('Permission','Edit', $this->permission) == FALSE):
            $editPermission = 'disabled';
        endif;
        
        echo json_encode(array('data'=>$permissionAll,'edit'=>$editPermission));
    }
    
    public function addedit(){
        $roleID = $this->input->post('roleID');
        $permissionArray = $this->input->post('formData')['action'];
        $this->Permission_model->delete($roleID);
        try {
            if(count($permissionArray) > 0):
                if(count($permissionArray) > 1):
                    foreach($permissionArray as $singleP):
                        $this->Permission_model->insert($roleID,$singleP);
                    endforeach;
                else:
                    $this->Permission_model->insert($roleID,$permissionArray);
                endif;
            endif;
            $ret = array('status'=>'1','msg'=>'Role Permission updated successfully.');
        } catch (Exception $e) {
            $ret = array('status'=>'0','msg'=>'There is problem adding role permission.');
        }
        echo json_encode($ret);
    }

    public function single(){
        
    }
    
    public function delete(){
        
    }
}