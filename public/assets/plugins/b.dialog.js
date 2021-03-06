/**
 * 使用Bootstrap的Modal对话框进行二次封装
 *
 * @version 2.0
 *
 * @author Terry
 * created : 2012.11.26
 *
 * 窗口拖拽功能依赖jQueryUI的draggable功能库
 *
 *
 * 2016.05.12
 * 解决在已经弹出的窗口中，再进行弹出窗口会进行覆盖的问题
 * 2016.05.25
 * 解决使用打开内容为HTML代码段的内容时，窗口关闭后，因为窗口里的所有内容会被移除，所以再打开时，原传递的原型内容则会不存在，即第二次打开后只有空白的窗口
 * 2016.06.22
 * 增加窗口打开后的重定位动画
 * 增加当窗口大小改变后的重定位功能
 * 解决在IE下多次打开弹出窗口后，窗口里的输入框无法获得焦点
 * 2016.08.09
 * 重构代码
 * 使用bootstrap3-3.3.7版本的bootstrap-modal.js的模态窗口代码单独提取出来使用
 * 解决多级弹出的窗口和遮罩的层次显示顺序问题
 * 增加背景遮罩点击后显示窗口抖动的动画效果
 * 2017.01.26
 * 增加fullWidth参数，设置是否为全宽度窗口，默认为false(关闭)
 * 2017.03.27
 * 增加customClass参数，允许使用样式对弹出框整体样式进行定义
 * 2017.06.14
 * 重构bDialog代码
 * 2017.06.20
 * 修复内容区域高度设置误差问题
 * 适配Bootstrap3版本
 * 修复部分参数丢失的问题
 * 2017.07.20
 * 修复窗口最小高度限制问题
 * 2017.07.24
 * 修复Bootstrap3下样式应用无效果问题
 * 统一处理Bootstrap2、3的窗口高度计算
 * 修复Bootstrap3下全宽度窗口没有铺满全宽度的问题
 * 2017.08.06
 * 增加窗口最大化功能
 * 增加dialogMaxButton配置项目，设置是否启用最大化窗口按钮，默认：true
 * 修正部分样式问题
 * 2017.08.19(2.0)
 * 修复窗口最大化后，内部iframe高度没有最大化的问题
 * 重构代码结构
 * 增加窗口打开后的动画效果
 * 增加国际化多语言支持
 * 增加bDialog.alert()对话框模式，支持info、warning、error、success、confirm五种模式
 * 增加bDialog.mask()遮罩模式
 * 修改原bDialog.closeCurrent方法的函数名为bDialog.close
 *
 * https://terryz.github.io/bdialog/index.html
*/

