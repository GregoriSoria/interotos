	<?php
	$arr_pages = array(
		'requirement'	=> esc_html__( "Requirements & Recommendations", 'medicplus' ),
		'plugin'		=> esc_html__( "Plugins", 'medicplus' ),
		'importer'		=> esc_html__( "Demo Importer", 'medicplus' ),
		'icon'			=> esc_html__( "MedicPlus Icons", 'medicplus' ),
		'changelog'		=> esc_html__( "Changes Log", 'medicplus' )
	);
	$screen = get_current_screen();
	$args = explode('_', $screen->id);
	$id_page = array_pop($args);
	?>
	<h1><?php esc_html_e( "Welcome to MedicPlus!", 'medicplus' ); ?></h1>
	<div class="about-text">
		<?php esc_html_e( "MedicPlus is now installed and ready to use!  Get ready to build something beautiful. Please register your purchase to get support and automatic theme updates. Read below for additional information. We hope you enjoy it!", 'medicplus' ); ?>
	</div>
	<h2 class="nav-tab-wrapper">
		<?php 
		foreach ( $arr_pages as $id => $name ) {
			$active = '';
			if( $id == $id_page || $id == 'welcome') {
				$active = 'nav-tab-active';
			}
			if( $id == 'icon' && ! MEDICPLUS_CORE_IS_ACTIVE ){
				continue;
			}
			if( $id == 'importer' && ! class_exists('Medicplus_Core_DemoImporterPlugin') ){
				continue;
			}
			printf( '<a href="%1$s" class="nav-tab %3$s">%2$s</a>',
					esc_url(admin_url( 'admin.php?page='.'medicplus_' . $id )),
					$name,
					esc_attr($active) );
		}
		?>
	</h2>