<?php

// Set post view
add_action('wp_head', 'medicplus_postview_set');
if( ! function_exists( 'medicplus_postview_set' ) ) :

	function medicplus_postview_set() {
		global $post;
		$post_types = array('post');
		if( $post ) {
			$post_id = $post->ID;
			if( in_array(get_post_type(), $post_types) && is_single() ) {
				$count_key = 'medicplus_postview_number';
				$count = get_post_meta( $post_id, $count_key, true );
				if( $count == '' ) {
					$count = 0;
					delete_post_meta( $post_id, $count_key );
					add_post_meta( $post_id, $count_key, '0' );
				} else {
					$count++;
					update_post_meta( $post_id, $count_key, $count );
				}
			}
		}
	}
endif;

// Get post view
if( ! function_exists( 'medicplus_postview_get' ) ) :

	function medicplus_postview_get( $post_id ) {
		$view_text = esc_html__( 'view', 'medicplus' );
		$count_key = 'medicplus_postview_number';
		$count = get_post_meta( $post_id, $count_key, true );
		$res = '';
		if($count == '') {
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );
			$res = 0;
		} else {
			$res = $count;
		}
		return $res;
	}
endif;

//-----------------------------------------------
if ( ! function_exists( 'medicplus_is_custom_post_type_archive' ) ) :
function medicplus_is_custom_post_type_archive() {
	if( is_post_type_archive('medicplus_dept') || is_tax( 'medicplus_dept_cat' ) ) {
		return 1;
	} else if( is_post_type_archive('medicplus_service') || is_tax( 'medicplus_service_cat' ) ) {
		return 2;
	} else if( is_post_type_archive('medicplus_team') || is_tax( 'medicplus_team_cat' ) ) {
		return 3;
	} else if( is_post_type_archive('medicplus_locate') || is_tax( 'medicplus_locate_cat' ) ) {
		return 4;
	} else if( is_post_type_archive('medicplus_faq') || is_tax( 'medicplus_faq_cat' ) ) {
		return 5;
	}
	return false;
}
endif;

// Breadcrumb
if ( ! function_exists( 'medicplus_get_breadcrumb' ) ) :
	function medicplus_get_breadcrumb()
	{
		if ( MEDICPLUS_WOOCOMMERCE_ACTIVE && get_post_type() == 'product' ) 
		{
			$breadcrumbs = new WC_Breadcrumb();
			$breadcrumbs->add_crumb( esc_html_x( 'Home', 'breadcrumb', 'medicplus' ), apply_filters( 'woocommerce_breadcrumb_home_url', esc_url( home_url('/') ) ) );
		} else {
			$breadcrumbs = new Medicplus_Breadcrumb();
			$breadcrumbs->add_crumb( esc_html_x( 'Home', 'breadcrumb', 'medicplus' ), apply_filters( 'medicplus_breadcrumb_home_url', esc_url( home_url('/') ) ) );
		}
		return $breadcrumbs->generate();
	}
endif;

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

if( !function_exists('medicplus_regex') ) :

	function medicplus_regex($string, $pattern = false, $start = "^", $end = "")
	{
		if(!$pattern) return false;

		if($pattern == "url")
		{
			$pattern = "!$start((https?|ftp)://(-\.)?([^\s/?\.#-]+\.?)+(/[^\s]*)?)$end!";
		}
		else if($pattern == "mail")
		{
			$pattern = "!$start\w[\w|\.|\-]+@\w[\w|\.|\-]+\.[a-zA-Z]{2,4}$end!";
		}
		else if($pattern == "image")
		{
			$pattern = "!$start(https?(?://([^/?#]*))?([^?#]*?\.(?:jpg|gif|png)))$end!";
		}
		else if(strpos($pattern,"<") === 0)
		{
			$pattern = str_replace('<',"",$pattern);
			$pattern = str_replace('>',"",$pattern);

			if(strpos($pattern,"/") !== 0) { $close = "\/>"; $pattern = str_replace('/',"",$pattern); }
			$pattern = trim($pattern);
			if(!isset($close)) $close = "<\/".$pattern.">";

			$pattern = "!$start\<$pattern.+?$close!";

		}

		preg_match($pattern, $string, $result);

		if(empty($result[0]))
		{
			return false;
		}
		else
		{
			return $result;
		}

	}