;(function($){
    "use strict";
    //模板
    var template = {
        dialog : '<div class="modal fade bDialog" dialog="bDialog" tabindex="-1" aria-labelledby="bDialogHeaderLabel" role="dialog" aria-hidden="true">' +
        '<div class="modal-dialog" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header bDialogHeader">' +
        '<button type="button" class="close bDialogCloseButton" data-dismiss="modal" aria-hidden="true">×</button>' +
        '<h3 class="modal-title bDialogHeaderLabel"></h3>' +
        '</div>' +
        '<div class="modal-body bDialogBody"></div>' +
        '<div class="modal-footer bDialogFooter hide">&nbsp;</div>' +
        '</div></div></div>',

        message : '<div class="bDialogAlert"><div class="messageContent"></div>' +
        '<div class="bDialogButtons"><button type="button" class="btn bDialogOk"></button>' +
        '<button type="button" class="btn bDialogCancel"></button></div>' +
        '</div>',

        mask : '<div class="bDialogMaskContent"><div class="bDialogTimer"></div><div class="messageContent"></div></div>'
    };
    //默认参数
    var defaults = {
        /**
         * 窗口背景遮罩设置
         * 'static'：静态模式窗口，鼠标点击背景不关闭窗口
         * false：不显示背景遮罩
         * true，显示背景遮罩，但鼠标点击遮罩会关闭窗口
         * @type string | boolean
         */
        'backdrop' : 'static',
        /**
         * 标题栏显示文本，设置为false则关闭标题栏
         * @type string | boolean
         */
        'title' : '对话框',
        /**
         * 使用的语言
         * @type string 默认'cn'
         */
        'language' : 'cn',
        /**
         * 窗口宽度
         * @type number
         */
        'width' : 800,
        /**
         * 窗口高度
         * @type number
         */
        'height' : 400,
        /**
         * 窗口打开时的动画效果
         * @type boolean 默认 true
         */
        'animation' : true,
        /**
         * 窗口标题栏的关闭按钮是否启用
         * @type boolean
         */
        'dialogCloseButton' : true,
        /**
         * 窗口标题栏的最大化按钮是否启用
         * @type boolean
         */
        'dialogMaxButton' : true,
        /**
         * 对话框底部的关闭窗口按钮
         * @type boolean
         */
        'closeButton' : false,
        /**
         * 是否显示滚动条，默认显示
         * @type boolean
         */
        'scroll' : true,
        /**
         * 是否允许窗口进行拖拽
         * @type boolean
         * 该功能需要引入jquery-ui的draggable功能库
         */
        'drag' : true,
        /**
         * 需要在窗口中打开窗口的链接地址
         * @type string
         */
        'url' : false,
        /**
         * 需要在窗口里显示的HTML DOM内容
         * 如果设置了dom参数，则优先设置，插件不会再加载url所指定的内容
         * @type object
         */
        'dom' : undefined,
        /**
         * 是否展示全宽度窗口
         * @type boolean
         */
        'fullWidth' : false,
        /**
         * 自定义样式，它会添加到弹出窗口的最外层DIV上
         * @type string
         */
        'customClass' : undefined,
        /**
         * 初始化时即显示模态对话框
         * @type boolean
         */
        'show' : false,
        /**
         * 显示对话框前执行的回调
         * @type function
         */
        'onShow' : $.noop,
        /**
         * 显示完成对话框后执行的回调
         * @type function
         */
        'onShowed' : $.noop,
        /**
         * 关闭/隐藏对话框前执行的回调
         * @type function
         */
        'onHide' : $.noop,
        /**
         * 关闭/隐藏对话框后执行的回调
         * @type function
         */
        'onHidden' : $.noop,
        /**
         * 窗口回调函数，参数1：回调后返回的数据(callback(data))
         * @type function
         */
        'callback' : $.noop,
        /**
         * 对话框模式，该参数为内部参数，不接受用户传递
         * @type string 窗口类型
         * @enum 'dialog' 模态窗口
         * @enum 'alert' 消息提示框
         * @enum 'mask' 遮罩
         */
        'type' : 'dialog',
        /**
         * 消息对话框模式的提示信息文本内容，仅内部使用，不接受用户传递
         * @type string
         */
        'message' : undefined,
        /**
         * 消息对话框类型
         * @type string
         * @enum info      消息提示（默认）
         * @enum warning   警告
         * @enum error     错误
         * @enum success   成功
         * @enum confirm   确认
         */
        'messageType' : 'info',
        /**
         * confirm模式下，取消按钮的执行回调
         * @type function
         * @example
         * cancel : function(dialog){}
         */
        'cancel' : undefined
    };
    /**
     * bDialog对象
     * @param p
     * @returns {bDialog} 返回窗口对象
     */
    var bDialog = function(p){
        //合并参数
        this.params = this.setParam(p);
        this.message = null;
        this.setLanguage();
        this.buildDialog();

        this.timeout = null;
        this.callback = null;
        //用于确认窗口的取消按钮回调处理
        this.cancalCallback = false;
        this.returnData = null;

        this.bindEvent();
        this.openDialog();
        this.setCssStyle();
        this.atLast();

        $(this.dialog).data('bDialog',this);
        return this;
    };
    //版本号
    bDialog.version = "2.0"

    /**
     * 合并默认参数与用户传递参数
     * @param {object} param - 用户传递参数集
     * @return {object} 合并后参数集
     */
    bDialog.prototype.setParam = function(param){
        return $.extend({},defaults,param);
    };
    /**
     * 设置国际化多语言
     */
    bDialog.prototype.setLanguage = function(){
        var p = this.params;
        var message = {};
        switch (p.language){
            case 'cn':
                message = {
                    titleInfo : '提示',
                    titleWarning : '警告',
                    titleError : '错误',
                    titleSuccess : '成功',
                    titleConfirm : '确认',
                    btnOk : '确认',
                    btnCancel : '取消',
                    maskText : '数据加载中……'
                };
                break;
            case 'en':
                message = {
                    titleInfo : 'information',
                    titleWarning : 'warning',
                    titleError : 'error',
                    titleSuccess : 'success',
                    titleConfirm : 'confirmation',
                    btnOk : 'OK',
                    btnCancel : 'Cancel',
                    maskText : 'Loading……'
                };
                break;
            case 'jp':
                message = {
                    titleInfo : 'ヒント',
                    titleWarning : '警告',
                    titleError : '間違った',
                    titleSuccess : '成功',
                    titleConfirm : '確認',
                    btnOk : '確認',
                    btnCancel : 'キャンセル',
                    maskText : 'データロード……'
                };
                break;
        }
        this.message = message;
    };
    /**
     * 生成窗口对象
     * @return {object} 生成完成的窗口对象
     */
    bDialog.prototype.buildDialog = function(){
        var p = this.params,self = this;
        var html = template.dialog;
        var dialog = $(html);
        var topBody = window.top.document.body;
        //在浏览器尺寸改变时使用的定时器
        self.timeout = null;

        //设置标题
        if(p.title) $("h3.bDialogHeaderLabel",$(dialog)).html(p.title);
        else $('div.bDialogHeader',$(dialog)).hide();
        if(!p.dialogCloseButton)$('button.bDialogCloseButton',$(dialog)).hide();
        if(!p.dialogMaxButton)$('button.bDialogMaxButton',$(dialog)).hide();
        //if(p.animation) $(dialog).addClass('fade');//设置动画效果(bootstrap modal默认动画效果)
        if(p.closeButton){
            $("div.bDialogFooter",$(dialog)).empty().append('<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">取消</button>');
            $("div.bDialogFooter",$(dialog)).show();
        }

        if(p.dom){//页面片断模式
            var content = $(p.dom).clone(true);
            $("div.bDialogBody",$(dialog)).html($(content).show());
            if(p.scroll) $("div.bDialogBody",$(dialog)).css('overflow-y','auto');
        }else if(p.url) {//iframe模式
            var tmp = p.scroll ? 'yes' : 'no';
            var iframe = '<iframe class="bDialogBodyFrame" frameborder="0" scrolling="'+tmp+'" style="width:100%;height:100%;border:0px;" src="'+p.url+'"></iframe>';
            $("div.bDialogBody",$(dialog)).html(iframe);
        }
        //对话框模式特殊处理
        if(p.type === 'alert'){
            $('button.bDialogOk',dialog).html(this.message.btnOk);
            $('button.bDialogCancel',dialog).html(this.message.btnCancel);
            if(p.title !== false){
                var atitle = '';
                switch(p.messageType){
                    case 'info':
                        atitle = this.message.titleInfo;
                        break;
                    case 'warning':
                        atitle = this.message.titleWarning;
                        break;
                    case 'error':
                        atitle = this.message.titleError;
                        break;
                    case 'success':
                        atitle = this.message.titleSuccess;
                        break;
                    case 'confirm':
                        atitle = this.message.titleConfirm;
                        break;
                }
                $("h3.bDialogHeaderLabel",dialog).html(atitle);
            }
        }
        if(p.type === 'mask'){
            var msg = p.message ? p.message : this.message.maskText;
            $('div.messageContent',dialog).html(msg);
            $(dialog).addClass('bDialogMask');
        }
        //设置全宽度内容
        if(p.fullWidth){
            $("div.bDialogHeader,div.bDialogBody,div.bDialogFooter",$(dialog)).addClass('container');
            $(dialog).addClass('fullWidth');
            p.width = '100%';
        }
        //自定义样式
        if(p.customClass) $(dialog).addClass(p.customClass);

        $(topBody).append(dialog);        
        this.dialog = dialog;
    };
    /**
     * 为窗口对象绑定事件
     * @return void
     */
    bDialog.prototype.bindEvent = function(){
        var p = this.params,dialog = this.dialog;
        var self = this;
        var topBody = window.top.document.body;

        var setReturnData = function(){
            var d = {"results" : null};
            if(self.returnData)
                d.results = $.isArray(self.returnData) ? self.returnData : [self.returnData];
            return d;
        }
        self.callback = function(){
            if(p.cancel && $.isFunction(p.cancel) && self.cancalCallback) p.cancel(dialog);
            else if(p.callback && $.isFunction(p.callback)) p.callback(setReturnData());
        };

        if(p.onShow && $.isFunction(p.onShow)) $(dialog).off('show.bs.modal').on('show.bs.modal',function(){
            p.onShow(this);
        });
        if(p.onShowed && $.isFunction(p.onShowed)) $(dialog).off('shown.bs.modal').on('shown.bs.modal',function(){
            p.onShowed(this);
            if(p.animation) $('div.modal-content',dialog).addClass('bDialogOpen');
        });
        if(p.onHide && $.isFunction(p.onHide)) $(dialog).off('hide.bs.modal').on('hide.bs.modal',function(){
            p.onHide(this);
        });
        $(dialog).off('hidden.bs.modal').on('hidden.bs.modal',function(e){
            // stop the timeout
            clearTimeout(self.timeout);
            if(p.onHidden && $.isFunction(p.onHidden)) p.onHidden(this);
            if(self.callback && $.isFunction(self.callback)) self.callback();
            //在移除窗口之前，先把iframe移除，解决在IE下，窗口上的输入控件获得不了焦点的问题
            if($('iframe',$(this)).size() > 0) $('iframe',$(this)).remove();
            $(this).remove();
            if($('[dialog="bDialog"]',$(topBody)).size() > 0) $('[dialog="bDialog"]:last',$(topBody)).addClass('dialogInActive');
        });
        if(p.dialogMaxButton){
            $('button.bDialogMaxButton',dialog).off('click.bDialog').on('click.bDialog',function(e){
                e.stopPropagation();
                self.maxWindow();
            });
        }
        if(p.type !== 'mask' && !p.fullWidth){
            $(dialog).off('click.bDialog').on('click.bDialog',function(e){
                e.stopPropagation();
                var srcEl = e.target || e.srcElement;
                if($(srcEl).is('div.bDialog')){
                    $(dialog).removeClass('animated').removeClass('shake');
                    setTimeout(function(){
                        $(dialog).addClass('animated').addClass('shake');
                    }, 0);
                }
            });
        }
        //浏览器窗口尺寸变化时，自动对窗口位置进行调整
        $(window.top).on('resize.bDialog', function(e) {
            e.stopPropagation();
            // clear a previously set timeout
            // this will ensure that the next piece of code will not be executed on every step of the resize event
            clearTimeout(self.timeout);
            // set a small timeout before doing anything
            self.timeout = setTimeout(function() {
                // reposition the dialog box
                self.rePosition();
            }, 100);
        });
    };
    /**
     * 在页面上弹出窗口
     * @return void
     */
    bDialog.prototype.openDialog = function(){
        var p = this.params,dialog = this.dialog;
        $('div.modal-dialog',dialog).css({
            'width' : p.width,
            'height' : p.height
        });
        var param = {
            backdrop : p.backdrop
        };
        if($.type(p.keyboard) !== 'undefined') param.keyboard = p.keyboard;
        $(dialog).modal(param).removeClass('hide');
    };
    /**
     * 处理窗口的样式、宽度高度及位置等内容
     * @return void
     */
    bDialog.prototype.setCssStyle = function(){
        var p = this.params,dialog = this.dialog;
        /**
         * 处理层级顺序及遮罩层级顺序
         */
        var topBody = window.top.document.body;
        var setSize = $('div.modal-backdrop',$(topBody)).size();
        var baseNumber = 1000;
        var stepNumber = (setSize -1) * 20;
        $('div.modal-backdrop:last',$(topBody)).css('z-index', baseNumber + stepNumber + 10 );
        $('div.bDialog:last div.modal-content',$(topBody)).css('z-index', baseNumber + stepNumber + 20 );
        $('div.bDialog:last',$(topBody)).css('z-index', baseNumber + stepNumber + 19 );
        if(setSize > 1) $('div.modal-backdrop:last',$(topBody)).css('opacity','0.1');

        this.adjust();

        //清除所有已弹出窗口的当前激活样式
        $('[dialog="bDialog"]',$(topBody)).removeClass('dialogInActive');
        $(dialog).addClass('dialogInActive');
    };
    /**
     * 调整窗口的内部外部的高度，宽度等内容
     */
    bDialog.prototype.adjust = function(){
        var p = this.params,dialog = this.dialog;
        /**
         * 处理窗口内部高度样式-----------------------------
         */
        var totalHeight = $('div.modal-dialog',$(dialog)).innerHeight();
        var head = $("div.bDialogHeader",$(dialog)).outerHeight(true);
        var footer = p.closeButton ? $("div.bDialogFooter",$(dialog)).outerHeight(true) : 0;
        var bodyPaddingTop = parseFloat($("div.bDialogBody",$(dialog)).css('padding-top'));
        var bodyPaddingBottom = parseFloat($("div.bDialogBody",$(dialog)).css('padding-bottom'));
        var newBodyHeight = totalHeight - head - footer;// - bodyPaddingTop - bodyPaddingBottom;
        var minBodyHeight = 100 - head - footer;//窗口最小高度
        if(newBodyHeight < minBodyHeight) newBodyHeight = minBodyHeight;
        var bodyCss = {'height':newBodyHeight,'max-height':newBodyHeight};
        $("div.bDialogBody",$(dialog)).css(bodyCss);

        //若是iFrame模式则设置iFrame高度等样式
        if(!p.dom){
            var frameHeight = newBodyHeight - bodyPaddingTop - bodyPaddingBottom;
            var minFrameHeight = 100 - bodyPaddingTop - bodyPaddingBottom;
            if(frameHeight < minFrameHeight) frameHeight = minFrameHeight;
            var bodyFrameCss = {'height':frameHeight,'max-height':frameHeight};
            $("iframe.bDialogBodyFrame",$(dialog)).css(bodyFrameCss);
        }
        if(p.fullWidth) $(dialog).css('padding-right','0px');
    };
    /**
     * 最后的一些处理
     */
    bDialog.prototype.atLast = function(){
        var p = this.params,dialog = this.dialog;
        var msie = navigator.userAgent.indexOf("MSIE") !== -1 || navigator.userAgent.indexOf("Trident") !== -1;
        //执行一次窗口位置定位
        this.rePosition(0);
        //处理窗口拖拽
        if(p.drag && $.fn.draggable && !msie && !p.fullWidth) $(dialog).draggable({handle:"div.bDialogHeader"});
    };
    /**
     * 关闭窗口
     * @param data 向调用者回传的数据
     */
    bDialog.prototype.close = function(data){
        var dialog = this.dialog,self = this;
        self.returnData = data;
        var modal = dialog.data('bs.modal');
        modal.hide();
    };
    /**
     * 最大化窗口
     */
    bDialog.prototype.maxWindow = function(){
        var dialog = this.dialog;
        if(!dialog.max){
            $(dialog).addClass('maximize');
            dialog.max = true;
        }else{
            $(dialog).removeClass('maximize');
            dialog.max = false;
        }
        this.adjust();
        this.rePosition(0);
    };
    /**
     * 重新定位窗口位置(主要是处理垂直高度居中)
     * @param {number} speed - 动画速度
     * @return void
     */
    bDialog.prototype.rePosition = function(speed) {
        var
            dialog = this.dialog,
            //获得可视区域的宽度和高度
            viewport_width = $(window.top).width(),
            viewport_height = $(window.top).height(),

            //获得对话框的宽度和高度
            dialog_width = $('div.modal-dialog',$(dialog)).width(),
            dialog_height = $('div.modal-dialog',$(dialog)).height(),

            //计算位置内容
            values = {
                'left':     0,
                'top':      0,
                'right':    viewport_width - dialog_width,
                'bottom':   viewport_height - dialog_height,
                'center':   (viewport_width - dialog_width) / 2,
                'middle':   (viewport_height - dialog_height) / 2
            };

        dialog.dialog_top = values['middle'];

        // position the dialog box and make it visible
        /*
        $(main).css({

            'top':          main.dialog_top,
            'visibility':   'visible',
            'opacity':      0

        }).animate({'opacity': 1}, 0);
        */

        //停止正在执行的动画
        $('div.modal-dialog',$(dialog)).stop(true);
        $('div.modal-dialog',$(dialog)).css('visibility', 'visible').animate({
            'top':  30
        }, (undefined !== $.type(speed) && $.type(speed) == 'number') ? speed : 100);
    };

    /**
     * 窗口工具集
     */
    var bDialogTools = {
        /**
         * 获得当前获得焦点的窗口对象
         */
        getDialog : function(){
            var dlg = $('[dialog="bDialog"].dialogInActive',window.top.document.body);
            return dlg ? dlg.data('bDialog') : null;
        },
        /**
         * 字符串截取，允许中英文混合（一个中文长度为2）
         * @param str
         * @param n
         * @returns {*}
         */
        sub : function(str,n){
            var r=/[^\x00-\xff]/g;
            if(str.replace(r,"mm").length<=n){return str;}
            var m=Math.floor(n/2);
            for(var i=m;i<str.length;i++){
                if(str.substr(0,i).replace(r,"mm").length>=n){
                    return str.substr(0,i)+"...";
                }
            }
            return str;
        }
    };

    var Plugin = {
        /**
         * 打开模态窗口
         * @param param         参数集
         * @returns {bDialog}   返回窗口对象
         */
        open : function(param){
            return new bDialog(param);
        },
        /**
         * 关闭当前弹出窗口
         * @param data    向调用者回传的数据
         * @param dialog  窗口对象（非必传参数）
         */
        close : function(data,dialog){
            var result,dlg;
            if(data instanceof bDialog){
                dlg = data;
                result = null;
            }else{
                result = data;
                dlg = dialog ? dialog : bDialogTools.getDialog();
            }
            if(dlg) dlg.close(result);
        },
        /**
         * 获得弹出窗口对象
         * @returns {object} 返回窗口对象
         */
        getDialog : function(){
            return bDialogTools.getDialog();
        },
        /**
         * 获得选择器中的传递参数
         * @returns {object} 返回窗口传递参数
         */
        getDialogParams : function(){
            var dlg = bDialogTools.getDialog();
            return dlg ? dlg.params.params : null;
        },
        /**
         * 打开消息对话框
         * @param message     显示的文本内容
         * @param callback    回调函数
         * @param param       初始化参数
         * @returns {bDialog} 窗口对象
         */
        alert : function(message,callback,param){
            if(!message) return;
            var html = template.message;
            var content = $(html);
            var className = 'alertInfo';
            if(!param) param = {};
            var type = param && param.messageType ? param.messageType : '';
            switch (type){
                case 'error':
                    className = "alertError";
                    break;
                case 'warning':
                    className = "alertWarning";
                    break;
                case 'success':
                    className = "alertSuccess";
                    break;
                case 'confirm':
                    className = "alertConfirm";
                    $('.bDialogCancel',content).show().on('click.bDialog',function(){
                        var dlg = bDialogTools.getDialog();
                        dlg.cancalCallback = true;
                        dlg.close();
                    });
                    break;
                case 'info':
                default:
                    className = 'alertInfo'
                    param.messageType = 'info';
                    break;
            }
            $(content).addClass(className);
            $('.messageContent',content).html(message);
            $('.bDialogOk',content).on('click.bDialog',function(){
                Plugin.close();
            });
            param.dom = content;
            if(callback && $.isFunction(callback)) param.callback = callback;
            //param.title = false;
            param.dialogCloseButton = false;
            param.dialogMaxButton = false;
            param.scroll = false;
            param.type = 'alert';
            if(typeof param.width == 'undefined' || typeof param.height == 'undefined'){
                param.width = message.length > 70 ? 700 : 320;
                param.height = message.length > 70 ? 400 :  $.type(param.title)=='undefined'||$.type(param.title)=='string' ? 150 : 150;
            }
            
            return new bDialog(param);
        },
        /**
         * 遮罩功能
         * @param message       遮罩上显示的文字，不传递则使用默认文本
         * @param param         插件参数
         * @returns {bDialog}   返回插件对象
         */
        mask : function(message,param){
            var html = template.mask;
            var content = $(html);
            if(message) message = bDialogTools.sub(message,65);
            if(!param) param = {};
            param.title = false;
            param.scroll = false;
            param.type = 'mask';
            param.width = 300;
            param.height = 50;
            param.message = message;
            param.dom = content;
            param.keyboard = false;
            return new bDialog(param);
        }
    };

    if(!window.top.bDialog) window.top.bDialog = Plugin;
    if(!window.bDialog) window.bDialog = Plugin;
})(window.top.jQuery);