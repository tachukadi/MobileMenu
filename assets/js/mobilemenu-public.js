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
            this.bindEvents();
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
            
            // Toggle submenu
            $('.mobilemenu-submenu-toggle').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                self.toggleSubmenu($(this));
            });
            
            // Handle anchor links
            if (this.settings.closeOnAnchorClick) {
                $('.mobilemenu-link.is-anchor a, .mobilemenu-item.is-anchor .mobilemenu-link').on('click', function() {
                    self.closeMenu();
                    
                    // Smooth scroll to anchor
                    const href = $(this).attr('href');
                    if (href && href.indexOf('#') !== -1) {
                        const anchor = href.substring(href.indexOf('#'));
                        const $target = $(anchor);
                        
                        if ($target.length) {
                            setTimeout(function() {
                                $('html, body').animate({
                                    scrollTop: $target.offset().top - 100
                                }, 600);
                            }, 300);
                        }
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
        toggleSubmenu: function($toggle) {
            const $item = $toggle.closest('.has-submenu');
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
