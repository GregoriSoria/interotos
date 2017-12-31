<div class="wrap about-wrap slz-wrap slz-tab-style">
	<?php do_action('medicplus_get_theme_header');?>
	<div class="slz-demo-themes slz-install-plugins slz-icons">
	<?php
		if( class_exists('Medicplus_Core_Params')) {
			$sh_icons = Medicplus_Core_Params::get('font_medic');
			unset($sh_icons['']);
			if( $sh_icons ) {
				foreach( $sh_icons as $icon ) {
					printf('<div class="glyph">
								<div class="clearfix pbs">
									<span class="%1$s"></span>
									<span class="mls">%1$s</span>
								</div>
							</div>', $icon);
				}
			}
		}
	?>
		<div class="clearfix"></div>
	</div>
</div>