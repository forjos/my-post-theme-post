<?php 
 
/*
 * Получаем все Отзывы
 * post_type - название нашего произвольного типа записей (идентификатор)
 * posts_per_page - количество получаемых записей 
 * (в нашем случае стоит -1, это значит, что нужно получить все посты)
 */
$reviews = new WP_Query(array('post_type' => 'news_new_megabuzz', 'posts_per_page' => 2)); 
 
?>
 
<div class="news_new_megabuzz_container">
  <?php if ( $reviews->have_posts() ) : while ( $reviews->have_posts() ) : $reviews->the_post(); ?>
  <div class="news_new_megabuzz_box" style="background-image:url(<?php echo get_post_meta(get_the_ID(), 'image_newnews', true) ?>)">
    <a href="<?php echo get_post_meta(get_the_ID(), 'link_newnews', true) ?>">
      <p><?php echo get_post_meta(get_the_ID(), 'heading_newnews', true) ?></p>
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 4L10.59 5.41L16.17 11H4V13H16.17L10.59 18.59L12 20L20 12L12 4Z" fill="white"/>
      </svg>

    </a>
  </div>
  <?php endwhile; ?>
  <?php endif; ?>
</div>