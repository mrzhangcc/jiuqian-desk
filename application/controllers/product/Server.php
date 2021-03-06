<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年11月19日
 * @author Zhangcc
 * @version
 * @des
 * 服务类产品
 */
class Server extends CWDMS_Controller{
    private $_Module;
	private $_Controller;
	private $_Item;
	private $_Cookie;
	
    public function __construct(){
        parent::__construct();
        $this->load->model('product/server_model');
        $this->_Module = $this->router->directory;
        $this->_Controller = $this->router->class;
        $this->_Item = $this->_Module.$this->_Controller.'/';
        
        log_message('debug', 'Controller Product/Server Start!');
    }

    public function index(){
        $View = $this->uri->segment(4, 'read');
        if(method_exists(__CLASS__, '_'.$View)){
            $View = '_'.$View;
            $this->$View();
        }else{
            $Item = $this->_Item.$View;
            $Data['action'] = site_url($Item);
            $this->load->view($Item, $Data);
        }
    }


    public function read(){
        $Data = array();
        if(!($Data = $this->server_model->select_server())){
            $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'没有服务';
        }
        $this->_return($Data);
    }
    public function add(){
        $Item = $this->_Item.__FUNCTION__;
        if($this->form_validation->run($Item)){
            $Post = gh_escape($_POST);
            if(!!($Id = $this->server_model->insert_server($Post))){
                $this->Success .= '服务新增成功, 刷新后生效!';
            }else{
                $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'服务信息新增失败';
            }
        }else{
            $this->Failue .= validation_errors();
        }
        $this->_return();
    }
    public function edit(){
        $Item = $this->_Item.__FUNCTION__;
        if($this->form_validation->run($Item)){
            $Post = gh_escape($_POST);
            $where = $this->input->post('selected');
            if(!!($this->server_model->update_server($Post, $where))){
                $this->Success .= '服务信息修改成功, 刷新后生效!';
            }else{
                $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'服务信息修改失败';
            }
        }else{
            $this->Failue .= validation_errors();
        }
        $this->_return();
    }
    /**
     * 批量定义板块的单价
     */
    public function unit_price(){
        $Selected = $this->input->post('selected', true);
        $UnitPrice = $this->input->post('unit_price', true);
        $Selected = trim($Selected);
        $Selected = explode(',', $Selected);
        $UnitPrice = floatval(trim($UnitPrice));
        $Set = array();
        foreach ($Selected as $key => $value){
            $value = intval(trim($value));
            if($value > 0){
                $Set[$key] = array(
                    'sid' => $value,
                    'unit_price' => $UnitPrice
                );
            }
        }
        unset($Selected);
        if(!empty($Set)){
            if(!!($this->server_model->update_batch($Set))){
                $this->Success .= '服务产品单价修改成功, 刷新后生效!';
            }else{
                $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'服务产品单价修改失败';
            }
        }else{
            $this->Failue = '请选择要修改单价的服务产品!';
        }
        $this->_return();
    }
    /**
     * 删除
     */
    public function remove(){
        $Item = $this->_Item.__FUNCTION__;
        if($this->form_validation->run($Item)){
            $Where = $this->input->post('selected', true);
            if($Where !== false && is_array($Where) && count($Where) > 0){
                if($this->server_model->delete_server($Where)){
                    $this->Success .= '服务信息删除成功, 刷新后生效!';
                }else {
                    $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'服务信息删除失败';
                }
            }else{
                $this->Failue .= '没有可删除项!';
            }
        }else{
            $this->Failue .= validation_errors();
        }
        $this->_return();
    }
}