endif;

// Paging
if(!function_exists('medicplus_paging_nav')) :
	/**
	 * Displays a page pagination if more posts are available than can be displayed on one page
	 * @param string $pages pass the number of pages instead of letting the script check the gobal paged var
	 * @return string $output returns the pagination html code
	 */
	function medicplus_paging_nav( $pages = '', $current_query = '' )
	{
		global $paged;
		if( $current_query == '' ) {
			if( empty( $paged ) ) $paged = 1;
		} else {
			$paged = $current_query->query_vars['paged'];
		}
		$prev = $paged - 1;
		$next = $paged + 1;
		$range = 1; // only edit this if you want to show more page-links
		$showitems = ($range * 2);
		
		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if( ! $pages ) {
				$pages = 1;
			}
		}
		$method = "get_pagenum_link";
		if(is_single()) {
			$method = 'medicplus_post_pagination_link';
		}
		$output = $output_page = $showpages = $disable = '';
		$page_format = '<li class="pagi-inner"><a href="%2$s" class="pagi-link" >%1$s</a></li>';
		if( 1 != $pages ) {
			$output_page .= '<ul class="pagination">';
			// prev
			if( $paged == 1 ) {
				$disable = ' hide';
			}
			$output_page .= '<li class="pagi-inner '.$disable.'"><a href="'.esc_url($method($prev)).'" rel="prev" class="pagi-link"><span aria-hidden="true">'.esc_html__('Prev', 'medicplus').'</span></a></li>';
			// first pages
			if( $paged > $showitems ) {
				$output_page .= sprintf( $page_format, 1, $method(1) );
			}
			// show ...
			if( $paged - $range > $showitems && $paged - $range > 2 ) {
				$output_page .= sprintf( $page_format, '&bull;&bull;&bull;', $method($paged - $range - 1) );'<li><a href="'.esc_url($method($prev)).'">&bull;&bull;&bull;</a></li>';
			}
			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$showitems || $i <= $paged-$showitems) || $pages <= $showitems )) {
					if( $paged == $i ) {
						$output_page .= '<li class="active pagi-inner"><span class="pagi-link">'.$i.'</span></li>';
					} else {
						$output_page .= sprintf( $page_format, $i, $method($i) );
					}
					$showpages = $i;
				}
			}
			// show ...
			if( $paged < $pages-1 && $showpages < $pages -1 ){
				$showpages = $showpages + 1;
				$output_page .= sprintf( $page_format, '&bull;&bull;&bull;', $method($showpages) );
			}
			// end pages
			if( $paged < $pages && $showpages < $pages ) {
				$output_page .= sprintf( $page_format, $pages, $method($pages) );
			}
			//next
			$disable = '';
			if( $paged == $pages ) {
				$disable = ' hide';
			}
			$output_page .= '<li class="pagi-inner '.$disable.'"><a href="'.esc_url($method($next)).'" rel="next" class="pagi-link">'.esc_html__('Next', 'medicplus').'</a></li>';
			$output_page .= '</ul>'."\n";
			$output = sprintf('<nav class="pagination-wrapper">%1$s</nav>', $output_page );
		}
		return $output;
	}

	function medicplus_post_pagination_link($link)
	{
		$url =  preg_replace('!">$!','',_wp_link_page($link));
		$url =  preg_replace('!^<a href="!','',$url);
		return $url;
	}

	function medicplus_get_pagenum_link( $pagenum = 1, $escape = true, $base = null) {
		global $wp_rewrite;

		$pagenum = (int) $pagenum;
	
		$request = $base ? remove_query_arg( 'paged', $base ) : remove_query_arg( 'paged' );
	
		$home_root = parse_url(esc_url( home_url('/') ));
		$home_root = ( isset($home_root['path']) ) ? $home_root['path'] : '';
		$home_root = preg_quote( $home_root, '|' );
	
		$request = preg_replace('|^'. $home_root . '|i', '', $request);
		$request = preg_replace('|^/+|', '', $request);
	
		if ( !$wp_rewrite->using_permalinks() || is_admin() ) {
			$base = trailingslashit( esc_url( home_url('/') ) );
	
			if ( $pagenum > 1 ) {
				$result = add_query_arg( 'paged', $pagenum, $base . $request );
			} else {
				$result = $base . $request;
			}
		} else {
			$qs_regex = '|\?.*?$|';
			preg_match( $qs_regex, $request, $qs_match );
	
			if ( !empty( $qs_match[0] ) ) {
				$query_string = $qs_match[0];
				$request = preg_replace( $qs_regex, '', $request );
			} else {
				$query_string = '';
			}
	
			$request = preg_replace( "|$wp_rewrite->pagination_base/\d+/?$|", '', $request);
			$request = preg_replace( '|^' . preg_quote( $wp_rewrite->index, '|' ) . '|i', '', $request);
			$request = ltrim($request, '/');
	
			$base = trailingslashit( esc_url( home_url('/') ) );
	
			if ( $wp_rewrite->using_index_permalinks() && ( $pagenum > 1 || '' != $request ) )
				$base .= $wp_rewrite->index . '/';
	
			if ( $pagenum > 1 ) {
				$request = ( ( !empty( $request ) ) ? trailingslashit( $request ) : $request ) . user_trailingslashit( $wp_rewrite->pagination_base . "/" . $pagenum, 'paged' );
			}
	
			$result = $base . $request . $query_string;
		}
	
		/**
		 * Filter the page number link for the current request.
		 *
		 * @since 2.5.0
		 *
		 * @param string $result The page number link.
		 */
		$result = apply_filters( 'get_pagenum_link', $result );
	
		if ( $escape )
			return esc_url( $result );
		else
			return esc_url_raw( $result );
	}
