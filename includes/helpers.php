<?php

/**
 * Map map types to their corresponding IDs as used by MapToolkit
 * @param string $type The map type (hybrid|terrain|osm|ocm|satellite|road)
 * @return number
 */
function xmap_maptype_id ( $type ) {
	$maptype = 2;
	$new_maptype = 'terrain';
	switch ( $type ) {
			case 'hybrid':
				$maptype = 1;
				$new_maptype = 'google_hybrid';
				break;
			case 'terrain':
				$maptype = 2;
				$new_maptype = 'terrain';
				break;
			case 'osm':
				$maptype = 3;
				$new_maptype = 'osm';
				break;
			case 'ocm':
				$maptype = 4;
				$new_maptype = 'opencyclemap';
				break;
			case 'satellite':
				$maptype = 5;
				break;
			case 'road':
				$maptype = 6;
				$new_maptype = 'google_roadmap';
				break;
			default:
				$maptype = 2;
				$new_maptype = 'terrain';
		}
	return $new_maptype;
}


/**
 * @since 1.0.1
 *
 * Map shortcodes to their corresponding domain
 * @param string $code The shortcode (wandermap|runmap|inlinemap|mopedmap|bikemap)
 * @return string
 */
function xmap_domain ( $code ) {
	$domain = 'www.bikemap.net';
		switch ( $code ) {
			case 'wandermap':
				$domain = 'www.wandermap.net';
				break;
			case 'runmap':
				$domain = 'www.runmap.net';
				break;
			case 'inlinemap':
				$domain = 'www.inlinemap.net';
				break;
			case 'mopedmap':
				$domain = 'www.mopedmap.net';
				break;
			case 'bikemap':
				$domain = 'www.bikemap.net';
				break;
		}
	return $domain;
}






?>