/**
 * MobileMenu Admin JavaScript
 */

(function($) {
    'use strict';
    
    // Common Dashicons list
    const dashicons = [
        'dashicons-admin-home', 'dashicons-admin-generic', 'dashicons-admin-settings',
        'dashicons-admin-users', 'dashicons-admin-tools', 'dashicons-admin-site',
        'dashicons-admin-page', 'dashicons-admin-media', 'dashicons-admin-links',
        'dashicons-admin-post', 'dashicons-admin-comments', 'dashicons-admin-appearance',
        'dashicons-admin-plugins', 'dashicons-admin-network', 'dashicons-menu',
        'dashicons-menu-alt', 'dashicons-menu-alt2', 'dashicons-menu-alt3',
        'dashicons-dashboard', 'dashicons-smiley', 'dashicons-phone', 'dashicons-email',
        'dashicons-email-alt', 'dashicons-location', 'dashicons-location-alt',
        'dashicons-camera', 'dashicons-camera-alt', 'dashicons-images-alt', 'dashicons-images-alt2',
        'dashicons-video-alt', 'dashicons-video-alt2', 'dashicons-video-alt3',
        'dashicons-cart', 'dashicons-products', 'dashicons-tag', 'dashicons-category',
        'dashicons-star-filled', 'dashicons-star-half', 'dashicons-star-empty',
        'dashicons-heart', 'dashicons-thumbs-up', 'dashicons-thumbs-down',
        'dashicons-money', 'dashicons-money-alt', 'dashicons-awards',
        'dashicons-lightbulb', 'dashicons-shield', 'dashicons-shield-alt',
        'dashicons-businessman', 'dashicons-id', 'dashicons-id-alt',
        'dashicons-building', 'dashicons-store', 'dashicons-chart-bar',
        'dashicons-chart-pie', 'dashicons-chart-area', 'dashicons-chart-line',
        'dashicons-groups', 'dashicons-businessman', 'dashicons-tickets',
        'dashicons-calendar', 'dashicons-calendar-alt', 'dashicons-clock',
        'dashicons-book', 'dashicons-book-alt', 'dashicons-portfolio',
        'dashicons-search', 'dashicons-filter', 'dashicons-download',
        'dashicons-upload', 'dashicons-cloud', 'dashicons-cloud-upload',
        'dashicons-cloud-download', 'dashicons-backup', 'dashicons-update',
        'dashicons-update-alt', 'dashicons-lock', 'dashicons-unlock',
        'dashicons-plus', 'dashicons-plus-alt', 'dashicons-plus-alt2',
        'dashicons-minus', 'dashicons-dismiss', 'dashicons-yes', 'dashicons-yes-alt',
        'dashicons-no', 'dashicons-no-alt', 'dashicons-arrow-up', 'dashicons-arrow-down',
        'dashicons-arrow-left', 'dashicons-arrow-right', 'dashicons-arrow-up-alt',
        'dashicons-arrow-down-alt', 'dashicons-arrow-left-alt', 'dashicons-arrow-right-alt',
        'dashicons-arrow-up-alt2', 'dashicons-arrow-down-alt2', 'dashicons-arrow-left-alt2',
        'dashicons-arrow-right-alt2', 'dashicons-sort', 'dashicons-randomize',
        'dashicons-list-view', 'dashicons-grid-view', 'dashicons-excerpt-view',
        'dashicons-hammer', 'dashicons-art', 'dashicons-migrate', 'dashicons-performance',
        'dashicons-universal-access', 'dashicons-universal-access-alt', 'dashicons-editor-help',
        'dashicons-info', 'dashicons-warning', 'dashicons-share', 'dashicons-share-alt',
        'dashicons-share-alt2', 'dashicons-twitter', 'dashicons-facebook', 'dashicons-facebook-alt',
        'dashicons-instagram', 'dashicons-pinterest', 'dashicons-linkedin',
        'dashicons-youtube', 'dashicons-reddit', 'dashicons-spotify',
        'dashicons-twitch', 'dashicons-whatsapp'
    ];
    
    // Common Font Awesome icons
    const fontAwesomeIcons = [
        'fa-solid fa-home', 'fa-solid fa-user', 'fa-solid fa-users', 'fa-solid fa-gear',
        'fa-solid fa-cog', 'fa-solid fa-bars', 'fa-solid fa-search', 'fa-solid fa-envelope',
        'fa-solid fa-phone', 'fa-solid fa-location-dot', 'fa-solid fa-heart', 'fa-solid fa-star',
        'fa-solid fa-cart-shopping', 'fa-solid fa-tag', 'fa-solid fa-tags', 'fa-solid fa-bookmark',
        'fa-solid fa-camera', 'fa-solid fa-image', 'fa-solid fa-video', 'fa-solid fa-music',
        'fa-solid fa-file', 'fa-solid fa-file-alt', 'fa-solid fa-folder', 'fa-solid fa-calendar',
        'fa-solid fa-clock', 'fa-solid fa-download', 'fa-solid fa-upload', 'fa-solid fa-cloud',
        'fa-solid fa-lock', 'fa-solid fa-unlock', 'fa-solid fa-key', 'fa-solid fa-shield',
        'fa-solid fa-check', 'fa-solid fa-times', 'fa-solid fa-plus', 'fa-solid fa-minus',
        'fa-solid fa-arrow-up', 'fa-solid fa-arrow-down', 'fa-solid fa-arrow-left', 'fa-solid fa-arrow-right',
        'fa-solid fa-chevron-up', 'fa-solid fa-chevron-down', 'fa-solid fa-chevron-left', 'fa-solid fa-chevron-right',
        'fa-solid fa-circle', 'fa-solid fa-square', 'fa-solid fa-map-marker', 'fa-solid fa-flag',
        'fa-solid fa-thumbs-up', 'fa-solid fa-thumbs-down', 'fa-solid fa-comment', 'fa-solid fa-comments',
        'fa-solid fa-bell', 'fa-solid fa-trophy', 'fa-solid fa-gift', 'fa-solid fa-lightbulb',
        'fa-solid fa-book', 'fa-solid fa-newspaper', 'fa-solid fa-graduation-cap', 'fa-solid fa-briefcase',
        'fa-solid fa-building', 'fa-solid fa-hospital', 'fa-solid fa-store', 'fa-solid fa-tree',
        'fa-solid fa-leaf', 'fa-solid fa-globe', 'fa-solid fa-wifi', 'fa-solid fa-signal',
        'fa-brands fa-facebook', 'fa-brands fa-twitter', 'fa-brands fa-instagram', 'fa-brands fa-youtube',
        'fa-brands fa-linkedin', 'fa-brands fa-pinterest', 'fa-brands fa-whatsapp', 'fa-brands fa-telegram'
    ];
    
    const MobileMenuAdmin = {
        
        currentIconItem: null,
        mediaUploader: null,
        
        init: function() {
            this.initTabs();
            this.initColorPickers();
            this.initFormSubmit();
            this.initIconPicker();
            this.initSVGUploader();
            this.initLogoUploader();
        },
        
        /**
         * Initialize tab switching
         */
        initTabs: function() {
            $('.mobilemenu-tab-button').on('click', function() {
                const tab = $(this).data('tab');
                
                $('.mobilemenu-tab-button').removeClass('active');
                $('.mobilemenu-tab-content').removeClass('active');
                
                $(this).addClass('active');
                $(`.mobilemenu-tab-content[data-tab="${tab}"]`).addClass('active');
            });
        },
        
        /**
         * Initialize color pickers
         */
        initColorPickers: function() {
            if ($.fn.wpColorPicker) {
                $('.mobilemenu-color-picker').wpColorPicker();
            }
        },
        
        /**
         * Initialize form submission
         */
        initFormSubmit: function() {
            const self = this;
            
            $('#mobilemenu-settings-form').on('submit', function(e) {
                e.preventDefault();
                
                const $button = $('#mobilemenu-save-button');
                const originalText = $button.html();
                
                $button.addClass('saving')
                    .prop('disabled', true)
                    .html('<span class="dashicons dashicons-update"></span> ' + mobilemenuAdmin.strings.saving);
                
                const formData = $(this).serializeArray();
                const settings = {};
                
                formData.forEach(function(field) {
                    const name = field.name.replace('mobilemenu_settings[', '').replace(']', '');
                    
                    if (name.includes('selected_menus')) {
                        if (!settings.selected_menus) {
                            settings.selected_menus = [];
                        }
                        settings.selected_menus.push(field.value);
                    } else {
                        settings[name] = field.value;
                    }
                });
                
                $.ajax({
                    url: mobilemenuAdmin.ajaxUrl,
                    type: 'POST',
                    data: {
                        action: 'mobilemenu_save_settings',
                        nonce: mobilemenuAdmin.nonce,
                        settings: settings
                    },
                    success: function(response) {
                        if (response.success) {
                            self.showNotice(response.data.message, 'success');
                        } else {
                            self.showNotice(response.data.message, 'error');
                        }
                    },
                    error: function() {
                        self.showNotice(mobilemenuAdmin.strings.error, 'error');
                    },
                    complete: function() {
                        $button.removeClass('saving')
                            .prop('disabled', false)
                            .html(originalText);
                    }
                });
            });
        },
        
        /**
         * Show admin notice
         */
        showNotice: function(message, type) {
            const $notice = $('.mobilemenu-admin-notice');
            $notice.removeClass('success error')
                .addClass(type)
                .find('p').text(message);
            $notice.slideDown();
            
            setTimeout(function() {
                $notice.slideUp();
            }, 3000);
        },
        
        /**
         * Initialize icon picker
         */
        initIconPicker: function() {
            const self = this;
            
            // Open icon picker modal
            $(document).on('click', '.mobilemenu-icon-select-btn', function() {
                self.currentIconItem = $(this).closest('.mobilemenu-menu-item');
                const currentType = self.currentIconItem.find('.mobilemenu-icon-type').val();
                
                self.openIconPicker(currentType);
            });
            
            // Close modal
            $('.mobilemenu-modal-close').on('click', function() {
                $('#mobilemenu-icon-picker-modal').hide();
            });
            
            // Click outside to close
            $('#mobilemenu-icon-picker-modal').on('click', function(e) {
                if ($(e.target).is('#mobilemenu-icon-picker-modal')) {
                    $(this).hide();
                }
            });
            
            // Switch icon type tabs
            $('.mobilemenu-icon-tab').on('click', function() {
                const type = $(this).data('type');
                
                $('.mobilemenu-icon-tab').removeClass('active');
                $(this).addClass('active');
                
                if (type === 'svg') {
                    $('#mobilemenu-icon-grid').hide();
                    $('.mobilemenu-icon-search').hide();
                    $('.mobilemenu-svg-uploader').show();
                } else {
                    $('#mobilemenu-icon-grid').show();
                    $('.mobilemenu-icon-search').show();
                    $('.mobilemenu-svg-uploader').hide();
                    self.loadIcons(type);
                }
            });
            
            // Icon search
            $('#mobilemenu-icon-search').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();
                
                $('.mobilemenu-icon-item').each(function() {
                    const iconClass = $(this).data('icon').toLowerCase();
                    if (iconClass.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
            
            // Select icon
            $(document).on('click', '.mobilemenu-icon-item', function() {
                const iconType = $('.mobilemenu-icon-tab.active').data('type');
                const iconValue = $(this).data('icon');
                
                self.applyIcon(iconType, iconValue);
                $('#mobilemenu-icon-picker-modal').hide();
            });
        },
        
        /**
         * Open icon picker modal
         */
        openIconPicker: function(iconType = 'dashicons') {
            $('#mobilemenu-icon-picker-modal').show();
            
            // Activate the correct tab
            $('.mobilemenu-icon-tab').removeClass('active');
            $(`.mobilemenu-icon-tab[data-type="${iconType}"]`).addClass('active');
            
            if (iconType === 'svg') {
                $('#mobilemenu-icon-grid').hide();
                $('.mobilemenu-icon-search').hide();
                $('.mobilemenu-svg-uploader').show();
            } else {
                $('#mobilemenu-icon-grid').show();
                $('.mobilemenu-icon-search').show();
                $('.mobilemenu-svg-uploader').hide();
                this.loadIcons(iconType);
            }
        },
        
        /**
         * Load icons into grid
         */
        loadIcons: function(type) {
            const $grid = $('#mobilemenu-icon-grid');
            $grid.empty();
            
            let icons = [];
            
            if (type === 'dashicons') {
                icons = dashicons;
                icons.forEach(function(icon) {
                    $grid.append(
                        `<div class="mobilemenu-icon-item" data-icon="${icon}">
                            <span class="dashicons ${icon}"></span>
                        </div>`
                    );
                });
            } else if (type === 'fontawesome') {
                icons = fontAwesomeIcons;
                icons.forEach(function(icon) {
                    $grid.append(
                        `<div class="mobilemenu-icon-item" data-icon="${icon}">
                            <i class="${icon}"></i>
                        </div>`
                    );
                });
            }
        },
        
        /**
         * Apply selected icon
         */
        applyIcon: function(iconType, iconValue, svgCode = '') {
            if (!this.currentIconItem) return;
            
            const menuItemId = this.currentIconItem.data('item-id');
            const $currentIcon = this.currentIconItem.find('.mobilemenu-current-icon');
            
            // Update the display
            if (iconType === 'dashicons') {
                $currentIcon.html(`<span class="dashicons ${iconValue}"></span>`);
            } else if (iconType === 'fontawesome') {
                $currentIcon.html(`<i class="${iconValue}"></i>`);
            } else if (iconType === 'svg' && svgCode) {
                $currentIcon.html(svgCode);
            }
            
            // Update hidden fields
            this.currentIconItem.find('.mobilemenu-icon-type').val(iconType);
            this.currentIconItem.find('.mobilemenu-icon-value').val(iconValue);
            
            // Save to database
            this.saveMenuIcon(menuItemId, iconType, iconValue, svgCode);
        },
        
        /**
         * Save menu icon via AJAX
         */
        saveMenuIcon: function(menuItemId, iconType, iconValue, svgCode = '') {
            $.ajax({
                url: mobilemenuAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'mobilemenu_save_menu_icon',
                    nonce: mobilemenuAdmin.nonce,
                    menu_item_id: menuItemId,
                    icon_data: {
                        type: iconType,
                        value: iconValue,
                        svg: svgCode
                    }
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Icon saved successfully');
                    }
                }
            });
        },
        
        /**
         * Initialize SVG uploader
         */
        initSVGUploader: function() {
            const self = this;
            
            // SVG file upload
            $('#mobilemenu-svg-upload-btn').on('click', function(e) {
                e.preventDefault();
                
                if (self.mediaUploader) {
                    self.mediaUploader.open();
                    return;
                }
                
                self.mediaUploader = wp.media({
                    title: 'Select SVG',
                    button: {
                        text: 'Use this SVG'
                    },
                    library: {
                        type: 'image/svg+xml'
                    },
                    multiple: false
                });
                
                self.mediaUploader.on('select', function() {
                    const attachment = self.mediaUploader.state().get('selection').first().toJSON();
                    
                    // Fetch SVG content
                    $.get(attachment.url, function(data) {
                        const svgCode = new XMLSerializer().serializeToString(data.documentElement);
                        $('#mobilemenu-svg-code').val(svgCode);
                    });
                });
                
                self.mediaUploader.open();
            });
            
            // Apply SVG code
            $('#mobilemenu-svg-apply-btn').on('click', function() {
                const svgCode = $('#mobilemenu-svg-code').val().trim();
                
                if (svgCode && svgCode.startsWith('<svg')) {
                    self.applyIcon('svg', 'custom-svg', svgCode);
                    $('#mobilemenu-icon-picker-modal').hide();
                    $('#mobilemenu-svg-code').val('');
                } else {
                    alert('Please enter valid SVG code.');
                }
            });
        },
        
        /**
         * Initialize logo uploader
         */
        initLogoUploader: function() {
            let logoUploader;
            
            // Logo upload button
            $('.mobilemenu-logo-upload-btn').on('click', function(e) {
                e.preventDefault();
                
                if (logoUploader) {
                    logoUploader.open();
                    return;
                }
                
                logoUploader = wp.media({
                    title: 'Select Logo',
                    button: {
                        text: 'Use this image'
                    },
                    library: {
                        type: 'image'
                    },
                    multiple: false
                });
                
                logoUploader.on('select', function() {
                    const attachment = logoUploader.state().get('selection').first().toJSON();
                    
                    // Update hidden field
                    $('#logo_image').val(attachment.url);
                    
                    // Update preview
                    $('.mobilemenu-logo-preview').html(
                        '<img src="' + attachment.url + '" style="max-width: 200px; max-height: 100px; display: block;" alt="Menu Logo">'
                    );
                    
                    // Show remove button
                    $('.mobilemenu-logo-remove-btn').show();
                });
                
                logoUploader.open();
            });
            
            // Logo remove button
            $('.mobilemenu-logo-remove-btn').on('click', function(e) {
                e.preventDefault();
                
                // Clear hidden field
                $('#logo_image').val('');
                
                // Clear preview
                $('.mobilemenu-logo-preview').html('<p class="description">No logo uploaded</p>');
                
                // Hide remove button
                $(this).hide();
            });
        },
        
        /**
         * Initialize logo uploader
         */
        initLogoUploader: function() {
            let logoUploader;
            
            $('#mobilemenu-upload-logo').on('click', function(e) {
                e.preventDefault();
                
                if (logoUploader) {
                    logoUploader.open();
                    return;
                }
                
                logoUploader = wp.media({
                    title: 'Select Logo',
                    button: {
                        text: 'Use this image'
                    },
                    library: {
                        type: 'image'
                    },
                    multiple: false
                });
                
                logoUploader.on('select', function() {
                    const attachment = logoUploader.state().get('selection').first().toJSON();
                    $('#logo_image').val(attachment.url);
                    $('#logo-preview').html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto; display: block;">').show();
                });
                
                logoUploader.open();
            });
            
            $('#mobilemenu-remove-logo').on('click', function(e) {
                e.preventDefault();
                $('#logo_image').val('');
                $('#logo-preview').hide().html('');
            });
        }
    };
    
    // Initialize on document ready
    $(document).ready(function() {
        MobileMenuAdmin.init();
    });
    
})(jQuery);

