<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="page-line" id="order">
    <div class="my-tools col-md-12">
        <div class="col-md-3">
            <div class="input-group" id="orderSearch" data-toggle="filter" data-target="#orderTable">
    <span class="input-group-btn">
        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#orderFilterModal"><i class="fa fa-search"></i></button>
    </span>
    <input type="hidden" name="status" value=""/><input type="hidden" name="start_date" value="2018-01-23"/><input type="hidden" name="end_date" value=""/><input type="text" class="form-control" name="keyword" placeholder="订单编号/经销商/业主/备注">
    <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
    </span>
</div>        </div>
        <div class="col-md-offset-3 col-md-6 text-right" id="orderFunction">
            <div class="btn-group" role="group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        共选中<span id="orderTableSelected" data-num="">0</span>项
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu" data-table="#orderTable"><li><a href="javascript:void(0);" data-toggle="modal" data-target="#orderModal" data-action="http://localhost/jiuqian-desk/index.php/order/order/edit" data-multiple=false><i class="fa fa-pencil"></i>&nbsp;&nbsp;编辑</a></li><li role="separator" class="divider"></li><li><a href="javascript:void(0);" data-toggle="child" data-target="#orderTable" data-action="http://localhost/jiuqian-desk/index.php/data/workflow_msg/index/read" data-multiple=false><i class="fa fa-hourglass-1"></i>&nbsp;&nbsp;进程图</a></li>    </ul>
    <button class="btn btn-default" data-toggle="refresh" type="button" value="刷新"><i class="fa fa-refresh"></i>&nbsp;&nbsp;刷新</button><a class="btn btn-default" data-toggle="backstage" href="http://localhost/jiuqian-desk/index.php/order/order/remove" data-target="#orderTable" data-multiple=true><i class="fa fa-trash-o"></i>&nbsp;&nbsp;作废</a>
</div>        </div>
    </div>
    <div class="my-table col-md-12">
        <table class="table table-bordered table-striped table-hover table-responsive table-condensed" id="orderTable" data-load="http://localhost/jiuqian-desk/index.php/order/order/read">
    <thead>
    <tr>
        <th class="td-xs checkall" data-name="selected" data-checkall=false>#</th><th >等级</th><th >订单编号</th>
    </tr>
    </thead>
    <tbody>
    <tr class="loading"><td colspan="15">加载中...</td></tr>
    <tr class="no-data"><td colspan="15">没有数据</td></tr>
    <tr class="model">
        <td ><input name="oid"  type="checkbox" value=""/></td><td name="icon"></td><td name="order_num"><a href="http://localhost/jiuqian-desk/index.php/order/order_detail/index/read/order" title="订单详情" data-toggle="floatover" data-target="#orderFloatover" data-remote="http://localhost/jiuqian-desk/index.php/order/order_detail/index/read_floatover"></a></td>
    </tr>
    </tbody>
</table>
<div class="hide btn-group pull-right paging">
    <p class="footnote"></p>
    <ul class="pagination">
        <li><a href="1">首页</a></li>
        <li class=""><a href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
        <li><a href=""></a></li>
        <li class=""><a href="" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        <li><a href="">尾页</a></li>
    </ul>
</div>    </div>
    <div class="floatover hide" id="orderFloatover"></div>
</div>


<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="orderForm" action="" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="orderModalLabel">编辑</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="selected" value="" />
                    <div class="form-group">
                        <label class="control-label col-md-2" >任务等级:</label>
                        <div class="col-md-6">
                            <select class="form-control" name="flag"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >业主:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="owner" type="text" placeholder="业主" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >对单:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="checker" type="text" placeholder="对单" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >支付电话:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="checker_phone" type="text" placeholder="对单电话" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >支付:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="payer" type="text" placeholder="支付" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >支付电话:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="payer_phone" type="text" placeholder="支付电话" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >支付条款:</label>
                        <div class="col-md-6">
                            <select class="form-control" name='payterms'><option value="">--选择支付条款--</option></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >出厂方式:</label>
                        <div class="col-md-6">
                            <select class="form-control" name='out_method'><option value="">--选择出厂方式--</option></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >物流:</label>
                        <div class="col-md-6">
                            <select class="form-control" name='logistics'><option value="">--选择物流--</option></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >收货地址:</label>
                        <div class="col-md-3">
                            <select class="form-control" name="delivery_area"><option value="">--选择收货地区--</option></select>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" name="delivery_address" type="text" placeholder="客户要求收货具体地址" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >收货人:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="delivery_linker" type="text" placeholder="收货人" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >收货电话:</label>
                        <div class="col-md-6">
                            <input class="form-control" name="delivery_phone" type="text" placeholder="收货电话" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >要求出厂:</label>
                        <div class="col-md-6">
                            <input class="form-control datepicker" type="text" name="request_outdate" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >备注:</label>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="3" name="remark" ></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2" >客户备注:</label>
                        <div class="col-md-6">
                            <textarea class="form-control" rows="3" name="dealer_remark" ></textarea>
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

