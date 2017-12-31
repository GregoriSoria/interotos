<?php
$cart_link = $account = $cart = '';
$show_woo_account = Medicplus::get_option('slz-header-ecommerce');
if($show_woo_account == '1' && MEDICPLUS_WOOCOMMERCE_ACTIVE) {
	$cart_link        = get_permalink( get_option( 'woocommerce_cart_page_id') );
	$register_page_id = $login_page_id = get_option( 'woocommerce_myaccount_page_id' );
	$account_link     = get_permalink( $login_page_id );
	$account_name     = get_permalink( $login_page_id );

}
else { // Custom Login
	$login_page_id    = get_option( 'medicplus_login_page_id' );
	$register_page_id = get_option( 'medicplus_register_page_id' );
	$account_link     = get_permalink( get_option( 'medicplus_profile_page_id' ) );
}
if ( is_user_logged_in() ) {
	$user = wp_get_current_user();
	if( !empty( $cart_link ) ) {
		$cart .= sprintf('<li><a href="%s">'.esc_html('Cart','medicplus').'</a></li>',
			esc_url($cart_link)
		);
	}
	$account = sprintf('<li><a href="%1$s">%2$s</a></li>%5$s
			<li><a href="%3$s">%4$s</a></li>',
			esc_url($account_link),
			esc_html($user->display_name),
			esc_url( wp_logout_url( get_permalink( $login_page_id ) ) ),
			esc_html__( 'Sign out', 'medicplus' ),
			$cart
	);
}
else {
	$account = sprintf('<li><a href="%1$s" class="item">%2$s</a></li>
						<li><a href="%3$s" class="item">%4$s</a></li>',
			esc_url( get_permalink( $login_page_id ) ),
			esc_html__( 'Login', 'medicplus' ),
			esc_url( get_permalink( $register_page_id ) ),
			esc_html__( 'Register', 'medicplus' )
		);
	if( !empty( $cart_link ) ) {
		$account .= sprintf('<li><a href="%s">'.esc_html('Cart','medicplus').'</a></li>',
			esc_url($cart_link)
		);
	}
}
if($show_woo_account == '1') {
	printf('<li class="account"><a href="javascript:void(0)" ><span>'.esc_html('My Account','medicplus').'</span><i class="topbar-icon icons-dropdown fa fa-angle-down"></i></a><ul class="dropdown-account list-unstyled hide">%1$s</ul></li>',$account);
}