endif;

// Post Navigation
if ( ! function_exists( 'medicplus_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	*
	*/
	function medicplus_post_nav() {
		global $post;
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		if ( ! $next && ! $previous )
			return;
		?>
		<nav class="post-navigation row" >
			<div class="col-md-12">
				<div class="nav-links">
					<div class="pull-left prev-post">
					<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'medicplus' ) ); ?>
					</div>
					<div class="pull-right next-post">
					<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'medicplus' ) ); ?>
					</div>
				</div><!-- .nav-links -->
			</div>
		</nav><!-- .navigation -->
		<?php
	}
endif;

// Get link of blog content ( post-format: link)
if ( ! function_exists( 'medicplus_get_link_url' ) ) :
	/**
	 * Return the post URL.
	 *
	 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
	 * the first link found in the post content.
	 *
	 * Falls back to the post permalink if no URL is found in the post.
	 *
	 *
	 * @return string The Link format URL.
	 */
	function medicplus_get_link_url() {
		$has_url = '';
		if( get_post_format() == 'link') {
			$content = get_the_content();
			$has_url = get_url_in_content( $content );
		}
		return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
	}
endif;

// Get Format Date
if ( ! function_exists( 'medicplus_post_date' ) ) :
	function medicplus_post_date() {
		$output = '';
		$format_string = '<div class="post-date"><a href="%4$s" ><span class="date">%1$s</span>%2$s %3$s</a></div>';
		if( is_singular() ) {
			$format_string = '<div class="post-date"><span class="date">%1$s</span>%2$s %3$s</div>';
		}
		$day = get_the_time('d');
		$month = get_the_time('M');
		$year = get_the_time('Y');
		$output = sprintf( $format_string, $day, $month, $year, esc_url( medicplus_get_link_url() ) );
		return $output;
	}
