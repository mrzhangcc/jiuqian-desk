<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 2015年11月28日
 * @author Zhangcc
 * @version
 * @des
 * 衣柜结构-之板材名称
 */
class Wardrobe_board extends CWDMS_Controller{
    private $_Module;
	private $_Controller;
	private $_Item;
    public function __construct(){
        parent::__construct();
        $this->load->model('data/wardrobe_board_model');
        $this->_Module = $this->router->directory;
        $this->_Controller = $this->router->class;
        $this->_Item = $this->_Module.$this->_Controller.'/';
        
        log_message('debug', 'Controller Data/Wardrobe_board Start!');
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
        $this->Item = $this->_Item.__FUNCTION__;
        $Data = array();
        if(!($Query = $this->wardrobe_board_model->select_wardrobe_board())){
            $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'没有异形名称';
        }else{
            $Data['content'] = $Query;
        }
        $this->_return($Data);
    }
    
    public function add(){
        $Item = $this->_Item.__FUNCTION__;
        if($this->form_validation->run($Item)){
            $Post = gh_escape($_POST);
            if(!!($Id = $this->wardrobe_board_model->insert_wardrobe_board($Post))){
                $this->Success .= '衣柜板块名称新增成功, 刷新后生效!';
            }else{
                $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'衣柜板块名称新增失败';
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
            $Where = $this->input->post('selected');
            if(!!($this->wardrobe_board_model->update_wardrobe_board($Post, $Where))){
                $this->Success .= '衣柜板块名称修改成功, 刷新后生效!';
            }else{
                $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'衣柜板块名称修改失败';
            }
        }else{
            $this->Failue .= validation_errors();
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
                if($this->wardrobe_board_model->delete_wardrobe_board($Where)){
                    $this->Success .= '衣柜板块名称删除成功, 刷新后生效!';
                }else {
                    $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'衣柜板块名称删除失败';
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