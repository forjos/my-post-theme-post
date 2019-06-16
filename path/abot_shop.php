<?php 
 
/*
 * Получаем все Отзывы
 * post_type - название нашего произвольного типа записей (идентификатор)
 * posts_per_page - количество получаемых записей 
 * (в нашем случае стоит -1, это значит, что нужно получить все посты)
 */
$reviews = new WP_Query(array('post_type' => 'home_about_shop', 'posts_per_page' => -1)); 
 
?>

<div class="swiper_about_shop">
    <div class="swiper-wrapper">
      <?php if ( $reviews->have_posts() ) : while ( $reviews->have_posts() ) : $reviews->the_post(); ?>
      <div class="swiper-slide" style="background-image:url(<?php echo get_post_meta(get_the_ID(), 'meta-image', true) ?>)">
        <a href="<?php echo get_post_meta(get_the_ID(), 'link_about_shop', true) ?>" style="color:<?php echo get_post_meta(get_the_ID(), 'meta-color', true) ?>">
          <i class="<?php echo get_post_meta(get_the_ID(), 'icon_about_shop', true) ?>"></i>
          <p><?php echo get_post_meta(get_the_ID(), 'heading_about_shop', true) ?></p>
        </a>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
</div>
