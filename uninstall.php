<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package    MobileMenu
 */

// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

/**
 * Remove all plugin data from the database
 */
function mobilemenu_uninstall(): void {
    // Remove plugin options
    delete_option('mobilemenu_settings');
    delete_option('mobilemenu_menu_icons');
    delete_option('mobilemenu_activated');
    
    // Remove transients
    delete_transient('mobilemenu_menu_cache');
    
    // Remove custom capabilities
    $role = get_role('administrator');
    if ($role) {
        $role->remove_cap('manage_mobile_menu');
    }
    
    // For multisite installations
    if (is_multisite()) {
        global $wpdb;
        
        $blog_ids = $wpdb->get_col("SELECT blog_id FROM {$wpdb->blogs}");
        
        foreach ($blog_ids as $blog_id) {
            switch_to_blog($blog_id);
            
            delete_option('mobilemenu_settings');
            delete_option('mobilemenu_menu_icons');
            delete_option('mobilemenu_activated');
            delete_transient('mobilemenu_menu_cache');
            
            restore_current_blog();
        }
    }
}

// Run uninstall
mobilemenu_uninstall();
