<?php
if ( ! isset( $content_width ) ) $content_width = 900;

add_action( 'admin_menu', 'business_cover_lite_pros');
function business_cover_lite_pros() {    	
	add_theme_page( esc_html__('Business Cover Lite Details', 'business-cover-lite'), esc_html__('Business Cover Lite Details', 'business-cover-lite'), 'edit_theme_options', 'business_cover_lite_pro', 'business_cover_lite_pro_details');   
} 

function business_cover_lite_pro_details() { 	
?>
<div class="wrap">
	<h1><?php esc_html_e( 'Business Cover Lite', 'business-cover-lite' ); ?></h1>
	<p><strong> <?php esc_html_e( 'Description: ', 'business-cover-lite' ); ?></strong><?php esc_html_e( 'Business Cover Lite multipurpose WordPress themes has used for most of all type of business. Its used for the multipurpose business like Marketing, Finance, Stock Market, IT infrastructure, Consultant, Manufacture plant, Services, Retailer, Wholesaler, Online business, Store, IT Firm, Cloth business, and many more business.', 'business-cover-lite' ); ?></p>
<a class="button button-primary button-large" href="<?php echo esc_url( business_cover_lite_THEMEURL ); ?>" target="_blank"><?php esc_html_e('Theme Url', 'business-cover-lite'); ?></a>	
<a class="button button-primary button-large" href="<?php echo esc_url( business_cover_lite_PROURL ); ?>" target="_blank"><?php esc_html_e('Purchase To Pro', 'business-cover-lite'); ?></a>
<a class="button button-primary button-large" href="<?php echo esc_url( business_cover_lite_DOCURL ); ?>" target="_blank"><?php esc_html_e('Documentation', 'business-cover-lite'); ?></a>
 </div> 
</div>
<?php }?>
<?php
add_action('customize_register', 'business_cover_lite_customize_register');
define('business_cover_lite_PROURL', 'http://www.themescave.com/themes/wordpress-theme-multipurpose-business-cover-pro/');
define('business_cover_lite_THEMEURL', 'http://www.themescave.com/themes/wordpress-theme-multipurpose-free-business-cover-lite/');
define('business_cover_lite_DOCURL', 'http://www.themescave.com/documentation/business-cover');
?>