endif;

// Get css to show/hide sidebar
if ( ! function_exists( 'medicplus_get_container_css' ) ) :
	function medicplus_get_container_css( $show_sidebar = false ) {
		do_action('medicplus_page_options');
		$def_sidebar = Medicplus::get_option('slz-sidebar-layout');
		$def_sidebar_id = Medicplus::get_option('slz-sidebar');
		$post_type = get_post_type();
		$sidebar = $sidebar_id = $has_sidebar = '';
		if( is_single() ) {
			if ( $post_type == 'product' ) {
				$sidebar = Medicplus::get_option('slz-shop-sidebar-layout');
				$sidebar_id = Medicplus::get_option('slz-shop-sidebar');
			} else if( $post_type == 'medicplus_dept' ) {
				$sidebar = Medicplus::get_option('slz-department-sidebar-layout');
				$sidebar_id = Medicplus::get_option('slz-department-sidebar');
			} else if( $post_type == 'medicplus_service' ) {
				$sidebar = Medicplus::get_option('slz-service-sidebar-layout');
				$sidebar_id = Medicplus::get_option('slz-service-sidebar');
			} elseif( $post_type == 'post' ) {
				// post
				$sidebar = Medicplus::get_option('slz-blog-sidebar-layout');
				$sidebar_id = Medicplus::get_option('slz-blog-sidebar');
			}
		}else if( is_archive() ) {
			if( MEDICPLUS_WOOCOMMERCE_ACTIVE ) {
				if( !is_shop()  && $post_type == 'product' ) {
					$sidebar = Medicplus::get_option('slz-shop-sidebar-layout');
					$sidebar_id = Medicplus::get_option('slz-shop-sidebar');
				}
			}
			if( (is_author() || is_tax() || is_category() || is_archive()) && $post_type != 'product' ) {
				if( empty($sidebar)) {
					$sidebar = 'right';
				}
			}
		} else if( is_search() ) {
			$sidebar = 'right';
		}
		if( empty($sidebar)) {
			$sidebar = $def_sidebar;
		}
		if( empty($sidebar_id)) {
			$sidebar_id = $def_sidebar_id;
		}
		$content_css = 'col-md-8';
		$sidebar_css = 'col-md-4';

		if ( $sidebar == 'left' ) {
			$content_css = 'col-md-8 content-with-sidebar-left';
			$sidebar_css = 'col-md-4';
		} else if ( $sidebar == 'right' ) {
			$content_css = 'col-md-8 content-with-sidebar-right';
			$sidebar_css = 'col-md-4';
		} else {
			if( $show_sidebar ){
				$content_css = 'col-md-8 layout-left';
				$sidebar_css = 'col-md-4 layout-right';
			} else {
				$content_css = 'col-md-12';
				$sidebar_css = 'hide';
				$has_sidebar = 'none';
			}
		}
		$container_css = 'container';
		return array(
			'container_css' => $container_css,
			'content_css'   => $content_css,
			'sidebar_css'   => $sidebar_css,
			'sidebar'       => $sidebar,
			'sidebar_id'    => $sidebar_id,
			'has_sidebar'   => $has_sidebar
		);
	}
endif;

if ( ! function_exists( 'medicplus_get_sidebar' ) ) :
	function medicplus_get_sidebar( $sidebar_id ) {
		if( empty($sidebar_id) ) {
			get_sidebar();
		} else {
			if ( is_active_sidebar( $sidebar_id ) ) {
				dynamic_sidebar( $sidebar_id );
			}
		}
	}
endif;
/**
 * Custom callback function, see comments.php
 * 
 */
