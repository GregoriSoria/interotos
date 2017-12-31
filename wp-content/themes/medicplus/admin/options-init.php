<?php
/**
 * Options Config (ReduxFramework Sample Config File).
 *
 * For full documentation, please visit: https://docs.reduxframework.com
 *
 */
if (!class_exists('Medicplus_Redux_Framework_Config')) {

	class Medicplus_Redux_Framework_Config {

		public $args     = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if ( ! class_exists('ReduxFramework') ) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
				$this->initSettings();
			} else {
				add_action('plugins_loaded', array($this, 'initSettings'), 10);
			}

		}

		public function initSettings() {

			// Just for demo pureposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();

			if (!isset($this->args['opt_name'])) { // No errors please
				return;
			}

			// If Redux is running as a plugin, this will remove the demo notice and links
			add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
		}

		/**
		 * This is a test function that will let you see when the compiler hook occurs.
		 *
		 * It only runs if a field   set with compiler=>true is changed.
		 */
		function compiler_action($options, $css) {
			return;
		}

		/**
		 * Custom function for filtering the sections array.
		 *
		 */
		function dynamic_section($sections) {
			$sections[] = array(
				'title'  => esc_html__('Section via hook', 'medicplus'),
				'desc'   => sprintf('<p class="description">%s</p>', esc_html__('This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'medicplus')),
				'icon'   => 'el-icon-paper-clip',
				// Leave this as a blank section, no options just some intro text set above.
				'fields' => array()
			);

			return $sections;
		}

		/**
		 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
		 *
		 */
		function change_arguments($args) {
			//$args['dev_mode'] = false;
			return $args;
		}

		/**
		 * Filter hook for filtering the default value of any given field. Very useful in development mode.
		 */
		function change_defaults($defaults) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists('ReduxFrameworkPlugin') ) {
				remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
			}
		}

		public function setSections() {

			/*
			  Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			*/
			// Background Patterns Reader
			$sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
			$sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
			$sample_patterns        = array();
			$image_opt_path         = get_template_directory_uri() . '/assets/admin/images/';

			if ( is_dir( $sample_patterns_path ) ) {

				if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
					$sample_patterns = array();

					while ( ( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false ) {

						if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
							$name = explode( '.', $sample_patterns_file );
							$name = str_replace( '.' . end($name), '', $sample_patterns_file );
							$sample_patterns[] = array( 'alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file );
						}
					}
				}
			}

			ob_start();

			$ct          = wp_get_theme();
			$this->theme = $ct;
			$item_name   = $this->theme->get('Name');
			$tags        = $this->theme->Tags;
			$screenshot  = $this->theme->get_screenshot();
			$class       = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf( esc_html__( 'Customize &#8220;%s&#8221;', 'medicplus' ), $this->theme->display('Name') );

			?>
			<div id="current-theme" class="<?php echo esc_attr($class); ?>">
			<?php if ( $screenshot ) : ?>
				<?php if ( current_user_can('edit_theme_options') ) : ?>
						<a href="<?php echo esc_url(wp_customize_url()); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
							<img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'medicplus'); ?>" />
						</a>
				<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'medicplus' ); ?>" />
				<?php endif; ?>

				<h4><?php echo esc_html( $this->theme->display('Name') ); ?></h4>

				<div>
					<ul class="theme-info">
						<li><?php printf(esc_html__('By %s', 'medicplus'), $this->theme->display('Author')); ?></li>
						<li><?php printf(esc_html__('Version %s', 'medicplus'), $this->theme->display('Version')); ?></li>
						<li><?php echo '<strong>' . esc_html__('Tags', 'medicplus') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
					</ul>
					<p class="theme-description"><?php echo esc_html( $this->theme->display('Description') ); ?></p>
			<?php
			if ( $this->theme->parent() ) {
				printf(' <p class="howto">' . wp_kses( __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'medicplus'), array( 'a' => array('href' => array()) ) ) . '</p>', 'http://codex.wordpress.org/Child_Themes', $this->theme->parent()->display('Name'));
			}
			?>

				</div>
			</div>

			<?php
			$item_info = ob_get_contents();

			ob_end_clean();

			$admin_widget_url 	= '<a href="'.esc_url(admin_url('widgets.php','http')).'" target="_blank">' .esc_html__('Widget', 'medicplus') .'</a>';
			$admin_menus_url 	= '<a href="'.esc_url(admin_url('nav-menus.php','http')).'" target="_blank">' .esc_html__('Menus', 'medicplus') .'</a>';
			$admin_icon_url 	= '<a href="'.esc_url(admin_url('admin.php?page=medicplus_icon','http')).'" target="_blank">' .esc_html__('Icon Page', 'medicplus') .'</a>';
			$fontawesome_url 	= '<a href="' .esc_url('https://fortawesome.github.io/Font-Awesome/icons/'). '">' .esc_html__('Font-Awesome', 'medicplus') .'</a>';
			$get_latlong		= '<a href="' .esc_url('http://www.latlong.net/'). '" target="_blank">http://www.latlong.net/</a>';

			// ACTUAL DECLARATION OF SECTIONS
			// General setting
			$this->sections[] = array(
				'title'     => esc_html__( 'General', 'medicplus' ),
				'icon'      => 'el-icon-adjust-alt',
				'fields'    => array(
					array(
						'id'       => 'slz-layout',
						'type'     => 'image_select',
						'title'    => esc_html__( 'Layout display', 'medicplus' ),
						'subtitle' => esc_html__( 'Choose type of layout', 'medicplus' ),
						'desc'     => esc_html__( 'This option will change layout for all page of theme.', 'medicplus' ),
						'options'  => array(
							'1' => array(
								'alt' => esc_html__( 'Fluid', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'full.png'
							),
							'2' => array(
								'alt' => esc_html__( 'Boxed', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'boxed.png'
							),
						),
						'default'  => '1'
					),

					array(
			            'id'       => 'slz-palette-color',
			            'type'     => 'palette',
			            'title'    => esc_html__( 'Palette Color Option', 'medicplus' ),
			            'subtitle' => esc_html__( 'Choose color of theme', 'medicplus' ),
			            'desc'     => esc_html__( 'This option will change color for all page of theme', 'medicplus' ),
			            'default'  => 'blue_green',
			            'palettes' => array(
			            	'blue_green' => array( //default
			                	'#0f77ad', 
			                	'#07932E',
			                ),
			            	'red_blue' => array( //theme-heart-center.css , theme-cancer-center.css
			                	'#F04E4E', 
			                	'#0F77AD',
			                ),
			                'lightgreen_blue'  => array( //==> theme-pediatric.css
			                	'#93C524',
			                	'#0F77AD',
			                ),
			                'pink_violet_blue' => array( //them-vet-clinic.css
			                    '#ec3460', 
			                    '#523855',
			                    '#0F77AD',
			                ),
			                'orange_blue' => array(
			                	'#F1622A', 
			                	'#0F77AD',
			                ),
			                'lightpink_lightblue_blue' => array( //theme-dermatorogy.css
			                    '#FF85BE', 
			                    '#30CDDB',
			                    '#0F77AD',
			                ),
			                'lightgreen_brown'  => array( //theme-dr-nutrition.css
								'#7FC241', 
								'#693F17',
			                ),
			                'lightblue_orange'  => array( //theme-ENT-center.css
								'#22ADF9', 
								'#F1622A',
			                ),
			                'lightorange_blue'  => array( //theme-orthopedic.css
								'#E68A59', 
								'#0F77AD',
			                ),
			                'lightviolet_blue'  => array( //theme-ophthalmology.css
								'#89A8C0', 
								'#0F77AD',
			                ),
			                'lightblue_blue'  => array( //theme-prenancy.css
								'#46C9D9', 
								'#0F77AD',
			                ),
			                'darkviolet_blue'  => array( //theme-psychology.css
								'#33324C', 
								'#0F77AD',
			                ),
			            )
			        ),

					array(
						'id'       => 'slz-layout-boxed-bg',
						'type'     => 'background',
						'title'    => esc_html__( 'Body Background', 'medicplus' ),
						'required' => array('slz-layout','=','2'),
						'default'  => array(
							'background-color'      => '#ffffff',
							'background-image'      => '',
							'background-repeat'     => 'no-repeat',
							'background-attachment' => '',
							'background-position'	=> 'center center',
							'background-size'		=> 'cover'
						)
					),
					array(
						'id'       => 'slz-logo-header',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'Header Logo', 'medicplus' ),
						'compiler' => 'true',
						'subtitle' => esc_html__( 'Choose logo image', 'medicplus' ),
						'default'  => array( 'url' => esc_url( MEDICPLUS_LOGO ) )
					),
					array(
						'id'		=> 'slz-sticky',
						'type'		=> 'switch',
						'title'		=> esc_html__('Header Sticky Enable', 'medicplus'),
						'subtitle'  => esc_html__( 'Enable or disable fixed header when scroll', 'medicplus' ),
						'default'   => true,
					),
					array(
						'id'       	=> 'slz-backtotop',
						'type'     	=> 'switch',
						'title'    	=> esc_html__( 'Back To Top Button', 'medicplus' ),
						'subtitle' 	=> esc_html__( 'Setting for back to top button', 'medicplus' ),
						'on'       	=> esc_html__( 'Show', 'medicplus' ),
						'off'      	=> esc_html__( 'Hide', 'medicplus' ),
						'default'  	=> true
					),
					array(
					    'id'             => 'slz-backtotop-color',
					    'type'           => 'color',
					    'title'          => esc_html__('Back To Top Button Color', 'medicplus'), 
					    'transparent'    => false,
					    'default'        => '#1c90cd',
					    'validate'       => 'color',
					),
					array(
						'id'       => 'slz-map-key-api',
						'type'     => 'text',
						'title'    => esc_html__( 'Map google API Key', 'medicplus' ),
						'subtitle' => esc_html__( 'This key is used to run a some feature of Map.Please refer document to create a key', 'medicplus' ),
					),
					array(
						'id'        => 'slz-header-ecommerce',
						'type'      => 'switch',
						'title'     => esc_html__( 'Woocommerce Account', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'subtitle'  => esc_html__( 'Show or hide login link of woocommerce in your site.', 'medicplus' ),
						'default'   => false
					),
				)
			);

			// Social Setting
			$this->sections[] = array (
				'title'     => esc_html__( 'Social', 'medicplus' ),
				'desc'      => wp_kses( __( 'These information will be used for content in <strong>Header</strong> & <strong>Footer</strong>', 'medicplus' ), array('strong' => array())),
				'icon'      => 'el-icon-group-alt',
				'fields'    => array(
					array(
						'id'       => 'slz-social-facebook',
						'type'     => 'text',
						'title'    => esc_html__( 'Facebook', 'medicplus' ),
						'default'  => 'http://facebook.com'
					),
					array(
						'id'       => 'slz-social-twitter',
						'type'     => 'text',
						'title'    => esc_html__( 'Twitter', 'medicplus' ),
						'default'  => 'http://twitter.com'
					),
					array(
						'id'       => 'slz-social-google-plus',
						'type'     => 'text',
						'title'    => esc_html__( 'Googleplus', 'medicplus' ),
						'default'  => 'https://plus.google.com/'
					),
					array(
						'id'       => 'slz-social-pinterest',
						'type'     => 'text',
						'title'    => esc_html__( 'Pinterest', 'medicplus' ),
						'default'  => 'https://pinterest.com/'
					),
					array(
						'id'       => 'slz-social-instagram',
						'type'     => 'text',
						'title'    => esc_html__( 'Instagram', 'medicplus' ),
						'default'  => 'http://instagram.com'
					),
					array(
						'id'       => 'slz-social-dribbble',
						'type'     => 'text',
						'title'    => esc_html__( 'Dribbble', 'medicplus' ),
						'default'  => 'http://dribbble.com'
					),
					array(
						'id'        => 'slz-social-share',
						'type'      => 'sorter',
						'title'     => esc_html__( 'Social Share Link', 'medicplus' ),
						'subtitle'  => esc_html__( 'These information will be used in blog.', 'medicplus' ),
						'options'   => array(
							'disabled' => array(
								'pinterest'     => esc_html__( 'Pinterest', 'medicplus' ),
								'linkedin'  	=> esc_html__( 'LinkedIn', 'medicplus' ),
								'digg'	 		=> esc_html__( 'Digg', 'medicplus' ),
							),
							'enabled'  => array(
								'facebook'  	=> esc_html__( 'Facebook', 'medicplus' ),
								'twitter'	 	=> esc_html__( 'Twitter', 'medicplus' ),
								'google-plus'   => esc_html__( 'Google Plus', 'medicplus' ),
							),
						),
					),
				)
			);

			// Header Setting
			$this->sections[] = array(
				'title'   => esc_html__( 'Header', 'medicplus' ),
				'desc'    => esc_html__( 'This section will change setting for header', 'medicplus' ),
				'icon'    => 'el-icon-caret-up',
				'fields'  => array(
					array(
						'id'			=> 'slz-header-layout',
						'type'			=> 'image_select',
						'title'			=> esc_html__( 'Header Style', 'medicplus' ),
						'indent'    	=> true,
						'subtitle'		=> esc_html__( 'Configuration Header Style : Logo and Menu', 'medicplus' ),
						'options'  		=> array(
							'one'   => array(
								'alt' => esc_html__( 'Style 1', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header01.png'
							),
							'two' => array(
								'alt' => esc_html__( 'Style 2', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header02.png'
							),
							'three'   => array(
								'alt' => esc_html__( 'Style 3', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header03.png'
							),
							'four'   => array(
								'alt' => esc_html__( 'Style 4', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header04.png'
							),
							'five' => array(
								'alt' => esc_html__( 'Style 5', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header05.png'
							),
							'six'   => array(
								'alt' => esc_html__( 'Style 6', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header06.png'
							),
							'seven'   => array(
								'alt' => esc_html__( 'Style 7', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header07.png'
							),
							'eight'   => array(
								'alt' => esc_html__( 'Style 8', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header08.png'
							),
							'nine'   => array(
								'alt' => esc_html__( 'Style 9', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header09.png'
							),
							'ten'   => array(
								'alt' => esc_html__( 'Style 10', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header10.png'
							),
							'eleven'   => array(
								'alt' => esc_html__( 'Style 11', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header11.png'
							),
							'twelve'   => array(
								'alt' => esc_html__( 'Style 12', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header12.png'
							),
							'thirt-teen'   => array(
								'alt' => esc_html__( 'Style 13', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header13.png'
							),
							'four-teen'   => array(
								'alt' => esc_html__( 'Style 14', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header14.png'
							),
							'fif-teen'   => array(
								'alt' => esc_html__( 'Style 15', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'header15.png'
							),
						),
						'default'  => 'one'
					),
					array(
						'id'       => 'slz-header-appointment-text',
						'type'     => 'text',
						'title'    => esc_html__( 'Make Appointment Text', 'medicplus' ),
						'required'  => array( 'slz-header-layout', '=', array('four','fif-teen') ),
						'default'  => esc_html__( 'Make Appointment Text', 'medicplus' ),
					),
					array(
						'id'       	=> 'slz-header-appointment-link',
						'type'     	=> 'select',
						'data'     	=> 'pages',
						'required'  => array( 'slz-header-layout', '=', array('four','fif-teen') ),
						'title'    	=> esc_html__( 'Select Page', 'medicplus' ),
						'default'  	=> '1'
					),
					array(
						'id'        => 'slz-header-search-icon',
						'type'      => 'switch',
						'title'     => esc_html__( 'Search On Header', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => false
					),
					array(
						'id'			=> 'slz-header-search-type',
						'type'			=> 'image_select',
						'title'			=> esc_html__( 'Search Style', 'medicplus' ),
						'subtitle'      => esc_html__( 'Not apply for header 03,04,05,06', 'medicplus' ),
						'indent'    	=> true,
						'required'      => array('slz-header-search-icon','=',true),
						'options'  		=> array(
							'one'   => array(
								'alt' => esc_html__( 'Style 1', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'search-01.png'
							),
							'two' => array(
								'alt' => esc_html__( 'Style 2', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'search-02.png'
							),
						),
						'default'  => 'one'
					),
					array(
						'id'        => 'slz-header-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Top Bar Left Content', 'medicplus' ),
						'subtitle'  => esc_html__( 'Configure detailed information for each content in header', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-header-ticker',
						'type'      => 'switch',
						'title'     => esc_html__( 'Ticker', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true
					),
					array(
					    'id'		=> 'slz-header-ticker-content',
					    'type' 		=> 'multi_text',
					    'title' 	=> esc_html__( 'Ticker Content', 'medicplus' ),
					),
					array(
						'id'     => 'section-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'        => 'slz-header-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Top Bar Right Content', 'medicplus' ),
						'subtitle'  => esc_html__( 'Configure detailed information for each content in header', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-header-other-info',
						'type'      => 'multi_text',
						'title'     => esc_html__( 'Contact Infomation', 'medicplus' ),
						'subtitle'  => sprintf( wp_kses( __( 'Please use format: icon / Content.<br>Ex: ["fa fa-phone","84 909 015 345"]', 'medicplus' ), array('br' => array()) )),
						'default'   => array('["fa-clock-o","Mon - Sat at <span class=\"info-inner\"> 7:00AM to 9:00PM </span>"]','["fa-map-marker","30 Mortensen Avenue, Salinas, CA 93905"]','["fa fa-phone","84 909 015 345"]')
					),
					array(
					    'id'             => 'slz-topbar-icon-color',
					    'type'           => 'color',
					    'title'          => esc_html__('Icon Color', 'medicplus'), 
					    'subtitle' 	     => esc_html__( 'Setting color for icon of contact information', 'medicplus' ),
					    'transparent'    => false,
					    'default'        => '',
					    'validate'       => 'color',
					),
					array(
						'id'       => 'slz-header-social',
						'type'     => 'sorter',
						'title'    => esc_html__( 'Social list', 'medicplus' ),
						'subtitle' => esc_html__( 'Only apply for header three.Please go on "Social" menu to enter social link', 'medicplus' ),
						'options'  => array(
							'disabled' => array(
								
							),
							'enabled'  => array(
								'facebook'     => esc_html__( 'Facebook', 'medicplus' ),
								'google-plus'  => esc_html__( 'Google plus', 'medicplus' ),
								'twitter'      => esc_html__( 'Twitter', 'medicplus' ),
								'instagram'    => esc_html__( 'Instagram', 'medicplus' ),
								'dribbble'     => esc_html__( 'Dribbble', 'medicplus' ),
								'pinterest'    => esc_html__( 'Pinterest', 'medicplus' ),
							),
						),
					),
					array(
						'id'     => 'section-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
			);

			// Menu
			$this->sections[] = array(
				'title'    => esc_html__( 'Menu', 'medicplus' ),
				'desc'     => esc_html__( 'Configuration for main navigation on top', 'medicplus' ),
				'icon'     => 'el-icon-brush',
				'fields'   => array(
					array(
						'id'        => 'slz-submenu-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Main Menu Setting', 'medicplus' ),
						'subtitle'  => esc_html__( 'Configuration for Main Menu', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-menu-custom',
						'type'      => 'switch',
						'title'     => esc_html__( 'Main Menu Custom', 'medicplus' ),
						'on'        => esc_html__( 'Custom', 'medicplus' ),
						'off'       => esc_html__( 'Default', 'medicplus' ),
						'default'   => false,
					),
					array(
						'id'        => 'slz-menu-item-text',
						'type'      => 'link_color',
						'title'     => esc_html__( 'Menu Item Color', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set color for Menu item', 'medicplus' ),
						'required'  => array( 'slz-menu-custom', '=', true ),
						'default'   => array(
							'regular'   => '#63727b',
							'hover'     => '#262626',
							'active'    => '#262626'
						)
					),
					array(
						'id'             => 'slz-menu-height',
						'type'           => 'dimensions',
						'units'          => 'px',
						'units_extended' => 'false',
						'all'			 => false,
						'width'			 => false,
						'title'          => esc_html__( 'Menu item height', 'medicplus' ),
						'subtitle'       => esc_html__( 'Choose line height for each menu item. This option only use for Header style 01', 'medicplus' ),
						'required'  => array( 'slz-menu-custom', '=', true ),
						'default'        => array (
							'width'		=> 'auto',
							'height'	=> '100px'
						)
					),
					array(
						'id'     => 'section-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'        => 'slz-submenu-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Dropdown Menu Setting', 'medicplus' ),
						'subtitle'  => esc_html__( 'Configuration for submenu', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-submenu-custom',
						'type'      => 'switch',
						'title'     => esc_html__( 'Dropdown Menu Custom', 'medicplus' ),
						'subtitle'	=> esc_html__( 'In default, dropdown menu will follow "Submenu Style" above', 'medicplus' ),
						'on'        => esc_html__( 'Custom', 'medicplus' ),
						'off'       => esc_html__( 'Default', 'medicplus' ),
						'default'   => false,
					),
					array(
						'id'        => 'slz-submenu-bg',
						'type'      => 'color_rgba',
						'title'     => esc_html__( 'Submenu background', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set background color for submenu dropdown', 'medicplus' ),
						'default'   => array(
							'color'    => '#fff',
							'alpha'    => '1',
							'rgba'     => 'rgba(255, 255, 255, 1)'
						),
						'required'  => array( 'slz-submenu-custom', '=', true ),
						'mode'      => 'background',
						'validate'  => 'colorrgba'
					),
					array(
						'id'        => 'slz-submenu-color',
						'type'      => 'link_color',
						'title'     => esc_html__( 'SubMenu item color', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set color for text in submenu', 'medicplus' ),
						'required'  => array( 'slz-submenu-custom', '=', true ),
						'default'   => array(
							'regular'   => '#63727b',
							'hover'     => '#262626',
							'active'    => '#262626',
						)
					),
					array(
						'id'             => 'slz-submenu-width',
						'type'           => 'dimensions',
						'units_extended' => false,
						'title'          => esc_html__( 'Submenu width', 'medicplus' ),
						'height'         => false,
						'required'       => array( 'slz-submenu-custom', '=', true ),
						'default'        => array(
							'width'  => 'auto',
							'height' => '60'
						)
					),
					array(
						'id'        => 'slz-submenu-border',
						'type'      => 'border',
						'title'     => esc_html__( 'Submenu Border', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set border bottom attribute for submenu', 'medicplus' ),
						'all'       => false,
						'top'       => false,
						'left'      => false,
						'right'     => false,
						'required'  => array( 'slz-submenu-custom', '=', true ),
						'default'   => array(
							'border-style'  => 'solid',
							'border-color'  => 'transparent',
							'border-bottom' => '1px',
							'border-top'    => '0px',
							'border-left'   => '0px',
							'border-right'  => '0px'
						)
					),
					array(
						'id'             => 'slz-submenu-padding',
						'type'           => 'spacing',
						'mode'           => 'padding',
						'all'            => false,
						'units'          => 'px',      // You can specify a unit value. Possible: px, em, %
						'units_extended' => 'false',   // Allow users to select any type of unit
						'title'          => esc_html__( 'SubMenu item padding', 'medicplus' ),
						'subtitle'       => esc_html__( 'Choose inwards spacing for each submenu item', 'medicplus' ),
						'desc'           => esc_html__( 'unit is "px"', 'medicplus' ),
						'required'  	 => array( 'slz-submenu-custom', '=', true ),
						'default'        => false
					),
					array(
						'id'        => 'slz-dropdownmenu-align',
						'type'      => 'radio',
						'title'     => esc_html__( 'Dropdown Menu Align', 'medicplus' ),
						'options'   => array(
							'left'     => esc_html__( 'Left', 'medicplus' ),
							'right'    => esc_html__( 'Right', 'medicplus' )
						),
						'default'   => 'right'
					),
					
				)
			);

			// Page title setting
			$this->sections[] = array(
				'title'     => esc_html__( 'Page Title Setting', 'medicplus' ),
				'icon'      => 'el-icon-website',
				'fields'    => array(
					array(
						'id'        => 'slz-page-title-show',
						'type'      => 'switch',
						'title'     => esc_html__( 'Show Page Title', 'medicplus' ),
						'subtitle'  => esc_html__( 'Choose to show or hide page title', 'medicplus' ),
						'on'       	=> esc_html__( 'Show', 'medicplus'),
						'off'      	=> esc_html__( 'Hide', 'medicplus'),
						'default'   => true,
					),
					array(
						'id'        => 'slz-page-title-bg',
						'type'      => 'background',
						'title'     => esc_html__( 'Page Title background image', 'medicplus' ),
						'subtitle'  => esc_html__( 'Body background image for page title section', 'medicplus' ),
						'default'   => array(
							'background-color'      => '#252e35',
							'background-repeat'     => 'no-repeat',
							'background-size'       => 'cover',
							'background-attachment' => 'fixed',
							'background-position'   => 'center center',
							'background-image'      => ''
						),
					),
					array(
						'id'        => 'slz-pagetitle-overlay-bg',
						'type'      => 'color_rgba',
						'title'     => esc_html__( 'Page Title overlay background', 'medicplus' ),
						'default'   => array(
							'color'     => '#fff',
							'alpha'     => '0',
							'rgba'      => 'rgba(255, 255, 255, 0)'
						)
					),
					array(
						'id'     	=> 'slz-pagetitle-pl-notice',
						'type'   	=> 'info',
						'notice' 	=> false,
						'style'  	=> 'info',
						'title'  	=> esc_html__( 'Background Parallax', 'medicplus' ),
						'desc'   	=> esc_html__( 'To use background parallax effect for Page Title, please set background-attachment field is "Fixed"', 'medicplus')
					),
					array(
						'id'        => 'slz-pagetitle-align',
						'type'      => 'radio',
						'title'     => esc_html__( 'Page Title Text Align', 'medicplus' ),
						'options'   => array(
							'center'   => esc_html__( 'Center', 'medicplus' ),
							'left'     => esc_html__( 'Left', 'medicplus' ),
							'right'    => esc_html__( 'Right', 'medicplus' ),
						),
						'default'   => 'left'
					),
					array(
						'id'             => 'slz-page-title-height',
						'type'           => 'dimensions',
						'units'          => 'px',
						'units_extended' => 'false',
						'all'			 => false,
						'width'			 => false,
						'title'          => esc_html__( 'Page Title Height', 'medicplus' ),
						'subtitle'       => esc_html__( 'Set height for page title session', 'medicplus' ),
						'default'        => array (
							'width'		=> 'auto',
							'height'	=> '65'
						)
					),
					array(
						'id'        => 'slz-title',
						'type'      => 'section',
						'title'     => esc_html__( 'The Title', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'       => 'slz-show-title',
						'type'     => 'switch',
						'title'    => esc_html__( 'Show Title', 'medicplus' ),
						'subtitle' => esc_html__( 'Choose to show or hide Title (only apply for page)', 'medicplus' ),
						'on'       	=> esc_html__( 'Show', 'medicplus'),
						'off'      	=> esc_html__( 'Hide', 'medicplus'),
						'default'  => true,
					),
					array(
						'id'        => 'slz-page-title-type-display',
						'type'      => 'radio',
						'title'     => esc_html__( 'Type Page Title', 'medicplus' ),
						'subtitle'  => esc_html__( 'Choose "Level Title" to show label of the level  if it at page of archive, taxonomy or page has hierarchical', 'medicplus' ),
						'options'   => array(
										'post' => esc_html__( 'Default', 'medicplus' ),
										'level' => esc_html__( 'Level Title', 'medicplus' )
									),
						'default'   => 'post',
					),
					array(
						'id'             => 'slz-pagetitle-title',
						'type'           => 'typography',
						'title'          => esc_html__( 'Page Title Text', 'medicplus' ),
						'google'         => false,
						'font-backup'    => true,
						'line-height'    => false,
						'preview'        => true,
						'text-transform' => true,
						'font-family'    => false,
						'text-align'     => false,
						'all_styles'     => true,
						'units'          => 'px',
						// Defaults to px
						'subtitle'       => esc_html__( 'Config typography for page title text', 'medicplus' ),
						'default'        => array(
							'color'           => '#2c3a44',
							'font-weight'     => '900',
							'font-size'       => '66px',
							'text-transform'  => 'uppercase'
						),
					),
					array(
						'id'     => 'slz-title-end',
						'type'   => 'section',
						'indent' => false,
					),
					array(
						'id'        => 'slz-breadcrumb',
						'type'      => 'section',
						'title'     => esc_html__( 'Breadcrumb', 'medicplus' ),
						'subtitle'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing.', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-show-breadcrumb',
						'type'      => 'switch',
						'title'     => esc_html__( 'Show Breadcrumb', 'medicplus' ),
						'subtitle'  => esc_html__( 'Choose to show or hide breadcrumb', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus'),
						'off'       => esc_html__( 'Hide', 'medicplus'),
						'default'   => true,
					),
					array(
						'id'             => 'slz-breadcrumb-path',
						'type'           => 'typography',
						'title'          => esc_html__( 'Breadcrumb Path', 'medicplus' ),
						'google'         => false,
						'font-backup'    => true,
						'line-height'    => false,
						'preview'        => true,
						'text-transform' => true,
						'font-family'    => false,
						'text-align'     => false,
						'all_styles'     => true,
						'units'          => 'px',
						// Defaults to px
						'subtitle'       => esc_html__( 'Config typography for breadcrumb title', 'medicplus' ),
						'default'        => array(
							'color'           => '#d4e3ee',
							'font-weight'     => '400',
							'font-size'       => '14px',
							'text-transform'  => 'capitalize',
						)
					),
					array(
						'id'             => 'slz-breadcrumb-path2',
						'type'           => 'typography',
						'title'          => esc_html__( 'Breadcrumb Text', 'medicplus' ),
						'google'         => false,
						'font-backup'    => false,
						'line-height'    => false,
						'preview'        => true,
						'text-transform' => true,
						'font-family'    => false,
						'text-align'     => false,
						'all_styles'     => false,
						'units'          => 'px',
						// Defaults to px
						'subtitle'       => esc_html__( 'Config typography for breadcrumb title', 'medicplus' ),
						'default'        => array(
							'color'           => '#ffffff',
							'font-weight'     => '400',
							'font-size'       => '14px',
							'text-transform'  => 'capitalize',
						)
					),
					array(
						'id'     => 'slz-breadcrumb-end',
						'type'   => 'section',
						'indent' => false,
					),
				)
			);

			// Sidebar setting
			$this->sections[] = array(
				'title'     => esc_html__( 'Sidebar', 'medicplus' ),
				'desc'      => esc_html__( 'Configuration for sidebar', 'medicplus' ),
				'icon'      => 'el-icon-caret-right',
				'fields'    => array(
					array(
						'id'        => 'slz-footer-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Default Sidebar', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-sidebar-layout',
						'type'      => 'image_select',
						'title'     => esc_html__( 'Default Sidebar Layout', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set how to display default sidebar', 'medicplus' ),
						'options'   => array(
							'left'  => array(
								'alt' => esc_html__( 'left', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'left.png'
							),
							'right' => array(
								'alt' => esc_html__( 'right', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'right.png'
							),
							'none'  => array(
								'alt' => esc_html__( 'none', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'nosidebar.png'
							)
						),
						'default'   => 'left'
					),
					array(
						'id'       	=> 'slz-sidebar',
						'type'     	=> 'select',
						'data'     	=> 'sidebars',
						'title'    	=> esc_html__( 'Default Sidebar', 'medicplus' ),
						'subtitle'	=> sprintf(esc_html__( 'You can create new sidebar in Appearance -> %s', 'medicplus' ), $admin_widget_url ),
						'default'  	=> ''
					),
					array(
						'id'        => 'slz-footer-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Blog Sidebar', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-blog-sidebar-layout',
						'type'      => 'image_select',
						'title'     => esc_html__( 'Blog Sidebar Layout', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set how to display sidebar  in blog single pages.', 'medicplus' ),
						'options'   => array(
							'left'  => array(
								'alt' => esc_html__( 'left', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'left.png'
							),
							'right' => array(
								'alt' => esc_html__( 'right', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'right.png'
							),
							'none'  => array(
								'alt' => esc_html__( 'none', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'nosidebar.png'
							)
						),
						'default'   => 'left'
					),
					array(
						'id'       	=> 'slz-blog-sidebar',
						'type'     	=> 'select',
						'data'     	=> 'sidebars',
						'title'    	=> esc_html__( 'Blog Sidebar', 'medicplus' ),
						'subtitle'	=> sprintf( esc_html__( 'You can create new sidebar in Appearance -> %s', 'medicplus' ), $admin_widget_url ),
						'default'  	=> ''
					),
					//department sidebar
					array(
						'id'        => 'slz-footer-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Department  Sidebar', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-department-sidebar-layout',
						'type'      => 'image_select',
						'title'     => esc_html__( 'Department Sidebar Layout', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set how to display sidebar in department single pages.', 'medicplus' ),
						'options'   => array(
							'left'  => array(
								'alt' => esc_html__( 'left', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'left.png'
							),
							'right' => array(
								'alt' => esc_html__( 'right', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'right.png'
							),
							'none'  => array(
								'alt' => esc_html__( 'none', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'nosidebar.png'
							)
						),
						'default'   => 'none'
					),
					array(
						'id'        => 'slz-department-sidebar',
						'type'      => 'select',
						'data'      => 'sidebars',
						'title'     => esc_html__( 'Department Sidebar', 'medicplus' ),
						'subtitle'  => sprintf( esc_html__( 'You can create new sidebar in Appearance -> %s', 'medicplus' ), $admin_widget_url ),
						'default'   => ''
					),
					//service detail sidebar
					array(
						'id'        => 'slz-footer-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Service Sidebar', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-service-sidebar-layout',
						'type'      => 'image_select',
						'title'     => esc_html__( 'Service Sidebar Layout', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set how to display sidebar in service single pages.', 'medicplus' ),
						'options'   => array(
							'left'  => array(
								'alt' => esc_html__( 'left', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'left.png'
							),
							'right' => array(
								'alt' => esc_html__( 'right', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'right.png'
							),
							'none'  => array(
								'alt' => esc_html__( 'none', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'nosidebar.png'
							)
						),
						'default'   => 'left'
					),
					array(
						'id'        => 'slz-service-sidebar',
						'type'      => 'select',
						'data'      => 'sidebars',
						'title'     => esc_html__( 'Service Detail Sidebar', 'medicplus' ),
						'subtitle'  => sprintf( esc_html__( 'You can create new sidebar in Appearance -> %s', 'medicplus' ), $admin_widget_url ),
						'default'   => ''
					),
					//shop  sidebar
					array(
						'id'        => 'slz-footer-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Shop Sidebar', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-shop-sidebar-layout',
						'type'      => 'image_select',
						'title'     => esc_html__( 'Shop Sidebar Layout', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set how to display sidebar in  product detail pages.', 'medicplus' ),
						'options'   => array(
							'left'  => array(
								'alt' => esc_html__( 'left', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'left.png'
							),
							'right' => array(
								'alt' => esc_html__( 'right', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'right.png'
							),
							'none'  => array(
								'alt' => esc_html__( 'none', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'nosidebar.png'
							)
						),
						'default'   => 'left'
					),
					array(
						'id'        => 'slz-shop-sidebar',
						'type'      => 'select',
						'data'      => 'sidebars',
						'title'     => esc_html__( 'Shop Detail Sidebar', 'medicplus' ),
						'subtitle'  => sprintf( esc_html__( 'You can create new sidebar in Appearance -> %s', 'medicplus' ), $admin_widget_url ),
						'default'   => ''
					),

					array(
						'id'        => 'slz-sidebar-section',
						'type'      => 'section',
						'indent'    => false,
					)
				)
			);

			// Footer setting
			$this->sections[] = array(
				'title'     => esc_html__( 'Footer', 'medicplus' ),
				'icon'      => 'el-icon-caret-down',
				'desc'      => esc_html__( 'Configuration for footer of site', 'medicplus' ),
				'fields'    => array(
					array(
						'id'        => 'slz-footer',
						'type'      => 'switch',
						'title'     => esc_html__( 'Footer section', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true
					),
					array(
						'id'       => 'slz-footer-style',
						'type'     => 'button_set',
						'title'    => esc_html__('Footer Style', 'medicplus'),
						//Must provide key => value pairs for options
						'options' => array(
							'default'  => esc_html__( 'Default', 'medicplus'),
							'dark'     => esc_html__( 'Dark', 'medicplus'), 
							'light'    => esc_html__( 'Light', 'medicplus'),
						), 
						'default' => 'default'
					),
					array(
						'id'        => 'slz-footerbt-contact-info-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Footer Contact Information', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-footerbt-contact-info',
						'type'      => 'switch',
						'title'     => esc_html__( 'Contact Information', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus'),
						'off'       => esc_html__( 'Hide', 'medicplus'),
						'default'   => true
					),
					array(
						'id'        => 'slz-footer-ci-dark-bg',
						'type'      => 'background',
						'title'     => esc_html__( 'Footer Contact Dark background image', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set background image for footer section', 'medicplus' ),
						'required'  => array('slz-footer-style','=','dark'),
						'default'   => array(
							'background-color'      => '#292F32',
							'background-image'      => '',
							'background-repeat'     => 'no-repeat',
							'background-attachment' => '',
							'background-position'	=> '',
							'background-size'		=> ''
						)
					),
					array(
						'id'        => 'slz-footer-ci-dark-mask-bg',
						'type'      => 'color_rgba',
						'title'     => esc_html__( 'Footer Contact Dark overlay background', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set background color for mask layer above footer', 'medicplus' ),
						'required'  => array('slz-footer-style','=','dark'),
						'default'   => array(
							'color'     => '#020e16',
							'alpha'     => 1,
							'rgba'      => 'rgba(2, 14, 22, 0.9)'
						)
					),
					array(
						'id'        => 'slz-footer-ci-light-bg',
						'type'      => 'background',
						'title'     => esc_html__( 'Footer Contact light background image', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set background image for footer section', 'medicplus' ),
						'required'  => array('slz-footer-style','=',array('light','default')),
						'default'   => array(
							'background-color'      => '#ffffff',
							'background-image'      => '',
							'background-repeat'     => 'no-repeat',
							'background-attachment' => '',
							'background-position'	=> '',
							'background-size'		=> ''
						)
					),
					array(
						'id'        => 'slz-footer-ci-default-mask-bg',
						'type'      => 'color_rgba',
						'title'     => esc_html__( 'Footer Contact Default overlay background', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set background color for mask layer above footer', 'medicplus' ),
						'required'  => array('slz-footer-style','=','default'),
						'default'   => array(
							'color'     => '#0f77ad',
							'alpha'     => 1,
							'rgba'      => 'rgba(15, 119, 173, 0.9)'
						)
					),
					array(
						'id'        => 'slz-footer-ci-light-mask-bg',
						'type'      => 'color_rgba',
						'title'     => esc_html__( 'Footer Contact light overlay background', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set background color for mask layer above footer', 'medicplus' ),
						'required'  => array('slz-footer-style','=','light'),
						'default'   => array(
							'color'     => '#fafcfd',
							'alpha'     => 1,
							'rgba'      => 'rgba(250, 252, 253, 0.9)'
						)
					),
					array(
						'id'        => 'slz-footer-contact-color',
						'type'      => 'color_rgba',
						'title'     => esc_html__( 'Icon Contact Color', 'medicplus' ),
						'subtitle'  => esc_html__( 'Choose color for icon of this session', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerct-phone-text',
						'type'      => 'text',
						'title'     => esc_html__( 'Phone', 'medicplus' ),
						'default'   => esc_html__( '8-222-333-5454', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerct-phone-caption',
						'type'      => 'text',
						'title'     => esc_html__( 'Phone Caption', 'medicplus' ),
						'default'   => esc_html__( 'For emergency case', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerct-mail-text',
						'type'      => 'text',
						'title'     => esc_html__( 'Mail', 'medicplus' ),
						'default'   => 'help@mail.com',
					),
					array(
						'id'        => 'slz-footerct-mail-caption',
						'type'      => 'text',
						'title'     => esc_html__( 'Mail Caption', 'medicplus' ),
						'default'   => esc_html__( 'Send Email For Help', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerbt-contact-info-section',
						'type'      => 'section',
						'indent'    => false,
					),
					array(
						'id'        => 'slz-footerbt-map-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Footer Contact Map', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-footerbt-map-info',
						'type'      => 'switch',
						'title'     => esc_html__( 'Contact Map', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => false
					),
					array(
						'id'			=> 'slz-footer-map-style',
						'type'			=> 'image_select',
						'title'			=> esc_html__( 'Footer Map Style', 'medicplus' ),
						'indent'    	=> true,
						'options'  		=> array(
							'one'   => array(
								'alt' => esc_html__( 'Style 1', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'footer_map_style1.png'
							),
							'two' => array(
								'alt' => esc_html__( 'Style 2', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'footer_map_style2.png'
							),
							'three'   => array(
								'alt' => esc_html__( 'Style 3', 'medicplus' ),
								'img' => esc_url($image_opt_path) . 'footer_map_style3.png'
							)
						),
						'default'  => 'one'
					),
					array(
						'id'        => 'slz-footer-map-illustration',
						'type'      => 'media',
						'title'     => esc_html__( 'Illustration Image', 'medicplus' ),
						'subtitle'  => esc_html__( 'Choose an image associated with map session', 'medicplus' ),
						'required'  => array('slz-footer-map-style','=','three'),
					),
					array(
						'id'        => 'slz-footer-map-color',
						'type'      => 'color_rgba',
						'title'     => esc_html__( 'Map Session Color', 'medicplus' ),
						'subtitle'  => esc_html__( 'Choose background color for map session', 'medicplus' ),
						'default'   => array(
							'color'     => '#0f77ad',
							'alpha'     => 1,
							'rgba'      => 'rgba(15, 119, 173, 1)'
						)
					),
					array(
						'id'        => 'slz-footer-map-bd-color',
						'type'      => 'color_rgba',
						'title'     => esc_html__( 'Map Session Border Color', 'medicplus' ),
						'default'   => array(
							'color'     => '#1582bb',
							'alpha'     => 1,
							'rgba'      => 'rgba(21, 130, 187, 1)'
						)
					),
					array(
						'id'        => 'slz-footer-map-text-color',
						'type'      => 'color_rgba',
						'title'     => esc_html__( 'Map Session text Color', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerbt-map-lat',
						'type'      => 'text',
						'title'     => esc_html__( 'Map Latitude', 'medicplus' ),
						'subtitle'  => sprintf(__( 'Please access to %s to get the value', 'medicplus' ), $get_latlong ),
						'default'   => '',
					),
					array(
						'id'        => 'slz-footerbt-map-long',
						'type'      => 'text',
						'title'     => esc_html__( 'Map Longitude', 'medicplus' ),
						'subtitle'  => sprintf(__( 'Please access to %s to get the value', 'medicplus' ), $get_latlong ),
						'default'   => '',
					),
					array(
						'id'        => 'slz-footerbt-map-zoom',
						'type'      => 'text',
						'title'     => esc_html__( 'Map Zoom', 'medicplus' ),
						'subtitle'  => esc_html__( 'Please enter number of map zoom 3-21', 'medicplus' ),
						'default'   => '15',
					),
					array(
						'id'        => 'slz-footerbt-wh-title',
						'type'      => 'text',
						'title'     => esc_html__( 'Working Hours Text', 'medicplus' ),
						'default'   => esc_html__( 'Working Hours', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerbt-wh-time',
						'type'      => 'multi_text',
						'title'     => esc_html__( 'Working Hours', 'medicplus' ),
						'subtitle'  => sprintf( wp_kses( __( 'Please use format: Title / Content.<br>Ex: Mon - Fri / 7:00AM - 9:00PM', 'medicplus' ), array('br' => array()) )),
						'default'   => array(
							esc_html__( 'Mon - Fri / 7:00AM - 9:00PM', 'medicplus' ),
							esc_html__( 'Sat / 8:00AM - 8:00PM', 'medicplus' ),
							esc_html__( 'Sun / Closed', 'medicplus' )
						)
					),					
					array(
						'id'        => 'slz-footerbt-ci-title',
						'type'      => 'text',
						'title'     => esc_html__( 'Contact Information Text', 'medicplus' ),
						'default'   => esc_html__( 'Contact Information', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerbt-ci-phone',
						'type'      => 'text',
						'title'     => esc_html__( 'Phone Title', 'medicplus' ),
						'default'   => esc_html__( 'Phone', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerbt-ci-phone-content',
						'type'      => 'text',
						'title'     => esc_html__( 'Phone', 'medicplus' ),
						'default'   => esc_html__( '+1 - 831 - 758 7214', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerbt-ci-email',
						'type'      => 'text',
						'title'     => esc_html__( 'Email Title', 'medicplus' ),
						'default'   => esc_html__( 'Email', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerbt-ci-email-content',
						'type'      => 'text',
						'title'     => esc_html__( 'Email', 'medicplus' ),
						'default'   => 'help@mail.com',
					),
					array(
						'id'        => 'slz-footerbt-ci-address',
						'type'      => 'text',
						'title'     => esc_html__( 'Address Title', 'medicplus' ),
						'default'   => esc_html__( 'Address', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerbt-ci-address-content',
						'type'      => 'text',
						'title'     => esc_html__( 'Address', 'medicplus' ),
						'subtitle'	=> esc_html__( 'Enter address that you want display.If you do not enter "Latitude" and "Longitude",this address will be used to show map.  ', 'medicplus' ),
						'default'   => esc_html__( '30 Mortensen Avenue, Salinas, CA 93905 ', 'medicplus' ),
					),
					array(
						'id'        => 'slz-footerbt-contact-map-section',
						'type'      => 'section',
						'indent'    => false,
					),
					array(
						'id'        => 'slz-footerbt-main-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Footer Main', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-footerbt-main-info',
						'type'      => 'switch',
						'title'     => esc_html__( 'Footer Main', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => false
					),
					array(
						'id'        => 'slz-footer-bg',
						'type'      => 'background',
						'title'     => esc_html__( 'Footer Dark Background Image', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set background image for footer section', 'medicplus' ),
						'required'  => array('slz-footer-style','=','dark'),
						'default'   => array(
							'background-color'      => '#292F32',
							'background-image'      => '',
							'background-repeat'     => 'no-repeat',
							'background-attachment' => '',
							'background-position'	=> '',
							'background-size'		=> ''
						)
					),
					array(
						'id'        => 'slz-footer-light-bg',
						'type'      => 'background',
						'title'     => esc_html__( 'Footer Light background image', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set background image for footer section', 'medicplus' ),
						'required'  => array('slz-footer-style','=',array('light','default')),
						'default'   => array(
							'background-color'      => '#ffffff',
							'background-image'      => '',
							'background-repeat'     => 'no-repeat',
							'background-attachment' => '',
							'background-position'	=> '',
							'background-size'		=> ''
						)
					),
					array(
						'id'        => 'slz-footer-col',
						'type'      => 'radio',
						'title'     => esc_html__( 'Columns', 'medicplus' ),
						'subtitle'  => sprintf( wp_kses( __( 'Choose grid layout for footer.<br> Please go on "Appearance->%1$s" to set data for footer', 'medicplus' ), array('br' => array()) ), $admin_widget_url),
						'options'   => array(
							'11' => esc_html__( '1 Column & Text Center', 'medicplus' ),
							'1'  => esc_html__( '1 Column', 'medicplus' ),
							'2'  => esc_html__( '2 Columns', 'medicplus' ),
							'3'  => esc_html__( '3 Columns', 'medicplus' ),
							'4'  => esc_html__( '4 Columns', 'medicplus' )
						),
						'default'   => '4'
					),
					array(
						'id'        => 'slz-footerbt-main-section',
						'type'      => 'section',
						'indent'    => true,
					),
					array(
						'id'        => 'slz-footerbt-section',
						'type'      => 'section',
						'title'     => esc_html__( 'Footer Bottom', 'medicplus' ),
						'indent'    => true,
					),
					array(
						'id'        => 'slz-footerbt-show',
						'type'      => 'switch',
						'title'     => esc_html__( 'Footer Bottom', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true,
					),
					array(
						'id'       => 'slz-footerbt-style',
						'type'     => 'button_set',
						'title'    => esc_html__('Footer Bottom Style', 'medicplus'),
						'options' => array(
							'dark'     => esc_html__( 'Dark', 'medicplus'), 
							'light'    => esc_html__( 'Light', 'medicplus'),
						), 
						'default' => 'light'
					),
					array(
						'id'        => 'slz-footerbt-text',
						'type'      => 'text',
						'title'     => esc_html__( 'Text Information', 'medicplus' ),
						'default'   => esc_html( MEDICPLUS_COPYRIGHT ),
					),
					array(
						'id'     => 'slz-subtitle-end',
						'type'   => 'section',
						'indent' => false,
					)
				)
			);
			
			// Blog Setting
			$this->sections[] = array(
				'title'     => esc_html__( 'Blog Display', 'medicplus' ),
				'icon'      => 'el-icon-edit',
				'desc'      => esc_html__( 'Configuration layout for blog template', 'medicplus' ),
				'fields'    => array(
					array(
						'id'        => 'slz-bloginfo',
						'type'      => 'sorter',
						'title'     => esc_html__( 'Blog Info', 'medicplus' ),
						'subtitle'  => esc_html__( 'Choose what information to show below blog content', 'medicplus' ),
						'options'   => array(
							'disabled' => array(

							),
							'enabled'  => array(
								'author'    => esc_html__( 'Author', 'medicplus' ),
								'view'      => esc_html__( 'View', 'medicplus' ),
								'comment'   => esc_html__( 'Comment number', 'medicplus' ),
								'date'      => esc_html__( 'Date', 'medicplus' ),
							),
						),
					),
					array(
						'id'        => 'slz-blog-share',
						'type'      => 'switch',
						'title'     => esc_html__( 'Social Sharing Section', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true
					),
					array(
						'id'       => 'slz-blog-social',
						'type'     => 'sorter',
						'title'    => esc_html__('Social network for share','medicplus'),
						'subtitle' => esc_html__('Choose what social networks to share','medicplus'),
						'required' => array('slz-blog-share','=',true),
						'options'  => array(
							'disabled' => array(
								'facebook'     => esc_html__( 'Facebook', 'medicplus' ),
								'twitter'      => esc_html__( 'Twitter', 'medicplus' ),
								'pinterest'    => esc_html__( 'Pinterest', 'medicplus' )
							),
							'enabled'  => array(
								'google-plus'  => esc_html__( 'Google plus', 'medicplus' ),
								'linkedin'     => esc_html__( 'Linkedin', 'medicplus' ),
								'digg'         => esc_html__( 'Digg', 'medicplus' )
							),
						),
					),
					array(
						'id'        => 'slz-blog-related-post',
						'type'      => 'switch',
						'title'     => esc_html__( 'Related Post', 'medicplus' ),
						'subtitle'  => esc_html__( 'Show/Hide related post session', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true
					),
					array(
						'id'        => 'slz-blog-author',
						'type'      => 'switch',
						'title'     => esc_html__( 'Author Section', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true
					),
					array(
						'id'        => 'slz-blog-tag',
						'type'      => 'switch',
						'title'     => esc_html__( 'Tag Section', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true
					),
					array(
						'id'        => 'slz-blog-cat',
						'type'      => 'switch',
						'title'     => esc_html__( 'Category Section', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true
					),
					array(
						'id'        => 'slz-commentbox',
						'type'      => 'switch',
						'title'     => esc_html__( 'Comments Section', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true
					),
				)
			);

			// Team Setting
			$this->sections[] = array(
				'title'     => esc_html__( 'Team Setting', 'medicplus' ),
				'icon'      => 'el el-group',
				'desc'      => esc_html__( 'Setting for team detail page', 'medicplus' ),
				'fields'    => array(
					array(
						'id'        => 'slz-team-contact-form',
						'type'      => 'switch',
						'title'     => esc_html__( 'Show Contact Form', 'medicplus' ),
						'on'        => esc_html__( 'Show', 'medicplus' ),
						'off'       => esc_html__( 'Hide', 'medicplus' ),
						'default'   => true
					),
					array(
						'id'       	=> 'slz-team-contact-sc',
						'type'      => 'textarea',
						'title'     => esc_html__( 'Shortcode Appointment', 'medicplus' ),
						'subtitle'  => esc_html__( 'Paste shortcode that you want to show on team detail page.', 'medicplus' ),
						'required'  => array('slz-team-contact-form','=',true),
						'default'   => '',
					),

				)
			);

			// 404  Setting
			$this->sections[] = array(
				'title'     => esc_html__( '404 Setting', 'medicplus' ),
				'icon'      => 'el-icon-info-circle',
				'desc'      => esc_html__( 'This page will display options for 404 page', 'medicplus' ),
				'fields'    => array(
					array(
						'id'        => 'slz-404-illustration-image',
						'type'      => 'media',
						'title'     => esc_html__( 'Illustration image 1', 'medicplus' ),
					),
					array(
						'id'        => 'slz-404-illustration-image1',			
						'type'      => 'media',
						'title'     => esc_html__( 'Illustration image 2', 'medicplus' ),
					),
					
					array(
						'id'        => 'slz-404-title',
						'type'      => 'text',
						'title'     => esc_html__( 'Main Title', 'medicplus' ),
						'default'   => esc_html__( 'Page not found', 'medicplus' )
					),
					array(
						'id'        => 'slz-404-desc',
						'type'      => 'editor',
						'title'     => esc_html__( 'Description', 'medicplus' ),
						'default'   => esc_html__( 'Please go back to home and try to find out once again.', 'medicplus' )
					),
					array(
						'id'        => 'slz-404-backhome',
						'type'      => 'text',
						'title'     => esc_html__( 'Back to home text', 'medicplus' ),
						'default'   => esc_html__( 'Go Home', 'medicplus' ),
					),
					array(
						'id'        => 'slz-404-button-02',
						'type'      => 'text',
						'title'     => esc_html__( 'Button 02 text', 'medicplus' ),
						'default'   => esc_html__( 'Get Help', 'medicplus' ),
					),
					array(
						'id'        => 'slz-404-button-02-link-custom',
						'type'      => 'text',
						'title'     => esc_html__( 'Button 02 Link(Custom)', 'medicplus'),
						'subtitle'  => esc_html__( 'Empty this field if you want to choose link to page', 'medicplus' ),
					),
					array(
						'id'        => 'slz-404-button-02-link',
						'type'      => 'select',
						'data'      => 'pages',
						'title'     => esc_html__( 'Button 02 Link(Link To Page)', 'medicplus' ),
						'default'   => '1'
					)
				)
			);

			// Custom CSS
			$this->sections[] = array(
				'title'     => esc_html__( 'Custom Style', 'medicplus' ),
				'icon'      => 'el-icon-css',
				'desc'      => esc_html__( 'Customize your site by code', 'medicplus' ),
				'fields'    => array(
					array(
						'id'       => 'slz-custom-css',
						'type'     => 'ace_editor',
						'title'    => esc_html__( 'CSS Code', 'medicplus' ),
						'subtitle' => esc_html__( 'Paste your CSS code here.', 'medicplus' ),
						'mode'     => 'css',
						'theme'    => 'monokai',
						'default'  => "body{\n   margin: 0 auto;\n}"
					)
				)
			);

			// Custom js
			$this->sections[] = array(
				'title'     => esc_html__( 'Custom Script', 'medicplus' ),
				'icon'      => 'el-icon-link',
				'desc'      => esc_html__( 'Customize your site by code', 'medicplus' ),
				'fields'    => array(
					array(
						'id'       => 'slz-custom-js',
						'type'     => 'ace_editor',
						'title'    => esc_html__( 'JS Code', 'medicplus' ),
						'subtitle' => esc_html__( 'Paste your JS code here.', 'medicplus' ),
						'mode'     => 'javascript',
						'theme'    => 'chrome',
						'default'  => "jQuery(document).ready(function(){\n\n});"
					),
				)
			);

			// Typography
			$this->sections[] = array(
				'title'     => esc_html__( 'Typography', 'medicplus' ),
				'icon'      => 'el-icon-text-height',
				'desc'      => esc_html__( 'Customize your site by code', 'medicplus' ),
				'fields'    => array(
					array(
						'id'        => 'slz-typo-body',
						'type'      => 'typography',
						'title'     => esc_html__( 'Body text', 'medicplus' ),
						'subtitle'  => esc_html__( 'Set font ', 'medicplus' ),
						'google'    => true,
						'default'   => false
					),
					array(
						'id'        => 'slz-typo-p',
						'type'      => 'typography',
						'title'     => esc_html__( 'Paragraph text', 'medicplus' ),
						'google'    => true,
						'default'   => false
					),
					array(
						'id'       => 'slz-link-color',
						'type'     => 'link_color',
						'title'    => esc_html__( 'Links Color Option', 'medicplus' ),
						'subtitle' => esc_html__( 'Only color validation can be done on this field type', 'medicplus' ),
						'default'  => array(
							'regular' => '#51616b',
							'hover'   => '#0f77ad',
							'active'  => '#0f77ad',
						)
					),
					array(
						'id'        => 'slz-typo-h1',
						'type'      => 'typography',
						'title'     => esc_html__( 'H1 text', 'medicplus' ),
						'google'    => true,
						'default'   => false
					),
					array(
						'id'        => 'slz-typo-h2',
						'type'      => 'typography',
						'title'     => esc_html__( 'H2 text', 'medicplus' ),
						'google'    => true,
						'default'   => false
					),
					array(
						'id'        => 'slz-typo-h3',
						'type'      => 'typography',
						'title'     => esc_html__( 'H3 text', 'medicplus' ),
						'google'    => true,
						'default'   => false
					),
					array(
						'id'        => 'slz-typo-h4',
						'type'      => 'typography',
						'title'     => esc_html__( 'H4 text', 'medicplus' ),
						'google'    => true,
						'default'   => false
					),
					array(
						'id'        => 'slz-typo-h5',
						'type'      => 'typography',
						'title'     => esc_html__( 'H5 text', 'medicplus' ),
						'google'    => true,
						'default'   => false
					),
					array(
						'id'        => 'slz-typo-h6',
						'type'      => 'typography',
						'title'     => esc_html__( 'H6 text', 'medicplus' ),
						'google'    => true,
						'default'   => false
					)
				)
			);

		}

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
				'id'        => 'redux-help-tab-1',
				'title'     => esc_html__('Theme Information 1', 'medicplus'),
				'content'   => sprintf('<p>%s</p>', esc_html__('This is the tab content, HTML is allowed.', 'medicplus'))
			);

			$this->args['help_tabs'][] = array(
				'id'        => 'redux-help-tab-2',
				'title'     => esc_html__('Theme Information 2', 'medicplus'),
				'content'   => sprintf('<p>%s</p>', esc_html__('This is the tab content, HTML is allowed.', 'medicplus'))
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = sprintf('<p>%s</p>', esc_html__('This is the sidebar content, HTML is allowed.', 'medicplus'));
		}

		/*
	      All the possible arguments for Redux.
	      For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
		*/

		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				'opt_name'              => 'medicplus_options',
				'dev_mode'              => false, // disable dev mode when release
				'use_cdn'               => false,
				'global_variable'       => 'medicplus_options',
				'display_name'          => esc_html__( 'MedicPlus', 'medicplus' ),
				'display_version'       => false,
				'page_slug'             => 'MedicPlus_options',
				'page_title'            => esc_html__( 'MedicPlus Option Panel', 'medicplus' ),
				'update_notice'         => false,
				'menu_type'             => 'menu',
				'menu_title'            => esc_html__( 'Theme Options', 'medicplus' ),
				'menu_icon'             => ReduxFramework::$_url.'assets/img/menu-icon.png',
				'allow_sub_menu'        => true,
				'page_priority'         => '31',
				'page_parent'           => 'medicplus_welcome',
				'customizer'            => true,
				'default_mark'          => '*',
				'class'                 => 'sw_theme_options_panel',
				'hints'                 => array(
					'icon'          => 'el-icon-question-sign',
					'icon_position' => 'right',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color' => 'light',
					),
					'tip_position' => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect' => array(
						'show' => array(
							'duration' => '500',
							'event'    => 'mouseover',
						),
						'hide' => array(
							'duration' => '500',
							'event'    => 'mouseleave unfocus',
						),
					),
				),
				'intro_text'         => '',
				'footer_text'        => '<p>'. esc_html__( 'Thank you for purchased MedicPlus!', 'medicplus' ).'</p>',
				'page_icon'          => 'icon-themes',
				'page_permissions'   => 'manage_options',
				'save_defaults'      => true,
				'show_import_export' => true,
				'database'           => 'options',
				'transient_time'     => '3600',
				'network_sites'      => true,
			);

			$this->args['share_icons'][] = array(
				'url'   => 'https://www.facebook.com/swlabs/',
				'title' => esc_html__( 'Like us on Facebook', 'medicplus' ),
				'icon'  => 'el-icon-facebook'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'http://themeforest.net/user/swlabs',
				'title' => esc_html__( 'Follow us on themeforest', 'medicplus' ),
				'icon'  => 'el-icon-user'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'mailto:admin@swlabs.co',
				'title' => esc_html__( 'Send us email', 'medicplus' ),
				'icon'  => 'el-icon-envelope'
			);
		}

	}

	global $medicplus_reduxConfig;
	$medicplus_reduxConfig = new Medicplus_Redux_Framework_Config();
}
/*
  Custom function for the callback validation referenced above
*/
if (!function_exists('medicplus_validate_callback_function')):
	function medicplus_validate_callback_function($field, $value, $existing_value) {
		$error = false;
		$value = 'just testing';

		$return['value'] = $value;
		if ($error == true) {
			$return['error'] = $field;
		}
		return $return;
	}
endif;