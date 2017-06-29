<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Alerts extends Admin_Controller
    {

        function __construct()
        {
            parent::__construct();
            $this->load->model('administrator/Alerts_model');
        }

        public function index()
        {
            
        }

        public function updatepreference()
        {
            $userID = $this->input->post('userID');
            $formElementStatus = $this->input->post('formElementStatus');
            $formElementSel = $this->input->post('formElementSel');
            $formElementStatusChk = $this->input->post('formElementStatusChk');
            //print_r($formElementStatus);
            //print_r($formElementSel);
            $this->Alerts_model->delete($userID);
            try {
                for($count = 0;$count < count($formElementStatus);$count++):
                    $data1 = array(
                        'creationtime' => date('Y-m-d'),
                        'updatetime' => date('Y-m-d'),
                        'sendalert' => $formElementStatusChk[$count],
                        'user_UserID' => $userID,
                        'alertType' => $formElementSel[$count]
                    );
                    $AlertpreferancesID = $this->Alerts_model->insertPreference($data1);
                    $data = array(
                        'creationtime' => date('Y-m-d'),
                        'alerts_alertsID' => $formElementStatus[$count],
                        'alertpreferances_alertpreferancesID' => $AlertpreferancesID,
                        'alertpreferances_user_UserID' => $userID
                    );
                    $this->Alerts_model->insertAlert($data);
                endfor;
                $ret = array('status'=>'1','msg'=>'Alert settings updated successfully.');
            } catch (Exception $e) {
                $ret = array('status'=>'0','msg'=>'There is problem updating alert settings permission.');
            }
            echo json_encode($ret);
        }
    }