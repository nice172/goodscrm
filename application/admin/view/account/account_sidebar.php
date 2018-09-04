        <!-- 中间导航 开始 viewFramework-product-col-1-->
        <div class="viewFramework-product-navbar">
            <div class="product-nav-stage product-nav-stage-main">
                <div class="product-nav-scene product-nav-main-scene">
                    <div class="product-nav-title">{$title}</div>
                    <div class="product-nav-list">
                        <ul>
                            <li {if condition="ACTION_NAME=='payment' || ACTION_NAME=='payment_info' || ACTION_NAME=='payment_edit'"}class="active"{/if}>
                                <a href="{:url('payment')}">
                                    <div class="nav-icon"></div><div class="nav-title">应付账款</div>
                                </a>
                            </li>
                            <li {if condition="ACTION_NAME=='wait' || ACTION_NAME=='create_payment'"}class="active"{/if}>
                                <a href="{:url('wait')}">
                                    <div class="nav-icon"></div><div class="nav-title">采购发票待处理</div>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--缩小展开-->
        <div class="viewFramework-product-navbar-collapse">
            <div class="product-navbar-collapse-inner" title="缩小/展开">
                <div class="product-navbar-collapse-bg"></div>
                <div class="product-navbar-collapse">
                    <span class="icon-collapse-left"></span>
                    <span class="icon-collapse-right"></span>
                </div>
            </div>
        </div>