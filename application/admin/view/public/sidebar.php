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
                                <a href="{:url('config/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">基本配置</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-role">
                                <a href="{:url('Role/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">角色管理</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-users">
                                <a href="{:url('users/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-topbar-certify"></span></div>
                                    <span class="nav-title">用户管理</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-auth">
                                <a href="{:url('Auth/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-topbar-certify"></span></div>
                                    <span class="nav-title">权限管理</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-goods_type">
                                <a href="{:url('Goods/goods_type')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-topbar-certify"></span></div>
                                    <span class="nav-title">商品类型管理</span>
                                </a>
                            </li>
                            <li class="nav-item" id="config-params">
                                <a href="{:url('Params/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-topbar-certify"></span></div>
                                    <span class="nav-title">系统参数管理</span>
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
                                <a href="{:url('supplier/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">供应商列表</span>
                                </a>
                            </li>
                            
                            <li class="nav-item" id="storage-xingcai">
                                <a href="{:url('Goods/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">商品维护</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="sidebar-nav" id="sidebar-baojia">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">报价管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="baojia-index">
                                <a href="{:url('baojia/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">报价列表</span>
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
                                <a href="{:url('customers/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">客户信息</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- 生产出货 -->
                    <li class="sidebar-nav" id="sidebar-schedule">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">订单管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="order-index">
                                <a href="{:url('order/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">订单列表</span>
                                </a>
                            </li>
                            <li class="nav-item" id="order-notindex">
                                <a href="{:url('order/nodeliery')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">未交货订单</span>
                                </a>
                            </li>
                            <li class="nav-item" id="order-finish">
                                <a href="{:url('order/finish')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">完成订单</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-nav" id="sidebar-purchase">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">采购管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="purchase-index">
                                <a href="{:url('purchase/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">采购单</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                   <li class="sidebar-nav" id="sidebar-delivery">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">送货管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="delivery-index">
                                <a href="{:url('delivery/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">送货单</span>
                                </a>
                            </li>
                        </ul>
                    </li>                    
                    <li class="sidebar-nav" id="sidebar-store">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">库存管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="relation-index">
                                <a href="{:url('store/relation')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">关联库存</span>
                                </a>
                            </li>
                            <li class="nav-item" id="store-index">
                                <a href="{:url('store/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">库存盘点</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- 财务管理 -->
                    <li class="sidebar-nav" id="sidebar-account">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">财务管理</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                            <li class="nav-item" id="account-index">
                                <a href="{:url('account/index')}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">应收账款</span>
                                </a>
                            </li>
                            <li class="nav-item" id="account-payment">
                                <a href="{:url('account/payment')}" class="sidebar-statistics">
                                    <div class="nav-icon sidebar-trans"><span class="icon-ecs"></span></div>
                                    <span class="nav-title">应付账款</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
    <!-- 左侧导航 结束 -->