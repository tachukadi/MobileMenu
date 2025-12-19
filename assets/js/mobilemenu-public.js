/**
 * MobileMenu Public JavaScript
 */

(function($) {
    'use strict';
    
    const MobileMenu = {
        
        $hamburger: null,
        $container: null,
        $overlay: null,
        $body: null,
        isOpen: false,
        settings: {},
        
        /**
         * Initialize the mobile menu
         */
        init: function() {
            this.$hamburger = $('.mobilemenu-hamburger');
            this.$container = $('.mobilemenu-container');
            this.$overlay = $('.mobilemenu-overlay');
            this.$body = $('body');
            
            if (!this.$hamburger.length || !this.$container.length) {
                return;
            }
            
            this.settings = typeof mobilemenuSettings !== 'undefined' ? mobilemenuSettings : {};
            
            this.setupAnimationClasses();
            this.setupDefaultSubmenuState();
            this.bindEvents();
        },
        
        /**
         * Setup default submenu state
         */
        setupDefaultSubmenuState: function() {
            if (this.settings.openSubmenusByDefault) {
                // Open all submenus by default
                $('.has-submenu').addClass('submenu-open');
                $('.mobilemenu-list .mobilemenu-list').addClass('submenu-open');
            }
        },
        
        /**
         * Setup animation classes based on settings
         */
        setupAnimationClasses: function() {
            const openAnimation = this.settings.openAnimation || 'slide-left';
            const submenuAnimation = this.settings.submenuAnimation || 'accordion';
            
            this.$container.addClass(openAnimation);
            
            $('.mobilemenu-list .mobilemenu-list').addClass(submenuAnimation);
        },
        
        /**
         * Bind all event handlers
         */
        bindEvents: function() {
            const self = this;
            
            // Toggle menu on hamburger click
            this.$hamburger.on('click', function(e) {
                e.preventDefault();
                self.toggleMenu();
            });
            
            // Close menu on close button click
            $('.mobilemenu-close').on('click', function(e) {
                e.preventDefault();
                self.closeMenu();
            });
            
            // Close menu on overlay click
            if (this.settings.closeOnOutsideClick) {
                this.$overlay.on('click', function() {
                    self.closeMenu();
                });
            }
            
            // Only bind submenu toggle if NOT opening by default
            if (!this.settings.openSubmenusByDefault) {
                // Toggle submenu - on entire parent item click
                $('.has-submenu > .mobilemenu-item-wrapper').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const $wrapper = $(this);
                    const $link = $wrapper.find('.mobilemenu-link');
                    const href = $link.attr('href');
                    
                    // Toggle the submenu
                    self.toggleSubmenu($wrapper);
                });
                
                // Prevent link navigation for parent items with submenus
                $('.has-submenu > .mobilemenu-item-wrapper .mobilemenu-link').on('click', function(e) {
                    e.preventDefault();
                });
            } else {
                // When submenus are open by default, parent items should still be clickable for navigation
                // Only prevent default if the link is just "#"
                $('.has-submenu > .mobilemenu-item-wrapper .mobilemenu-link').on('click', function(e) {
                    const href = $(this).attr('href');
                    if (!href || href === '#' || href === '') {
                        e.preventDefault();
                    }
                });
            }
            
            // Handle anchor links - both same page and different page
            if (this.settings.closeOnAnchorClick) {
                // Handle all anchor links
                $('.mobilemenu-link').on('click', function(e) {
                    const href = $(this).attr('href');
                    
                    // Check if it's an anchor link (contains #)
                    if (href && href.indexOf('#') !== -1) {
                        // Check if parent has submenu and is not open by default
                        const $item = $(this).closest('.mobilemenu-item');
                        const hasSubmenu = $item.hasClass('has-submenu');
                        
                        // If it has submenu and submenus aren't open by default, don't close
                        if (hasSubmenu && !self.settings.openSubmenusByDefault) {
                            return; // Let the submenu toggle handler take care of it
                        }
                        
                        // Close the menu for anchor links
                        self.closeMenu();
                        
                        // Get the anchor part
                        const anchorPart = href.substring(href.indexOf('#'));
                        
                        // If it's a same-page anchor (starts with # or current page URL + #)
                        const currentUrl = window.location.href.split('#')[0];
                        const linkUrl = href.split('#')[0];
                        
                        // Check if it's same page anchor
                        if (href.startsWith('#') || linkUrl === '' || linkUrl === currentUrl || 
                            href === currentUrl + anchorPart) {
                            e.preventDefault(); // Prevent default for same-page anchors
                            
                            // Smooth scroll to target
                            const $target = $(anchorPart);
                            
                            if ($target.length) {
                                setTimeout(function() {
                                    $('html, body').animate({
                                        scrollTop: $target.offset().top - 100
                                    }, 600);
                                }, 300);
                            } else {
                                // If target doesn't exist, just jump to it
                                setTimeout(function() {
                                    window.location.hash = anchorPart.substring(1);
                                }, 300);
                            }
                        }
                        // For different page anchors, let the browser handle navigation naturally
                    }
                });
            }
            
            // Close on ESC key
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && self.isOpen) {
                    self.closeMenu();
                }
            });
            
            // Handle window resize
            let resizeTimer;
            $(window).on('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    if (self.isOpen && $(window).width() > 1024) {
                        self.closeMenu();
                    }
                }, 250);
            });
        },
        
        /**
         * Toggle menu open/closed
         */
        toggleMenu: function() {
            if (this.isOpen) {
                this.closeMenu();
            } else {
                this.openMenu();
            }
        },
        
        /**
         * Open the menu
         */
        openMenu: function() {
            this.isOpen = true;
            
            this.$hamburger.addClass('active');
            this.$overlay.addClass('active');
            this.$container.addClass('active');
            
            // Prevent body scroll
            if (this.settings.preventBodyScroll) {
                const scrollY = window.scrollY;
                this.$body.addClass('mobilemenu-no-scroll')
                    .css('top', `-${scrollY}px`);
            }
            
            // Blur background
            if (this.settings.blurBackground) {
                this.$overlay.addClass('blur-active');
            }
            
            // Push content animation
            if (this.settings.openAnimation === 'push') {
                this.$body.addClass('mobilemenu-push-active');
            }
            
            // Trigger custom event
            $(document).trigger('mobilemenu:open');
        },
        
        /**
         * Close the menu
         */
        closeMenu: function() {
            if (!this.isOpen) return;
            
            this.isOpen = false;
            
            this.$hamburger.removeClass('active');
            this.$overlay.removeClass('active blur-active');
            this.$container.removeClass('active');
            this.$body.removeClass('mobilemenu-push-active');
            
            // Re-enable body scroll
            if (this.settings.preventBodyScroll) {
                const scrollY = this.$body.css('top');
                this.$body.removeClass('mobilemenu-no-scroll')
                    .css('top', '');
                window.scrollTo(0, parseInt(scrollY || '0') * -1);
            }
            
            // Close all submenus
            $('.mobilemenu-list .mobilemenu-list').removeClass('submenu-open');
            $('.has-submenu').removeClass('submenu-open');
            
            // Trigger custom event
            $(document).trigger('mobilemenu:close');
        },
        
        /**
         * Toggle submenu
         */
        toggleSubmenu: function($wrapper) {
            // $wrapper is now the .mobilemenu-item-wrapper
            const $item = $wrapper.closest('.has-submenu');
            const $submenu = $item.find('> .mobilemenu-list');
            
            const isOpen = $item.hasClass('submenu-open');
            
            if (isOpen) {
                $item.removeClass('submenu-open');
                $submenu.removeClass('submenu-open');
            } else {
                // Close other submenus at the same level
                const $siblings = $item.siblings('.has-submenu');
                $siblings.removeClass('submenu-open')
                    .find('> .mobilemenu-list').removeClass('submenu-open');
                
                $item.addClass('submenu-open');
                $submenu.addClass('submenu-open');
            }
            
            // Trigger custom event
            $(document).trigger('mobilemenu:submenu-toggle', [$item, !isOpen]);
        }
    };
    
    /**
     * Initialize on document ready
     */
    $(document).ready(function() {
        MobileMenu.init();
    });
    
    /**
     * Expose MobileMenu to global scope for custom extensions
     */
    window.MobileMenu = MobileMenu;
    
})(jQuery);
