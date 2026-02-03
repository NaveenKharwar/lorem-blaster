<?php
/**
 * Uninstall cleanup for Lorem Blaster
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Clean up plugin transients
delete_transient( 'lorem_blaster_last_run' );
