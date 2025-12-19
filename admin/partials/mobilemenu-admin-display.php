<?php
/**
 * Admin settings page template.
 *
 * @package    MobileMenu
 * @subpackage MobileMenu/admin/partials
 */

if (!defined('ABSPATH')) {
    exit;
}

$menu_icons = get_option('mobilemenu_menu_icons', []);
?>

<div class="wrap mobilemenu-admin-wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <div class="mobilemenu-admin-notice" style="display:none;">
        <p></p>
    </div>
    
    <form id="mobilemenu-settings-form" method="post" action="options.php">
        <?php settings_fields('mobilemenu_settings'); ?>
        
        <div class="mobilemenu-tabs">
            <nav class="mobilemenu-tabs-nav">
                <button type="button" class="mobilemenu-tab-button active" data-tab="general">
                    <span class="dashicons dashicons-admin-generic"></span>
                    <?php _e('General Settings', 'mobilemenu'); ?>
                </button>
                <button type="button" class="mobilemenu-tab-button" data-tab="menus">
                    <span class="dashicons dashicons-menu-alt"></span>
                    <?php _e('Menu Selection', 'mobilemenu'); ?>
                </button>
                <button type="button" class="mobilemenu-tab-button" data-tab="icons">
                    <span class="dashicons dashicons-star-filled"></span>
                    <?php _e('Menu Icons', 'mobilemenu'); ?>
                </button>
                <button type="button" class="mobilemenu-tab-button" data-tab="animations">
                    <span class="dashicons dashicons-format-video"></span>
                    <?php _e('Animations', 'mobilemenu'); ?>
                </button>
                <button type="button" class="mobilemenu-tab-button" data-tab="styling">
                    <span class="dashicons dashicons-art"></span>
                    <?php _e('Colors & Styling', 'mobilemenu'); ?>
                </button>
                <button type="button" class="mobilemenu-tab-button" data-tab="behavior">
                    <span class="dashicons dashicons-admin-settings"></span>
                    <?php _e('Behavior', 'mobilemenu'); ?>
                </button>
            </nav>
            
            <!-- General Settings Tab -->
            <div class="mobilemenu-tab-content active" data-tab="general">
                <h2><?php _e('General Settings', 'mobilemenu'); ?></h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="enabled"><?php _e('Enable Mobile Menu', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <label class="mobilemenu-switch">
                                <input type="checkbox" name="mobilemenu_settings[enabled]" id="enabled" 
                                    value="1" <?php checked($settings['enabled'] ?? true, true); ?>>
                                <span class="mobilemenu-slider"></span>
                            </label>
                            <p class="description"><?php _e('Turn the mobile menu on or off globally.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="enable_mobile"><?php _e('Enable on Mobile', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <label class="mobilemenu-switch">
                                <input type="checkbox" name="mobilemenu_settings[enable_mobile]" id="enable_mobile" 
                                    value="1" <?php checked($settings['enable_mobile'] ?? true, true); ?>>
                                <span class="mobilemenu-slider"></span>
                            </label>
                            <p class="description"><?php _e('Show mobile menu on mobile devices.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="mobile_breakpoint"><?php _e('Mobile Breakpoint (px)', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="number" name="mobilemenu_settings[mobile_breakpoint]" id="mobile_breakpoint" 
                                value="<?php echo esc_attr($settings['mobile_breakpoint'] ?? 768); ?>" 
                                min="320" max="1024" class="small-text">
                            <p class="description"><?php _e('Screen width below which mobile menu appears.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="enable_tablet"><?php _e('Enable on Tablet', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <label class="mobilemenu-switch">
                                <input type="checkbox" name="mobilemenu_settings[enable_tablet]" id="enable_tablet" 
                                    value="1" <?php checked($settings['enable_tablet'] ?? true, true); ?>>
                                <span class="mobilemenu-slider"></span>
                            </label>
                            <p class="description"><?php _e('Show mobile menu on tablet devices.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="tablet_breakpoint"><?php _e('Tablet Breakpoint (px)', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="number" name="mobilemenu_settings[tablet_breakpoint]" id="tablet_breakpoint" 
                                value="<?php echo esc_attr($settings['tablet_breakpoint'] ?? 1024); ?>" 
                                min="768" max="1280" class="small-text">
                            <p class="description"><?php _e('Screen width below which tablet menu appears.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="hamburger_position"><?php _e('Hamburger Icon Position', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[hamburger_position]" id="hamburger_position">
                                <option value="top-left" <?php selected($settings['hamburger_position'] ?? 'top-right', 'top-left'); ?>>
                                    <?php _e('Top Left', 'mobilemenu'); ?>
                                </option>
                                <option value="top-right" <?php selected($settings['hamburger_position'] ?? 'top-right', 'top-right'); ?>>
                                    <?php _e('Top Right', 'mobilemenu'); ?>
                                </option>
                                <option value="bottom-left" <?php selected($settings['hamburger_position'] ?? 'top-right', 'bottom-left'); ?>>
                                    <?php _e('Bottom Left', 'mobilemenu'); ?>
                                </option>
                                <option value="bottom-right" <?php selected($settings['hamburger_position'] ?? 'top-right', 'bottom-right'); ?>>
                                    <?php _e('Bottom Right', 'mobilemenu'); ?>
                                </option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Menu Selection Tab -->
            <div class="mobilemenu-tab-content" data-tab="menus">
                <h2><?php _e('Select Menus to Display', 'mobilemenu'); ?></h2>
                
                <?php if (empty($menus)) : ?>
                    <div class="notice notice-warning inline">
                        <p>
                            <?php _e('No menus found. Please create a menu first in', 'mobilemenu'); ?>
                            <a href="<?php echo admin_url('nav-menus.php'); ?>"><?php _e('Appearance → Menus', 'mobilemenu'); ?></a>
                        </p>
                    </div>
                <?php else : ?>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('Available Menus', 'mobilemenu'); ?></th>
                            <td>
                                <?php
                                $selected_menus = $settings['selected_menus'] ?? [];
                                foreach ($menus as $menu) :
                                    $checked = in_array($menu->term_id, $selected_menus);
                                ?>
                                    <label style="display: block; margin-bottom: 10px;">
                                        <input type="checkbox" name="mobilemenu_settings[selected_menus][]" 
                                            value="<?php echo esc_attr($menu->term_id); ?>"
                                            <?php checked($checked); ?>>
                                        <strong><?php echo esc_html($menu->name); ?></strong>
                                        <span class="description">(<?php echo esc_html($menu->count); ?> <?php _e('items', 'mobilemenu'); ?>)</span>
                                    </label>
                                <?php endforeach; ?>
                                <p class="description"><?php _e('Select one or more menus to display in the mobile menu.', 'mobilemenu'); ?></p>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>
            
            <!-- Menu Icons Tab -->
            <div class="mobilemenu-tab-content" data-tab="icons">
                <h2><?php _e('Configure Menu Item Icons', 'mobilemenu'); ?></h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="icon_position"><?php _e('Icon Position', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[icon_position]" id="icon_position">
                                <option value="above" <?php selected($settings['icon_position'] ?? 'above', 'above'); ?>>
                                    <?php _e('Above Text', 'mobilemenu'); ?>
                                </option>
                                <option value="left" <?php selected($settings['icon_position'] ?? 'above', 'left'); ?>>
                                    <?php _e('Left of Text', 'mobilemenu'); ?>
                                </option>
                                <option value="right" <?php selected($settings['icon_position'] ?? 'above', 'right'); ?>>
                                    <?php _e('Right of Text', 'mobilemenu'); ?>
                                </option>
                            </select>
                            <p class="description"><?php _e('Horizontal position of icon relative to text.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="icon_vertical_position"><?php _e('Icon Vertical Position', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[icon_vertical_position]" id="icon_vertical_position">
                                <option value="top" <?php selected($settings['icon_vertical_position'] ?? 'center', 'top'); ?>>
                                    <?php _e('Top', 'mobilemenu'); ?>
                                </option>
                                <option value="center" <?php selected($settings['icon_vertical_position'] ?? 'center', 'center'); ?>>
                                    <?php _e('Center', 'mobilemenu'); ?>
                                </option>
                                <option value="bottom" <?php selected($settings['icon_vertical_position'] ?? 'center', 'bottom'); ?>>
                                    <?php _e('Bottom', 'mobilemenu'); ?>
                                </option>
                            </select>
                            <p class="description"><?php _e('Vertical alignment of icon when positioned left or right.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="default_icon_type"><?php _e('Default Icon Type', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[default_icon_type]" id="default_icon_type">
                                <option value="dashicons" <?php selected($settings['default_icon_type'] ?? 'dashicons', 'dashicons'); ?>>
                                    <?php _e('Dashicons', 'mobilemenu'); ?>
                                </option>
                                <option value="fontawesome" <?php selected($settings['default_icon_type'] ?? 'dashicons', 'fontawesome'); ?>>
                                    <?php _e('Font Awesome', 'mobilemenu'); ?>
                                </option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="submenu_indicator"><?php _e('Submenu Indicator', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[submenu_indicator]" id="submenu_indicator">
                                <option value="chevron-down" <?php selected($settings['submenu_indicator'] ?? 'chevron-down', 'chevron-down'); ?>>
                                    <?php _e('Chevron Down', 'mobilemenu'); ?>
                                </option>
                                <option value="plus" <?php selected($settings['submenu_indicator'] ?? 'chevron-down', 'plus'); ?>>
                                    <?php _e('Plus Icon', 'mobilemenu'); ?>
                                </option>
                                <option value="arrow" <?php selected($settings['submenu_indicator'] ?? 'chevron-down', 'arrow'); ?>>
                                    <?php _e('Arrow', 'mobilemenu'); ?>
                                </option>
                            </select>
                        </td>
                    </tr>
                </table>
                
                <div class="mobilemenu-icon-manager">
                    <h3><?php _e('Menu Item Icons', 'mobilemenu'); ?></h3>
                    
                    <?php
                    $selected_menus = $settings['selected_menus'] ?? [];
                    if (!empty($selected_menus)) :
                        foreach ($selected_menus as $menu_id) :
                            $menu = wp_get_nav_menu_object($menu_id);
                            if ($menu) :
                                $menu_items = wp_get_nav_menu_items($menu_id);
                    ?>
                                <div class="mobilemenu-menu-section">
                                    <h4><?php echo esc_html($menu->name); ?></h4>
                                    <div class="mobilemenu-menu-items">
                                        <?php
                                        foreach ($menu_items as $item) :
                                            $icon_data = $menu_icons[$item->ID] ?? [];
                                            $icon_type = $icon_data['type'] ?? 'dashicons';
                                            $icon_value = $icon_data['value'] ?? 'dashicons-admin-home';
                                        ?>
                                            <div class="mobilemenu-menu-item" data-item-id="<?php echo esc_attr($item->ID); ?>">
                                                <div class="mobilemenu-item-info">
                                                    <span class="mobilemenu-item-title"><?php echo esc_html($item->title); ?></span>
                                                    <?php if ($item->menu_item_parent > 0) : ?>
                                                        <span class="mobilemenu-item-badge"><?php _e('Sub-item', 'mobilemenu'); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mobilemenu-item-icon-picker">
                                                    <button type="button" class="button mobilemenu-icon-select-btn">
                                                        <span class="mobilemenu-current-icon">
                                                            <?php if ($icon_type === 'dashicons') : ?>
                                                                <span class="dashicons <?php echo esc_attr($icon_value); ?>"></span>
                                                            <?php elseif ($icon_type === 'fontawesome') : ?>
                                                                <i class="<?php echo esc_attr($icon_value); ?>"></i>
                                                            <?php elseif ($icon_type === 'svg' && !empty($icon_data['svg'])) : ?>
                                                                <?php echo wp_kses_post($icon_data['svg']); ?>
                                                            <?php endif; ?>
                                                        </span>
                                                        <?php _e('Change Icon', 'mobilemenu'); ?>
                                                    </button>
                                                    <input type="hidden" class="mobilemenu-icon-type" value="<?php echo esc_attr($icon_type); ?>">
                                                    <input type="hidden" class="mobilemenu-icon-value" value="<?php echo esc_attr($icon_value); ?>">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                    <?php
                            endif;
                        endforeach;
                    else :
                    ?>
                        <p class="description"><?php _e('Please select a menu in the Menu Selection tab first.', 'mobilemenu'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Animations Tab -->
            <div class="mobilemenu-tab-content" data-tab="animations">
                <h2><?php _e('Animation Settings', 'mobilemenu'); ?></h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="open_animation"><?php _e('Menu Open Animation', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[open_animation]" id="open_animation" class="regular-text">
                                <option value="slide-left" <?php selected($settings['open_animation'] ?? 'slide-left', 'slide-left'); ?>>
                                    <?php _e('Slide from Left', 'mobilemenu'); ?>
                                </option>
                                <option value="slide-right" <?php selected($settings['open_animation'] ?? 'slide-left', 'slide-right'); ?>>
                                    <?php _e('Slide from Right', 'mobilemenu'); ?>
                                </option>
                                <option value="slide-bottom" <?php selected($settings['open_animation'] ?? 'slide-left', 'slide-bottom'); ?>>
                                    <?php _e('Slide from Bottom', 'mobilemenu'); ?>
                                </option>
                                <option value="fade" <?php selected($settings['open_animation'] ?? 'slide-left', 'fade'); ?>>
                                    <?php _e('Fade In', 'mobilemenu'); ?>
                                </option>
                                <option value="scale" <?php selected($settings['open_animation'] ?? 'slide-left', 'scale'); ?>>
                                    <?php _e('Scale Up', 'mobilemenu'); ?>
                                </option>
                                <option value="zoom-fade" <?php selected($settings['open_animation'] ?? 'slide-left', 'zoom-fade'); ?>>
                                    <?php _e('Zoom & Fade', 'mobilemenu'); ?>
                                </option>
                                <option value="flip" <?php selected($settings['open_animation'] ?? 'slide-left', 'flip'); ?>>
                                    <?php _e('Flip (3D)', 'mobilemenu'); ?>
                                </option>
                                <option value="push" <?php selected($settings['open_animation'] ?? 'slide-left', 'push'); ?>>
                                    <?php _e('Push Content', 'mobilemenu'); ?>
                                </option>
                            </select>
                            <p class="description"><?php _e('Animation effect when opening the menu.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="submenu_animation"><?php _e('Submenu Animation', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[submenu_animation]" id="submenu_animation" class="regular-text">
                                <option value="accordion" <?php selected($settings['submenu_animation'] ?? 'accordion', 'accordion'); ?>>
                                    <?php _e('Accordion Slide', 'mobilemenu'); ?>
                                </option>
                                <option value="fade-slide" <?php selected($settings['submenu_animation'] ?? 'accordion', 'fade-slide'); ?>>
                                    <?php _e('Fade + Slide', 'mobilemenu'); ?>
                                </option>
                                <option value="scale-y" <?php selected($settings['submenu_animation'] ?? 'accordion', 'scale-y'); ?>>
                                    <?php _e('Scale Y Expand', 'mobilemenu'); ?>
                                </option>
                            </select>
                            <p class="description"><?php _e('Animation effect when expanding submenus.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="animation_speed"><?php _e('Animation Speed (ms)', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="number" name="mobilemenu_settings[animation_speed]" id="animation_speed" 
                                value="<?php echo esc_attr($settings['animation_speed'] ?? 300); ?>" 
                                min="100" max="1000" step="50" class="small-text">
                            <p class="description"><?php _e('Duration of animations in milliseconds.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="animation_easing"><?php _e('Animation Easing', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[animation_easing]" id="animation_easing">
                                <option value="linear" <?php selected($settings['animation_easing'] ?? 'ease-in-out', 'linear'); ?>>
                                    <?php _e('Linear', 'mobilemenu'); ?>
                                </option>
                                <option value="ease" <?php selected($settings['animation_easing'] ?? 'ease-in-out', 'ease'); ?>>
                                    <?php _e('Ease', 'mobilemenu'); ?>
                                </option>
                                <option value="ease-in" <?php selected($settings['animation_easing'] ?? 'ease-in-out', 'ease-in'); ?>>
                                    <?php _e('Ease In', 'mobilemenu'); ?>
                                </option>
                                <option value="ease-out" <?php selected($settings['animation_easing'] ?? 'ease-in-out', 'ease-out'); ?>>
                                    <?php _e('Ease Out', 'mobilemenu'); ?>
                                </option>
                                <option value="ease-in-out" <?php selected($settings['animation_easing'] ?? 'ease-in-out', 'ease-in-out'); ?>>
                                    <?php _e('Ease In-Out', 'mobilemenu'); ?>
                                </option>
                                <option value="cubic-bezier(0.68, -0.55, 0.265, 1.55)" <?php selected($settings['animation_easing'] ?? 'ease-in-out', 'cubic-bezier(0.68, -0.55, 0.265, 1.55)'); ?>>
                                    <?php _e('Back Ease', 'mobilemenu'); ?>
                                </option>
                            </select>
                            <p class="description"><?php _e('Timing function for animations.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Colors & Styling Tab -->
            <div class="mobilemenu-tab-content" data-tab="styling">
                <h2><?php _e('Colors & Styling', 'mobilemenu'); ?></h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="row" colspan="2">
                            <h3><?php _e('Logo', 'mobilemenu'); ?></h3>
                        </th>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="logo_image"><?php _e('Logo Image', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="mobilemenu_settings[logo_image]" 
                                id="logo_image" 
                                value="<?php echo esc_url($settings['logo_image'] ?? ''); ?>" 
                                class="regular-text">
                            <button type="button" class="button" id="mobilemenu-upload-logo">
                                <?php _e('Upload Logo', 'mobilemenu'); ?>
                            </button>
                            <button type="button" class="button" id="mobilemenu-remove-logo">
                                <?php _e('Remove', 'mobilemenu'); ?>
                            </button>
                            <p class="description"><?php _e('Upload a logo to display at the top of the mobile menu. Leave empty to hide.', 'mobilemenu'); ?></p>
                            <?php if (!empty($settings['logo_image'])) : ?>
                                <div id="logo-preview" style="margin-top: 10px;">
                                    <img src="<?php echo esc_url($settings['logo_image']); ?>" 
                                        style="max-width: 150px; height: auto; display: block;">
                                </div>
                            <?php else : ?>
                                <div id="logo-preview" style="display: none; margin-top: 10px;"></div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="logo_width"><?php _e('Logo Width (px)', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="number" name="mobilemenu_settings[logo_width]" 
                                id="logo_width" 
                                value="<?php echo esc_attr($settings['logo_width'] ?? 150); ?>" 
                                min="50" max="300" class="small-text">
                            <p class="description"><?php _e('Maximum width of the logo image.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row" colspan="2">
                            <h3><?php _e('Hamburger Icon', 'mobilemenu'); ?></h3>
                        </th>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="hamburger_icon_color"><?php _e('Icon Color', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="mobilemenu_settings[hamburger_icon_color]" 
                                id="hamburger_icon_color" 
                                value="<?php echo esc_attr($settings['hamburger_icon_color'] ?? '#000000'); ?>" 
                                class="mobilemenu-color-picker">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="hamburger_bg_color"><?php _e('Background Color', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="mobilemenu_settings[hamburger_bg_color]" 
                                id="hamburger_bg_color" 
                                value="<?php echo esc_attr($settings['hamburger_bg_color'] ?? '#ffffff'); ?>" 
                                class="mobilemenu-color-picker">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row" colspan="2">
                            <h3><?php _e('Menu Appearance', 'mobilemenu'); ?></h3>
                        </th>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="menu_alignment"><?php _e('Menu Alignment', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[menu_alignment]" id="menu_alignment">
                                <option value="left" <?php selected($settings['menu_alignment'] ?? 'center', 'left'); ?>>
                                    <?php _e('Left', 'mobilemenu'); ?>
                                </option>
                                <option value="center" <?php selected($settings['menu_alignment'] ?? 'center', 'center'); ?>>
                                    <?php _e('Center', 'mobilemenu'); ?>
                                </option>
                                <option value="right" <?php selected($settings['menu_alignment'] ?? 'center', 'right'); ?>>
                                    <?php _e('Right', 'mobilemenu'); ?>
                                </option>
                            </select>
                            <p class="description"><?php _e('Text alignment for menu items.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="menu_bg_color"><?php _e('Background Color', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="mobilemenu_settings[menu_bg_color]" 
                                id="menu_bg_color" 
                                value="<?php echo esc_attr($settings['menu_bg_color'] ?? '#00bcd4'); ?>" 
                                class="mobilemenu-color-picker">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="menu_bg_gradient"><?php _e('Background Gradient', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="mobilemenu_settings[menu_bg_gradient]" 
                                id="menu_bg_gradient" 
                                value="<?php echo esc_attr($settings['menu_bg_gradient'] ?? ''); ?>" 
                                class="regular-text"
                                placeholder="linear-gradient(135deg, #667eea 0%, #764ba2 100%)">
                            <p class="description">
                                <?php _e('Optional CSS gradient. Example: linear-gradient(135deg, #667eea 0%, #764ba2 100%)', 'mobilemenu'); ?>
                            </p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="menu_text_color"><?php _e('Text Color', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="mobilemenu_settings[menu_text_color]" 
                                id="menu_text_color" 
                                value="<?php echo esc_attr($settings['menu_text_color'] ?? '#ffffff'); ?>" 
                                class="mobilemenu-color-picker">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="menu_link_color"><?php _e('Link Color', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="mobilemenu_settings[menu_link_color]" 
                                id="menu_link_color" 
                                value="<?php echo esc_attr($settings['menu_link_color'] ?? '#ffffff'); ?>" 
                                class="mobilemenu-color-picker">
                            <p class="description"><?php _e('Color for menu item links.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="menu_link_hover_color"><?php _e('Link Hover Color', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="mobilemenu_settings[menu_link_hover_color]" 
                                id="menu_link_hover_color" 
                                value="<?php echo esc_attr($settings['menu_link_hover_color'] ?? '#ffffff'); ?>" 
                                class="mobilemenu-color-picker">
                            <p class="description"><?php _e('Color for menu item links on hover.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="menu_icon_color"><?php _e('Icon Color', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="text" name="mobilemenu_settings[menu_icon_color]" 
                                id="menu_icon_color" 
                                value="<?php echo esc_attr($settings['menu_icon_color'] ?? '#ffffff'); ?>" 
                                class="mobilemenu-color-picker">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="menu_font_size"><?php _e('Font Size (px)', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <input type="number" name="mobilemenu_settings[menu_font_size]" 
                                id="menu_font_size" 
                                value="<?php echo esc_attr($settings['menu_font_size'] ?? 18); ?>" 
                                min="12" max="32" class="small-text">
                            <p class="description"><?php _e('Font size for menu items.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row" colspan="2">
                            <h3><?php _e('Icon Settings', 'mobilemenu'); ?></h3>
                        </th>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="icon_vertical_position"><?php _e('Icon Vertical Position', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <select name="mobilemenu_settings[icon_vertical_position]" id="icon_vertical_position">
                                <option value="top" <?php selected($settings['icon_vertical_position'] ?? 'center', 'top'); ?>>
                                    <?php _e('Top', 'mobilemenu'); ?>
                                </option>
                                <option value="center" <?php selected($settings['icon_vertical_position'] ?? 'center', 'center'); ?>>
                                    <?php _e('Center (Default)', 'mobilemenu'); ?>
                                </option>
                                <option value="bottom" <?php selected($settings['icon_vertical_position'] ?? 'center', 'bottom'); ?>>
                                    <?php _e('Bottom', 'mobilemenu'); ?>
                                </option>
                            </select>
                            <p class="description"><?php _e('Vertical alignment of icons relative to text.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Behavior Tab -->
            <div class="mobilemenu-tab-content" data-tab="behavior">
                <h2><?php _e('Menu Behavior', 'mobilemenu'); ?></h2>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="open_submenus_by_default"><?php _e('Open Submenus by Default', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <label class="mobilemenu-switch">
                                <input type="checkbox" name="mobilemenu_settings[open_submenus_by_default]" 
                                    id="open_submenus_by_default" 
                                    value="1" <?php checked($settings['open_submenus_by_default'] ?? false, true); ?>>
                                <span class="mobilemenu-slider"></span>
                            </label>
                            <p class="description"><?php _e('Keep all submenus expanded by default when menu opens. When disabled, users must click parent items to expand submenus.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="show_close_button"><?php _e('Show Close Button', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <label class="mobilemenu-switch">
                                <input type="checkbox" name="mobilemenu_settings[show_close_button]" 
                                    id="show_close_button" 
                                    value="1" <?php checked($settings['show_close_button'] ?? true, true); ?>>
                                <span class="mobilemenu-slider"></span>
                            </label>
                            <p class="description"><?php _e('Display X button at the top-right of the menu.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="close_on_outside_click"><?php _e('Close on Outside Click', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <label class="mobilemenu-switch">
                                <input type="checkbox" name="mobilemenu_settings[close_on_outside_click]" 
                                    id="close_on_outside_click" 
                                    value="1" <?php checked($settings['close_on_outside_click'] ?? true, true); ?>>
                                <span class="mobilemenu-slider"></span>
                            </label>
                            <p class="description"><?php _e('Close menu when clicking outside of it.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="close_on_anchor_click"><?php _e('Close on Anchor Link Click', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <label class="mobilemenu-switch">
                                <input type="checkbox" name="mobilemenu_settings[close_on_anchor_click]" 
                                    id="close_on_anchor_click" 
                                    value="1" <?php checked($settings['close_on_anchor_click'] ?? true, true); ?>>
                                <span class="mobilemenu-slider"></span>
                            </label>
                            <p class="description"><?php _e('Automatically close menu when clicking anchor links (#section).', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="prevent_body_scroll"><?php _e('Prevent Background Scroll', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <label class="mobilemenu-switch">
                                <input type="checkbox" name="mobilemenu_settings[prevent_body_scroll]" 
                                    id="prevent_body_scroll" 
                                    value="1" <?php checked($settings['prevent_body_scroll'] ?? true, true); ?>>
                                <span class="mobilemenu-slider"></span>
                            </label>
                            <p class="description"><?php _e('Disable scrolling on the page when menu is open.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="blur_background"><?php _e('Blur Background', 'mobilemenu'); ?></label>
                        </th>
                        <td>
                            <label class="mobilemenu-switch">
                                <input type="checkbox" name="mobilemenu_settings[blur_background]" 
                                    id="blur_background" 
                                    value="1" <?php checked($settings['blur_background'] ?? false, true); ?>>
                                <span class="mobilemenu-slider"></span>
                            </label>
                            <p class="description"><?php _e('Apply blur effect to page content when menu is open.', 'mobilemenu'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <p class="submit">
            <button type="submit" class="button button-primary button-large" id="mobilemenu-save-button">
                <span class="dashicons dashicons-saved"></span>
                <?php _e('Save Settings', 'mobilemenu'); ?>
            </button>
        </p>
    </form>
</div>

<!-- Icon Picker Modal -->
<div id="mobilemenu-icon-picker-modal" class="mobilemenu-modal" style="display: none;">
    <div class="mobilemenu-modal-content">
        <div class="mobilemenu-modal-header">
            <h2><?php _e('Select Icon', 'mobilemenu'); ?></h2>
            <button type="button" class="mobilemenu-modal-close">&times;</button>
        </div>
        <div class="mobilemenu-modal-body">
            <div class="mobilemenu-icon-tabs">
                <button type="button" class="mobilemenu-icon-tab active" data-type="dashicons">
                    <?php _e('Dashicons', 'mobilemenu'); ?>
                </button>
                <button type="button" class="mobilemenu-icon-tab" data-type="fontawesome">
                    <?php _e('Font Awesome', 'mobilemenu'); ?>
                </button>
                <button type="button" class="mobilemenu-icon-tab" data-type="svg">
                    <?php _e('Custom SVG', 'mobilemenu'); ?>
                </button>
            </div>
            
            <div class="mobilemenu-icon-search">
                <input type="text" id="mobilemenu-icon-search" placeholder="<?php _e('Search icons...', 'mobilemenu'); ?>">
            </div>
            
            <div class="mobilemenu-icon-grid" id="mobilemenu-icon-grid">
                <!-- Icons will be loaded here via JavaScript -->
            </div>
            
            <div class="mobilemenu-svg-uploader" style="display: none;">
                <p><?php _e('Upload an SVG file or paste SVG code:', 'mobilemenu'); ?></p>
                <button type="button" class="button" id="mobilemenu-svg-upload-btn">
                    <?php _e('Upload SVG File', 'mobilemenu'); ?>
                </button>
                <div style="margin-top: 15px;">
                    <textarea id="mobilemenu-svg-code" rows="5" class="large-text" placeholder="<svg>...</svg>"></textarea>
                </div>
                <button type="button" class="button button-primary" id="mobilemenu-svg-apply-btn">
                    <?php _e('Apply SVG', 'mobilemenu'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
