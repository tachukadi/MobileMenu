<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    MobileMenu
 * @subpackage MobileMenu/public
 */

class MobileMenu_Public {
    
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
     * Register the stylesheets for the public-facing side.
     */
    public function enqueue_styles(): void {
        $settings = get_option('mobilemenu_settings', []);
        
        if (empty($settings['enabled'])) {
            return;
        }
        
        // Only load on mobile/tablet devices
        if (!$this->should_display_menu()) {
            return;
        }
        
        // Enqueue Dashicons (WordPress built-in icons)
        wp_enqueue_style('dashicons');
        
        wp_enqueue_style(
            $this->plugin_name,
            MOBILEMENU_PLUGIN_URL . 'assets/css/mobilemenu-public.css',
            ['dashicons'],
            $this->version,
            'all'
        );
        
        // Font Awesome if needed
        $menu_icons = get_option('mobilemenu_menu_icons', []);
        $has_fontawesome = false;
        
        foreach ($menu_icons as $icon_data) {
            if (($icon_data['type'] ?? '') === 'fontawesome') {
                $has_fontawesome = true;
                break;
            }
        }
        
        if ($has_fontawesome) {
            wp_enqueue_style(
                'font-awesome',
                'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
                [],
                '6.4.0'
            );
        }
        
        // Add inline custom styles
        $this->add_custom_styles();
    }
    
    /**
     * Register the JavaScript for the public-facing side.
     */
    public function enqueue_scripts(): void {
        $settings = get_option('mobilemenu_settings', []);
        
        if (empty($settings['enabled'])) {
            return;
        }
        
        if (!$this->should_display_menu()) {
            return;
        }
        
        wp_enqueue_script(
            $this->plugin_name,
            MOBILEMENU_PLUGIN_URL . 'assets/js/mobilemenu-public.js',
            ['jquery'],
            $this->version,
            true
        );
        
        wp_localize_script(
            $this->plugin_name,
            'mobilemenuSettings',
            [
                'openAnimation' => $settings['open_animation'] ?? 'slide-left',
                'closeAnimation' => $settings['close_animation'] ?? $settings['open_animation'] ?? 'slide-left',
                'submenuAnimation' => $settings['submenu_animation'] ?? 'accordion',
                'animationSpeed' => absint($settings['animation_speed'] ?? 300),
                'animationEasing' => $settings['animation_easing'] ?? 'ease-in-out',
                'closeOnOutsideClick' => !empty($settings['close_on_outside_click']),
                'closeOnAnchorClick' => !empty($settings['close_on_anchor_click']),
                'preventBodyScroll' => !empty($settings['prevent_body_scroll']),
                'blurBackground' => !empty($settings['blur_background']),
                'openSubmenusByDefault' => !empty($settings['open_submenus_by_default']),
            ]
        );
    }
    
    /**
     * Check if mobile menu should be displayed.
     */
    private function should_display_menu(): bool {
        $settings = get_option('mobilemenu_settings', []);
        
        // Check if enabled
        if (empty($settings['enabled'])) {
            return false;
        }
        
        // Check breakpoints via CSS
        // The actual device detection is handled by CSS media queries
        // This function just ensures we're not on a page where it shouldn't show
        
        return true;
    }
    
