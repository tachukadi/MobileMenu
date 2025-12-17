<?php
/**
 * Fired during plugin deactivation.
 *
 * @package    MobileMenu
 * @subpackage MobileMenu/includes
 */

class MobileMenu_Deactivator {
    
    /**
     * Plugin deactivation tasks.
     *
     * @since    1.0.0
     */
    public static function deactivate(): void {
        // Clean up transients
        delete_transient('mobilemenu_menu_cache');
        
        // Remove custom capabilities
        $role = get_role('administrator');
        if ($role) {
            $role->remove_cap('manage_mobile_menu');
        }
    }
}
