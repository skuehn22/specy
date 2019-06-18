<section id="banner">
  <div class="banner ">
      <?php if ( is_front_page() || is_home() ) {?>
        <?php if ( get_header_image() ) : ?>
        <div class="homeslider">
          <img src="<?php header_image(); ?>">
          <div class="logo bannerlogo">
              <?php if (display_header_text()==true){?>
              <h1><a href="<?php echo esc_url( home_url( '/') ); ?>"><?php bloginfo('name'); ?></a></h1>
              <p><?php bloginfo('description'); ?></p>
              <?php } ?>
        </div><!-- bannerlogo -->
        </div>  <!--homeslider-->
        
              <?php endif; ?>
      <?php }elseif(is_page()){?>
          <?php if ( has_post_thumbnail() ) {
            ?> 
             <?php $featured_img_url = esc_url(get_the_post_thumbnail_url(get_the_ID(),'full')); ?>
            <img src="<?php echo esc_url($featured_img_url);?>">            
            <?php }else{?>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/innerbanner.jpg">   
          <?php } ?>
    <?php }?>
  </div><!--banner-->
</section><!--banner-->