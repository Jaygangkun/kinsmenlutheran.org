<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The main sidebar file
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */

$sidebarname = 'yes';



$sidebarbox 	= (get_post_meta(get_option('woocommerce_shop_page_id'), 'cromabox_sbbar', true) == '')? 0 : get_post_meta(get_option('woocommerce_shop_page_id'), 'cromabox_sbbar', true);	
$sidebarname 	= (get_post_meta(get_option('woocommerce_shop_page_id'), 'cromabox_sidebarnames', true) == '')? 0 : get_post_meta(get_option('woocommerce_shop_page_id'), 'cromabox_sidebarnames', true);	


$sidebarname 	= ($sidebarname  == 'yes')? 'cro_sidebarmain' :  'cro_' . $sidebarname ;




?>



<?php if ( is_active_sidebar($sidebarname) ) : ?>
<aside class="cro_bodysidebar">
	<ul class="mainwidget">
		<?php dynamic_sidebar($sidebarname); ?>
	</ul><!-- #secondary -->
</aside>
<?php endif; ?>