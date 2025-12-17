<?php
/**
 * Define the internationalization functionality.
 *
 * @package    MobileMenu
 * @subpackage MobileMenu/includes
 */

class MobileMenu_i18n {
    
    /**
     * Load the plugin text domain for translation.
     */
    public function load_plugin_textdomain(): void {
        load_plugin_textdomain(
            'mobilemenu',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