if ( ! function_exists( 'medicplus_display_comments' ) ) : 
	function medicplus_display_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		$comment_id = get_comment_ID();
		?>
		<li class="li-comment" id="comment-<?php echo get_comment_ID() ?>">
			<div  class="comment-wrap clearfix">
				<div class="comment-meta">
					<div class="comment-author"><span class="comment-avatar clearfix">
						<?php echo get_avatar($comment, 54) ?>
					</span></div>
				</div>
				<div class="comment-content clearfix">
					<div class="comment-author">
						<span class="author-info">
							<?php
									$url	= get_comment_author_url( $comment_id );
									$author = get_comment_author( $comment_id );
									
									if ( empty( $url ) || 'http://' == $url ){
										printf('<a class="url" title="%1$s">%1$s</a>',
											esc_html(ucfirst($author))
										);
										
									}else {
										printf('<a class="url" href="%1$s" title="%2$s">%2$s</a>',
												esc_url($url),
												esc_html(ucfirst($author))
											);
									}
							?>
						</span>
						<span class="author-info">
							<a class="info">
								<i class="fa fa-calendar"></i><?php echo medicplus_display_comments_date(); ?>
							</a>
						</span>
						<span class="author-info">
						<?php
							$comment_reply_link_args = array(
								'depth'  => $depth, 
								'before' => '',
								'after'  => ''
							);
							comment_reply_link( array_merge ( $args, $comment_reply_link_args ) ); 
						?>
						</span>
					</div>
					<div class="description"><?php comment_text() ?></div>
				</div>
				<div class="clearfix"></div>
			</div>
		<!-- </li> // no open-->
		<?php
	}
endif;

if ( ! function_exists( 'medicplus_display_comments_date' ) ) : 
	function medicplus_display_comments_date() {
		$cmt_time = get_comment_time( 'U' );
		$current_time = current_time( 'timestamp' );
		$subtract_time = $current_time - $cmt_time;
		$days = ( 60*60*24*5 ); // 5 days
		if( $subtract_time > $days ){
			$res = get_comment_date();
		}
		else {
			$res = human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) );
			$res .= esc_html__( ' ago', 'medicplus' );
		}
		return $res;
	}
endif;

/**
 * getPosts
 * @param  string $postType : post type
 * @param  array $params   	: aguments to get post
 * @return array            : posts terms and conditions
 */
if ( ! function_exists( 'medicplus_getPosts' ) ) : 
	function medicplus_getPosts($postType = null, $params = null, $wp_query = false) {
		$postType || $postType = 'post';
		$defaultParams = array(
			'post_type' => $postType,
			'posts_per_page' => -1,
			'suppress_filters' => false
		);
		($params != null && is_array($params)) && $defaultParams = array_merge($defaultParams, $params);
		return !$wp_query ? get_posts($defaultParams) : new WP_Query($defaultParams);
	}
endif;

/*
* getTermSimpleByPost (Related post or post tag)
* params:
* 		- post id
* 		- taxonomy: (taxonomy slug | category | post_tag)
* return: One term related by post
*/
if ( ! function_exists( 'medicplus_getTermSimpleByPost' ) ) : 
	function medicplus_getTermSimpleByPost( $postID, $taxonomy ) {
		if( empty( $postID ) && empty($taxonomy) ) {
			return;
		}
		$result = array();
		$terms = get_the_terms( $postID, $taxonomy );
		if ($terms && ! is_wp_error($terms)) {
			$result = current( $terms );
		}
		return (array)$result;
	}
endif;

/*
* getTermsByPost (Related post or post tag)
* params:
* 		- post id
* 		- taxonomy: (taxonomy slug | category | post_tag)
* return: all terms related by post
*/
if ( ! function_exists( 'medicplus_getTermsByPost' ) ) : 
	function medicplus_getTermsByPost($postID, $taxonomy) {
		return get_the_terms($postID, $taxonomy);
	}
endif;

