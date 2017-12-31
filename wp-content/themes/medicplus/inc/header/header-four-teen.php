<header>
    <div class="header-topbar bg-vet-clinic">
        <div class="container"><?php
            echo '<div class="topbar-left ticker-news">'.$topbar_left.'</div>';
               echo '<div class="topbar-right"><ul class="list-inline list-unstyled social-topbar">'.$social;
            do_action( 'medicplus_login_link' );
            echo '</ul></div>';?>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="header-main header-vet-clinic">
        <div class="container">
            <div class="header-main-wrapper">
                <div class="hamburger-menu">
                    <div class="hamburger-menu-wrapper">
                        <div class="icons"></div>
                    </div>
                </div>
                <div class="navbar-header pull-left">
                    <div class="logo">
                        <a href="<?php echo esc_url(site_url()); ?>" class="header-logo"><?php echo wp_kses_post($header_logo_data);?></a>
                    </div>
                </div>
                <nav class="navigation pull-right">
                 	<?php medicplus_show_main_menu();
                 	if ( Medicplus::get_option('slz-header-search-icon') == '1' ) {?>
                    <div class="button-search">
                        <p class="main-menu"><i class="fa fa-search"></i></p>
                    </div>
                    <div class="nav-search hide">
                        <?php get_search_form(true);?>
                    </div>
                    <?php } ?>
                </nav>
            </div>
        </div>
    </div>
</header>