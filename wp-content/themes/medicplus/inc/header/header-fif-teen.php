<?php 
$appointment_text = Medicplus::get_option('slz-header-appointment-text');
$appointment_link = Medicplus::get_option('slz-header-appointment-link');
$button_link = '';
if ( !empty($appointment_link ) ) {
    $button_link    = get_page_link($appointment_link );  
}
?>
<header>
    <div class="header-topbar border-bottom header-dental-care">
        <div class="container"><?php
            echo '<div class="topbar-left ticker-news">'.$topbar_left.'</div>';
            echo '<div class="topbar-right ticker-info"><ul class="list-inline list-unstyled topbar_right">'.$topbar_right;
            do_action( 'medicplus_login_link' );
            echo '</ul></div>';?>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="header-main header-dental-care">
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
                    if (!empty($appointment_text)){?>
                        <div class="btn-wrapper">
                           <a href="<?php echo esc_url( $button_link );?>" class="btn"><?php echo esc_html($appointment_text);?></a>
                        </div><?php
                    }   
                    if ( Medicplus::get_option('slz-header-search-icon') == '1' ) {?>
                    <div class="button-search">
                        <p class="main-menu"><i class="fa fa-search">      </i></p>
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