/* 
*add item for user profile
*To get contact items of user :
	* get_user_meta ( int $user_id, string $key = '', bool $single = false )
*/
function medicplus_add_item_user_profile($items) {

	// Add new item
	$links = Medicplus_Params::get('author_social_links');
	foreach($links as $k=>$v){
		$items[$k] = $v;
	}
	return $items;
}
add_filter('user_contactmethods', 'medicplus_add_item_user_profile');

//---- Change logo in login page
if ( ! function_exists( 'medicplus_login_style' ) ) {
	function medicplus_login_style() {
		$logo = Medicplus::get_option('slz-logo-header', 'url');
		if( $logo ) {
			$custom_css = '.login h1 a { 
								background : url('.esc_url($logo).') center no-repeat; 
								width: 100%; 
							}';
			wp_enqueue_style( 'medicplus-admin-style', get_template_directory_uri()."/assets/admin/css/medicplus-admin-style.css", false, MEDICPLUS_THEME_VER, 'all' );
			wp_add_inline_style( 'medicplus-admin-style', $custom_css );
		}
	}
}
add_action( 'login_enqueue_scripts', 'medicplus_login_style' );
if ( ! function_exists( 'medicplus_login_logo_url' ) ) {
	function medicplus_login_logo_url() {
		return esc_url( home_url('/') );
	}
}
add_filter( 'login_headerurl', 'medicplus_login_logo_url' );

// Add body class to special template
if ( ! function_exists( 'medicplus_add_body_class' ) ) {
	function medicplus_add_body_class( $classes)  {
		$classes[] = 'template-login';
		return $classes;
	}
}
// Check header page
function medicplus_has_page_title() {
	$is_page_title = false;
	$header_page = true;
	if( is_page_template ( 'page-templates/page-coming-soon.php' ) ){
		$header_page = false;
		add_filter( 'body_class', 'medicplus_add_body_class' );
	}
	//check front_page
	if( !is_front_page()) {
		$is_page_title = $header_page;
	} else {
		$special_home = array('six', 'seven', 'eight', 'nine');
		if( in_array( Medicplus::get_option('slz-header-layout'), $special_home ) ){
			$home_id = get_option('page_on_front');
			$slider_page_settings = get_post_meta( $home_id, 'medicplus_page_options', true );
			if( empty( $slider_page_settings ))  {
				$is_page_title = true;
			}
		}
	}
	return $is_page_title;
}
if ( ! function_exists( 'medicplus_get_page_class' ) ) {
	function medicplus_get_page_class() {
		$page_class = '';
		//Layout boxed
		if ( Medicplus::get_option('slz-layout') == '2' ) {
			$page_class .= 'layout-boxed';
		}
		return $page_class;
	}
}
//footer class
if ( ! function_exists( 'medicplus_get_footer_class' ) ) {
	function medicplus_get_footer_class() {
		$footer_col = Medicplus::get_option('slz-footer-col');
		$arr_footer_css = array(
			'footer_c1' => '',
			'footer_c2' => '',
			'footer_c3' => '',
			'footer_c4' => '',
		);
		if ( $footer_col == '2' ) {
			$arr_footer_css = array(
				'footer_c1' => 'col-md-6 col-sm-6',
				'footer_c2' => 'col-md-6 col-sm-6',
				'footer_c3' => 'hide',
				'footer_c4' => 'hide',
			);
		}
		if ( $footer_col == '3' ) {
			$arr_footer_css = array(
				'footer_c1' => 'col-md-4 col-sm-4',
				'footer_c2' => 'col-md-4 col-sm-4',
				'footer_c3' => 'col-md-4 col-sm-4',
				'footer_c4' => 'hide',
			);
		}
		if ( $footer_col == '4' ) {
			$arr_footer_css = array(
				'footer_c1' => 'col-md-3 prl col-sm-3',
				'footer_c2' => 'col-md-3 pll prl col-sm-3',
				'footer_c3' => 'col-md-3 pll col-sm-3',
				'footer_c4' => 'col-md-3 prl col-sm-3',
			);
		}
		return $arr_footer_css;
	}
}
