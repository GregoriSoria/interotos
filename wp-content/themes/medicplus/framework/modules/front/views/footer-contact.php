	<?php 
	//contact
	$phone = Medicplus::get_option( 'slz-footerct-phone-text' );
	$phone_des = Medicplus::get_option( 'slz-footerct-phone-caption' );
	$address= Medicplus::get_option( 'slz-footerct-mail-text' );
	$address_des = Medicplus::get_option( 'slz-footerct-mail-caption' );
	//map
	$map_style =  Medicplus::get_option( 'slz-footer-map-style' );
	$illustration_image = Medicplus::get_option( 'slz-footer-map-illustration' );
	$title =  Medicplus::get_option( 'slz-footerbt-wh-title' );
	$time1 =  Medicplus::get_option( 'slz-footerbt-wh-time01' );
	$time1_content =  Medicplus::get_option( 'slz-footerbt-wh-time01-content' );
	$time2 =  Medicplus::get_option( 'slz-footerbt-wh-time02' );
	$time2_content =  Medicplus::get_option( 'slz-footerbt-wh-2-content' );
	$time3 =  Medicplus::get_option( 'slz-footerbt-wh-time03' );
	$time3_content =  Medicplus::get_option( 'slz-footerbt-wh-3-content' );
	
	$contact_text =  Medicplus::get_option( 'slz-footerbt-ci-title' );
	$contact_phone_text = Medicplus::get_option( 'slz-footerbt-ci-phone');
	$contact_phone = Medicplus::get_option( 'slz-footerbt-ci-phone-content' );
	$contact_address_text = Medicplus::get_option( 'slz-footerbt-ci-address' );
	$contact_address = Medicplus::get_option( 'slz-footerbt-ci-address-content' );
	$contact_email_text = Medicplus::get_option( 'slz-footerbt-ci-email' );
	$contact_email = Medicplus::get_option( 'slz-footerbt-ci-email-content' );
	$lat = Medicplus::get_option('slz-footerbt-map-lat');
	$lng = Medicplus::get_option('slz-footerbt-map-long');
	$map_zoom = Medicplus::get_option('slz-footerbt-map-zoom');
	$map_zoom = (int) $map_zoom;
	$attrZoom = 13;
	$range_zoom = range(3, 21);
	if ( $map_zoom && in_array($map_zoom, $range_zoom) ) {
		$attrZoom = $map_zoom;
	}
	$time = Medicplus::get_option('slz-footerbt-wh-time');
	$time_arr =  array();
	if ( (!empty($time)) ) {
		foreach ($time  as $value) {
			$time_arr [] = explode('/', $value);
		}
	}

	$show_map = Medicplus::get_option('slz-footerbt-map-info');
	$show_contact =  Medicplus::get_option('slz-footerbt-contact-info');
	$footer_style = Medicplus::get_option('slz-footer-style');

	if ($footer_style == 'dark'){
		$class = 'footer-content-style-3';
	}else if ($footer_style == 'light'){
		$class = 'footer-content-style-2';
	}else{
		$class = 'footer-content-style-1';
	}
	if ($map_style == 'three'){
		$map_class = 'footer-content-style-8 new-footer-map';
	}else if ($map_style == 'two'){
		$map_class = 'footer-content-style-15 new-footer-map';
	}else{
		$map_class = '';
	}
	
if ($show_contact == '1'){?>
	<div class="footer-content <?php echo esc_attr($class);?>">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="info-footer">
						<div class="info-footer-img btn-for-icon"><i class="icon1 icon-hphone"></i></div>
						<h2 class="title-footer"><?php echo esc_html($phone);?></h2>
						<div class="footer-description"><?php echo esc_html($phone_des );?></div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="info-footer">
						<div class="info- info-footer-img btn-for-icon"><i class="icon1 icon-hmail"></i></div>
						<h2 class="title-footer"><?php echo esc_html($address);?></h2>
						<div class="footer-description"><?php echo esc_html($address_des);?></div>
					</div>
				</div>
				<div class="clerfix"></div>
			</div>
		</div>
	</div>
<?php }
if ($show_map == '1'){?>	
	<div class="footer-map <?php echo esc_attr($map_class);?>">
		<div class="container">
			<div class="contact-form-wrapper footer-contact-form-wrapper">
				<div class="contact-form-content right">
					<div class="contact-form-inner">
						<h3 class="contact-form-title"><?php echo esc_html($title);?> </h3>
						<div class="working-hours-wrapper"><?php
							if(!empty($time_arr)){
								foreach ($time_arr as $value) {
									echo '
									<div class="working-hours-inner">
										<div class="date-working">'.esc_html($value[0]).'</div>
										<div class="time-working">'.esc_html($value[1]).'</div>
									</div>';
								}
							}?>
						</div>
					</div>
					<div class="contact-form-inner">
						<h3 class="contact-form-title"><?php echo esc_html($contact_text);?></h3>
						<div class="contact-information-wrapper">
					   		<?php if (!empty($contact_phone)){?>
							<div class="contact-information-inner">
								<div class="info-left"><i class="fa fa-phone fa-fw"></i><?php echo esc_html($contact_phone_text);?></div>
								<div class="info-right"><span><?php echo esc_html($contact_phone);?></span></div>
							</div>
							<?php }?>
							<?php if (!empty($contact_email)){?>
							<div class="contact-information-inner">
								<div class="info-left"><i class="fa fa-envelope fa-fw"></i><?php echo esc_html($contact_email_text);?></div>
								<div class="info-right"><span><?php echo esc_html($contact_email);?></span></div>
							</div>
							<?php }?>
							<?php if (!empty($contact_address)){?>
							<div class="contact-information-inner">
								<div class="info-left"><i class="fa fa-map-marker fa-fw"></i><?php echo esc_html($contact_address_text);?></div>
								<div class="info-right"><?php echo esc_html($contact_address);?></div>
							</div>
						 <?php }?>
						</div>
					</div>
					<div class="img-wrapper">
						<?php if(isset($illustration_image['url']) && $map_style == 'three'){?>
						<img src="<?php echo esc_url($illustration_image['url']);?>" alt="" class="img-responsive img-contact" />
						<?php } ?>
					</div>
				</div>
				<div class="contact-footer-map contact-form-content left">
					<div id="footer-map" class="map-contact-style footer-map" data-img-url="<?php echo esc_url(MEDICPLUS_MAP_MAKER)?>"  data-address="<?php echo esc_attr($contact_address);?>" data-lat="<?php echo esc_attr($lat);?>" data-lng="<?php echo esc_attr($lng);?>" data-zoom="<?php echo esc_attr($attrZoom);?>" data-style = "<?php echo esc_attr($map_style);?>">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>