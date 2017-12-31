<?php
$contact_form_arr = array(esc_html__( '-None-', 'slz-core' ) => '');
$args = array (
			'post_type'        => 'wpcf7_contact_form',
			'post_per_page'    => -1,
			'status'           => 'publish',
			'suppress_filters' => false,
		);
$post_arr = get_posts( $args );
foreach( $post_arr as $post ){
	$k = ( !empty( $post->post_title ) )? $post->post_title : $post->post_name;
	$contact_form_arr[$k] =  $post->ID ;
}

$params = array(
	array(
		'type'            => 'dropdown',
		'heading'         => esc_html__( 'Contact Form', 'slz-core' ),
		'param_name'      => 'contact_form',
		'value'           => $contact_form_arr,
		'description'     => esc_html__( 'Select contact form to display.', 'slz-core' ),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Header', 'slz-core' ),
		'param_name'     => 'header',
		'description'    => esc_html__( 'Enter header.', 'slz-core' ),
		'dependency' => array(
			'element' => 'contact_form',
			'value_not_equal_to' => array( '' ),
		),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Title', 'slz-core' ),
		'param_name'     => 'title',
		'description'    => esc_html__( 'Enter title.', 'slz-core' ),
		'dependency' => array(
			'element' => 'contact_form',
			'value_not_equal_to' => array( '' ),
		),
	),
	array(
		'type'           => 'textarea',
		'heading'        => esc_html__( 'Description', 'slz-core' ),
		'param_name'     => 'description',
		'description'    => esc_html__( 'Enter description.', 'slz-core' ),
		'dependency' => array(
			'element' => 'contact_form',
			'value_not_equal_to' => array( '' ),
		),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Address', 'slz-core' ),
		'param_name'     => 'address',
		'description'    => esc_html__( 'Enter address.', 'slz-core' ),
		'group'          => 'Map',
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Phone', 'slz-core' ),
		'param_name'     => 'phone',
		'description'    => esc_html__( 'Enter phone number.', 'slz-core' ),
		'group'          => 'Map',
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Height', 'slz-core' ),
		'param_name'     => 'height',
		'value'          => '400',
		'description'    => esc_html__( 'Enter height of map', 'slz-core' ),
		'group'          => 'Map',
		'dependency'     => array(
			'element'  => 'contact_form',
			'value'    => array( '' ),
		),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Width', 'slz-core' ),
		'param_name'     => 'width',
		'value'          => '500',
		'description'    => esc_html__( 'Enter width of map', 'slz-core' ),
		'group'          => 'Map',
		'dependency'     => array(
			'element'  => 'contact_form',
			'value'    => array( '' ),
		),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Zoom', 'slz-core' ),
		'param_name'     => 'zoom',
		'value'          => '10',
		'description'    => esc_html__( 'Enter zoom number of map. Number between 0 (farthest) and 22 that sets the zoom level of the map.', 'slz-core' ),
		'group'          => 'Map',
	),	
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'     => 'extra_class',
		'description'    => esc_html__( 'Enter extra class name.', 'slz-core' )
	),
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Contact', 'slz-core' ),
	'base'        => 'slzcore_contact_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_contact_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'Show contact as map or contact form', 'slz-core' ),
	'params'      => $params
));