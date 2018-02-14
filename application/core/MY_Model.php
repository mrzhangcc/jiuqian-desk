<?php
/**
 *  2014-9-22
 * @author ZhangCC
 * @version
 * @description  
 */
class MY_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
}

class Base_Model extends MY_Model
{
	public $HostDb;
	public $CompanyDb;
	public function __construct($Second = false)
	{
		parent::__construct();
		$this->HostDb = $this->load->database('default', TRUE);
		if($Second){
			$this->com_connect();
		}
		/**
		 * 开启缓存
		 */
		$this->e_cache->open_cache();
		log_message('debug', 'Model Base_Model Start');
	}
	
	public function com_connect(){
		$Database = $this->session->userdata('database');
		log_message('debug', 'Model Base_Model Start Second on!'.$Database);
		if(!empty($Database) && $Database !== 'default'){
			$this->CompanyDb = $this->load->database($Database, TRUE);
		}else{
			redirect(site_url('sign/out'));
		}
	}
	
	public function remove_cache($File, $Reg = true){
	    $this->load->helper('file');
	    if($Reg){
	        delete_cache_files('(.*'.$File.'.*)');
	    }else{
	        delete_cache_files($File);
	    }
	}
	
	protected function _unformat_as($Item, $File){
	    $this->config->load('dbview/'.$File);
	    $Dbview = $this->config->item($Item);
	    $Return = array();
	    foreach ($Dbview as $key => $value){
	        $Return[] = $key.' as '.$value;
	    }
	    return implode(',', $Return);
	}
	protected function _unformat($Data, $Item, $File){
	    $this->config->load('dbview/'.$File);
	    $Dbview = $this->config->item($Item);
	    $Return = array();
	    foreach ($Data as $key => $value){
	        foreach ($Dbview as $ikey=>$ivalue){
	            $Return[$key][$ivalue] = isset($value[$ikey])?$value[$ikey]:'';
	        }
	    }
	    return $Return;
	}
	
	protected function _format($Data, $Item, $File){
	    $this->config->load('formview/'. $File);
	    $FormView = $this->config->item($Item);
	    foreach ($FormView as $key=>$value){
	        if(isset($Data[$key])){
	            if(is_array($Data[$key])){
	                $Set[$value] = implode(',', $Data[$key]);
	            }else{
	                $Set[$value] = $Data[$key];
	            }
	        }elseif(array_key_exists($key, $Data) && is_null($Data[$key])){
	            $Set[$value] = $this->_default($key, null);
	        }else{
	            $Set[$value] = $this->_default($key);
	        }
	    }
	    return $Set;
	}
	
	/**
	 * 通过Data来格式化数据
	 * @param unknown $Data
	 * @param unknown $Item
	 * @param unknown $File
	 */
	protected function _format_re($Data, $Item, $File){
	    $this->config->load('formview/'. $File);
	    $FormView = $this->config->item($Item);
	    foreach ($Data as $key => $value){
	        if(is_array($value)){
	            $value = implode(',', $value);
	        }
	        if(isset($FormView[$key])){
	            $Set[$FormView[$key]] = $value;
	        }
	    }
	    return $Set;
	}
	
	protected function _default($name, $tmp=''){
	    switch ($name){
	        case 'creator':
	            $Return = $this->session->userdata('uid');
	            break;
	        case 'create_datetime':
	            $Return = date('Y-m-d H:i:s');
	            break;
	        default:
	            $Return = $tmp;
	    }
	    return $Return;
	}
}//end Base_Model