<?php

define( 'MIN_MAP_WIDTH', 200 );
define( 'MIN_MAP_HEIGHT', 100 );
define( 'XMAP_WARNING_STYLE', 'border:1px solid #C00;' );


/**
 * Handler creating the options page
 */
function xmap_admin_menu_handler() {
	add_options_page( 'XMap', 'XMap', 'manage_options', 'xmap', 'xmap_options_page');
}


/**
 * Handler registering the settings, sections and fields
 */
function xmap_admin_init_handler() {
	register_setting( 'xmap_options', 'xmap_options', 'xmap_validate_options' );
	
	add_settings_section('xmap_properties_section', __('Map Properties', 'xmap'), 'xmap_properties_section_description', 'xmap');
	add_settings_field('xmap_width_field', __('Map Width', 'xmap'), 'xmap_width_input', 'xmap', 'xmap_properties_section');
	add_settings_field('xmap_height_field', __('Map Height', 'xmap'), 'xmap_height_input', 'xmap', 'xmap_properties_section');
	//add_settings_field('xmap_type_field', __('Map Type', 'xmap'), 'xmap_type_input', 'xmap', 'xmap_properties_section');
	add_settings_field('xmap_extended_field', __('Show Track Metadata', 'xmap'), 'xmap_extended_input', 'xmap', 'xmap_properties_section');
	add_settings_field('xmap_unit_field', __('Unit', 'xmap'), 'xmap_unit_input', 'xmap', 'xmap_properties_section');	
	
	add_settings_section('xmap_styles_section', __('Map Styles', 'xmap'), 'xmap_styles_section_description', 'xmap');
	add_settings_field('xmap_css_field', __('CSS', 'xmap'), 'xmap_css_input', 'xmap', 'xmap_styles_section');
}


/**
 * Print the description for the map properties section
 */
function xmap_properties_section_description() {
	echo "<p>" . __('Enter the default map properties here.', 'xmap') . "<br/>";
	echo  __('You can override these defaults by using the appropriate attributes in each shortcode.', 'xmap') . "</p>";
}

function xmap_styles_section_description() {
	printf('<p>%s</p>', __('Enter the CSS for the xmap class', 'xmap' ) );
}


/** Draw the input fields **/


function xmap_width_input() {
	$options = get_option( 'xmap_options' );
	$width = $options['width'];
	echo "<input id='xmap_width_field' name='xmap_options[width]' type='text' value='$width' size='4'/> px";
}


function xmap_height_input() {
	$options = get_option( 'xmap_options' );
	$height = $options['height'];
	echo "<input id='xmap_height_field' name='xmap_options[height]' type='text' value='$height' size='4'/> px";
}

/*
* Deprecated @since 1.1
*
*/
function xmap_type_input() {
	$options = get_option( 'xmap_options' );
	$type = $options['type'];
	printf( "<select id='xmap_type_field' name='xmap_options[type]'>" );	
	printf( "	<option value='%s' %s>%s</option>", 'road', $type == 'road' ? 'selected' : '', __('Road', 'xmap') );
	printf( "	<option value='%s' %s>%s</option>", 'satellite', $type == 'satellite' ? 'selected' : '', __('Satellite', 'xmap') );
	printf( "	<option value='%s' %s>%s</option>", 'hybrid', $type == 'hybrid' ? 'selected' : '', __('Hybrid', 'xmap') );
	printf( "	<option value='%s' %s>%s</option>", 'terrain', $type == 'terrain' ? 'selected' : '', __('Terrain', 'xmap') );
	printf( "	<option value='' disabled='disabled'>&nbsp;</option> " );
	printf( "	<option value='%s' %s>%s</option>", 'osm', $type == 'osm' ? 'selected' : '', __('Open Street Map', 'xmap') );
	printf( "	<option value='%s' %s>%s</option>", 'ocm', $type == 'ocm' ? 'selected' : '', __('Open Cycle Map', 'xmap') );
	printf( "</select>" );
}


function xmap_extended_input() {
	$options = get_option( 'xmap_options' );
	$extended = $options['extended'];
	printf( "<input id='xmap_extended_field' name='xmap_options[extended]' type='checkbox' value='1' %s />", $extended == '1' ? 'checked=\'checked\'' : '' );
}


