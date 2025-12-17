<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package    MobileMenu
 * @subpackage MobileMenu/admin
 */

class MobileMenu_Admin {
    
    /**
     * The ID of this plugin.
     */
    private string $plugin_name;
    
    /**
     * The version of this plugin.
     */
    private string $version;
    
    /**
     * Initialize the class and set its properties.
     */
    public function __construct(string $plugin_name, string $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the admin area.
     */
    public function enqueue_styles(): void {
        $screen = get_current_screen();
        
        if ($screen && strpos($screen->id, 'mobilemenu') !== false) {
            wp_enqueue_style(
                $this->plugin_name . '-admin',
                MOBILEMENU_PLUGIN_URL . 'assets/css/mobilemenu-admin.css',
                [],
                $this->version,
                'all'
            );
            
            // Font Awesome for admin icon picker
            wp_enqueue_style(
                'font-awesome',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
                [],
                '6.4.0'
            );
        }
    }
    
    /**
     * Register the JavaScript for the admin area.
     */
    public function enqueue_scripts(): void {
        $screen = get_current_screen();
        
        if ($screen && strpos($screen->id, 'mobilemenu') !== false) {
            wp_enqueue_media(); // For SVG upload
            
            wp_enqueue_script(
                $this->plugin_name . '-admin',
                MOBILEMENU_PLUGIN_URL . 'assets/js/mobilemenu-admin.js',
                ['jquery', 'wp-color-picker'],
                $this->version,
                true
            );
            
            wp_localize_script(
                $this->plugin_name . '-admin',
                'mobilemenuAdmin',
                [
                    'ajaxUrl' => admin_url('admin-ajax.php'),
                    'nonce' => wp_create_nonce('mobilemenu_admin_nonce'),
                    'strings' => [
                        'saved' => __('Settings saved successfully!', 'mobilemenu'),
                        'error' => __('An error occurred. Please try again.', 'mobilemenu'),
                        'saving' => __('Saving...', 'mobilemenu'),
                    ]
                ]
            );
        }
    }
    
    /**
     * Add menu page to WordPress admin.
     */
    public function add_menu_page(): void {
        add_menu_page(
            __('Mobile Menu Settings', 'mobilemenu'),
            __('Mobile Menu', 'mobilemenu'),
            'manage_options',
            'mobilemenu',
            [$this, 'render_admin_page'],
            'dashicons-smartphone',
            65
        );
    }
    
    /**
     * Register plugin settings.
     */
    public function register_settings(): void {
        register_setting('mobilemenu_settings', 'mobilemenu_settings', [
            'sanitize_callback' => [$this, 'sanitize_settings']
        ]);
        
        register_setting('mobilemenu_menu_icons', 'mobilemenu_menu_icons', [
            'sanitize_callback' => [$this, 'sanitize_menu_icons']
        ]);
    }
    
    /**
     * Sanitize settings before saving.
     */
    public function sanitize_settings(array $input): array {
        $sanitized = [];
        
        // Boolean values
        $boolean_fields = [
            'enabled', 'enable_mobile', 'enable_tablet', 'close_on_outside_click',
            'close_on_anchor_click', 'prevent_body_scroll', 'show_close_button', 'blur_background'
        ];
        
        foreach ($boolean_fields as $field) {
            $sanitized[$field] = !empty($input[$field]);
        }
        
        // Integer values
        $sanitized['mobile_breakpoint'] = absint($input['mobile_breakpoint'] ?? 768);
        $sanitized['tablet_breakpoint'] = absint($input['tablet_breakpoint'] ?? 1024);
        $sanitized['menu_font_size'] = absint($input['menu_font_size'] ?? 18);
        $sanitized['animation_speed'] = absint($input['animation_speed'] ?? 300);
        
        // Color values
        $color_fields = [
            'hamburger_icon_color', 'hamburger_bg_color', 'menu_bg_color',
            'menu_text_color', 'menu_icon_color'
        ];
        
        foreach ($color_fields as $field) {
            $sanitized[$field] = sanitize_hex_color($input[$field] ?? '#000000');
        }
        
        // Text values
        $sanitized['menu_bg_gradient'] = sanitize_text_field($input['menu_bg_gradient'] ?? '');
        $sanitized['hamburger_position'] = sanitize_text_field($input['hamburger_position'] ?? 'top-right');
        $sanitized['icon_position'] = sanitize_text_field($input['icon_position'] ?? 'above');
        $sanitized['open_animation'] = sanitize_text_field($input['open_animation'] ?? 'slide-left');
        $sanitized['close_animation'] = sanitize_text_field($input['close_animation'] ?? 'slide-left');
        $sanitized['submenu_animation'] = sanitize_text_field($input['submenu_animation'] ?? 'accordion');
        $sanitized['animation_easing'] = sanitize_text_field($input['animation_easing'] ?? 'ease-in-out');
        $sanitized['default_icon_type'] = sanitize_text_field($input['default_icon_type'] ?? 'dashicons');
        $sanitized['default_icon'] = sanitize_text_field($input['default_icon'] ?? 'dashicons-admin-home');
        $sanitized['submenu_indicator'] = sanitize_text_field($input['submenu_indicator'] ?? 'chevron-down');
        
        // Array values
        $sanitized['selected_menus'] = isset($input['selected_menus']) && is_array($input['selected_menus'])
            ? array_map('sanitize_text_field', $input['selected_menus'])
            : [];
        
        return $sanitized;
    }
    
    /**
     * Sanitize menu icons before saving.
     */
    public function sanitize_menu_icons(array $input): array {
        $sanitized = [];
        
        foreach ($input as $menu_item_id => $icon_data) {
            $item_id = absint($menu_item_id);
            
            if ($item_id > 0 && is_array($icon_data)) {
                $sanitized[$item_id] = [
                    'type' => sanitize_text_field($icon_data['type'] ?? 'dashicons'),
                    'value' => sanitize_text_field($icon_data['value'] ?? ''),
                    'svg' => isset($icon_data['svg']) ? wp_kses_post($icon_data['svg']) : '',
                ];
            }
        }
        
        return $sanitized;
    }
    
    /**
     * Render the admin settings page.
     */
    public function render_admin_page(): void {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'mobilemenu'));
        }
        
        $settings = get_option('mobilemenu_settings', []);
        $menus = wp_get_nav_menus();
        
        include MOBILEMENU_PLUGIN_DIR . 'admin/partials/mobilemenu-admin-display.php';
    }
    
    /**
     * AJAX handler to save settings.
     */
    public function ajax_save_settings(): void {
        check_ajax_referer('mobilemenu_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => __('Permission denied.', 'mobilemenu')]);
        }
        
        $settings = isset($_POST['settings']) ? $_POST['settings'] : [];
        
        if (is_array($settings)) {
            $sanitized = $this->sanitize_settings($settings);
            update_option('mobilemenu_settings', $sanitized);
            
            wp_send_json_success(['message' => __('Settings saved successfully!', 'mobilemenu')]);
        }
        
        wp_send_json_error(['message' => __('Invalid data.', 'mobilemenu')]);
    }
    
    /**
     * AJAX handler to get menu items for a specific menu.
     */
    public function ajax_get_menu_items(): void {
        check_ajax_referer('mobilemenu_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => __('Permission denied.', 'mobilemenu')]);
        }
        
        $menu_id = isset($_POST['menu_id']) ? absint($_POST['menu_id']) : 0;
        
        if ($menu_id > 0) {
            $menu_items = wp_get_nav_menu_items($menu_id);
            
            if ($menu_items) {
                $items = [];
                foreach ($menu_items as $item) {
                    $items[] = [
                        'id' => $item->ID,
                        'title' => $item->title,
                        'parent' => $item->menu_item_parent,
                    ];
                }
                
                wp_send_json_success(['items' => $items]);
            }
        }
        
        wp_send_json_error(['message' => __('No menu items found.', 'mobilemenu')]);
    }
    
    /**
     * AJAX handler to save menu item icon.
     */
    public function ajax_save_menu_icon(): void {
        check_ajax_referer('mobilemenu_admin_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => __('Permission denied.', 'mobilemenu')]);
        }
        
        $menu_item_id = isset($_POST['menu_item_id']) ? absint($_POST['menu_item_id']) : 0;
        $icon_data = isset($_POST['icon_data']) ? $_POST['icon_data'] : [];
        
        if ($menu_item_id > 0 && is_array($icon_data)) {
            $menu_icons = get_option('mobilemenu_menu_icons', []);
            
            $menu_icons[$menu_item_id] = [
                'type' => sanitize_text_field($icon_data['type'] ?? 'dashicons'),
                'value' => sanitize_text_field($icon_data['value'] ?? ''),
                'svg' => isset($icon_data['svg']) ? wp_kses_post($icon_data['svg']) : '',
            ];
            
            update_option('mobilemenu_menu_icons', $menu_icons);
            
            wp_send_json_success(['message' => __('Icon saved successfully!', 'mobilemenu')]);
        }
        
        wp_send_json_error(['message' => __('Invalid data.', 'mobilemenu')]);
    }
}
