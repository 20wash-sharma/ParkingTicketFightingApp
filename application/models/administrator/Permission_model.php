<?php
    class Permission_model extends CI_Model{
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        function all($roleID){
            /*$this->db->select("p.PermissionID, pg.PermissionGroupID, pg.GroupName");
            $this->db->from("permission p");
            $this->db->join("permission_group pg","p.PermissionGroup = pg.PermissionGroupID","inner");
            $query = $this->db->get();
            return $query->result();*/
            
            $sql = "select p.PermissionID, pg.PermissionGroupID, pg.GroupName, (CASE WHEN rp.Role_roleID IS NULL THEN 0 ELSE 1 END) isAssign from permission p inner join permission_group pg on p.PermissionGroup = pg.PermissionGroupID left join (select * from role_has_permission where Role_roleID = ?) rp on rp.permission_permissionID = p.PermissionID order by PermissionID";
            $query = $this->db->query($sql, array($roleID));
            return $query->result();
        }
        
        function insert($roleId,$permissionId){
            try {
                $data = array('Role_roleID' => $roleId, 'permission_permissionID' => $permissionId);
                $this->db->insert('role_has_permission', $data);
                return array('status' => '1', 'msg' => 'Role added successfully.');
            } catch (Exception $e) {
                return array('status'=>'0','msg'=>'There is problem adding role.');
            }
        }
        
        function delete($roleID){
            try{
                $this->db->where("Role_roleID", $roleID);
                $this->db->delete("role_has_permission");
                return array('status' => '1', 'msg' => 'Role permission deleted successfully.');
            }catch(Exception $e){
                return array('status'=>'0','msg'=>'There was problem deleting role permission.');
            }
        }
        
        function getPermissionsByRole($roleID){
            $sql = "select pg.GroupName, p.name from role_has_permission rp inner join permission p on rp.permission_permissionID = p.permissionID inner join permission_group pg on p.PermissionGroup = pg.PermissionGroupID where Role_roleID = ?";
            $query = $this->db->query($sql, array($roleID));
            return $query->result();
        }
    }
?>