    /**
     * Add custom inline styles.
     */
    private function add_custom_styles(): void {
        $settings = get_option('mobilemenu_settings', []);
        
        $css = "
        /* MobileMenu Custom Styles */
        
        /* Ensure Dashicons font is loaded */
        @font-face {
            font-family: 'dashicons';
            src: url('" . includes_url('fonts/dashicons.woff2') . "') format('woff2'),
                 url('" . includes_url('fonts/dashicons.woff') . "') format('woff'),
                 url('" . includes_url('fonts/dashicons.ttf') . "') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        
        .mobilemenu-icon .dashicons,
        .mobilemenu-icon .dashicons-before:before {
            font-family: dashicons;
            display: inline-block;
            line-height: 1;
            font-weight: 400;
            font-style: normal;
            speak: never;
            text-decoration: inherit;
            text-transform: none;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            width: 24px;
            height: 24px;
            font-size: 24px;
            vertical-align: top;
        }
        
        :root {
            --mobilemenu-hamburger-icon-color: " . esc_attr($settings['hamburger_icon_color'] ?? '#000000') . ";
            --mobilemenu-hamburger-bg-color: " . esc_attr($settings['hamburger_bg_color'] ?? '#ffffff') . ";
            --mobilemenu-bg-color: " . esc_attr($settings['menu_bg_color'] ?? '#00bcd4') . ";
            --mobilemenu-text-color: " . esc_attr($settings['menu_text_color'] ?? '#ffffff') . ";
            --mobilemenu-link-color: " . esc_attr($settings['menu_link_color'] ?? '#ffffff') . ";
            --mobilemenu-link-hover-color: " . esc_attr($settings['menu_link_hover_color'] ?? '#ffffff') . ";
            --mobilemenu-icon-color: " . esc_attr($settings['menu_icon_color'] ?? '#ffffff') . ";
            --mobilemenu-font-size: " . absint($settings['menu_font_size'] ?? 18) . "px;
            --mobilemenu-animation-speed: " . absint($settings['animation_speed'] ?? 300) . "ms;
            --mobilemenu-animation-easing: " . esc_attr($settings['animation_easing'] ?? 'ease-in-out') . ";
        }
        
        .mobilemenu-link {
            color: var(--mobilemenu-link-color) !important;
        }
        
        .mobilemenu-link:hover,
        .mobilemenu-link:focus {
            color: var(--mobilemenu-link-hover-color) !important;
        }
        ";
        
        // Add gradient if specified
        if (!empty($settings['menu_bg_gradient'])) {
            $css .= "
            .mobilemenu-container {
                background: " . esc_attr($settings['menu_bg_gradient']) . " !important;
            }
            ";
        }
        
        // Hamburger position
        $position = $settings['hamburger_position'] ?? 'top-right';
        $positions = [
            'top-left' => 'top: 20px; left: 20px;',
            'top-right' => 'top: 20px; right: 20px;',
            'bottom-left' => 'bottom: 20px; left: 20px;',
            'bottom-right' => 'bottom: 20px; right: 20px;',
        ];
        
        $css .= "
        .mobilemenu-hamburger {
            {$positions[$position]}
        }
        ";
        
        // Menu alignment
        $menu_alignment = $settings['menu_alignment'] ?? 'center';
        $css .= "
        .mobilemenu-list {
            text-align: {$menu_alignment};
        }
        ";
        
        // Icon position
        $icon_position = $settings['icon_position'] ?? 'above';
        $icon_vertical_position = $settings['icon_vertical_position'] ?? 'center';
        $menu_alignment = $settings['menu_alignment'] ?? 'center';
        
        // Menu alignment
        $css .= "
        .mobilemenu-list {
            text-align: {$menu_alignment};
        }
        ";
        
        // Icon horizontal position
        if ($icon_position === 'above') {
            $css .= "
            .mobilemenu-item-content {
                flex-direction: column;
            }
            ";
        } elseif ($icon_position === 'left') {
            $css .= "
            .mobilemenu-item-content {
                flex-direction: row;
            }
            ";
        } elseif ($icon_position === 'right') {
            $css .= "
            .mobilemenu-item-content {
                flex-direction: row-reverse;
            }
            ";
        }
        
        // Icon vertical alignment (only applies when icon is left or right)
        if ($icon_position !== 'above') {
            $align_items = $icon_vertical_position === 'top' ? 'flex-start' : ($icon_vertical_position === 'bottom' ? 'flex-end' : 'center');
            $css .= "
            .mobilemenu-item-content {
                align-items: {$align_items};
            }
            ";
        }
        
        // Icon vertical position
        $icon_vertical_position = $settings['icon_vertical_position'] ?? 'center';
        $alignments = [
            'top' => 'flex-start',
            'center' => 'center',
            'bottom' => 'flex-end',
        ];
        $css .= "
        .mobilemenu-item-content {
            align-items: {$alignments[$icon_vertical_position]};
        }
        ";
        
        // Logo width
        if (!empty($settings['logo_image'])) {
            $logo_width = absint($settings['logo_width'] ?? 150);
            $css .= "
            .mobilemenu-logo img {
                max-width: {$logo_width}px;
            }
            ";
        }
        
        // Responsive breakpoints
        $mobile_breakpoint = absint($settings['mobile_breakpoint'] ?? 768);
        $tablet_breakpoint = absint($settings['tablet_breakpoint'] ?? 1024);
        $enable_mobile = !empty($settings['enable_mobile']);
        $enable_tablet = !empty($settings['enable_tablet']);
        
        if (!$enable_mobile && !$enable_tablet) {
            $css .= "
            .mobilemenu-hamburger,
            .mobilemenu-container {
                display: none !important;
            }
            ";
        } elseif ($enable_mobile && !$enable_tablet) {
            $css .= "
            @media (min-width: {$mobile_breakpoint}px) {
                .mobilemenu-hamburger,
                .mobilemenu-container {
                    display: none !important;
                }
            }
            ";
        } elseif (!$enable_mobile && $enable_tablet) {
            $css .= "
            @media (max-width: " . ($mobile_breakpoint - 1) . "px) {
                .mobilemenu-hamburger,
                .mobilemenu-container {
                    display: none !important;
                }
            }
            @media (min-width: {$tablet_breakpoint}px) {
                .mobilemenu-hamburger,
                .mobilemenu-container {
                    display: none !important;
                }
            }
            ";
        } else {
            // Both enabled
            $css .= "
            @media (min-width: {$tablet_breakpoint}px) {
                .mobilemenu-hamburger,
                .mobilemenu-container {
                    display: none !important;
                }
            }
            ";
        }
        
        wp_add_inline_style($this->plugin_name, $css);
    }
    
    /**
     * Render the mobile menu HTML.
     */
    public function render_mobile_menu(): void {
        $settings = get_option('mobilemenu_settings', []);
        
        if (empty($settings['enabled'])) {
            return;
        }
        
        $selected_menus = $settings['selected_menus'] ?? [];
        if (empty($selected_menus)) {
            return;
        }
        
        $menu_icons = get_option('mobilemenu_menu_icons', []);
        $show_close_button = !empty($settings['show_close_button']);
        $submenu_indicator = $settings['submenu_indicator'] ?? 'chevron-down';
        
        ?>
        <!-- MobileMenu -->
        <button class="mobilemenu-hamburger" aria-label="<?php esc_attr_e('Open Menu', 'mobilemenu'); ?>">
            <span class="mobilemenu-hamburger-line"></span>
            <span class="mobilemenu-hamburger-line"></span>
            <span class="mobilemenu-hamburger-line"></span>
        </button>
        
        <div class="mobilemenu-overlay"></div>
        
        <nav class="mobilemenu-container" aria-label="<?php esc_attr_e('Mobile Navigation', 'mobilemenu'); ?>">
            <?php if ($show_close_button) : ?>
                <button class="mobilemenu-close" aria-label="<?php esc_attr_e('Close Menu', 'mobilemenu'); ?>">
                    <span>&times;</span>
                </button>
            <?php endif; ?>
            
            <?php if (!empty($settings['logo_image'])) : ?>
                <div class="mobilemenu-logo">
                    <img src="<?php echo esc_url($settings['logo_image']); ?>" 
                        alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                        style="max-width: <?php echo absint($settings['logo_width'] ?? 150); ?>px;">
                </div>
            <?php endif; ?>
            
            <div class="mobilemenu-content">
                <?php 
                // Display logo if set
                $logo_image = $settings['logo_image'] ?? '';
                if (!empty($logo_image)) : 
                ?>
                    <div class="mobilemenu-logo">
                        <img src="<?php echo esc_url($logo_image); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    </div>
                <?php endif; ?>
                
                <?php
                foreach ($selected_menus as $menu_id) {
                    $menu_items = wp_get_nav_menu_items($menu_id);
                    
                    if ($menu_items) {
                        $this->render_menu_items($menu_items, $menu_icons, $submenu_indicator);
                    }
                }
                ?>
            </div>
        </nav>
        <?php
    }
    
    /**
     * Render menu items recursively.
     */
    private function render_menu_items(array $items, array $menu_icons, string $submenu_indicator, int $parent_id = 0): void {
        $children = array_filter($items, function($item) use ($parent_id) {
            return (int)$item->menu_item_parent === $parent_id;
        });
        
        if (empty($children)) {
            return;
        }
        
        echo '<ul class="mobilemenu-list">';
        
        foreach ($children as $item) {
            $has_children = $this->has_children($items, $item->ID);
            $icon_data = $menu_icons[$item->ID] ?? [];
            $item_classes = ['mobilemenu-item'];
            
            if ($has_children) {
                $item_classes[] = 'has-submenu';
            }
            
            // Check if link is an anchor
            $is_anchor = strpos($item->url, '#') !== false;
            if ($is_anchor) {
                $item_classes[] = 'is-anchor';
            }
            
            echo '<li class="' . esc_attr(implode(' ', $item_classes)) . '">';
            
            echo '<div class="mobilemenu-item-wrapper">';
            echo '<a href="' . esc_url($item->url) . '" class="mobilemenu-link">';
            echo '<span class="mobilemenu-item-content">';
            
            // Render icon
            if (!empty($icon_data['type'])) {
                echo '<span class="mobilemenu-icon">';
                
                if ($icon_data['type'] === 'dashicons' && !empty($icon_data['value'])) {
                    echo '<span class="dashicons ' . esc_attr($icon_data['value']) . '"></span>';
                } elseif ($icon_data['type'] === 'fontawesome' && !empty($icon_data['value'])) {
                    echo '<i class="' . esc_attr($icon_data['value']) . '"></i>';
                } elseif ($icon_data['type'] === 'svg' && !empty($icon_data['svg'])) {
                    echo wp_kses_post($icon_data['svg']);
                }
                
                echo '</span>';
            }
            
            echo '<span class="mobilemenu-text">' . wp_kses_post($item->title) . '</span>';
            echo '</span>'; // .mobilemenu-item-content
            echo '</a>';
            
            if ($has_children) {
                echo '<button class="mobilemenu-submenu-toggle" aria-label="' . esc_attr__('Toggle submenu', 'mobilemenu') . '">';
                
                if ($submenu_indicator === 'chevron-down') {
                    echo '<span class="dashicons dashicons-arrow-down-alt2"></span>';
                } elseif ($submenu_indicator === 'plus') {
                    echo '<span class="dashicons dashicons-plus-alt2"></span>';
                } else {
                    echo '<span class="dashicons dashicons-arrow-right-alt2"></span>';
                }
                
                echo '</button>';
            }
            
            echo '</div>'; // .mobilemenu-item-wrapper
            
            if ($has_children) {
                $this->render_menu_items($items, $menu_icons, $submenu_indicator, $item->ID);
            }
            
            echo '</li>';
        }
        
        echo '</ul>';
    }
    
    /**
     * Check if menu item has children.
     */
    private function has_children(array $items, int $parent_id): bool {
        foreach ($items as $item) {
            if ((int)$item->menu_item_parent === $parent_id) {
                return true;
            }
        }
        return false;
    }
}
