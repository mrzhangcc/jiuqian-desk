<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created for jiuqian-desk.
 * User: chuangchuangzhang
 * Date: 2018/2/13
 * Time: 11:22
 *
 * Desc:
 */
class Role_element extends CWDMS_Controller {
    private $_Module;
    private $_Controller;
    private $_Item ;

    public function __construct() {
        parent::__construct();
        $this->load->model('permission/role_element_model');
        $this->_Module = $this->router->directory;
        $this->_Controller = $this->router->class;
        $this->_Item = $this->_Module.$this->_Controller.'/';
        $this->_Cookie = str_replace('/', '_', $this->_Item).'_';

    }

    public function index(){
        $View = $this->uri->segment(4, 'read');
        if(method_exists(__CLASS__, '_'.$View)){
            $View = '_'.$View;
            $this->$View();
        }else{
            $Item = $this->_Item.$View;
            $this->data['action'] = site_url($Item);
            $this->load->view($Item, $this->data);
        }
    }

    private function _read() {
        $Id = $this->input->get('id', true);
        $Id = intval(trim($Id));

        if ($Id > 0) {
            $Data['Id'] = $Id;
            $this->load->model('permission/element_model');
            if (!!($Element = $this->element_model->select())) {
                if (!!($Query = $this->role_element_model->select_by_rid($Id))) {
                    foreach ($Query as $key => $value) {
                        $Query[$key] = $value['eid'];
                    }
                }else {
                    $Query = array();
                }
                foreach ($Element as $key => $value) {
                    if (in_array($value['eid'], $Query)) {
                        $Element[$key]['checked'] = 1;
                    }else {
                        $Element[$key]['checked'] = 0;
                    }
                }
                $Data['content'] = $Element;
            }else {
                $Data['Error'] = '您无权设置角色元素功能!';
            }
        }else {
            $Data['Error'] = '请选择需要设置元素的角色!';
        }
        $this->load->view($this->_Item.__FUNCTION__, $Data);
    }

    public function edit(){
        $Item = $this->_Item.__FUNCTION__;
        if($this->form_validation->run($Item)){
            $Post = gh_escape($_POST);
            if(!!($this->role_element_model->delete_by_rid($Post['rid']))){
                if (isset($Post['eid'])) {
                    $Data = array();
                    foreach ($Post['eid'] as $key => $value) {
                        $Data[] = array(
                            'eid' => $value,
                            'rid' => $Post['rid']
                        );
                    }
                    $this->role_element_model->insert_batch($Data);
                }
                $this->Success .= '角色-元素权限修改成功, 刷新后生效!';
            }else{
                $this->Failue .= isset($GLOBALS['error'])?is_array($GLOBALS['error'])?implode(',', $GLOBALS['error']):$GLOBALS['error']:'角色-元素修改失败';
            }
        }else{
            $this->Failue .= validation_errors();
        }
        $this->_return();
    }
}
