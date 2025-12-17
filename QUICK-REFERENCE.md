# MobileMenu - Quick Reference

## Admin Settings Quick Access

**Path**: WordPress Admin → Appearance → Mobile Menu

## Tabs Overview

| Tab | Purpose |
|-----|---------|
| General Settings | Enable/disable, device targeting, breakpoints |
| Menu Selection | Choose which WordPress menus to display |
| Menu Icons | Customize icons for each menu item |
| Animations | Configure open/close and submenu animations |
| Colors & Styling | Customize colors, fonts, gradients |
| Behavior | Control menu behavior and interactions |

## Common Tasks

### Enable/Disable Menu
**Appearance → Mobile Menu → General Settings**
- Toggle "Enable Mobile Menu"

### Change Menu
**Appearance → Mobile Menu → Menu Selection**
- Check/uncheck menus

### Change Colors
**Appearance → Mobile Menu → Colors & Styling**
- Use color pickers for instant changes

### Add Icon to Menu Item
**Appearance → Mobile Menu → Menu Icons**
1. Find your menu item
2. Click "Change Icon"
3. Choose icon type
4. Select icon

### Change Animation
**Appearance → Mobile Menu → Animations**
- Select from dropdown menus

## Settings Cheat Sheet

### Recommended Settings

```
General:
✅ Enable Mobile Menu
✅ Enable on Mobile (768px)
✅ Enable on Tablet (1024px)
📍 Position: Top Right

Animations:
🎬 Open: Slide from Left
🎬 Submenu: Accordion
⚡ Speed: 300ms
⏱️ Easing: ease-in-out

Behavior:
✅ Show Close Button
✅ Close on Outside Click
✅ Close on Anchor Click
✅ Prevent Body Scroll
❌ Blur Background (optional)
```

## Default Values

| Setting | Default |
|---------|---------|
| Mobile Breakpoint | 768px |
| Tablet Breakpoint | 1024px |
| Hamburger Position | Top Right |
| Icon Position | Above Text |
| Open Animation | Slide from Left |
| Submenu Animation | Accordion |
| Animation Speed | 300ms |
| Animation Easing | ease-in-out |
| Menu Background | #00bcd4 (cyan) |
| Text Color | #ffffff (white) |
| Font Size | 18px |

## CSS Variables

Access via browser DevTools or custom CSS:

```css
--mobilemenu-hamburger-icon-color: #000000;
--mobilemenu-hamburger-bg-color: #ffffff;
--mobilemenu-bg-color: #00bcd4;
--mobilemenu-text-color: #ffffff;
--mobilemenu-icon-color: #ffffff;
--mobilemenu-font-size: 18px;
--mobilemenu-animation-speed: 300ms;
--mobilemenu-animation-easing: ease-in-out;
```

## JavaScript API

### Open/Close Menu

```javascript
// Open
window.MobileMenu.openMenu();

// Close
window.MobileMenu.closeMenu();

// Toggle
window.MobileMenu.toggleMenu();
```

### Events

```javascript
// Menu opened
jQuery(document).on('mobilemenu:open', function() {
    // Your code
});

// Menu closed
jQuery(document).on('mobilemenu:close', function() {
    // Your code
});

// Submenu toggled
jQuery(document).on('mobilemenu:submenu-toggle', function(e, $item, isOpen) {
    // Your code
});
```

## Animation Options

### Menu Open/Close
- `slide-left` - Slides in from left
- `slide-right` - Slides in from right
- `slide-bottom` - Slides up from bottom
- `fade` - Fades in
- `scale` - Scales up from center
- `zoom-fade` - Zooms and fades
- `flip` - 3D flip effect
- `push` - Pushes content aside

### Submenu
- `accordion` - Smooth slide down
- `fade-slide` - Fade and slide
- `scale-y` - Scale vertically

## Icon Types

### Dashicons
- Built into WordPress
- 300+ icons available
- No external loading
- Example: `dashicons-admin-home`

### Font Awesome
- 1,000+ icons
- Loaded from CDN when used
- Example: `fa-solid fa-home`

### Custom SVG
- Upload your own
- Paste SVG code
- Full customization
- Example: `<svg>...</svg>`

## Breakpoints Reference

| Device | Typical Width | Setting |
|--------|---------------|---------|
| Phone (portrait) | 320-480px | ≤ Mobile Breakpoint |
| Phone (landscape) | 480-768px | ≤ Mobile Breakpoint |
| Tablet (portrait) | 768-1024px | ≤ Tablet Breakpoint |
| Tablet (landscape) | 1024-1280px | ≤ Tablet Breakpoint |
| Desktop | > 1280px | Menu hidden |

## Keyboard Shortcuts

| Key | Action |
|-----|--------|
| ESC | Close menu (when open) |
| Tab | Navigate menu items |
| Enter | Activate link |
| Space | Toggle submenu |

## Best Practices

### ✅ Do
- Use consistent icon style
- Keep menu items under 7 per level
- Test on real devices
- Match brand colors
- Use descriptive labels

### ❌ Don't
- Mix too many icon types
- Use very long menu labels
- Set breakpoint too high
- Use illegible color combinations
- Forget to test submenus

## Common Custom CSS

### Round Hamburger Button
```css
.mobilemenu-hamburger {
    border-radius: 50% !important;
}
```

### Bold Menu Text
```css
.mobilemenu-link {
    font-weight: 600 !important;
}
```

### Larger Icons
```css
.mobilemenu-icon {
    font-size: 28px !important;
    width: 36px !important;
    height: 36px !important;
}
```

### Custom Hover Effect
```css
.mobilemenu-link:hover {
    background: rgba(255,255,255,0.2) !important;
    border-left: 4px solid #fff !important;
    padding-left: 24px !important;
}
```

## Troubleshooting Quick Fixes

| Problem | Quick Fix |
|---------|-----------|
| Menu not showing | Check "Enable Mobile Menu" is ON |
| Wrong colors | Clear browser cache |
| Animations choppy | Reduce animation speed |
| Icons missing | Try different icon type |
| Z-index issues | Increase z-index in CSS |
| JavaScript errors | Disable conflicting plugins |

## File Locations

```
Plugin Root: /wp-content/plugins/mobilemenu/
Settings: /wp-admin/admin.php?page=mobilemenu
Database: wp_options table
- mobilemenu_settings
- mobilemenu_menu_icons
```

## Support Checklist

Before asking for help:

- [ ] Plugin version: 1.0.0
- [ ] WordPress version: ?
- [ ] PHP version: ?
- [ ] Theme name: ?
- [ ] Browser tested: ?
- [ ] Console errors: ?
- [ ] Conflicting plugins: ?
- [ ] Custom CSS added: ?

---

**Quick Links**
- [Full Documentation](README.md)
- [Installation Guide](INSTALLATION.md)
- [Changelog](CHANGELOG.md)
