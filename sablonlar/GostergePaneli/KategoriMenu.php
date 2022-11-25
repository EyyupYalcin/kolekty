    <?php
    function render_list($item){
        if($item['gorunurluk'] != 0){
            global $ust_id, $hizmetler;
            $ust_id = $item['id'];
            $sub_level_items2 = array_filter($hizmetler, function($v, $k) {
                global $ust_id;
                return $v['ust_id'] == $ust_id;
            }, ARRAY_FILTER_USE_BOTH);
            if(count($sub_level_items2) != 0){
                ?>
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <!-- <?php 
                                if(isset($item['icon']) && $item['icon'] != ""){
                                    //include $item['icon'];
                                }else{
                                    ?>
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                    <?php
                                }?> -->
                                <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg> -->
                                
                            </span>
                            <span class="menu-text"><?= $item['hizmet_adi'] ?></span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                            <ul class="menu-subnav">
                                <?php
                                    foreach ($sub_level_items2 as $key => $item) {
                                        render_list($item);
                                    }
                                ?>
                            </ul>
                        </div>
                    </li>
                <?php
            }else{
                ?>
                <li class="menu-item" aria-haspopup="true" data-menu-toggle="hover" aria-haspopup="true">
                    <a href="/Hizmetler/<?= $item['hizmet_adi'] ?>" class="menu-link">
                        <!-- <?php
                            if(isset($item['icon']) && $item['icon'] != ""){
                                //include $item['icon'];
                            }else{
                                ?>
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                <?php
                            }
                        ?> -->
                                                        <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                        <span class="menu-text"><?= $item['hizmet_adi'] ?></span>
                        <!-- <span class="menu-desc"><?= $item['menu_aciklama'] ?></span> -->
                    </a>
                </li>
                <?php
            }
        }
    }
    ?>
    <!--begin::Bottom-->
    <div class="header-bottom gutter-b" id="KategoriMenu">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->
                <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                    <!--begin::Header Nav-->
                    <ul class="menu-nav">
                        <!-- 
                            <?php
                                var_export($hizmetler);
                                $root_level_items = array_filter($hizmetler, function($v, $k) {
                                    var_export($v['ust_id']);
                                    return $v['ust_id'] == 0;
                                }, ARRAY_FILTER_USE_BOTH);
                                var_export($root_level_items);
                            ?>
                        -->
                        <?php
                            foreach ($root_level_items as $key => $item) {
                                $ust_id = $item['id'];
                                $sub_level_items = array_filter($hizmetler, function($v, $k) {
                                    global $ust_id;
                                    return $v['ust_id'] == $ust_id;
                                }, ARRAY_FILTER_USE_BOTH);
                                if(count($sub_level_items) != 0){
                                    ?>
                                    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link menu-toggle">
                                            <span class="menu-text"><?= $item['hizmet_adi'] ?></span>
                                            <!-- <span class="menu-desc"><?= $item['menu_aciklama'] ?></span> -->
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                            <ul class="menu-subnav">
                                                <?php
                                                    foreach ($sub_level_items as $key => $item) {
                                                        render_list($item);
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php
                                }else{
                                    ?>
                                    <li class="menu-item menu-item-submenu menu-item-rel"  aria-haspopup="true">
                                        <a href="/Hizmetler/<?= $item['hizmet_adi'] ?>" class="menu-link">
                                            <span class="menu-text"><?= $item['hizmet_adi'] ?></span>
                                            <!-- <span class="menu-desc"><?= $item['menu_aciklama'] ?></span> -->
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                            <ul class="menu-subnav">
                                                <?php
                                                    foreach ($sub_level_items as $key => $item) {
                                                        render_list($item);
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php
                                }

                            }
                        ?>
                        <!-- Arama Icon -->
                        <!-- <li class="menu-item menu-item-submenu menu-item-rel" id="AramaBtn">
                            <a href="javascript:;" class="menu-link">
                                <span class="menu-text"><i class="fas fa-search"></i></span>
                                <i class="menu-arrow"></i>
                            </a>
                        </li> -->
                        <!--end::Arama Icon -->
                    </ul>
                    <!--end::Header Nav-->
                </div>
                <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Bottom-->
