<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created for jiuqian-desk.
 * User: chuangchuangzhang
 * Date: 2018/2/12
 * Time: 12:30
 *
 * Desc:
 */
class Role_visit_model extends Base_Model {
    public function __construct() {
        parent::__construct(__DIR__, __CLASS__);
        log_message('debug', 'Model permission/Role_visit_model Start!');
    }

    public function select_by_rid($Rid) {
        $Item = $this->Item.__FUNCTION__;
        $Cache = $this->Cache.__FUNCTION__;
        $Return = false;
        if(!($Return = $this->cache->get($Cache))){
            $Sql = $this->_unformat_as($Item, $this->Module);
            $Query = $this->HostDb->select($Sql)->from('role_visit')
                        ->where('rv_role_id', $Rid)
                        ->get();
            if($Query->num_rows() > 0){
                $Return = $Query->result_array();
                $this->cache->save($Cache, $Return, MONTHS);
            }
        }
        return $Return;
    }

    public function insert($Data) {
        $Item = $this->Item.__FUNCTION__;
        $Data = $this->_format($Data, $Item, $this->Module);
        if($this->HostDb->insert('role_visit', $Data)){
            log_message('debug', "Model Role_visit_model/insert_role_visit Success!");
            $this->remove_cache($this->Module);
            return $this->HostDb->insert_id();
        }else{
            log_message('debug', "Model Role_visit_model/insert_role_visit Error");
            return false;
        }
    }

    public function insert_batch($Data) {
        $Item = $this->Item.__FUNCTION__;
        foreach ($Data as $key => $value){
            $Data[$key] = $this->_format($value, $Item, $this->Module);
        }
        if($this->HostDb->insert_batch('role_visit', $Data)){
            log_message('debug', "Model Role_visit_model/insert_batch Success!");
            $this->remove_cache($this->Module);
            return true;
        }else{
            log_message('debug', "Model Role_visit_model/insert_batch Error");
            return false;
        }
    }

    /**
     * 删除功能时同时删除相应的角色权限
     * @param $Mid
     * @return bool
     */
    public function delete_by_vid($Id){
        if(is_array($Id)){
            $this->HostDb->where_in('rv_visit_id', $Id);
        }else{
            $this->HostDb->where('rv_visit_id', $Id);
        }
        $this->HostDb->delete('role_visit');
        $this->remove_cache($this->Module);
        return true;
    }

    /**
     * 删除角色时同时删除相关联的功能权限
     * @param $Rid
     * @return boolean
     */
    public function delete_by_rid($Id) {
        if(is_array($Id)){
            $this->HostDb->where_in('rv_role_id', $Id);
        }else{
            $this->HostDb->where('rv_role_id', $Id);
        }
        $this->HostDb->delete('role_visit');
        $this->remove_cache($this->Module);
        return true;
    }
}
