# MobileMenu - WordPress Plugin

A modern, animated, mobile-only navigation menu plugin for WordPress with extensive customization options.

## Features

- ✅ **Mobile & Tablet Responsive** - Show menu only on specified devices
- ✅ **Multiple Menus** - Select and display multiple WordPress menus
- ✅ **Custom Icons** - Support for Dashicons, Font Awesome, and custom SVG icons
- ✅ **Rich Animations** - 8+ menu animations and 3 submenu animation styles
- ✅ **Flexible Design** - Full color customization and gradient support
- ✅ **Smart Behavior** - Auto-close on anchor links, outside clicks, ESC key
- ✅ **Submenu Support** - Expandable submenus with smooth animations
- ✅ **Touch Friendly** - Large tap targets for mobile devices
- ✅ **No Conflicts** - Works with any WordPress theme
- ✅ **Modern Code** - PHP 8.2+ compatible, OOP architecture

## Requirements

- WordPress 5.8 or higher
- PHP 8.2 or higher
- jQuery (included with WordPress)

## Installation

### Method 1: Upload via WordPress Admin

1. Download the plugin ZIP file
2. Go to **WordPress Admin → Plugins → Add New**
3. Click **Upload Plugin**
4. Choose the ZIP file and click **Install Now**
5. Click **Activate Plugin**

### Method 2: Manual Installation

1. Download and extract the plugin files
2. Upload the `mobilemenu` folder to `/wp-content/plugins/`
3. Go to **WordPress Admin → Plugins**
4. Find **MobileMenu** and click **Activate**

### Method 3: FTP Upload

1. Extract the plugin ZIP file
2. Connect to your server via FTP
3. Upload the `mobilemenu` folder to `/wp-content/plugins/`
4. Activate via WordPress Admin

## Configuration

After activation, go to **Appearance → Mobile Menu** in your WordPress admin.

### General Settings

- **Enable Mobile Menu** - Turn the plugin on/off globally
- **Enable on Mobile** - Show menu on mobile devices (< 768px by default)
- **Mobile Breakpoint** - Screen width below which mobile menu appears
- **Enable on Tablet** - Show menu on tablet devices
- **Tablet Breakpoint** - Screen width for tablet display
- **Hamburger Icon Position** - Top-left, top-right, bottom-left, or bottom-right

### Menu Selection

1. Select one or multiple WordPress menus to display
2. Create menus first at **Appearance → Menus** if needed
3. Multiple menus will be combined in the mobile menu

### Menu Icons

- **Icon Position** - Above, left, or right of text
- **Default Icon Type** - Dashicons or Font Awesome
- **Submenu Indicator** - Chevron, plus, or arrow icon
- **Per-Item Icons** - Customize each menu item's icon individually

#### Setting Icons for Menu Items

1. Go to the **Menu Icons** tab
2. Select a menu from the list
3. Click **Change Icon** for any menu item
4. Choose from:
   - **Dashicons** - WordPress built-in icons
   - **Font Awesome** - Popular icon library
   - **Custom SVG** - Upload or paste SVG code

### Animations

#### Menu Open/Close Animations

- Slide from Left
- Slide from Right
- Slide from Bottom
- Fade In/Out
- Scale Up
- Zoom & Fade
- Flip (3D)
- Push Content

#### Submenu Animations

- Accordion Slide
- Fade + Slide
- Scale Y Expand

#### Animation Controls

- **Animation Speed** - Duration in milliseconds (100-1000ms)
- **Animation Easing** - Timing function (linear, ease, ease-in, ease-out, ease-in-out, back ease)

### Colors & Styling

#### Hamburger Icon

- Icon Color
- Background Color

#### Menu Appearance

- Background Color
- Background Gradient (CSS gradient syntax)
- Text Color
- Icon Color
- Font Size

### Behavior

- **Show Close Button** - Display X button at top-right
- **Close on Outside Click** - Close menu when clicking overlay
- **Close on Anchor Link Click** - Auto-close and scroll to section
- **Prevent Background Scroll** - Lock body scroll when menu is open
- **Blur Background** - Apply backdrop blur effect

## Usage Examples

### Basic Setup

1. Create a menu at **Appearance → Menus**
2. Go to **Appearance → Mobile Menu**
3. Enable the plugin
4. Select your menu
5. Save settings

### Custom Styling with Gradient

```css
/* In the Background Gradient field */
linear-gradient(135deg, #667eea 0%, #764ba2 100%)
```

### Using with Anchor Links

If your menu contains anchor links like:
- `#about`
- `#services`
- `#contact`

Enable **"Close on Anchor Link Click"** in the Behavior tab. The menu will automatically close and smoothly scroll to the target section.

### Programmatic Control

The plugin exposes a global `MobileMenu` object for custom JavaScript:

