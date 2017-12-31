<?php
class Medicplus_Core_Pagination {
	private $theme_post_pagination_link = 'medicplus_post_pagination_link';

	public static function paging_nav( $pages = '', $range = 2, $current_query = '' ) {
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
		
		if( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if( ! $pages ) {
				$pages = 1;
			}
		}
		$method = "get_pagenum_link";
		if(is_single()) {
			$method = self::theme_post_pagination_link;
		}
		$output = $output_page = $showpages = $disable = '';
		$page_format = '<li class="pagi-inner"><a href="%2$s" class="pagi-link" >%1$s</a></li>';
		if( 1 != $pages ) {
			$output_page .= '<ul class="pagination">';
			// prev
			if( $paged == 1 ) {
				$disable = ' hide';
			}
			$output_page .= '<li class="pagi-inner '.$disable.'"><a href="'.$method($prev).'" rel="prev" class="pagi-link">'.esc_html__('Prev', 'slz-core').'</a></li>';
			// first pages
			if( $paged > $showitems ) {
				$output_page .= sprintf( $page_format, 1, $method(1) );
			}
			// show ...
			if( $paged - $range > $showitems && $paged - $range > 2 ) {
				$output_page .= sprintf( $page_format, '&bull;&bull;&bull;', $method($paged - $range - 1) );'<li><a href="'.$method($prev).'">&bull;&bull;&bull;</a></li>';
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
				$output_page .= sprintf( $page_format, '...', $method($showpages) );
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
			$output_page .= '<li class="pagi-inner '.$disable.'"><a href="'.$method($next).'" rel="next" class="pagi-link">'.esc_html__('Next', 'slz-core').'</a></li>';
			$output_page .= '</ul>'."\n";
			$output = sprintf('<nav class="pagination-wrapper text-center col-md-12">%1$s</nav>', $output_page );
		}
		return $output;
	}
	public static function paging_ajax( $pages = '', $range = 2, $current_query = '' ) {
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
		
		if( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if( ! $pages ) {
				$pages = 1;
			}
		}
		$output = $output_page = $showpages = $disable = '';
		$page_format = '<li class="pagi-inner"><a href="%2$s" class="pagi-link" >%1$s</a></li>';
		if( 1 != $pages ) {
			$output_page .= '<ul class="pagination">';
			// prev
			if( $paged == 1 ) {
				$disable = ' hide';
				$output_page .= '<li class="pagi-inner '.$disable.'"><span class="pagi-link">'.esc_html__('Prev', 'slz-core').'</span></li>';
			} else {
				$output_page .= '<li class="pagi-inner"><a href="'.$prev.'" rel="prev" class="pagi-link">'.esc_html__('Prev', 'slz-core').'</a></li>';
			}
			// first pages
			if( $paged > $showitems ) {
				$output_page .= sprintf( $page_format, 1, 1 );
			}
			// show ...
			if( $paged - $range > $showitems && $paged - $range > 2 ) {
				$output_page .= sprintf( $page_format, '&bull;&bull;&bull;', ($paged - $range - 1) );'<li><a href="'.$prev.'">&bull;&bull;&bull;</a></li>';
			}
			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$showitems || $i <= $paged-$showitems) || $pages <= $showitems )) {
					if( $paged == $i ) {
						$output_page .= '<li class="active pagi-inner"><span class="pagi-link">'.$i.'</span></li>';
					} else {
						$output_page .= sprintf( $page_format, $i, $i );
					}
					$showpages = $i;
				}
			}
			// show ...
			if( $paged < $pages-1 && $showpages < $pages -1 ){
				$showpages = $showpages + 1;
				$output_page .= sprintf( $page_format, '...', $showpages );
			}
			// end pages
			if( $paged < $pages && $showpages < $pages ) {
				$output_page .= sprintf( $page_format, $pages, $pages );
			}
			//next
			$disable = '';
			if( $paged == $pages ) {
				$disable = ' hide';
				$output_page .= '<li class="pagi-inner '.$disable.'"><span class="pagi-link">'.esc_html__('Next', 'slz-core').'</span></li>';
			} else {
				$output_page .= '<li class="pagi-inner"><a href="'.$next.'" rel="next" class="pagi-link">'.esc_html__('Next', 'slz-core').'</a></li>';
			}
			$output_page .= '</ul>'."\n";
			$output = sprintf('<nav class="pagination-wrapper paging-ajax col-md-12">%1$s</nav>', $output_page );
		}
		return $output;
	}
}