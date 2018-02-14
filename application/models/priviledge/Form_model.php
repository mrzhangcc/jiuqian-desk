<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created for jiuqian-desk.
 * User: chuangchuangzhang
 * Date: 2018/2/13
 * Time: 09:58
 *
 * Desc:
 */
class Form_model extends Base_Model{
    private $_Module;
    private $_Model;
    private $_Item;
    private $_Cache;

    public function __construct(){
        log_message('debug', 'Model Priviledge/Form_model Start!');
        parent::__construct();

        $this->_Module = str_replace("\\", "/", dirname(__FILE__));
        $this->_Module = substr($this->_Module, strrpos($this->_Module, '/')+1);
        $this->_Model = strtolower(__CLASS__);
        $this->_Item = $this->_Module.'/'.$this->_Model.'/';
        $this->_Cache = str_replace('/', '_', $this->_Item);
    }

    public function select() {
        $Item = $this->_Item.__FUNCTION__;
        $Cache = $this->_Cache . __FUNCTION__;
        $Return = false;
        if (!($Return = $this->cache->get($Cache))) {
            $Sql = $this->_unformat_as($Item, $this->_Module);
            $Query = $this->HostDb->select($Sql)->from('form AS A ')
                ->join('j_func AS B', 'B.f_id = A.f_func_id', 'left', false)
                ->join('menu', 'm_id = B.f_menu_id', 'left')
                ->order_by('m_displayorder')
                ->order_by('B.f_displayorder')
                ->get();
            if ($Query->num_rows() > 0) {
                $Return = $Query->result_array();
                $this->cache->save($Cache, $Return, MONTHS);
            }
        }
        return $Return;
    }

    /**
     * 通过用户组id获取数据
     * @param $Uid
     * @return bool
     */
    public function select_by_fid($Fid){
        $Item = $this->_Item.__FUNCTION__;
        $Cache = $this->_Cache.__FUNCTION__;
        $Return = false;
        if(!($Return = $this->cache->get($Cache))){
            $Sql = $this->_unformat_as($Item, $this->_Module);
            $Query = $this->HostDb->select($Sql)->from('form')
                ->where('f_func_id', $Fid)
                ->get();
            if($Query->num_rows() > 0){
                $Return = $Query->result_array();
                $this->cache->save($Cache, $Return, MONTHS);
            }
        }
        return $Return;
    }

    public function insert($Data){
        $Item = $this->_Item.__FUNCTION__;
        $Data = $this->_format($Data, $Item, $this->_Module);

        if($this->HostDb->insert('form', $Data)){
            log_message('debug', "Model Form_model/insert Success!");
            $this->remove_cache($this->_Module);
            return $this->HostDb->insert_id();
        }else{
            log_message('debug', "Model Form_model/insert Error");
            return false;
        }
    }

    /**
     * 更新菜单
     * @param unknown $Data
     * @param unknown $Where
     */
    public function update($Data, $Where){
        $Item = $this->_Item.__FUNCTION__;
        $Data = $this->_format_re($Data, $Item, $this->_Module);

        $this->HostDb->where('f_id', $Where);
        $this->HostDb->update('form', $Data);
        $this->remove_cache($this->_Module);
        return TRUE;
    }

    /**
     * 在删除用户组时，删除冗余的用户组角色信息
     * 在设置用户组包含角色时，也需要删除冗余信息
     * @param $Where
     * @return bool
     */
    public function delete($Where) {

        if(is_array($Where)){
            $this->HostDb->where_in('f_id', $Where);
        }else{
            $this->HostDb->where('f_id', $Where);
        }

        $this->HostDb->delete('form');
        $this->remove_cache($this->_Module);
        return true;
    }

    /**
     * 通过FuncId删除时清理冗余信息
     * @param $Where
     * @return bool
     */
    public function delete_by_func_id($Where) {
        if (is_array($Where)) {
            $Query = $this->HostDb->select('f_id')->from('form')
                            ->where_in('f_func_id', $Where)->get();
        }else {
            $Query = $this->HostDb->select('f_id')->from('form')
                            ->where('f_func_id', $Where)->get();
        }
        if ($Query->num_rows() > 0) {
            $Fids = $Query->result_array();
            $Query->free_result();
        }else {
            $Fids = false;
        }
        if(is_array($Where)){
            $this->HostDb->where_in('f_func_id', $Where);
        }else{
            $this->HostDb->where('f_func_id', $Where);
        }

        $this->HostDb->delete('form');
        if ($Fids) {
            foreach ($Fids as $key => $value) {
                $Fids[$key] = $value['f_id'];
            }
            $this->load->model('priviledge/role_form_model');
            $this->load->model('priviledge/form_model');
            return $this->role_form_model->delete_by_fid($Fids);
        }else {
            return true;
        }
    }
}