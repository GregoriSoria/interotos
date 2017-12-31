<?php
/**
 * Medicplus params class.
 * 
 * @author Swlabs
 * @package MedicPlus
 * @since 1.0
 */
class Medicplus_Params {
	/**
	 * Retrieve value from the params variable.
	 *
	 * @param string $name The key name of first level.
	 * @param string $field optional The key name of second level.
	 * @return mixed.
	 */
	public static function get( $name, $field = NULL ) {
		//get param from special function
		if ( method_exists( __CLASS__, $name ) ) {
			$params = call_user_func( array(__CLASS__, $name) );
			if( $field ) {
				return ( isset( $params[ $field ] ) ) ? $params[ $field ] : null;
			} else {
				return $params;
			}
		}
		//get param from setting function
		if ( method_exists( __CLASS__, 'setting' ) ) {
			$setting_params = call_user_func( array(__CLASS__, 'setting') );
			if( $field ) {
				if( isset($setting_params[ $name ][ $field ]) ){
					return $setting_params[ $name ][ $field ];
				} else {
					return null;
				}
			} else {
				if(isset( $setting_params[ $name ] )  ) {
					return $setting_params[ $name ];
				} else {
					return null;
				}
			}
		}
		return array();
	}
	public static function setting() {
		return array(
			'header-social' => array(
				'facebook'   => 'fa-facebook',
				'twitter'    => 'fa-twitter',
				'google-plus'=> 'fa-google-plus',
				'pinterest'  => 'fa-pinterest',
				'instagram'  => 'fa-instagram',
				'dribbble'   => 'fa-dribbble',
			),
			'header-contact' => array(
				'workingtime'  => 'fa-clock-o',
				'phone'        => 'fa-phone',
				'address'      => 'fa-map-marker',
			),
			'social-icons' =>array(
				'facebook'      => 'fa-facebook',
				'twitter'       => 'fa-twitter',
				'google-plus'   => 'fa-google-plus',
				'skype'         => 'fa-skype',
				'youtube'       => 'fa-youtube',
				'rss'           => 'fa-rss',
				'delicious'     => 'fa-delicious',
				'flickr'        => 'fa-flickr',
				'lastfm'        => 'fa-lastfm',
				'linkedin'      => 'fa-linkedin',
				'vimeo'         => 'fa-vimeo',
				'tumblr'        => 'fa-tumblr',
				'pinterest'     => 'fa-pinterest',
				'deviantart'    => 'fa-deviantart',
				'git'           => 'fa-git',
				'instagram'     => 'fa-instagram',
				'soundcloud'    => 'fa-soundcloud',
				'stumbleupon'   => 'fa-stumbleupon',
				'behance'       => 'fa-behance',
				'tripAdvisor'   => 'fa-tripadvisor',
				'vk'            => 'fa-vk',
				'foursquare'    => 'fa-foursquare',
				'xing'          => 'fa-xing',
				'weibo'         => 'fa-weibo',
				'odnoklassniki' => 'fa-odnoklassniki',
			),
			// ---------- Editor Formats -----------------
			
			// image size
			'default-image-size' => array(
				'wg_recent_post'      => array( 'large' => '100x69' ),
				'recent_news'         => array( 'large' => '100x100' ),
				'blog'                => array( 'large' => '100x100' ),
				'author'              => array( 'large' => '1200x750' ),
			),
			//************* Page Setting >> ****************
			'video-type' => array(
				''              => esc_html__( 'None', 'medicplus'),
				'vimeo'         => esc_html__( 'Vimeo', 'medicplus'),
				'youtube'       => esc_html__( 'Youtube', 'medicplus'),
			),
			'background-repeat' => array(
				''          => esc_html__( '-Background Repeat-', 'medicplus'),
				'no-repeat' => esc_html__( 'No Repeat', 'medicplus'),
				'repeat'    => esc_html__( 'Repeat All', 'medicplus'),
				'repeat-x'  => esc_html__( 'Repeat Horizontally', 'medicplus'),
				'repeat-y'  => esc_html__( 'Repeat Vertically', 'medicplus'),
				'inherit'   => esc_html__( 'Inherit', 'medicplus'),
			),
			'background-size' => array(
				''        => esc_html__( '-Background Size-', 'medicplus'),
				'inherit' => esc_html__( 'Inherit', 'medicplus'),
				'cover'   => esc_html__( 'Cover', 'medicplus'),
				'contain' => esc_html__( 'Contain', 'medicplus'),
			),
			'background-position' => array(
				''              => esc_html__( '-Background Position-', 'medicplus'),
				'left top'      => esc_html__( 'Left Top', 'medicplus'),
				'left center'   => esc_html__( 'Left Center', 'medicplus'),
				'left bottom'   => esc_html__( 'Left Bottom', 'medicplus'),
				'center top'    => esc_html__( 'Center Top', 'medicplus'),
				'center center' => esc_html__( 'Center Center', 'medicplus'),
				'center bottom' => esc_html__( 'Center Bottom', 'medicplus'),
				'right top'     => esc_html__( 'Right Top', 'medicplus'),
				'right center'  => esc_html__( 'Right Center', 'medicplus'),
				'right bottom'  => esc_html__( 'Right Bottom', 'medicplus'),
			),
			'background-attachment' => array(
				''        => esc_html__( '-Background Attachment-', 'medicplus'),
				'fixed'   => esc_html__( 'Fixed', 'medicplus'),
				'scroll'  => esc_html__( 'Scroll', 'medicplus'),
				'inherit' => esc_html__( 'Inherit', 'medicplus'),
			),
			'sidebar-layout' => array(
				'none'  => esc_html__( 'None', 'medicplus'),
				'left'  => esc_html__( 'Left', 'medicplus'),
				'right' => esc_html__( 'Right', 'medicplus')
			),
			'header_layout' => array(
				'one'   => 'header01.png',
				'two'   => 'header02.png',
				'three' => 'header03.png',
			),
		);
	}
	public static function author_social_links() {
		return array(
			'behance'       => esc_html__( 'Behance', 'medicplus' ),
			'delicious'     => esc_html__( 'Delicious', 'medicplus' ),
			'deviantart'    => esc_html__( 'Deviantart', 'medicplus' ),
			'facebook'      => esc_html__( 'Facebook', 'medicplus' ),
			'flickr'        => esc_html__( 'Flickr', 'medicplus' ),
			'foursquare'    => esc_html__( 'Foursquare', 'medicplus' ),
			'lastfm'        => esc_html__( 'Lastfm', 'medicplus' ),
			'linkedin'      => esc_html__( 'Linkedin', 'medicplus' ),
			'git'           => esc_html__( 'Github', 'medicplus' ),
			'google-plus'   => esc_html__( 'Google+', 'medicplus' ),
			'instagram'     => esc_html__( 'Instagram', 'medicplus' ),
			'odnoklassniki' => esc_html__( 'Odnoklassniki', 'medicplus' ),
			'pinterest'     => esc_html__( 'Pinterest', 'medicplus' ),
			'rss'           => esc_html__( 'RSS', 'medicplus' ),
			'skype'         => esc_html__( 'Skype', 'medicplus' ),
			'soundcloud'    => esc_html__( 'Soundcloud', 'medicplus' ),
			'stumbleupon'   => esc_html__( 'Stumbleupon', 'medicplus' ),
			'tripAdvisor'   => esc_html__( 'TripAdvisor', 'medicplus' ),
			'tumblr'        => esc_html__( 'Tumblr', 'medicplus' ),
			'twitter'       => esc_html__( 'Twitter', 'medicplus' ),
			'vimeo'         => esc_html__( 'Vimeo', 'medicplus' ),
			'vk'            => esc_html__( 'VK', 'medicplus' ),
			'weibo'         => esc_html__( 'Weibo', 'medicplus' ),
			'xing'          => esc_html__( 'XING', 'medicplus' ),
			'youtube'       => esc_html__( 'YouTube', 'medicplus' ),
		);
	} 
	public static function style_formats() {
		return array(
			'medicplus_dropcap' => array(
				'title' => esc_html__( 'Dropcaps', 'medicplus' ),
				'items' => array(
					array(
						'parent_id' => 'medicplus_dropcap',
						'title'     => esc_html__( 'Box', 'medicplus' ),
						'classes'   => 'dropcap',
						'inline'    => 'span',
					),
					array(
						'parent_id' => 'medicplus_dropcap',
						'title'     => esc_html__( 'Circle', 'medicplus' ),
						'classes'   => 'dropcap1',
						'inline'    => 'span',
					),
					array(
						'parent_id' => 'medicplus_dropcap',
						'title'     => esc_html__( 'Regular', 'medicplus' ),
						'classes'   => 'dropcap2',
						'inline'    => 'span',
					),
					array(
						'parent_id' => 'medicplus_dropcap',
						'title'     => esc_html__( 'Bold', 'medicplus' ),
						'classes'   => 'dropcap3',
						'inline'    => 'span',
					),
				)
			),
			'medicplus_text_highlight' => array(
				'title' => esc_html__( 'Text Highlighting', 'medicplus' ),
				'items' => array(
					array(
						'parent_id' => 'medicplus_text_highlight',
						'title'     => esc_html__( 'Black censured', 'medicplus' ),
						'classes'   => 'highlight',
						'inline'    => 'span',
					),
					array(
						'parent_id' => 'medicplus_text_highlight',
						'title'     => esc_html__( 'Red marker', 'medicplus' ),
						'classes'   => 'highlight_maker red',
						'inline'    => 'span',
					),
					array(
						'parent_id' => 'medicplus_text_highlight',
						'title'     => esc_html__( 'Blue marker', 'medicplus' ),
						'classes'   => 'highlight_maker blue',
						'inline'    => 'span',
					),
					array(
						'parent_id' => 'medicplus_text_highlight',
						'title'     => esc_html__( 'Green marker', 'medicplus' ),
						'classes'   => 'highlight_maker green',
						'inline'    => 'span',
					),
					array(
						'parent_id' => 'medicplus_text_highlight',
						'title'     => esc_html__( 'Yellow  marker', 'medicplus' ),
						'classes'   => 'highlight_maker yellow ',
						'inline'    => 'span',
					),
					array(
						'parent_id' => 'medicplus_text_highlight',
						'title'     => esc_html__( 'Pink  marker', 'medicplus' ),
						'classes'   => 'highlight_maker pink ',
						'inline'    => 'span',
					),
				)
			),
			'medicplus_blockquote' => array(
				'title' => esc_html__( 'Text Blockquote', 'medicplus' ),
				'items' => array(
					array(
						'parent_id' => 'medicplus_blockquote',
						'title'		=> esc_html__( 'Style 01', 'medicplus' ),
						'block'		=> 'blockquote',
						'classes'	=> 'blockquote-01 blockquote',
						'wrapper'	=> true,
					),
					array(
						'parent_id' => 'medicplus_blockquote',
						'title'     => esc_html__( 'Style 02', 'medicplus' ),
						'block'		=> 'blockquote',
						'classes'	=> 'blockquote-02 blockquote',
						'wrapper'	=> true,
					),
					array(
						'parent_id' => 'medicplus_blockquote',
						'title'     => esc_html__( 'Style 03', 'medicplus' ),
						'block'		=> 'blockquote',
						'classes'	=> 'blockquote-03 blockquote',
						'wrapper'	=> true,
					),
					array(
						'parent_id' => 'medicplus_blockquote',
						'title'     => esc_html__( 'Style 04', 'medicplus' ),
						'block'		=> 'blockquote',
						'classes'	=> 'blockquote-04 blockquote',
						'wrapper'	=> true,
					),
				)
			)
		);
	}
	public static function sort_blog(){
		return array(
			esc_html__( '- Latest -', 'medicplus' )               => '',
			esc_html__( 'A to Z', 'medicplus')                    => 'az_order',
			esc_html__( 'Z to A', 'medicplus')                    => 'za_order',
			esc_html__( 'Random posts today', 'medicplus' )       => 'random_today',
			esc_html__( 'Random posts a week ago', 'medicplus' )  => 'random_7_day',
			esc_html__( 'Random posts a month ago', 'medicplus' ) => 'random_month',
			esc_html__( 'Random Posts', 'medicplus' )             => 'random_posts',
			esc_html__( 'Most Commented', 'medicplus' )           => 'comment_count',
		);
	}
	
	
}