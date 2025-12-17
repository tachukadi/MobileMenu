<?php
/**
 * Plugin Name: MobileMenu
 * Plugin URI: https://github.com/tachukadi/MobileMenu
 * Description: A modern, animated, mobile-only navigation menu with extensive customization options
 * Version: 1.0.0
 * Requires at least: 5.8
 * Requires PHP: 8.2
 * Author: Sachin Solanki
 * Author URI: https://github.com/tachukadi/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mobilemenu
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin constants
define('MOBILEMENU_VERSION', '1.0.0');
define('MOBILEMENU_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MOBILEMENU_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MOBILEMENU_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * The code that runs during plugin activation.
 */
function activate_mobilemenu(): void {
    require_once MOBILEMENU_PLUGIN_DIR . 'includes/class-mobilemenu-activator.php';
    MobileMenu_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_mobilemenu(): void {
    require_once MOBILEMENU_PLUGIN_DIR . 'includes/class-mobilemenu-deactivator.php';
    MobileMenu_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_mobilemenu');
register_deactivation_hook(__FILE__, 'deactivate_mobilemenu');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require MOBILEMENU_PLUGIN_DIR . 'includes/class-mobilemenu.php';

/**
 * Begins execution of the plugin.
 */
function run_mobilemenu(): void {
    $plugin = new MobileMenu();
    $plugin->run();
}

run_mobilemenu();
