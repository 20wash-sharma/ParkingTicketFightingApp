<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('administrator/Vehicles_model');
        $this->load->model('administrator/Plates_model');
    }
    public function deleteselected(){
        $vehicleIds = $this->input->post('vehicleIDs');
        $ret = $this->Vehicles_model->delete($vehicleIds);
        echo json_encode($ret);
    }
    function delete(){
        $vehicleId = $this->input->post('vehicleId');
        $ret = $this->Vehicles_model->delete($vehicleId);
        
        if($ret == null):
            $retBack = array('status'=>'0','msg'=>'There is problem deleting data.');
        else:
            $retBack = $ret;
        endif;
        echo json_encode($retBack);
        
    }
    
    function single(){      
        $vehicleID = $this->input->post('vechileID');
        $vehicleSingle = $this->Vehicles_model->single($vehicleID);
        echo json_encode($vehicleSingle);
    }
        
    public function index()
    {
        
    }
    
    public function all(){
        $vehiclesArray = array();
        $userID = $this->uri->segment(4);
        $vehicleArrary = array();
        $allVehicles = $this->Vehicles_model->all($userID);
        
        $index = 0;
        $count = 1;
        
        foreach($allVehicles as $singleVehicle){
            $isExpiry = 0;
            $hasSticker = $singleVehicle->hasSticker;
            
            $plateExpiry = new DateTime($singleVehicle->plateexperation);
            $stickerExpiry = new DateTime($singleVehicle->stickerExperation);
            $currentDate = new DateTime();
            $plateExpiryDays = $plateExpiry->diff($currentDate)->format('%a');
            $stickerExpiryDays = $stickerExpiry->diff($currentDate)->format('%a');
            
            if($plateExpiry < $currentDate || ($hasSticker && $stickerExpiry < $currentDate))
                $isExpiry = 2;
            else if($plateExpiryDays < 30 || ($hasSticker && $stickerExpiryDays < 30)){
                $isExpiry = 1;
            }
            
            $deleteCheckBox = '<input type="checkbox" class="checkboxDel" name="deleteRole" value="' . $singleVehicle->VehicleID . '">';
            
            $userData = $this->session->userdataall;
            $roleID = $userData[0]->Role_roleID;
            $permission = $this->Permission_model->getPermissionsByRole($roleID);
            
            $editVehicle = checkPermission('Vehicle','Edit', $permission);
            $deleteVehicle = checkPermission('Vehicle','Delete', $permission);
            $actionhtml = "";
            if($editVehicle)
                $actionhtml .= '<button class="edit btn btn-default btn-rounded btn-condensed btn-sm" data-toggle="modal" data-target="#modal_Vehicle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Vehicle" data-vehicleID="' . $singleVehicle->VehicleID . '"><span class="fa fa-pencil"></span></button>';
            if($deleteVehicle)
                $actionhtml .= '<button class="delete btn btn-danger btn-rounded btn-condensed btn-sm" data-vehicleID="' . $singleVehicle->VehicleID . '" onClick="delete_row(\'trow_' . $count . ',' . $singleVehicle->VehicleID . '"><span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Vehicle" data-vehicleID="' . $singleVehicle->VehicleID . '"></span></button>';
            
             $position = 0;
             $vehiclesArray[$index][$position] = $isExpiry;
             $position++;
             if($deleteVehicle):
                $vehiclesArray[$index][$position] = $deleteCheckBox;
                $position++;
            endif;
            $vehiclesArray[$index][$position] = $count;
            $position++;
            $vehiclesArray[$index][$position] = $singleVehicle->nickName;
            $position++;
            $vehiclesArray[$index][$position] = $singleVehicle->vehiclemake;
            $position++;
            $vehiclesArray[$index][$position] = $singleVehicle->platenumber;
            $position++;
            $vehiclesArray[$index][$position] = date('Y-m-d', strtotime($singleVehicle->creationtime));
            $position++;
            $vehiclesArray[$index][$position] = $singleVehicle->StateShortName;
            $position++;
            $vehiclesArray[$index][$position] = $singleVehicle->platetype;
            $position++;
            $vehiclesArray[$index][$position] = date('Y-m-d', strtotime($singleVehicle->plateexperation));
            $position++;
            $vehiclesArray[$index][$position] = $singleVehicle->registeredname;
            $position++;
            
            if($hasSticker):
                $vehiclesArray[$index][$position] = 'Yes';
            else:
                $vehiclesArray[$index][$position] = 'No';
            endif;
            $position++;
            if($hasSticker):
                $vehiclesArray[$index][$position] = date('Y-m-d', strtotime($singleVehicle->stickerExperation));
            else:
                $vehiclesArray[$index][$position] = '';
            endif;
            $position++;
            if($actionhtml != ''):
                $vehiclesArray[$index][$position] = $actionhtml;
            endif;
            
            //$vehiclesArray[$index] = array($deleteCheckBox,$count, $item->firstname . ' ' . $item->lastname, $item->email, $item->noOfVehicles, $item->noOfPaymentsAcc, $item->name, $statushtml, date('Y-m-d',strtotime($item->creationtime)),$actionhtml);
            $index++;   
            $count++;
        }
        //echo $userID;
        //var_dump($vehicleArrary);
        echo json_encode(array('status'=>'1','data'=>$vehiclesArray));
    }
    
    public function addedit(){
        $userID = $this->input->post('userID');
        $vehicleID = $this->input->post('vehicleID');
        
        $nickname = $this->input->post('nickname');
        $plateno = $this->input->post('plateno');
        $makeid = $this->input->post('makeid');
        $stateid = $this->input->post('stateid');
        $platetype = $this->input->post('platetype');
        $plateexpiry = $this->input->post('plateexpiry');
        $isCitySticker = $this->input->post('isCitySticker');
        $stickerExpiry = $this->input->post('stickerExpiry');
        $registeredOwner = $this->input->post('registeredOwner');
        $vin = $this->input->post('vin');
            
        $dataVehicle = array(
            'creationtime' => date('Y-m-d'),
            'nickName' => $nickname,
            'user_UserID' => $userID,
            'vehicleMake_vehicleMake' => $makeid,
            'VIN' => $vin
        );
        if($vehicleID > 0):
            $ret = $this->Vehicles_model->update($dataVehicle, $vehicleID);
        else:
            $ret = $this->Vehicles_model->insert($dataVehicle);
        endif;
            
        if($ret != NULL && $ret['vehicleID'] != "0"):
            $dataPlate = array(
                'platenumber' => $plateno,
                'creationtime' => date('Y-m-d'),
                'state_StateID' => $stateid,
                'plateTypes_plateTypesID' => $platetype,
                'plateexperation' => $plateexpiry,
                'registeredname' => $registeredOwner,
                'hasSticker' => $isCitySticker,
                'stickerExperation' => $stickerExpiry,
                'Vehicles_vehicleID' => $ret['vehicleID'],
                'Vehicles_user_UserID' => $userID
            );
            if($vehicleID > 0):
                $ret = $this->Plates_model->update($dataPlate, $vehicleID);
            else:
                $ret = $this->Plates_model->insert($dataPlate);
            endif;
        endif;
            
        if($ret == null):
            $retBack = array('status'=>'0','msg'=>'There is problem updating data.');
        else:
            $retBack = $ret;
        endif;
        echo json_encode($retBack);
    }
}