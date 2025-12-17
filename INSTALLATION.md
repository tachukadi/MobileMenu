# MobileMenu - Installation Guide

## Quick Start (5 Minutes)

### Step 1: Install the Plugin

Choose one of these methods:

#### Option A: WordPress Admin Upload
1. Download `mobilemenu.zip`
2. Go to **WordPress Admin → Plugins → Add New**
3. Click **Upload Plugin** button
4. Choose the ZIP file
5. Click **Install Now**
6. Click **Activate Plugin**

#### Option B: FTP Upload
1. Extract the ZIP file
2. Upload the `mobilemenu` folder to `/wp-content/plugins/`
3. Go to **WordPress Admin → Plugins**
4. Find **MobileMenu** and click **Activate**

### Step 2: Configure Your First Menu

1. Go to **Appearance → Mobile Menu**
2. In the **General Settings** tab:
   - Check **Enable Mobile Menu**
   - Keep default breakpoints (768px mobile, 1024px tablet)
3. Click **Save Settings**

### Step 3: Select a Menu

1. Go to the **Menu Selection** tab
2. Check the box next to your desired menu
3. Click **Save Settings**

✅ **Done!** Your mobile menu is now active. Test it by resizing your browser or viewing on a mobile device.

---

## Detailed Configuration

### Creating Your WordPress Menu (If Needed)

If you don't have a menu yet:

1. Go to **Appearance → Menus**
2. Click **Create a new menu**
3. Name it (e.g., "Mobile Navigation")
4. Click **Create Menu**
5. Add pages, posts, or custom links
6. Click **Save Menu**
7. Return to **Appearance → Mobile Menu** and select your new menu

### Customizing Appearance

#### Colors & Gradient

1. Go to the **Colors & Styling** tab
2. Click color pickers to choose:
   - Hamburger icon color
   - Menu background color
   - Text and icon colors
3. For a gradient background, paste CSS gradient code:
   ```
   linear-gradient(135deg, #667eea 0%, #764ba2 100%)
   ```
4. Save settings

#### Animations

1. Go to the **Animations** tab
2. Select your preferred:
   - **Menu Open Animation** (e.g., Slide from Left)
   - **Submenu Animation** (e.g., Accordion Slide)
3. Adjust:
   - **Animation Speed** (300ms recommended)
   - **Animation Easing** (ease-in-out recommended)
4. Save settings

#### Icons

1. Go to the **Menu Icons** tab
2. Set **Icon Position** (Above, Left, or Right of text)
3. For each menu item, click **Change Icon**
4. Choose from:
   - **Dashicons** - WordPress built-in icons
   - **Font Awesome** - Popular icon library  
   - **Custom SVG** - Upload your own icons

---

## Advanced Configuration

### Breakpoint Customization

**Mobile Breakpoint**
- Default: 768px
- Recommendation: 768px for most sites
- Adjust if your theme has a specific mobile breakpoint

**Tablet Breakpoint**
- Default: 1024px
- Recommendation: Keep at 1024px
- Increase to 1280px if you want the menu on larger tablets

### Behavior Options

**Close on Outside Click**
- ✅ Enable for better UX (recommended)
- ❌ Disable if you want manual close only

**Close on Anchor Click**
- ✅ Enable for one-page sites with #section links
- ❌ Disable for standard multi-page navigation

**Prevent Body Scroll**
- ✅ Enable to lock page when menu is open (recommended)
- ❌ Disable to allow scrolling behind menu

**Blur Background**
- ✅ Enable for modern frosted-glass effect
- ❌ Disable for better performance on older devices

### Hamburger Position

Choose where the menu icon appears:
- **Top Right** - Most common, follows mobile conventions
- **Top Left** - Alternative placement
- **Bottom Right** - Floating action button style
- **Bottom Left** - Thumb-friendly for one-handed use

---

## Theme Integration Tips

### Hiding Your Theme's Default Mobile Menu

Add this to your theme's CSS (Appearance → Customize → Additional CSS):

```css
/* Hide theme's mobile menu */
@media (max-width: 1024px) {
    .your-theme-menu-class {
        display: none !important;
    }
}
```

