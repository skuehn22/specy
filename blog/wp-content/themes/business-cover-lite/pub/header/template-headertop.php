<section id="header">
  <header class="container">
    <div class="header_top row">
      <?php if (!is_front_page() && !is_home() ) {?>
      <div class="header_left headercommon">
        <div class="logo">
          <?php if (display_header_text()==true){?>
          <h1><a href="<?php echo esc_url( home_url( '/') ); ?>"><?php bloginfo('name'); ?></a></h1>
          <p><?php bloginfo('description'); ?></p>
          <?php } ?>
        </div><!-- logo -->
      </div><!--header_left-->
    <?php }?>
      <div class="header_middle headercommon">
        <ul>
          <?php if(get_theme_mod('business_cover_lite_fb')){?>
            <li><a title="<?php esc_attr_e('Facebook','business-cover-lite'); ?>" class="fa fa-facebook" target="_blank" href="<?php echo esc_url(get_theme_mod('business_cover_lite_fb','')); ?>"></a> </li>
          <?php }?>
          <?php if(get_theme_mod('business_cover_lite_twitter')){?>
            <li><a title="<?php esc_attr_e('twitter','business-cover-lite'); ?>" class="fa fa-twitter" target="_blank" href="<?php echo esc_url(get_theme_mod('business_cover_lite_twitter','')); ?>"></a></li>
          <?php }?>
          <?php if(get_theme_mod('business_cover_lite_glplus')){?>
            <li><a title="<?php esc_attr_e('googleplus','business-cover-lite'); ?>" class="fa fa-google-plus" target="_blank" href="<?php echo esc_url(get_theme_mod('business_cover_lite_glplus','')); ?>"></a></li>
          <?php }?>
          <?php if(get_theme_mod('business_cover_lite_in')){?>
            <li><a title="<?php esc_attr_e('linkedin','business-cover-lite'); ?>" class="fa fa-linkedin" target="_blank" href="<?php echo esc_url(get_theme_mod('business_cover_lite_in','')); ?>"></a></li>
          <?php }?>
        </ul>
        
        <div class="clear"></div>
      </div><!--header_middle-->
      <div class="header_right headercommon">
        <ul>
          <li>
            <?php $business_cover_lite_email = get_theme_mod('business_cover_lite_email'); ?>
            <?php if(get_theme_mod('business_cover_lite_email')){?>
              <?php echo esc_html($business_cover_lite_email);?>&nbsp;&nbsp;<i class="fa fa-envelope"></i>
            <?php }?>
            

          </li>
          <li>
            <?php $business_cover_lite_phone = get_theme_mod('business_cover_lite_phone'); ?>
            <?php if(get_theme_mod('business_cover_lite_phone')){?>
              <?php echo esc_html($business_cover_lite_phone);?>&nbsp;&nbsp;<i class="fa fa-phone"></i>
            <?php }?>           
            </li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div><!--header_top-->
    <div class="clear"></div>
    
  </header>
</section><!--header-->
<section id="main_navigation">
  <div class="container">
  <div class="main-navigation-inner mainwidth">
      <div class="toggle">
                <a class="togglemenu" href="#"><?php esc_html_e('Menu','business-cover-lite'); ?></a>
             </div><!-- toggle --> 
      <div class="sitenav">
          <?php
          wp_nav_menu( array(
          'theme_location' => 'primary'
          ) );
          ?>
            </div><!-- site-nav -->
    </div><!--main-navigation-->
  </div><!--container-->
</section><!--main_navigation-->