<header>
	<div class="header-topbar bg-gray border-top">
		<div class="container"><?php
			echo '<div class="topbar-left ticker-news">'.$topbar_left.'</div>';
			echo '<div class="topbar-right ticker-info"><ul class="list-inline list-unstyled social-topbar ">'.$social;
				do_action( 'medicplus_login_link' );
			echo '</ul></div>';?>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="header-banner header-3">
		<div class="container">
			<div class="header-banner-wrapper">
				<div class="hamburger-menu">
					<div class="hamburger-menu-wrapper">
						<div class="icons"></div>
					</div>
				</div>
				<div class="navbar-header pull-left">
					<div class="logo">
						<a href="<?php echo esc_url(site_url()); ?>" class="header-logo">
							<?php echo wp_kses_post($header_logo_data);?>
						</a>
					</div>
				</div>
				<?php echo '<div class="banner-header pull-right"><ul class="list-inline list-unstyled topbar_right">'.$topbar_right.'</ul></div>'?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="header-main header-3">
		<div class="container">
			<div class="header-main-wrapper">
				<div class="navbar-header">
					<div class="logo">
						<a href="<?php echo esc_url(site_url()); ?>" class="header-logo">
							<?php echo wp_kses_post($header_logo_data);?>
						</a>
					</div>
				</div>
				<nav class="navigation">
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