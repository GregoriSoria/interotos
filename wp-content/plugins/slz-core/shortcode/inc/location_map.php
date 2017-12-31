<?php
$function = array(
	esc_html__( 'Interactive map with locations page', 'slz-core' )		=> '1',
	esc_html__( 'Map showing location list only', 'slz-core' )			=> '2',
);
$sort_by = Medicplus_Core_Params::get('sort-other');

// get all location
$args = array('post_type'     => 'medicplus_locate');
$options = array('empty'      => esc_html__( '-All Location-', 'slz-core' ) );
$location = Medicplus_Core_Com::get_post_title2id( $args, $options );

$params = array(
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Map Function', 'slz-core' ),
		'param_name'  	=> 'function',
		'value'       	=> $function,
		'std'      		=> '1',
		'description' 	=> esc_html__( 'Select the function to be performed.', 'slz-core' )
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Limit Posts', 'slz-core' ),
		'param_name'      => 'limit_post',
		'description'     => esc_html__( 'Enter location numbers will be displayed.', 'slz-core' ),
		'dependency'  => array(
			'element'   => 'function',
			'value'     => array( '2' )
		),
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Offset Posts', 'slz-core' ),
		'param_name'  => 'offset_post',
		'value'       => '0',
		'description' => esc_html__( 'Enter offset to pass over posts. If you want to start on record 6, using offset 5.', 'slz-core' ),
		'dependency'  => array(
			'element'   => 'function',
			'value'     => array( '2' )
		),
	),
	array(
		'type'            => 'dropdown',
		'heading'         => esc_html__( 'Sort By', 'slz-core' ),
		'param_name'      => 'sort_by',
		'value'           => $sort_by,
		'description'     => esc_html__( 'Select order to display list properties.', 'slz-core' ),
		'dependency'  => array(
			'element'   => 'function',
			'value'     => array( '2' )
		),
	),
	array(
		'type'            => 'param_group',
		'heading'         => esc_html__( 'location', 'slz-core' ),
		'param_name'      => 'location_list',
		'params'          => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add location', 'slz-core' ),
				'param_name'  => 'location',
				'value'       => $location,
				'description' => esc_html__( 'Choose special location to show',  'slz-core'  )
			),			
		),
		'value'           => '',
		'callbacks'       => array(
			'after_add'   => 'vcChartParamAfterAddCallback'
		),
		'description'     => esc_html__( 'Default display all location if no tean is selected and Number location is empty.', 'slz-core' ),
		'dependency'  => array(
			'element'   => 'function',
			'value'     => array( '2' )
		),
		'group'       	  => esc_html__('Filter', 'slz-core'),
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'      => 'extra_class',
		'description'     => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'slz-core' )
	),

	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Height Map', 'slz-core' ),
		'param_name'      => 'height_map',
		'value'           => '',
		'description'     => esc_html__( 'Enter height map will be displayed. The unit is pixels. Just enter the number. Example: If you want the height to 600 Pixel, just enter "600".', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Zoom Map', 'slz-core' ),
		'param_name'      => 'zoom_map',
		'value'           => '',
		'description'     => esc_html__( 'Enter zoom number of map. Just enter the number 3 to 21 to set the zoom level of the map.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'attach_image',
		'heading'         => esc_html__( 'Icon Marker Image', 'slz-core' ),
		'param_name'      => 'image_icon_marker',
		'value'           => '',
		'description'     => esc_html__( 'Upload the icon marker image. Do not upload photos larger size 40x40 pixel.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'attach_image',
		'heading'         => esc_html__( 'Icon Big Marker Image', 'slz-core' ),
		'param_name'      => 'image_icon_marker_big',
		'value'           => '',
		'description'     => esc_html__( 'Upload the icon big marker image. Do not upload photos larger size 60x60 pixel.', 'slz-core' ),
		'group'       	  => esc_html__('Custom', 'slz-core'),
	),
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Location Map', 'slz-core' ),
	'base'        => 'slzcore_location_map_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_location_map_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'Location map.', 'slz-core' ),
	'params'      => $params
	)
);