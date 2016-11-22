/**
 * Customizer custom js
 */

jQuery(document).ready(function() {
   jQuery('.wp-full-overlay-sidebar-content').prepend('<div class="acme-ads"> <a href="http://www.acmethemes.com/themes/supermagpro" class="button" target="_blank">{pro}</a></div>'.replace('{pro}',supermag_customizer_js_obj.pro));
});