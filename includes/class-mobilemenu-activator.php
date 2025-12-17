<?php
/**
 * Fired during plugin activation.
 *
 * @package    MobileMenu
 * @subpackage MobileMenu/includes
 */

class MobileMenu_Activator {
    
    /**
     * Plugin activation tasks.
     *
     * @since    1.0.0
     */
    public static function activate(): void {
        // Set default options if they don't exist
        $default_options = [
            'enabled' => true,
            'mobile_breakpoint' => 768,
            'tablet_breakpoint' => 1024,
            'enable_mobile' => true,
            'enable_tablet' => true,
            'selected_menus' => [],
            'hamburger_position' => 'top-right',
            'hamburger_icon_color' => '#000000',
            'hamburger_bg_color' => '#ffffff',
            'menu_bg_color' => '#00bcd4',
            'menu_bg_gradient' => '',
            'menu_text_color' => '#ffffff',
            'menu_icon_color' => '#ffffff',
            'menu_font_size' => 18,
            'icon_position' => 'above',
            'open_animation' => 'slide-left',
            'close_animation' => 'slide-left',
            'submenu_animation' => 'accordion',
            'animation_speed' => 300,
            'animation_easing' => 'ease-in-out',
            'close_on_outside_click' => true,
            'close_on_anchor_click' => true,
            'prevent_body_scroll' => true,
            'show_close_button' => true,
            'blur_background' => false,
            'default_icon_type' => 'dashicons',
            'default_icon' => 'dashicons-admin-home',
            'submenu_indicator' => 'chevron-down',
        ];
        
        if (!get_option('mobilemenu_settings')) {
            add_option('mobilemenu_settings', $default_options);
        }
        
        // Create custom capability
        $role = get_role('administrator');
        if ($role) {
            $role->add_cap('manage_mobile_menu');
        }
        
        // Set activation timestamp
        add_option('mobilemenu_activated', time());
    }
}
