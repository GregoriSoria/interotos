<?php
$style = array(
	esc_html__( 'Style 1', 'slz-core' )			=> '1',
	esc_html__( 'Style 2', 'slz-core' )			=> '2'
);
// get all teams
$args = array('post_type'     => 'medicplus_team');
$options = array('empty'      => esc_html__( '--None--', 'slz-core' ) );
$teams = Medicplus_Core_Com::get_post_title2id( $args, $options );

$params = array(
	array(
		'type'        	=> 'dropdown',
		'heading'     	=> esc_html__( 'Style', 'slz-core' ),
		'param_name'  	=> 'style',
		'value'       	=> $style,
		'std'      		=> '1',
		'description' 	=> esc_html__( 'Choose style will be displayed.', 'slz-core' )
	),
	array(
		'type'            => 'checkbox',
		'heading'         => esc_html__( 'Insert Container', 'slz-core' ),
		'param_name'      => 'is_container',
		'value'           => array( esc_html__( 'Yes', 'slz-core' ) => 'yes' ),
		'description' => esc_html__( 'Checked to insert container for full width.', 'slz-core' ),
	),
	array(
		'type'            => 'dropdown',
		'heading'         => esc_html__( 'Team', 'slz-core' ),
		'param_name'      => 'team_id',
		'value'           => $teams,
		'description'     => esc_html__( 'Choose team will be displayed.', 'slz-core' )
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Title Color', 'slz-core' ),
		'param_name'      => 'title_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color title for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Position Color', 'slz-core' ),
		'param_name'      => 'position_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color position for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Icon Color', 'slz-core' ),
		'param_name'      => 'icon_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color icon for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Text Color', 'slz-core' ),
		'param_name'      => 'text_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color text description, email, phone for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Hover Color', 'slz-core' ),
		'param_name'      => 'hover_color',
		'value'           => '',
		'description'     => esc_html__( 'Choose color when hover for block.', 'slz-core' ),
		'group'       	=> esc_html__('Custom', 'slz-core'),
	),
	array(
		'type'            	=> 'colorpicker',
		'heading'         	=> esc_html__( 'Background Color', 'slz-core' ),
		'param_name'      	=> 'background_color',
		'value'           	=> '',
		'description'     	=> esc_html__( 'Choose color background for block.', 'slz-core' ),
		'group'       		=> esc_html__('Custom', 'slz-core'),
		'dependency'  => array(
			'element'   => 'style',
			'value'     => array( '1' )
		),
	),
	array(
		'type'            => 'textfield',
		'heading'         => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'      => 'extra_class',
		'description'     => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'slz-core' )
	),
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Team Simple', 'slz-core' ),
	'base'        => 'slzcore_team_simple_sc',
	'class'       => 'slzcore-sc',
	'icon'        => 'icon-slzcore_team_sc',
	'category'    => SLZCORE_SC_CATEGORY,
	'description' => esc_html__( 'Simple team information.', 'slz-core' ),
	'params'      => $params
	)
);