<div class="modal fade filter" id="orderFilterModal" tabindex="-1" role="dialog" aria-labelledby="orderFilterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  class="form-horizontal" id="orderFilterForm" action="" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="orderFilterModalLabel">搜索</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-2">状态:</label>
                        <div class="col-md-6">
                            <select class="form-control" name="status" multiple="multiple"></select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">开始日期:</label>
                        <div class="col-md-6">
                            <input class="form-control datepicker" name="start_date" value="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">结束日期:</label>
                        <div class="col-md-6">
                            <input class="form-control datepicker" name="end_date" value="" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    (function($){
        var SessionData = undefined, Item, Index;
        if(!(SessionData = $.sessionStorage('task_level'))){
            $.ajax({
                async: true,
                type: 'get',
                dataType: 'json',
                url: 'http://localhost/jiuqian-desk/index.php/data/task_level/read',
                success: function(msg){
                    if(msg.error == 0){
                        var Content = msg.data.content;
                        Item = '';
                        for(Index in Content){
                            Item += '<option value="'+Content[Index]['tlid']+'" >'+Content[Index]['name']+'</option>';
                        }
                        $.sessionStorage('task_level', Item);
                        $('#orderModal select[name="flag"]').append(Item);
                    }
                }
            });
        }else{
            $('#orderModal select[name="flag"]').append(SessionData);
        }
        if(!(SessionData = $.sessionStorage('payterms'))){
            $.ajax({
                async: true,
                type: 'get',
                dataType: 'json',
                url: 'http://localhost/jiuqian-desk/index.php/dealer/payterms/read',
                success: function(msg){
                    if(msg.error == 0){
                        var Content = msg.data.content;
                        Item = '';
                        for(Index in Content){
                            Item += '<option value="'+Content[Index]['name']+'" >'+Content[Index]['name']+'</option>';
                        }
                        $.sessionStorage('payterms', Item);
                        $('#orderModal select[name="payterms"]').append(Item);
                    }
                }
            });
        }else{
            $('#orderModal select[name="payterms"]').append(SessionData);
        }
        if(!(SessionData = $.sessionStorage('out_method'))){
            $.ajax({
                async: true,
                type: 'get',
                dataType: 'json',
                url: 'http://localhost/jiuqian-desk/index.php/data/out_method/read',
                success: function(msg){
                    if(msg.error == 0){
                        var Content = msg.data.content;
                        Item = '';
                        for(Index in Content){
                            Item += '<option value="'+Content[Index]['name']+'" >'+Content[Index]['name']+'</option>';
                        }
                        $('#orderModal select[name="out_method"]').append(Item);
                        $.sessionStorage('out_method', Content);
                    }
                }
            });
        }else{
            Item = '';
            for(var Index in SessionData){
                Item += '<option value="'+SessionData[Index]['name']+'" >'+SessionData[Index]['name']+'</option>';
            }
            $('#orderModal select[name="out_method"]').append(Item);
        }

        if(!(SessionData = $.sessionStorage('area'))){
            $.ajax({
                async: true,
                type: 'get',
                dataType: 'json',
                url: 'http://localhost/jiuqian-desk/index.php/data/area/read',
                success: function(msg){
                    if(msg.error == 0){
                        var Content = msg.data.content;
                        Item = '';
                        for(Index in Content){
                            Item += '<option value="'+Content[Index]['area']+'" >'+Content[Index]['area']+'</option>';
                        }
                        $('#orderModal select[name="delivery_area"]').append(Item);
                        $.sessionStorage('area', Content);
                    }
                }
            });
        }else{
            Item = '';
            for(var Index in SessionData){
                Item += '<option value="'+SessionData[Index]['area']+'" >'+SessionData[Index]['area']+'</option>';
            }
            $('#orderModal select[name="delivery_area"]').append(Item);
        }

        if(!(SessionData = $.sessionStorage('logistics'))){
            $.ajax({
                async: true,
                type: 'get',
                dataType: 'json',
                url: 'http://localhost/jiuqian-desk/index.php/data/logistics/read',
                success: function(msg){
                    if(msg.error == 0){
                        var Content = msg.data.content;
                        Item = '';
                        for(Index in Content){
                            Item += '<option value="'+Content[Index]['name']+'" >'+Content[Index]['name']+'</option>';
                        }
                        $('#orderModal select[name="logistics"]').append(Item);
                        $.sessionStorage('logistics', Content);
                    }
                }
            });
        }else{
            Item = '';
            for(var index in SessionData){
                Item += '<option value="'+SessionData[index]['name']+'" >'+SessionData[index]['name']+'</option>';
            }
            $('#orderModal select[name="logistics"]').append(Item);
        }

        if(!(SessionData = $.sessionStorage('workflow_order'))){
            $.ajax({
                async: true,
                type: 'get',
                dataType: 'json',
                url: 'http://localhost/jiuqian-desk/index.php/data/workflow/read/order',
                success: function(msg){
                    if(msg.error == 0){
                        var Content = msg.data.content;
                        Item = '';
                        for(Index in Content){
                            Item += '<option value="'+Content[Index]['no']+'" >'+Content[Index]['name']+'</option>';
                        }
                        $('#orderFilterModal select[name="status"]').append(Item);
                        $.sessionStorage('workflow_order', Content);
                    }
                }
            });
        }else{
            Item = '';
            for(var index in SessionData){
                Item += '<option value="'+SessionData[index]['no']+'" >'+SessionData[index]['name']+'</option>';
            }
            $('#orderFilterModal select[name="status"]').append(Item);
        }
        $('div#order').handle_page();
        $('div#orderModal').handle_modal_000();
        $('div#orderFilterModal').handle_modal_000();
    })(jQuery);
</script>
