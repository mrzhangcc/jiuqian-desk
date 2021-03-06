<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chuangchuangzhang
 * Date: 2017/10/17
 * Time: 15:19
 *
 * Desc:
 */

?>
<div class="page-line" id="positionOrderProduct">
    <div class="my-tools col-md-12">
        <div class="col-md-3">
            <div class="input-group" id="positionOrderProductSearch" data-toggle="filter" data-target="#positionOrderProductTable">
                <input type="hidden" name="id" value="<?php echo $id;?>"/>
                <input type="text" class="form-control" name="keyword" placeholder="搜索">
		      		<span class="input-group-btn">
		        		<button class="btn btn-default" type="submit">Go!</button>
		      		</span>
            </div>
        </div>
        <div class="col-md-offset-3 col-md-6 text-right" id="positionOrderProductFunction">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    共选中<span id="positionOrderProductTableSelected" data-num="">0</span>项
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" data-table="#positionOrderProductTable">
                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#positionOrderProductModal" data-action="<?php echo site_url('position/position_order_product/edit');?>" data-multiple=false><i class="fa fa-pencil"></i>&nbsp;&nbsp;编辑</a></li>
                </ul>
            </div>
            <a class="btn btn-primary" data-toggle="backstage" data-target="#positionOrderProductTable" href="<?php echo site_url('position/position_order_product/edit_out');?>" data-multiple=true><i class="fa fa-trash-o"></i>&nbsp;&nbsp;出库</a>
            <button class="hide btn btn-primary" type="button" value="新增" data-toggle="modal" data-target="#positionOrderProductModal" data-action="<?php echo site_url('position/position_order_product/add');?>"><i class="fa fa-plus"></i>&nbsp;&nbsp;入库</button>
            <button class="btn btn-default" data-toggle="refresh" type="button" value="刷新"><i class="fa fa-refresh"></i>&nbsp;&nbsp;刷新</button>
            <a class="btn btn-default" data-toggle="backstage" data-target="#positionOrderProductTable" href="<?php echo site_url('position/position_order_product/remove');?>" data-multiple=true><i class="fa fa-trash-o"></i>&nbsp;&nbsp;删除</a>
            <button class="btn btn-default" data-toggle="reply" type="button" value="返回"><i class="fa fa-refresh"></i>&nbsp;&nbsp;返回</button>
        </div>
    </div>
    <div class="my-table col-md-12">
        <table class="table table-bordered table-striped table-hover table-responsive table-condensed" id="positionOrderProductTable" data-load="<?php echo site_url('position/position_order_product/read') ?>">
            <thead>
            <tr>
                <th class="td-xs" data-name="selected">#</th>
                <th data-name="name">库位名称</th>
                <th data-name="order_product_num">订单号</th>
                <th data-name="count">入库件数</th>
                <th data-name="creator">操作员壹</th>
                <th data-name="create_datetime">操作时间</th>
                <th data-name="destroy">操作员贰</th>
                <th data-name="destroy_datetime">操作时间</th>
                <th class="hide" data-name="status">状态</th>
            </tr>
            </thead>
            <tbody>
            <tr class="loading"><td colspan="2">加载中...</td></tr>
            <tr class="no-data"><td colspan="2">没有数据</td></tr>
            <tr class="model">
                <td ><input name="popid"  type="checkbox" value=""/></td>
                <td name="name"></td>
                <td name="order_product_num"></td>
                <td name="count"></td>
                <td name="creator"></td>
                <td name="create_datetime"></td>
                <td name="destroy"></td>
                <td name="destroy_datetime"></td>
                <td class="hide" name="status"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="positionOrderProductModal" tabindex="-1" role="dialog" aria-labelledby="positionOrderProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="positionOrderProductForm" action="" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="positionOrderProductModalLabel">编辑</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="selected" value="" />
                    <div class="form-group">
                        <label class="control-label col-md-2" >库位名称:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="name" type="text" readonly="readonly" placeholder="库位名称" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >订单号:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="order_product_num" type="text" readonly="readonly" placeholder="订单号" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >入库件数:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="count" type="text" placeholder="0" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >订单状态:</label>
                        <div class="col-md-6">
                            <select class="form-control" name='status'>
                                <option value="0">已出库</option>
                                <option value="1">未出库</option>
                            </select>
                        </div>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade in serverError" role="alert"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary" data-save="ajax.modal">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    (function($){
        $('div#positionOrderProduct').handle_page();
        $('div#positionOrderProductModal').handle_modal_000();
    })(jQuery);
</script>
