        <!-- 中间导航 开始 viewFramework-product-col-1-->
        <div class="viewFramework-product-navbar">
            <div class="product-nav-stage product-nav-stage-main">
                <div class="product-nav-scene product-nav-main-scene">
                    <div class="product-nav-title">{$title}</div>
                    <div class="product-nav-list">
                        <ul>
                            <li {if condition="ACTION_NAME=='category'"}class="active"{/if}>
                                <a href="{:url('goods/category')}">
                                    <div class="nav-icon"></div><div class="nav-title">商品分类</div>
                                </a>
                            </li>
                            <!-- <li {if condition="ACTION_NAME=='brand'"}class="active"{/if}>
                                <a href="{:url('goods/brand')}">
                                    <div class="nav-icon"></div><div class="nav-title">品牌管理</div>
                                </a>
                            </li> -->
                            <li {if condition="ACTION_NAME=='index' or ACTION_NAME=='add' or ACTION_NAME=='goodsinfo' or ACTION_NAME=='goods_edit'"}class="active"{/if}>
                                <a href="{:url('goods/index')}">
                                    <div class="nav-icon"></div><div class="nav-title">商品列表</div>
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