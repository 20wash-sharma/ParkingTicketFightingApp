<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH.'/libraries/REST_Controller.php';
    
    class Vehicle extends REST_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->load->model('administrator/Vehiclemake_model');
            $this->load->model('administrator/Vehicles_model');
            $this->load->model('administrator/Platetype_model');
            $this->load->model('administrator/State_model');
            $this->load->model('administrator/Plates_model');
            $this->load->model('administrator/User_model');
            
            // Configure limits on our controller methods. Ensure
            // you have created the 'limits' table and enabled 'limits'
            // within application/config/rest.php
            $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
            $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
            $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
        }
        
        function allMake_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            $vechicleMakeAll = $this->Vehiclemake_model->all();
            $this->response($vechicleMakeAll, 200);
        }
        
        function allPlateType_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            $vechiclePlateType =  $this->Platetype_model->all();
            $this->response($vechiclePlateType, 200);
        }
        
        function allState_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            $states =  $this->State_model->all();
            $this->response($states, 200);
        }
        
        function setup_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            if(!$this->post('nickname'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('plateno'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('makeid'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('stateid'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('platetype'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('plateexpiry'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('isCitySticker'))
            {
                $this->response(NULL, 400);
            }
            
            $nickname = $this->post('nickname');
            $plateno = $this->post('plateno');
            $makeid = $this->post('makeid');
            $stateid = $this->post('stateid');
            $platetype = $this->post('platetype');
            $plateexpiry = $this->post('plateexpiry');
            $isCitySticker = $this->post('isCitySticker');
            $stickerExpiry = $this->post('stickerExpiry');
            $registeredOwner = $this->post('registeredOwner');
            
            $firstname = $this->post('firstname');
            $lastname = $this->post('lastname');
            $email = $this->post('email');
            
            $dataVehicle = array(
                'creationtime' => date('Y-m-d'),
                'nickName' => $nickname,
                'user_UserID' => $userID,
                'vehicleMake_vehicleMake' => $makeid
            );
            $ret = $this->Vehicles_model->insert($dataVehicle);
            if($ret != NULL && $ret['vehicleID'] != 0):
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
                $ret = $this->Plates_model->insert($dataPlate);
            endif;
            $dataUser = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email
            );
            $ret = $this->User_model->update($dataUser, $userID, 23);
            if($ret == null):
                $retBack = array('status'=>'0','msg'=>'There is problem updating data.');
            else:
                $retBack = $ret;
            endif;
            $this->response($ret,400);
        }
        
        function vehicleInsertUpdate_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            if(!$this->post('nickname'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('stateid'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('makeid'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('plateno'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('platetype'))
            {
                $this->response(NULL, 400);
            }
            if(!$this->post('plateexpiry'))
            {
                $this->response(NULL, 400);
            }
            /*if(!$this->post('isCitySticker'))
            {
                $this->response('NULL8', 400);
            }*/
        
            $vehicleID = 0;
            if($this->post('vehicleID')){
                $vehicleID = $this->post('vehicleID');
            }
            $nickname = $this->post('nickname');
            $plateno = $this->post('plateno');
            $makeid = $this->post('makeid');
            $stateid = $this->post('stateid');
            $platetype = $this->post('platetype');
            $plateexpiry = $this->post('plateexpiry');
            $isCitySticker = $this->post('isCitySticker');
            $stickerExpiry = $this->post('stickerExpiry');
            $registeredOwner = $this->post('registeredOwner');
            $vin = $this->post('vin');
            
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
            $this->response($ret,400);
        }
        
        function allVehicle_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            $vechicleAll = $this->Vehicles_model->allList($this->post('userID'));
            $this->response($vechicleAll, 200);
        }
        
        function singleVehicle_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            if(!$this->post('vehicleID'))
            {
                $this->response(NULL, 400);
            }
            $vechicleSingle = $this->Vehicles_model->single($this->post('vehicleID'));
            $this->response($vechicleSingle, 200);
        }
        
        function deleteVehicle_post(){
            if(!$this->post('token')){
                $this->response(NULL,400);
            }
            if(!$this->post('userID'))
            {
                $this->response(NULL, 400);
            }
            $userID = $this->post('userID');
            $token = $this->post('token');
            $checkStatus = $this->User_model->checkToken($userID, $token);
            if(!$checkStatus)
                $this->response(NULL,400);
            
            if(!$this->post('vehicleID'))
            {
                $this->response(NULL, 400);
            }
            $ret = $this->Vehicles_model->delete($this->post('vehicleID'));
            $this->response($ret, 200);
        }
    }