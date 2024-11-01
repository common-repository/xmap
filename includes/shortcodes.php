<?php

add_shortcode( 'bikemap', 'xmap_shortcode_handler' );
add_shortcode( 'runmap', 'xmap_shortcode_handler' );
add_shortcode( 'wandermap', 'xmap_shortcode_handler' );
add_shortcode( 'mopedmap', 'xmap_shortcode_handler' );
add_shortcode( 'inlinemap', 'xmap_shortcode_handler' );

/**
 * Processes the shortcodes
 * @param array $atts Associative Array containing the attributes of the shortcode
 * @param string $content The shortcode content is not used here.
 * @param string $code The actual shortcode (bikemap|runmap|wandermap|mopedmap|inlinemap)
 * @return string The HTML representing the embedded map
 */
function xmap_shortcode_handler($atts, $content, $code) {
	
	$options = get_option('xmap_options');
	
	extract( shortcode_atts( array(
			//'type' => $options['type'],
			'route' => '',
			'user' => '',
			'extended' => $options['extended'] == 'true' ? 1 : 0,
			'unit' => $options['unit'],
			'width' => $options['width'],
			'height' => $options['height']
		), $atts ) );
		
		if($user != '') return xmap_print_warning( __('User maps currently not supported.', 'xmap' ) );
		if($route == '' && $user == '') return xmap_print_warning( __('Missing route or user ID.', 'xmap' ) );
		if($route != '' && $user != '') return xmap_print_warning( __('You must not specify both, route and user ID.', 'xmap' ) );
		
		
		/**
		 * @todo map zoom has to be fixed for user maps
		 */
		$domain = xmap_domain( $code );
		
		$dir = $user != '' ? "user/$user" : "route/$route";
		
		$maptype = xmap_maptype_id($type);
		$ext = $extended == "true" || $extended == 1 ? 1 : 0;

		$src = "http://$domain/$dir/widget?width=$width&amp;height=$height&amp;extended=$ext&amp;unit=$unit";
		
		return xmap_print_map($src, (int) $width, $ext == 1 ? (int) $height + 105 : (int) $height);
}


/**
 * Generates the HTML replacement for the shortcode
 * @param string $src the source of the map to be embedded in an iframe
 * @param integer $width The width of the map in pixels
 * @param integer $height The height of the map in pixels
 * @return string
 */
function xmap_print_map($src, $width, $height) {
	
	$options = get_option('xmap_options', 'xmap');
	$css = $options['css'];
	
	$out = '';
	
	$out .= sprintf('<div class="xmap" style="width:%spx;%s">', $width, $css);
	$out .= sprintf('<iframe src="%s" width="%s" height="%s" border="0" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe>', $src, $width, $height);
	$out .= sprintf('</div>');
	
	return $out;
	
}

/**
 * @since 1.0.1
 * 
 * Return a warning on screen
 * @param string $warning
 * @return string The HTML formatted warning
 */
function xmap_print_warning($warning) {
	return sprintf( '<pre style="%s">XMap: %s</pre>', XMAP_WARNING_STYLE, $warning );
}

?>