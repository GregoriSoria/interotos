<ul class="list-meta list-inline list-unstyled">
	<?php edit_post_link( esc_html__( 'Edit', 'medicplus' ), '<li class="item edit-link"><i class="fa fa-pencil"></i>', '</li>' ); ?>
	<?php
	$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$prefix = esc_html__('Posted by', 'medicplus');
	if( $author_url ) {
		$author_string = '<li><i class="fa fa-user"></i>%3$s<span class="author"><a href="%1$s">%2$s</a></span></li>';
	} else {
		$author_string = '<li><i class="fa fa-user"></i>%3$s<span class="author">%2$s</span></li>';
	}
	echo sprintf( 
		$author_string,
		esc_url( $author_url ),
		esc_html( get_the_author_meta( 'display_name' ) ),
		$prefix
	);
	?>
	<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
	<li><i class="fa fa-comment"></i><a href="<?php echo esc_url( get_comments_link() )?>"><?php echo wp_kses_post( get_comments_number_text() );?></a></li>
	<?php endif;?>
	<?php $view_count = medicplus_postview_get( get_the_ID() );?>
	<li><i class="fa fa-eye"></i><?php printf( _n('%s View', '%s Views', $view_count, 'medicplus'), $view_count ); ?></li>
</ul>