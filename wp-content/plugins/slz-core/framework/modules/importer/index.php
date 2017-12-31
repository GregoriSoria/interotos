<?php

Medicplus_Core::load_class( 'Demo_Importer' );
class Medicplus_Core_DemoImporterPlugin {

	function form() {
?>

<div class="wrap about-wrap slz-wrap slz-tab-style">
	<?php do_action(SLZCORE_THEME_PREFIX . '_get_theme_header');?>
	<div class=" slz-content-importer">
		<div class="slz-important-notice">
			<p class="about-description"><?php esc_html_e('Works best to import on a new install of WordPress. You should remove all posts, pages, widgets content before import demo data. Please install required plugins before click import demo.', 'slz-core' );?></p>
		</div>
		<div class="slz-demo-themes slz-install-plugins">
			<div class="feature-section theme-browser rendered">
			<?php
				if( is_dir( SLZCORE_SAMPLE_DATA_DIR ) )
					$demo_directory = array_diff( scandir( SLZCORE_SAMPLE_DATA_DIR ), array( '..', '.' ) );
				$dir_array = array();

				if ( !empty( $demo_directory ) && is_array( $demo_directory ) ) {

					foreach ( $demo_directory as $key => $value ) {

						if ( is_dir( SLZCORE_SAMPLE_DATA_DIR . $value ) && is_file( SLZCORE_SAMPLE_DATA_DIR . $value . '/config.json' ) ) {

							$dir = SLZCORE_SAMPLE_DATA_DIR . $value . '/';
							$json_data = file_get_contents( $dir . 'config.json' );
							$json_data = json_decode($json_data, true);

							if( !empty( $json_data['redux_opt_name'] ) && is_file( $dir . $json_data['wordpress_content_file'] ) && is_file( $dir . $json_data['theme_option_file'] ) && is_file( $dir . $json_data['widget_backup_file'] ) ) {
								$dir_array[$value]['data'] = $json_data;
								$dir_array[$value]['dir'] = $dir;
								$dir_array[$value]['name'] = $value;
								$dir_array[$value]['url'] = SLZCORE_SAMPLE_DATA_URL . $value;
							}
						}
					}

					uksort( $dir_array, 'strcasecmp' );
				} else {
					echo '<b>' . esc_html_e('No Demo Data Provided', 'slz-core' ) . '</b>';
				}


				foreach( $dir_array as $demo => $data ):
				?>
				<div class="theme">
					<div class="theme-screenshot">
						<div class="slz-box-loader hide">
							<img class="img-loading" src="<?php echo SLZCORE_ASSET_URI.'/images/loader.gif'; ?>" alt="loader">
						</div>
						<img src="<?php echo esc_url( $data['url'] . '/' . $data['data']['screen_image_file'] ); ?>" alt="" />
					</div>
					<?php if( !empty( $data['data']['description'] ) ) echo '<span class="more-details">' . esc_attr( $data['data']['description'] ) . '</span>'; ?>
					<h3 class="theme-name">
						<?php
						echo esc_attr( $data['data']['name'] );
						?>
					</h3>
					<div class="theme-actions">
						<?php

							if( !empty( $data['data']['demo_url'] ) ) {
								echo '<a href="' . $data['data']['demo_url'] . '" target="_blank" class="button button-primary">' . esc_html__('Demo', 'slz-core' ) . '</a>&nbsp;';
							}

							$my_options = get_option('medicplus_import');
							if( is_array( $my_options ) && in_array( $data['name'], $my_options ) ) {
								$btn_demo_text = esc_html__('Re-Install', 'slz-core' );
							} else {
								$btn_demo_text = esc_html__('Install', 'slz-core' );
							}
							echo '<a href="javascript:;" class="button button-primary btn-import-data" data-name="' . esc_attr( $data['name'] ) . '" data-text-importing="' . esc_attr__( 'Importing', 'slz-core' ) . '" data-text-imported="' . esc_attr__( 'Imported', 'slz-core' ) . '" data-text-importer="' . esc_attr__( 'Importer', 'slz-core' ) . '" data-text-confirm="' . esc_attr__( 'Are you sure to install this content ?', 'slz-core' ) . '">' . esc_html($btn_demo_text) . '</a>';

						?>

					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<div class="slz-fixed-bg hide"></div>

<?php
	}

