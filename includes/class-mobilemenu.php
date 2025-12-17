<?php
/**
 * The core plugin class.
 *
 * @package    MobileMenu
 * @subpackage MobileMenu/includes
 */

class MobileMenu {
    
    /**
     * The loader that's responsible for maintaining and registering all hooks.
     *
     * @var MobileMenu_Loader
     */
    protected MobileMenu_Loader $loader;
    
    /**
     * The unique identifier of this plugin.
     *
     * @var string
     */
    protected string $plugin_name;
    
    /**
     * The current version of the plugin.
     *
     * @var string
     */
    protected string $version;
    
    /**
     * Define the core functionality of the plugin.
     */
    public function __construct() {
        $this->version = MOBILEMENU_VERSION;
        $this->plugin_name = 'mobilemenu';
        
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }
    
    /**
     * Load the required dependencies for this plugin.
     */
    private function load_dependencies(): void {
        /**
         * The class responsible for orchestrating the actions and filters
         */
        require_once MOBILEMENU_PLUGIN_DIR . 'includes/class-mobilemenu-loader.php';
        
        /**
         * The class responsible for defining internationalization functionality
         */
        require_once MOBILEMENU_PLUGIN_DIR . 'includes/class-mobilemenu-i18n.php';
        
        /**
         * The class responsible for defining all actions in the admin area
         */
        require_once MOBILEMENU_PLUGIN_DIR . 'admin/class-mobilemenu-admin.php';
        
        /**
         * The class responsible for defining all actions in the public-facing side
         */
        require_once MOBILEMENU_PLUGIN_DIR . 'public/class-mobilemenu-public.php';
        
        $this->loader = new MobileMenu_Loader();
    }
    
    /**
     * Define the locale for this plugin for internationalization.
     */
    private function set_locale(): void {
        $plugin_i18n = new MobileMenu_i18n();
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }
    
    /**
     * Register all hooks related to the admin area functionality.
     */
    private function define_admin_hooks(): void {
        $plugin_admin = new MobileMenu_Admin($this->get_plugin_name(), $this->get_version());
        
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_menu_page');
        $this->loader->add_action('admin_init', $plugin_admin, 'register_settings');
        
        // AJAX handlers
        $this->loader->add_action('wp_ajax_mobilemenu_save_settings', $plugin_admin, 'ajax_save_settings');
        $this->loader->add_action('wp_ajax_mobilemenu_get_menu_items', $plugin_admin, 'ajax_get_menu_items');
        $this->loader->add_action('wp_ajax_mobilemenu_save_menu_icon', $plugin_admin, 'ajax_save_menu_icon');
    }
    
    /**
     * Register all hooks related to the public-facing functionality.
     */
    private function define_public_hooks(): void {
        $plugin_public = new MobileMenu_Public($this->get_plugin_name(), $this->get_version());
        
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_action('wp_footer', $plugin_public, 'render_mobile_menu');
    }
    
    /**
     * Run the loader to execute all hooks.
     */
    public function run(): void {
        $this->loader->run();
    }
    
    /**
     * The name of the plugin.
     */
    public function get_plugin_name(): string {
        return $this->plugin_name;
    }
    
    /**
     * The reference to the class that orchestrates the hooks.
     */
    public function get_loader(): MobileMenu_Loader {
        return $this->loader;
    }
    
    /**
     * Retrieve the version number of the plugin.
     */
    public function get_version(): string {
        return $this->version;
    }
}
