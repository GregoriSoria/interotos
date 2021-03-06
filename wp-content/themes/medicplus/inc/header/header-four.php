<?php 
$appointment_text = Medicplus::get_option('slz-header-appointment-text');
$appointment_link = Medicplus::get_option('slz-header-appointment-link');
$button_link = '';
if ( !empty($appointment_link ) ) {
    $button_link    = get_page_link($appointment_link );  
}
?>
<header>
    <div class="header-topbar bg-gray header-cancer-center">
        <div class="container"><?php
            echo '<div class="topbar-left"><ul class="list-inline list-unstyled social-topbar">'.$social.'</ul></div>';
            echo '<div class="ticker-news">'.$topbar_left.'</div>';
            if (!empty($appointment_text)){?>
                <div class="topbar-right btn-wrapper">
                    <a href="<?php echo esc_url( $button_link );?>" class="btn"><?php echo esc_html($appointment_text);?></a>
                </div>
            <?php }?>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="header-banner header-cancer-center">
        <div class="container">
            <div class="header-banner-wrapper">
                <div class="hamburger-menu">
                    <div class="hamburger-menu-wrapper">
                        <div class="icons"></div>
                    </div>
                </div>
                <div class="navbar-header pull-left">
                    <div class="logo">
                        <a href="<?php echo esc_url(site_url()); ?>" class="header-logo"><?php echo wp_kses_post($header_logo_data);?></a>
                    </div>
                </div><?php
                echo '<div class="banner-header pull-right"><ul class="list-inline list-unstyled topbar_right">'.$topbar_right;
                do_action( 'medicplus_login_link' );
                echo '</ul></div>';?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="header-main header-3 header-heart-center">
        <div class="container">
            <div class="header-main-wrapper">
                <div class="navbar-header">
                    <div class="logo">
                        <a href="<?php echo esc_url(site_url()); ?>" class="header-logo"><?php echo wp_kses_post($header_logo_data);?></a>
                    </div>
                </div>
                <nav class="navigation collapse navbar-collapse">
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
                <?php if ( Medicplus::get_option('slz-header-search-icon') == '1' ) {?>
                    <div class="nav-search-2">
                        <?php get_search_form(true);?>
                    </div>
                <?php }?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</header>