	function ajaxImporting() {
		$data_name = $_POST['params']['name'];
		// echo $data_name;
		if ( empty($data_name) ) {
			return false;
		}
		$data_name = esc_attr( $data_name );
		?>
		<div class="slz-demo-themes slz-install-plugins">
			<div class="feature-section theme-browser rendered">
				<div class="slz-important-loading">
					<h3 class="about-description" id="title_loading"><?php esc_html_e('Installing the demo...', 'slz-core' );?></h3>
					<h3 class="about-description" id="title_success" style="display: none;"><?php esc_html_e('Congratulation! Demo is installed', 'slz-core' );?></h3>
					<h3 class="about-description" id="title_error" style="display: none;"><?php esc_html_e('Something Wrong!', 'slz-core' );?></h3>
				</div>
				<?php
					$demo_loading = SLZCORE_SAMPLE_DATA_DIR . $data_name;
					if( is_dir( $demo_loading ) && is_file ( $demo_loading . '/config.json' ) ){
				?>
				<div class="td-box" id="progress_bar">
					<div class="td-box-row">
						<div class="td-section td-loading" id="content_loading">
							<p><?php esc_html_e('Please wait until the demo is installing. It may take 10 to 15 minutes.', 'slz-core' );?></p>
						</div>

						<div class="td-section td-complete" id="content_success" style="display:none">
						</div>

						<div class="td_progress_bar_wrap">
							<div class="td_progress_bar" id="progress_loading">
								<div></div>
							</div>
							<div>
								<a href="<?php echo esc_url(admin_url( 'admin.php?page=' . SLZCORE_THEME_PREFIX . '_importer' )); ?>" class="td-return-dashboard" style="display: none;" ><?php esc_attr_e('Return to Dashboard', 'slz-core' );?></a>
							</div>
							<div>
								<a href="javascript:void(0)" class="td-progress-show-details" style="display: none;" data-text-show="<?php esc_attr_e('Show details', 'slz-core' );?>" data-text-hide="<?php esc_attr_e('Hide details', 'slz-core' );?>"><?php esc_attr_e('Show details', 'slz-core' );?></a>
							</div>
						</div>
					</div>
					<div class="td-clear"></div>
				</div>
				<div class="td_report" id="report">
					<?php
					$demo_loading = SLZCORE_SAMPLE_DATA_DIR . $data_name;
					if( is_dir( $demo_loading ) && is_file ( $demo_loading . '/config.json' ) ){
						$dir = $demo_loading . '/';
						$json_data = file_get_contents( $dir . 'config.json' );
						$json_data = json_decode($json_data, true);

						if( !empty( $json_data ) && is_array($json_data) ) {
							$slz_import = new Medicplus_Core_Demo_Importer();
							$slz_import->fetch_attachments = true;
					
							$slz_import->widgets_file = $dir . $json_data['widget_backup_file'];
							$slz_import->demo_file = $dir . $json_data['wordpress_content_file'];
							
							if( !empty( $json_data['custom_sidebar_file'] ) && file_exists($dir . $json_data['custom_sidebar_file']) ) {
								$slz_import->custom_sidebar_file = $dir . $json_data['custom_sidebar_file'];
								$slz_import->custom_sidebar_name = SLZCORE_CUSTOM_SIDEBAR_NAME;
							}

							if( !empty( $json_data['custom_category_file'] ) && file_exists($dir . $json_data['custom_category_file']) ) {
								$slz_import->custom_category_file = $dir . $json_data['custom_category_file'];
							}

							if( !empty ($json_data['redux_opt_name']) && !empty ($json_data['theme_option_file']) && file_exists($dir . $json_data['theme_option_file'])){
								$slz_import->theme_option_name = $json_data['redux_opt_name'];
								$slz_import->theme_options_file = $dir . $json_data['theme_option_file'];
							}

							if(!empty($json_data['menu'])){
								$slz_import->demo_menu = $json_data['menu'];
							}
							$slz_import->import();

							$my_options = get_option('medicplus_import');
							if( empty( $my_options ) ) {
								$my_options = array();
							}

							if( !in_array( $data_name, $my_options ) ) {
								$my_options[] = $data_name;
								update_option('medicplus_import', $my_options);
							}
							echo 'Successfully imported.';
						} else {
							echo esc_html__('Cannot found this demo file. Please check and try again later', 'slz-core' );
						}
					}
					?>
				</div>
				<?php
					} else {
						echo esc_html__('Cannot found this demo file. Please check and try again later', 'slz-core' );
					}
				?>
			</div>
		</div>
		<?php
	}

}
?>