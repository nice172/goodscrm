    <!-- 左侧导航 开始 -->
    <div class="viewFramework-sidebar">
        <div class="sidebar-content console-component-sidebar">
            <div class="sidebar-inner">
                <div class="sidebar-fold icon-unfold"></div>
                <!--sidebar-nav-active-->
                <ul id="accordion">
                    {foreach name="left_menu" item="v"}
                    {if condition="!empty($v['subNode'])"}
                    <li class="sidebar-nav {if condition="$v['id']==$left_active"}sidebar-nav-active{/if}" id="{$v.nodeid}">
                        <div class="sidebar-title sidebar-trans">
                            <div class="sidebar-title-inner">
                                <span class="sidebar-title-icon icon-arrow-right"></span>
                                <span class="sidebar-title-text">{$v.title}</span>
                            </div>
                        </div>
                        <ul class="sidebar-trans submenu">
                        {foreach name="v.subNode" item="vv"}
                            <li class="nav-item {if condition="$vv['node']==$left_URL || $vv['id']==$current_pid"}active{/if}">
                                <a href="{$vv.url}" class="sidebar-trans">
                                    <div class="nav-icon sidebar-trans"><span class="{$vv.icon}"></span></div>
                                    <span class="nav-title">{$vv.title}</span>
                                </a>
                            </li>
                        {/foreach}
                        </ul>
                    </li>
                    {/if}
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>
    <!-- 左侧导航 结束 -->