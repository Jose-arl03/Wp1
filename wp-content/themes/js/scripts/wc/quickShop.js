/* global woodmart_settings */
(function($) {
	$.each([
		'frontend/element_ready/wd_products.default',
		'frontend/element_ready/wd_products_tabs.default'
	], function(index, value) {
		woodmartThemeModule.wdElementorAddAction(value, function() {
			woodmartThemeModule.quickShop();
		});
	});

	woodmartThemeModule.quickShop = function() {
		if ('no' === woodmart_settings.quick_shop) {
			return;
		}

		var btnSelector = '.wd-product.product-type-variable .add_to_cart_button';

		woodmartThemeModule.$document.on('click', btnSelector, function(e) {
				e.preventDefault();

				var $this        = $(this),
				    $product     = $this.parents('.product').first(),
				    $content     = $product.find('.wd-quick-shop'),
				    id           = $product.data('id'),
				    loadingClass = 'btn-loading';

				if ($this.hasClass(loadingClass)) {
					return;
				}

				// Simply show quick shop form if it is already loaded with AJAX previously
				if ($product.hasClass('quick-shop-loaded')) {
					$product.addClass('quick-shop-shown');
					woodmartThemeModule.$body.trigger('woodmart-quick-view-displayed');
					return;
				}

				$this.addClass(loadingClass);
				$product.addClass('wd-loading-quick-shop');

				$.ajax({
					url     : woodmart_settings.ajaxurl,
					data    : {
						action: 'woodmart_quick_shop',
						id    : id
					},
					method  : 'get',
					success : function(data) {
						woodmartThemeModule.removeDuplicatedStylesFromHTML(data, function(html) {
							$content.append(html);

							initVariationForm($product);
							woodmartThemeModule.$document.trigger('wdQuickShopSuccess');

							$this.removeClass(loadingClass);
							$product.removeClass('wd-loading-quick-shop');
							$product.addClass('quick-shop-shown quick-shop-loaded');
							woodmartThemeModule.$body.trigger('woodmart-quick-view-displayed');
						});
					},
				});
			})
			.on('click', '.quick-shop-close', function(e) {
				e.preventDefault();

				var $this    = $(this),
				    $product = $this.parents('.product');

				$product.removeClass('quick-shop-shown');
			});

		woodmartThemeModule.$body.on('added_to_cart', function() {
			$('.product').removeClass('quick-shop-shown');
		});

		function initVariationForm($product) {
			$product.find('.variations_form').wc_variation_form().find('.variations select:eq(0)').trigger('change');
			$product.find('.variations_form').trigger('wc_variation_form');
		}
	};

	$(document).ready(function() {
		woodmartThemeModule.quickShop();
	});
})(jQuery);
