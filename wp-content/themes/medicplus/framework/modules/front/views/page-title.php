<?php
if ( Medicplus::get_option('slz-page-title-show') != '1' ) {
	return;
}
$title = '';
$opt_title_type = Medicplus::get_option('slz-page-title-type-display');
$breadcrumb = medicplus_get_breadcrumb();
$count_breadcrumb = count($breadcrumb);
//title
$page_options = get_post_meta( get_the_ID(), 'medicplus_page_options', true);
$page_title_default = Medicplus::get_value($page_options, 'page_title_default');
if( empty($page_title_default) && !empty($page_options['title_custom_content']) ) {
	$title = $page_options['title_custom_content'];
} 
elseif ( empty($page_title_default) && !empty($page_options['page_title_type_display']) ) {
	if ( $page_options['page_title_type_display'] == 'level' && $count_breadcrumb > 2 ) {
		$title = $breadcrumb[$count_breadcrumb-2][0];
	} elseif ( $page_options['page_title_type_display'] == 'post' ) {
		$title = get_the_title();
	}
}
elseif ( ( $opt_title_type == 'level' ) && $count_breadcrumb > 2 ) {	
	$title = $breadcrumb[$count_breadcrumb-2][0];
} 
elseif( is_single() ) {
	$post_type = get_post_type( get_the_ID() );
	if ( $post_type && 'post' != $post_type ) {
		$post_type_obj = get_post_type_object( $post_type );
		$title = $post_type_obj->labels->singular_name;
	} else {
		$cat = current( get_the_category( get_the_ID() ) );
		if( $cat ) {
			$title = $cat->name;
		}
	}
} else {
	$title = get_the_title();
}
if( is_front_page() ) {
	$title = '';
}

// Page title style
$class = '';
$header_style = Medicplus::get_option( 'slz-header-layout' );
switch ($header_style) {
    case 'four':
        $class = 'heart-cancer-center';
        break;
    case 'five':
        $class = 'heart-center';
        break;
    case 'six':
     	$class = 'home-ent-center';
        break;
    case 'seven':
     	$class = 'dermatology';
        break;
    case 'eight':
        $class = 'home-psychology';
        break;
    case 'nine':
        $class = 'header-nutrition';
        break;
    case 'ten':
     	$class = 'home-ophthalmology';
        break;
    case 'eleven':
     	$class = 'home-orthopedic';
        break;
    case 'twelve':
        $class = 'pediatric';
        break;
    case 'thirt-teen':
     	$class = 'home-prenancy';
        break;
    case 'four-teen':
     	$class = 'vet-clinic';
        break;
 	case 'fif-teen':
     	$class = 'dental-care';
        break;  
    default: $class = 'home-default';
}
?>
<!-- Page Title -->
<div class="page-title-container <?php echo esc_attr($class); ?>">
	<section class="breadcrumb">
		<div class="container">
			<div class="breadcrumb-wrapper">
				<?php if ( Medicplus::get_option('slz-show-title') == '1' ): ?>
				<h2 class="breadcrumb-text"><?php
					$output_title = '';
					if ( is_search() ) {
						$output_title = esc_html__( 'Search results', 'medicplus' );
					} elseif ( is_tax() && $opt_title_type == 'level' && $count_breadcrumb > 2 ) {
						$output_title = $title;
					} elseif( is_archive() ) {
						if ( is_month() ) {
							$output_title = sprintf( '%s' , get_the_date( _x( 'F Y', 'monthly archives date format', 'medicplus' ) ) );
						} elseif ( is_day() ) {
							$output_title = sprintf( '%s' , get_the_date( _x( 'F j, Y', 'daily archives date format', 'medicplus' ) ) );
						} else{
							$output_title = get_the_archive_title();
						}
						if( MEDICPLUS_WOOCOMMERCE_ACTIVE ) {
							if( is_shop() ) {
								if( empty($page_title_default) && !empty($page_options['title_custom_content']) ) {
									$output_title = $page_options['title_custom_content'];
								} else {
									$output_title = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
										
									if ( ! $output_title ) {
										$product_post_type = get_post_type_object( 'product' );
										$output_title = $product_post_type->labels->singular_name;
									}
								}
							}
						}
					} else if( is_404() ) {
						$output_title = esc_html__( 'Error 404', 'medicplus' );
					} 
					else {
						$output_title = esc_html($title);
					}
					echo wp_kses_post( $output_title );
					?>
				</h2>
				<?php endif; // show_title ?>
				<?php if ( Medicplus::get_option('slz-show-breadcrumb') == '1' ):
					$breadcrumb_html = '';
					if ( $breadcrumb ) {
						foreach ( $breadcrumb as $key => $crumb ) {
							if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
								$breadcrumb_html .= '<li class="breadcrumb-list"><a class="breadcrumb-link" href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
							} else {
								if( ! empty( $crumb[0] ) ) {
									$breadcrumb_html .= '<li class="breadcrumb-list active">' . esc_html( $crumb[0] ) . '</li>';
								}
							}
						}
					}
					printf('<ol class="breadcrumb-content">%s</ol>', $breadcrumb_html );
				endif;//show_breadcrumb?>
			</div>
		</div>
	</section>
</div>