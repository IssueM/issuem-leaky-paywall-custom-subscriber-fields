<?php
/**
 * Main PHP file used to for initial calls to IssueM's Leak Paywall classes and functions.
 *
 * @package IssueM's Leak Paywall - Subscriber Meta
 * @since 1.0.0
 */
 
/*
Plugin Name: IssueM's Leaky Paywall - Subscriber Meta
Plugin URI: http://zeen101.com/
Description: A premium leaky paywall add-on for WordPress and IssueM.
Author: IssueM Development Team
Version: 1.0.0
Author URI: http://zeen101.com/
Tags:
*/

//Define global variables...
if ( !defined( 'ZEEN101_STORE_URL' ) )
	define( 'ZEEN101_STORE_URL',	'http://zeen101.com' );
	
define( 'ISSUEM_LP_SM_NAME', 		'Leaky Paywall - Subscriber Meta' );
define( 'ISSUEM_LP_SM_SLUG', 		'issuem-leaky-paywall-subscriber-meta' );
define( 'ISSUEM_LP_SM_VERSION', 	'1.0.0' );
define( 'ISSUEM_LP_SM_DB_VERSION', 	'1.0.0' );
define( 'ISSUEM_LP_SM_URL', 		plugin_dir_url( __FILE__ ) );
define( 'ISSUEM_LP_SM_PATH', 		plugin_dir_path( __FILE__ ) );
define( 'ISSUEM_LP_SM_BASENAME', 	plugin_basename( __FILE__ ) );
define( 'ISSUEM_LP_SM_REL_DIR', 	dirname( ISSUEM_LP_SM_BASENAME ) );

/**
 * Instantiate Pigeon Pack class, require helper files
 *
 * @since 1.0.0
 */
function issuem_leaky_paywall_subscriber_meta_plugins_loaded() {
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'issuem/issuem.php' ) )
		define( 'ISSUEM_ACTIVE_LP_SM', true );
	else
		define( 'ISSUEM_ACTIVE_LP_SM', false );

	if ( is_plugin_active( 'issuem-leaky-paywall/issuem-leaky-paywall.php' ) ) {

		require_once( 'class.php' );
	
		// Instantiate the Pigeon Pack class
		if ( class_exists( 'IssueM_Leaky_Paywall_Subscriber_Meta' ) ) {
			
			global $dl_pluginissuem_leaky_paywall_subscriber_meta;
			
			$dl_pluginissuem_leaky_paywall_subscriber_meta = new IssueM_Leaky_Paywall_Subscriber_Meta();
			
			require_once( 'functions.php' );
				
			//Internationalization
			load_plugin_textdomain( 'issuem-lp-sm', false, ISSUEM_LP_SM_REL_DIR . '/i18n/' );
				
		}
	
	} else {
	
		add_action( 'admin_notices', 'issuem_leaky_paywall_subscriber_meta_requirement_nag' );
		
	}

}
add_action( 'plugins_loaded', 'issuem_leaky_paywall_subscriber_meta_plugins_loaded', 4815162342 ); //wait for the plugins to be loaded before init

function issuem_leaky_paywall_subscriber_meta_requirement_nag() {
	?>
	<div id="leaky-paywall-requirement-nag" class="update-nag">
		<?php _e( 'You must have the Leaky Paywall plugin activated to use the Leaky Paywall Subscriber Meta plugin.' ); ?>
	</div>
	<?php
}