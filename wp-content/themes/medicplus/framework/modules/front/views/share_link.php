<?php
if( ! MEDICPLUS_CORE_IS_ACTIVE ) return;

$cls_share = new Medicplus_Core_Social_Share;
$share_url = $cls_share->get_share_link();
$action = 'window.open(this.href, \''.esc_html__('Share Window', 'medicplus').'\',\'left=50,top=50,width=600,height=350,toolbar=0\');';
$social_enable  = Medicplus::get_option('slz-social-share', 'enabled');
$share_link = '';
if( $social_enable) {
	foreach ($social_enable as $key => $value) {
		if ( isset($share_url[$key])){
			$share_link[] = sprintf('<a href="%1$s" onclick="%2$s; return false;" class="socials-link %3$s">
										<i class="fa fa-%3$s"></i>
									</a>',
									esc_url($share_url[$key]), $action, $key);
		}
	}
}
?>
<div class="share"><?php
	if( $share_link ):
		esc_html_e( 'Share to ', 'medicplus' );?>
		<ul class="list-inline list-unstyled list-socials">
			<li><?php echo implode('</li><li>', $share_link)?></li>
		</ul><?php
	endif;?>
</div>