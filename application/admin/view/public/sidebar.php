    <!-- 左侧导航 开始 -->
    <div class="viewFramework-sidebar">
        <div class="sidebar-content console-component-sidebar">
            <div class="sidebar-inner">
                <div class="sidebar-fold icon-unfold"></div>
                <!--sidebar-nav-active-->
                <ul id="accordion">
                    <!-- li -->
                    <li class="sidebar-nav" id="sidebar-config">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">系统管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="config-index">
                                <a href="{:Url('config/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">基本配置</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-role">
                                <a href="{:Url('Role/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">角色管理</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-users">
                                <a href="{:Url('users/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-topbar-certify"></span></div>
                                    <span class="nav-title">用户管理</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-auth">
                                <a href="{:Url('Auth/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-topbar-certify"></span></div>
                                    <span class="nav-title">权限管理</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-goods_type">
                                <a href="{:Url('Goods/goods_type')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-topbar-certify"></span></div>
                                    <span class="nav-title">商品类型管理</span>
                                </a>
                            </li>
<!--                             <li class="nav-item" id="config-goods_attr">
                                <a href="{:Url('Goods/goods_attr')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-topbar-certify"></span></div>
                                    <span class="nav-title">商品属性管理</span>
                                </a>
                            </li> -->
                            <li class="nav-item" id="config-params">
                                <a href="{:Url('Params/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-topbar-certify"></span></div>
                                    <span class="nav-title">系统参数管理</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-shengchan">
                                <a href="{:Url('config/produce')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">原料设定</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- 供应商管理 -->
                    
                    <li class="sidebar-nav" id="sidebar-storage">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">供应商管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="supplier-index">
                                <a href="{:Url('supplier/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">供应商列表</span>
                                </a>
                            </li>
                            <li class="nav-item" id="storage-index">
                                <a href="{:Url('storage/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">原料仓库</span>
                                </a>
                            </li>
                            <li class="nav-item" id="storage-xingcai">
                                <a href="{:url('Goods/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">商品维护</span>
                                </a>
                            </li>
                            <li class="nav-item" id="storage-jinliao">
                                <a href="{:Url('storage/numlc')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">新增进料</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- 仓库管理 -->
                    <li class="sidebar-nav" id="sidebar-storage">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">库存管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="storage-index">
                                <a href="{:Url('storage/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">原料仓库</span>
                                </a>
                            </li>
                            <li class="nav-item" id="storage-xingcai">
                                <a href="{:Url('storage/charge')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">型材管理</span>
                                </a>
                            </li>
                            <li class="nav-item" id="storage-jinliao">
                                <a href="{:Url('storage/numlc')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">新增进料</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- 销售管理 -->
                    <li class="sidebar-nav" id="sidebar-sales">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">客户管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="sidebar-customers">
                                <a href="{:Url('customers/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">客户信息</span>
                                </a>
                            </li>
                            <li class="nav-item" id="sidebar-orders">
                                <a href="{:Url('orders/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">销售订单</span>
                                </a>
                            </li>
                            <li class="nav-item" id="logis-index">
                                <a href="{:Url('logistics/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">物流信息</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- 生产出货 -->
                    <li class="sidebar-nav" id="sidebar-schedule">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">生产管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="schedule-paidan">
                                <a href="{:Url('schedule/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">生产订单</span>
                                </a>
                            </li>
                            <li class="nav-item" id="schedule-shengchan">
                                <a href="{:Url('schedule/shengchan')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">完成订单</span>
                                </a>
                            </li><!--
                            <li class="nav-item" id="schedule-daichu">
                                <a href="{:Url('schedule/daichu')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">确认发货</span>
                                </a>
                            </li>-->
                            <li class="nav-item" id="schedule-chuku">
                                <a href="{:Url('schedule/endck')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">已出库单</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- 财务管理 -->
                    <li class="sidebar-nav" id="sidebar-finance">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">财务管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="finance-receivables">
                                <a href="{:Url('finance/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">应收款项</span>
                                </a>
                            </li>
                            <li class="nav-item" id="finance-statistics">
                                <a href="{:Url('finance/statistics')}" class="sidebar-statistics">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">销售统计</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- 产品管理 -->
                    <li class="sidebar-nav" id="sidebar-product">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">产品价格</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="product-color">
                                <a href="{:Url('product/color')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">颜色设置</span>
                                </a>
                            </li>
                            <li class="nav-item" id="product-number">
                                <a href="{:Url('product/number')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">系列价格</span>
                                </a>
                            </li>
                            <li class="nav-item" id="product-lock">
                                <a href="{:Url('product/suoju')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">配件价格</span>
                                </a>
                            </li>
                            <li class="nav-item" id="product-others">
                                <a href="{:Url('product/others')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">包墙价格</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 左侧导航 结束 -->