Replace `.your-theme-menu-class` with your theme's actual menu class.

### Adjusting Z-Index Conflicts

If the menu appears behind other elements:

```css
.mobilemenu-container {
    z-index: 999999 !important;
}

.mobilemenu-hamburger {
    z-index: 999998 !important;
}
```

---

## Testing Your Menu

### Test on Different Devices

1. **Desktop Browser**
   - Resize browser window below 1024px
   - Menu should appear

2. **Mobile Device**
   - Open site on phone
   - Tap hamburger icon
   - Test all menu items and submenus

3. **Tablet**
   - Test on iPad or Android tablet
   - Verify menu appears based on your settings

### Checklist

- [ ] Hamburger icon appears at correct position
- [ ] Menu opens smoothly
- [ ] All menu items are visible
- [ ] Submenus expand/collapse correctly
- [ ] Icons display properly
- [ ] Colors match your brand
- [ ] Close button works
- [ ] Clicking outside closes menu
- [ ] Anchor links scroll smoothly
- [ ] No JavaScript errors in console

---

## Troubleshooting

### Menu Not Showing

**Problem**: Hamburger icon doesn't appear

**Solutions**:
1. Check **General Settings** → Ensure "Enable Mobile Menu" is checked
2. Verify you've selected at least one menu
3. Clear WordPress cache (if using caching plugin)
4. Clear browser cache
5. Check screen width is below your breakpoint setting
6. Disable conflicting plugins temporarily

### Icons Not Displaying

**Problem**: Menu item icons are missing

**Solutions**:
1. For Dashicons: Already included in WordPress, should work automatically
2. For Font Awesome: Check browser console for loading errors
3. For SVG: Verify SVG code is valid XML
4. Try a different icon type to isolate the issue

### Styling Conflicts

**Problem**: Menu looks broken or unstyled

**Solutions**:
1. Check for theme CSS conflicts
2. Inspect element in browser DevTools
3. Add `!important` to custom CSS rules if needed
4. Contact your theme developer for guidance

### Animation Issues

**Problem**: Animations are choppy or not working

**Solutions**:
1. Reduce animation speed
2. Try a simpler animation (fade instead of flip)
3. Disable other animations on the page
4. Check browser console for JavaScript errors
5. Test on a different device

---

## Performance Optimization

### Tips for Faster Loading

1. **Use Dashicons** when possible (already loaded by WordPress)
2. **Minimize Font Awesome** use to reduce HTTP requests
3. **Optimize SVG** files before uploading
4. **Use caching** plugin compatible with WordPress
5. **Lazy load** images in menu items if any

### Recommended Settings for Speed

- Animation Speed: 200-300ms
- Simple animations over complex (Slide vs Flip)
- Disable blur if targeting older devices
- Use solid colors instead of gradients when possible

---

## Support Resources

### Documentation
- Full README: [README.md](README.md)
- Changelog: [CHANGELOG.md](CHANGELOG.md)

### Getting Help
1. Check this installation guide
2. Review the troubleshooting section
3. Check browser console for errors
4. Test with default WordPress theme
5. Disable other plugins to check for conflicts

### Common Questions

**Q: Can I have different menus for mobile and desktop?**
A: Yes! Select only the menus you want in MobileMenu settings. Your desktop menu remains separate.

**Q: Does this work with page builders?**
A: Yes! MobileMenu works with Elementor, WPBakery, Divi, and other page builders.

**Q: Can I customize the CSS?**
A: Absolutely! Add custom CSS in Appearance → Customize → Additional CSS.

**Q: Will this slow down my site?**
A: No. The plugin is lightweight (~50KB) and only loads on pages where it's active.

**Q: Is it compatible with WooCommerce?**
A: Yes! You can add WooCommerce pages to your menu.

**Q: Can I use it with a child theme?**
A: Yes! MobileMenu works with child themes.

---

## Next Steps

After installation:

1. ✅ Customize colors to match your brand
2. ✅ Add icons to important menu items
3. ✅ Test on real devices
4. ✅ Share feedback or request features

Enjoy your new mobile menu! 🎉
