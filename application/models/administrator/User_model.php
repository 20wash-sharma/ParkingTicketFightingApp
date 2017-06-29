<?php
    class User_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function insert($data,$roleID){
            try {
                $query = $this->db->insert('user', $data);
                if($query == FALSE)
                {
                    //print_r($this->db);
                    $error = $this->db->conn_id->errno;
                    if($error == 1062)
                        return array('status' => '0', 'msg' => 'This username already exists.');
                }
                
                $UserID = $this->db->insert_id();
                $this->db->insert('role_member', array('user_UserID'=>$UserID,'Role_roleID'=>$roleID));
                return array('status' => '1', 'msg' => 'User added successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There was problem adding user.');
            }
        }
        
        function update($data,$userID,$roleID){
            try{
                $this->db->where('UserID', $userID);
                $query = $this->db->update('user',$data);
                if($query == FALSE)
                {
                    //print_r($this->db);
                    $error = $this->db->conn_id->errno;
                    if($error == 1062)
                        return array('status' => '0', 'msg' => 'This username already exists.');
                }
                $this->db->where('user_UserID', $userID);
                $this->db->update('role_member',array('Role_roleID'=>$roleID));
                return array('status' => '1', 'msg' => 'User updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There was problem updating user.');
            }
        }
        
        function updateProfile($userID, $data){
            try{
                $this->db->where('UserID', $userID);
                $this->db->update('user',$data);
                return array('status' => '1', 'msg' => 'Profile updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There was problem updating profile.');
            }
        }
        
        function updateContact($userID, $data){
            try{
                $this->db->where('UserID', $userID);
                $this->db->update('user',$data);
                return array('status' => '1', 'msg' => 'Contact updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There was problem updating contact.');
            }
        }
        
        function updateimage($userID, $userImg){
            try{
                $this->db->where('UserID', $userID);
                $this->db->update('user',array('profileImage'=>$userImg));
                return array('status' => '1', 'msg' => 'Profile image updated successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There was problem updating profile image.');
            }
        }
        
        function all($roleLevel){
            $sql = "SELECT u.UserID, u.username, u.firstname, u.lastname, u.email, u.phone, u.facebook, u.twitter, r.name, u.status, u.creationtime, (select count(v.VehicleID) from vehicles v where v.user_UserID = u.UserID) noOfVehicles, (select count(pa.PaymentaccountID) from payment_accounts pa where pa.user_UserID = u.UserID) noOfPaymentsAcc FROM user u LEFT JOIN role_member rm ON u.UserID = rm.user_UserID LEFT JOIN role r ON rm.Role_roleID = r.RoleID WHERE r.level >= " . $roleLevel . " ORDER BY u.UserID DESC";
            $query = $this->db->query($sql);
            return $query->result();
            
            /*$this->db->select("u.UserID, u.username, u.firstname, u.lastname, u.email, r.name, u.status, u.creationtime, count(*) noVehicle");
            $this->db->from("user u");
            $this->db->join("role_member rm","u.UserID = rm.user_UserID","left");
            $this->db->join("role r","rm.Role_roleID = r.RoleID","left");
            $this->db->join("vehicles v","u.UserID = v.user_UserID","left");
            $this->db->order_by("u.UserID","desc");
            $query = $this->db->get();
            echo $this->db->last_query();
            return $query->result();*/
        }
        
        
        
        function single($userID){
            $this->db->select("*");
            $this->db->from("user u");
            $this->db->join("role_member rm","u.UserID = rm.user_UserID","left");
            $this->db->where('UserID', $userID);
            $query = $this->db->get();
            return $query->result();
        }
        
        function singleByUserName($userName){
            $this->db->select("*");
            $this->db->from("user u");
            $this->db->join("role_member rm","u.UserID = rm.user_UserID","left");
            $this->db->join("role r","rm.Role_roleID = r.RoleID","left");
            $this->db->where("u.username", $userName);
            $query = $this->db->get();
            return $query->result();
        }
        
        function delete($userID){
            try{
                $this->db->where_in("UserID", explode(',',$userID));
                $this->db->delete("user");
                return array('status' => '1', 'msg' => 'User deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There was problem deleting user.');
            }
        }
        
        function changeStatus($userID,$userStatus){
            try{
                $this->db->where("UserID", $userID);
                $this->db->update("user",array('status'=>!$userStatus));
                return array('status' => '1', 'msg' => 'User status changed successfully.');
            } catch (Exception $ex) {
                return array('status' => '0', 'msg' => 'User status could not be changed.');
            }
        }
        
        function checkLogin($userName,$password){
            try{
//                $query = $this->db->select('*')
//                                    ->from('user u')
//                                    ->from('role_member rm','u.UserID = rm.user_UserID','inner')
//                                    ->from('role r','rm.Role_roleID = r.RoleID','inner')
//                                    ->where('username', $userName)
//                                    ->where('password', $password)
//                                    ->limit(1)
//                                    ->get();
                $sql = "select * from user u inner join role_member rm on u.UserID = rm.user_UserID inner join role r on rm.Role_roleID = r.RoleID where username = ? and password = ? limit 0,1";
                $query = $this->db->query($sql,array($userName,$password));
                //echo $this->db->last_query();
                if($query -> num_rows() == 1)
                {
                    return array('status'=>'1', 'data'=>$query->result());
                }
                else
                {
                    return array('status'=>'0','msg'=>'Incorrct username/password.');
                }
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'Incorrct username/password.');
            }
        }
        
        function updateLastLogin($userName){
            $lastSeen = date('Y-m-d h:i:s');
            $sql = "update user set lastseen = ? where username = ?";
            $this->db->query($sql,array($lastSeen,$userName));
            //$this->db->where("username", $userName);
            //$this->db->update("user",array("lastseen"),date('Y-m-d h:i:s'));
        }
        
        function changePassword($userID, $oldPassword, $newPassword){
            try{
                $this->db->select('*');
                $this->db->from('user');
                $this->db->where('UserID',$userID);
                $this->db->where('password', md5($oldPassword));
                $query = $this->db->get();
                if($query->num_rows() > 0){
                    $this->db->where('UserID',$userID);
                    $this->db->update('user',array('password'=>  md5($newPassword)));
                    return array('status'=>'1','msg'=>'Password changed successfully.');
                } else {
                    return array('status'=>'0','msg'=>'Old password do not match.');
                }
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'Incorrct username/password.');
            }
        }
        
        function checkactivationcode($activationCode){
            echo $activationCode;
            try{
                $this->db->select('UserID');
                $this->db->from('user');
                $this->db->where('activationCode',$activationCode);
                $query = $this->db->get();
                if($query->num_rows() > 0){
                    return array('status'=>'1','userID'=>$query->result()[0]->UserID);
                } else {
                    return array('status'=>'0','msg'=>'Old password do not match.');
                }
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'Invalid activation code.');
            }
        }
        
        function createpassword($userID, $password){
            try{
                $this->db->where('UserID',$userID);
                $query = $this->db->update('user',array('password'=>  md5($password),'activationCode'=>''));
                
                return array('status'=>'1','msg'=>'Password created successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'Password could not be created.');
            }
        }
        
        function insertToken($token, $userID){
            try{
                $this->db->insert('api_token', array('userID'=>$userID,'token'=>$token));
                return array('status' => '1', 'msg' => 'User added successfully.');
            }catch(Exception $e){
                return array('status' => '0', 'msg' => 'User added successfully.');
            }
        }
        
        function checkToken($userID,$token){
            try{
                $query = $this->db->select('*')
                            ->from('api_token')
                            ->where('userID', $userID)
                            ->where('token', $token)
                            ->get();
                //echo $this->db->last_query();
                if($query -> num_rows() == 1)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }catch(Exception $e){
                return false;
            }
        }
        
        function getLevelByUserID($userID){
            $this->db->select('r.level');
            $this->db->from('role r');
            $this->db->join('role_member rm', "r.RoleID = rm.Role_roleID", "inner");
            $this->db->where('rm.user_UserID',$userID);
            $query = $this->db->get();
            $result = $query->result();
            return $result[0]->level;
        }
    }