function xmap_unit_input() {
	$options = get_option( 'xmap_options' );
	$unit = $options['unit'];
	printf( "<select id='xmap_unit_field' name='xmap_options[unit]'>" );	
	printf( "	<option value='%s' %s>%s</option>", 'km', $unit == 'km' ? 'selected' : '', __('km', 'xmap') );
	printf( "	<option value='%s' %s>%s</option>", 'miles', $unit == 'miles' ? 'selected' : '', __('Miles', 'xmap') );
	printf( "</select>" );
}

function xmap_css_input() {
	$options = get_option( 'xmap_options' );
	$css = $options['css'];
	printf( "<textarea rows='10' cols='50' id='xmap_css_field' name='xmap_options[css]'>%s</textarea>", $css );
}


/**
 * Validate user input
 * @param array $input Array containing the user input fields
 * @return array Array containing validated fields
 */
function xmap_validate_options($input) {
	
	$valid['width'] = preg_replace( '/[^0-9]/', '', $input['width'] );
	if( $valid['width'] != $input['width'] ) {
		add_settings_error(
			'xmap_width_field',
			'xmap_error_notanumber',
			sprintf( __('<i>%s</i> – You must enter a number!', 'xmap'), __('Map Width', 'xmap') ),
			'error'
		);		
	}
	if( (int) $input['width'] < MIN_MAP_WIDTH) {
		$valid['width'] = MIN_MAP_WIDTH;
		add_settings_error(
			'xmap_width_field',
			'xmap_error_tosmall',
			sprintf( __('<i>%s</i> – This value must be at least %s!', 'xmap'), __('Map Width', 'xmap'), MIN_MAP_WIDTH ),
			'error'
		);
	}
	
	$valid['height'] = preg_replace( '/[^0-9]/', '', $input['height'] );
	if( $valid['height'] != $input['height'] ) {
		add_settings_error(
			'xmap_height_field',
			'xmap_error_notanumber',
			sprintf( __('<i>%s</i> – You must enter a number!', 'xmap'), __('Map Height', 'xmap') ),
			'error'
		);		
	}
	if( (int) $input['height'] < MIN_MAP_HEIGHT) {
		$valid['height'] = MIN_MAP_HEIGHT;
		add_settings_error(
			'xmap_height_field',
			'xmap_error_tosmall',
			sprintf( __('<i>%s</i> – This value must be at least %s!', 'xmap'), __('Map Height', 'xmap'), MIN_MAP_HEIGHT ),
			'error'
		);
	}
	
	$valid['type'] = $input['type'];
	$valid['extended'] = $input['extended'];
	$valid['unit'] = $input['unit'];
	$valid['css'] = $input['css'];
	
	return $valid;
}


/**
 * Add default options to the db on plugin activation. Don't overwrite existing options.
 */
function xmap_default_options() {
	$options = get_option('xmap_options');
	$tmp = $options;
	if( !isset( $options['width'] ) ) $tmp['width'] = 640;
	if( !isset( $options['height'] ) ) $tmp['height'] = 400;
	if( !isset( $options['type'] ) ) $tmp['type'] = 'terrain';
	if( !isset( $options['unit'] ) ) $tmp['unit'] = 'km';
	if( !isset( $options['extended'] ) ) $tmp['extended'] = '1';
	if( !isset( $options['css'] ) ) $tmp['css'] = 'margin-bottom:12px;
font-family:Arial,Helvetica,sans-serif;
font-size:9px;
color:#535353;
background-color:#ffffff;
font-style:normal;
text-align:right;
padding:0px;';
	update_option( 'xmap_options', $tmp );
}



/**
 * Draw the plugin options page
 */
function xmap_options_page() {
	
	?>
	
	<div class="wrap">
	
	<?php screen_icon(); ?>
	<h2><?php _e('XMap Settings', 'xmap'); ?></h2>
	
	<form action="options.php" method="post">
	<?php settings_fields('xmap_options'); ?>
	<?php do_settings_sections('xmap'); ?>
	<p class="submit"><input name="Submit" type="submit" value="<?php _e('Save Changes', 'xmap'); ?>" class="button-primary" /></p>
	</form>
	
	</div>
	
	<?php 
	
} 

?>