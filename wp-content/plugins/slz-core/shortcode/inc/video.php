<?php
$video_type = array(
	esc_html__('Youtube', 'slz-core')         => '1',
	esc_html__('Vimeo', 'slz-core')           => '2',
);

$params = array(
	array(
		'type'           => 'attach_image',
		'heading'        => esc_html__( 'Add Video Background Image', 'slz-core' ),
		'param_name'     => 'image_video',
		'description'    => esc_html__( 'Choose background image to add.', 'slz-core' ),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Video height', 'slz-core' ),
		'param_name'    => 'height',
		'description'   => esc_html__( 'Set height for video.EX:56.25%.', 'slz-core' ),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Video Type', 'slz-core' ),
		'param_name'  => 'video_type',
		'value'       => $video_type,
		'description' => esc_html__( 'Choose Type of Video.', 'slz-core' ),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Youtube ID', 'slz-core' ),
		'param_name'    => 'id_youtube',
		'description'   => esc_html__( 'For example the Video ID for http://www.youtube.com/v/8OBfr46Y0cQ is 8OBfr46Y0cQ.', 'slz-core' ),
		'dependency'     => array(
			'element' => 'video_type',
			'value'   => array( '1' ),
		),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Vimeo ID', 'slz-core' ),
		'param_name'    => 'id_vimeo',
		'description'   => esc_html__( 'For example the Video ID for http://vimeo.com/86323053 is 86323053.', 'slz-core' ),
		'dependency'     => array(
			'element' => 'video_type',
			'value'   => array( '2' ),
		),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'    => 'extra_class',
		'description'   => esc_html__( 'Enter extra class name.', 'slz-core' )
	),
);
vc_map(array(
	'name'               => esc_html__( 'SLZ Video', 'slz-core' ),
	'base'               => 'slzcore_video_sc',
	'class'              => 'slzcore-sc',
	'icon'               => 'icon-slzcore_video_sc',
	'category'           => SLZCORE_SC_CATEGORY,
	'description'        => esc_html__( 'Video', 'slz-core' ),
	'params'             => $params
));