<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  2015-4-27
 * @author ZhangCC
 * @version
 * @description  
 */
class Payterms_model extends Base_Model{
    private $_Module = 'dealer';
    private $_Model;
    private $_Item;
    private $_Cache;
    
	public function __construct(){
		parent::__construct();
		
		$this->_Model = strtolower(__CLASS__);
		$this->_Item = $this->_Module.'/'.$this->_Model.'/';
		$this->_Cache = $this->_Module.'_'.$this->_Model.'_';
		log_message('debug', 'Model Dealer/Payterms_model Start!');
	}

	public function select(){
	    $Item = $this->_Item.__FUNCTION__;
	    $Cache = $this->_Cache.__FUNCTION__;
	    if(!($Return = $this->cache->get($Cache))){
	        $Sql = $this->_unformat_as($Item, $this->_Module);
	        $this->HostDb->select($Sql, FALSE);
	        $this->HostDb->from('payterms');
	         
	        $Query = $this->HostDb->get();
	        if($Query->num_rows() > 0){
	            $Result = $Query->result_array();
	            $Return = array(
	                'content' => $Result,
	                'num' => $Query->num_rows(),
	                'p' => 1,
	                'pn' => 1
	            );
	            $this->cache->save($Cache, $Return, MONTHS);
	        }else{
	            $GLOBALS['error'] = '没有经销商支付条款信息!';
	        }
	    }
	    return $Return;
	}
	
	public function insert($Data) {
	    $Item = $this->_Item.__FUNCTION__;
	    $Data = $this->_format($Data, $Item, $this->_Module);
	    if($this->HostDb->insert('payterms', $Data)){
	        log_message('debug', "Model Payterms_model/insert Success!");
	        $this->remove_cache($this->_Cache);
	        return $this->HostDb->insert_id();
	    }else{
	        log_message('debug', "Model Payterms_model/insert Error");
	        return false;
	    }
	}
	
	public function update($Data, $Where) {
	    $Item = $this->_Item.__FUNCTION__;
	    $Data = $this->_format_re($Data, $Item, $this->_Module);
	    $this->HostDb->where('p_id', $Where);
	    $this->HostDb->update('payterms', $Data);
	    $this->remove_cache($this->_Cache);
	    return TRUE;
	}
}