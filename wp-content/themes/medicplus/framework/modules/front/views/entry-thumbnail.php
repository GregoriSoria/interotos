<?php
if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) {
	printf( '<div class="post-image"><a href="%s" class="link" >%s</a></div>',
			esc_url(medicplus_get_link_url()),
			get_the_post_thumbnail( get_the_ID(), 'post-thumbnail', array('class' => 'img-responsive post-thumb-img') ));
}