```javascript
// Open menu programmatically
jQuery(document).ready(function($) {
    window.MobileMenu.openMenu();
});

// Close menu programmatically
window.MobileMenu.closeMenu();

// Listen for menu events
jQuery(document).on('mobilemenu:open', function() {
    console.log('Menu opened');
});

jQuery(document).on('mobilemenu:close', function() {
    console.log('Menu closed');
});

jQuery(document).on('mobilemenu:submenu-toggle', function(event, $item, isOpen) {
    console.log('Submenu toggled', isOpen);
});
```

## Hooks & Filters

### PHP Filters

```php
// Modify menu settings before rendering
add_filter('mobilemenu_settings', function($settings) {
    $settings['menu_bg_color'] = '#ff0000';
    return $settings;
});

// Customize menu item output
add_filter('mobilemenu_menu_item_class', function($classes, $item) {
    if ($item->url === home_url()) {
        $classes[] = 'home-item';
    }
    return $classes;
}, 10, 2);
```

### CSS Customization

Override plugin styles in your theme:

```css
/* Customize hamburger button */
.mobilemenu-hamburger {
    border-radius: 50% !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3) !important;
}

/* Customize menu items */
.mobilemenu-link {
    font-family: 'Your Custom Font', sans-serif !important;
    letter-spacing: 1px !important;
}

/* Add hover effects */
.mobilemenu-link:hover {
    background: rgba(255, 255, 255, 0.2) !important;
    border-left: 4px solid #fff !important;
}
```

## Troubleshooting

### Menu Not Showing

1. Check if the plugin is activated
2. Ensure "Enable Mobile Menu" is checked
3. Verify you've selected at least one menu
4. Check your device screen width matches the breakpoint settings
5. Clear browser and WordPress cache

### Icons Not Displaying

1. For Dashicons: Ensure WordPress is loading properly
2. For Font Awesome: Check browser console for loading errors
3. For SVG: Verify SVG code is valid XML
4. Clear browser cache

### Animations Not Working

1. Check if jQuery is loaded properly
2. Disable conflicting JavaScript from other plugins
3. Check browser console for JavaScript errors
4. Try a different animation type

### Menu Covers Site Content

1. Adjust the z-index in custom CSS if needed:
```css
.mobilemenu-container {
    z-index: 99999 !important;
}
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- iOS Safari 12+
- Android Chrome 70+

## Performance

- Lightweight: ~50KB total (CSS + JS)
- No external dependencies except jQuery (included in WordPress)
- Lazy-loads Font Awesome only if used
- Optimized animations with hardware acceleration
- Mobile-first responsive design

## Security

- All user inputs are sanitized
- Nonce verification on AJAX requests
- Capability checks for admin functions
- XSS protection on all outputs
- SQL injection prevention (uses WordPress APIs)

## Development

### File Structure

```
mobilemenu/
├── mobilemenu.php              # Main plugin file
├── includes/
│   ├── class-mobilemenu.php                 # Core plugin class
│   ├── class-mobilemenu-loader.php          # Hooks loader
│   ├── class-mobilemenu-i18n.php            # Internationalization
│   ├── class-mobilemenu-activator.php       # Activation tasks
│   └── class-mobilemenu-deactivator.php     # Deactivation tasks
├── admin/
│   ├── class-mobilemenu-admin.php           # Admin functionality
│   └── partials/
│       └── mobilemenu-admin-display.php     # Admin page template
├── public/
│   └── class-mobilemenu-public.php          # Public functionality
├── assets/
│   ├── css/
│   │   ├── mobilemenu-admin.css             # Admin styles
│   │   └── mobilemenu-public.css            # Public styles
│   └── js/
│       ├── mobilemenu-admin.js              # Admin scripts
│       └── mobilemenu-public.js             # Public scripts
└── README.md
```

### Extending the Plugin

Create a custom plugin or add to your theme's `functions.php`:

```php
// Add custom menu item classes
add_filter('mobilemenu_menu_item_class', function($classes, $item) {
    if (is_user_logged_in() && $item->title === 'Account') {
        $classes[] = 'user-logged-in';
    }
    return $classes;
}, 10, 2);

// Modify settings programmatically
add_action('init', function() {
    $settings = get_option('mobilemenu_settings', []);
    // Modify settings as needed
    update_option('mobilemenu_settings', $settings);
});
```

## Changelog

### Version 1.0.0
- Initial release
- Full menu customization support
- Multiple animation options
- Icon support (Dashicons, Font Awesome, SVG)
- Responsive breakpoint controls
- Submenu functionality
- Anchor link handling

## Credits

- Developed by: Your Name
- Dashicons by WordPress
- Font Awesome by Fonticons, Inc.

## License

GPL v2 or later

## Support

For support, feature requests, or bug reports:
- GitHub: [your-repo-url]
- WordPress.org: [plugin-page-url]
- Email: [your-email]

## Roadmap

Future features planned:
- [ ] Multiple hamburger icon styles
- [ ] RTL (Right-to-Left) language support
- [ ] Mega menu support
- [ ] Search integration
- [ ] User profile widget
- [ ] Animation builder
- [ ] Import/export settings
- [ ] Menu item badges

---

Made with ❤️ for the WordPress community
