<?php
/**
 * footer Template.
 *
 * @package Business Cover Lite
 */
?>
<footer>
	<?php if((is_active_sidebar('footer-1')) || (is_active_sidebar('footer-2')) || (is_active_sidebar('footer-3')) || (is_active_sidebar('footer-4'))) {?>
		<?php get_template_part('pub/footer/template', 'footertop');?>
<!--footer-->
<?php }?>
	<?php get_template_part('pub/footer/template', 'footerbottom');?>		
</footer>
<?php wp_footer(); ?>

</body>
</html>