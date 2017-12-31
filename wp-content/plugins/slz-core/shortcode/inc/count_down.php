<?php
$align   = Medicplus_Core_Params::get('align');
$params = array(
	array(
        'type'            => 'slz_datetime_picker',
        'heading'         => esc_html__( 'Time Release', 'slz-core' ),
        'param_name'      => 'date',
        'description'     => esc_html__( 'Enter Time Release',  'slz-core'  ),
    ),
	array(
		'type'           => 'dropdown',		
		'heading'        => esc_html__( 'Align', 'slz-core' ),
		'param_name'     => 'align',
		'value'          => $align,
		'description'    => esc_html__( 'Choose text align for block.', 'slz-core' ),
	),
	array(
		'type'            => 'checkbox',
		'heading'         => esc_html__( 'Show Colon', 'slz-core' ),
		'param_name'      => 'show_colon',
		'value'           => array( esc_html__( 'Yes', 'slz-core' ) => 'yes' ),
		'description'     => esc_html__( 'Chech this if you want show colon( : ) between numbers.', 'slz-core' )
	),
    array(
		'type'            => 'colorpicker',		
		'heading'         => esc_html__( 'Text Color', 'slz-core' ),
		'param_name'      => 'text_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for text.', 'slz-core' ),
		'group'           => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'            => 'colorpicker',
		'heading'         => esc_html__( 'Line Color', 'slz-core' ),
		'param_name'      => 'line_color',
		'value'           => '',
		'description'     => esc_html__( 'Select color for line.', 'slz-core' ),
		'group'           => esc_html__('Options', 'slz-core'),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Extra Class', 'slz-core' ),
		'param_name'    => 'extra_class',
		'description'   => esc_html__( 'Enter extra class name.', 'slz-core' )
	),
);
vc_map(array(
	'name'               => esc_html__( 'SLZ Count Down', 'slz-core' ),
	'base'               => 'slzcore_count_down_sc',
	'class'              => 'slzcore-sc',
	'icon'               => 'icon-slzcore_count_down_sc',
	'category'           => SLZCORE_SC_CATEGORY,
	'description'        => esc_html__( 'Add count down with custom options', 'slz-core' ),
	'params'             => $params
));
