<?php
/**
 * @package business-cover-lite
 */

get_header(); 
?>
<div class="container">
     <div class="page_content">
        <div class="site-main">
        	 <div class="blog-post">
					<?php
                    if ( have_posts() ) :
                        
                        while ( have_posts() ) : the_post();
                        ?>   
						<div><h1><?php the_title(); ?></h1></div>
						<div><?php the_content();?></div>
						 <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
						<?php if ( comments_open() || get_comments_number() ) :
						comments_template();
						endif;?>
                        <?php endwhile;
                    endif;
                    ?>
                    </div><!--blog-post -->
             </div><!--col-md-8-->
             
                <?php get_sidebar();?>
                            
        <div class="clear"></div>
    </div><!-- row -->
</div><!-- container -->
<?php get_footer(); ?>