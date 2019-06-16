<?php 
/* 
Plugin Name: Плагин пользовательский тип постов 
Description: Provides a starting point for creating custom meta boxes. 
Author: Milk
Version: 1.0
*/


// Создаём страницу в меню админки
add_action( 'admin_menu', 'settings_menu');

function settings_menu() {
    add_menu_page( __( 'Page Title' ), 'Главная страница', 'manage_options', 'menu_home', 'show_page_callback', 'dashicons-align-right', 4 );
    add_menu_page( 'Megabuzz Theme Options', 'Megabuzz', 'manage_options', 'megabuzz_setting', 'megabuzz_theme_create_page', get_stylesheet_directory_uri() . '/assets/img/seal.png', 5 );
}
function show_page_callback() {
}

/* тип записи новинки/новости */
add_action('init', 'news_new_megabuzz_funct');
function news_new_megabuzz_funct(){
	$labels = array(
		'name' 				=> 'Новинки/Новости',
		'singular_name' 	=> 'Новинки/Новости',
		'menu_name'			=> 'Новинки/Новости',
		'name_admin_bar'	=> 'Новинки/Новости',
		'add_new'           => 'Добавить новость',
 		'add_new_item'      => 'Добавить новость',
 		'edit_item'         => 'Редактировать новость',
	);
	 $args = array(
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_in_menu'		=> 'megabuzz_setting',
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'menu_position'		=> 26,
		'menu_icon'			=> 'dashicons-email-alt',
		'supports'			=> array( 'title', 'author' )
	 );    
register_post_type( 'news_new_megabuzz', $args ); 
}
/* Тип записи новинки/новости end */


/* тип записи about */
add_action('init', 'home_about_shop_funct');
function home_about_shop_funct(){
 	$labels = array(
 		'name' 					=> 'О магазине',
 		'add_new'               => 'Добавить запись',
 		'add_new_item'          => 'Добавить запись',
 		'edit_item'             => 'Редактировать запись',
 		'singular_name' 		=> 'О магазине'
 	);
 	$args = array(
 		'labels'			=> $labels,
 		'show_ui'			=> true,
 		'show_in_menu'		=> 'megabuzz_setting',
 		'capability_type'	=> 'post',
 		'hierarchical'		=> false,
 		'menu_position'		=> 26,
 		'menu_icon'			=> 'dashicons-email-alt',
 		'supports'			=> array( 'title', 'author' )
 	);
 register_post_type('home_about_shop', $args);
 }    
/* Тип записи about end */



// новые поля в админке

/**
  * Adds a meta box to the post editing screen
*/
function prfx_custom_meta() {
    add_meta_box( 'prfx_meta', __( 'Настройки', 'storefront-megabuzz' ), 'home_about_shop_meta', 'home_about_shop', 'normal', 'high' );
    add_meta_box( 'prfx_meta', __( 'Настройки', 'storefront-megabuzz' ), 'news_new_megabuzz_meta', 'news_new_megabuzz', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'prfx_custom_meta' );

/**
 * Outputs the content of the meta box
*/

// о магазине
function home_about_shop_meta( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
	$prfx_stored_meta = get_post_meta( $post->ID );
	?>

	<p>
		<label for="heading_about_shop" class="prfx-row-title"><?php _e( 'Заголовок', 'storefront-megabuzz' )?></label>
		<input type="text" name="heading_about_shop" id="heading_about_shop" value="<?php if ( isset ( $prfx_stored_meta['heading_about_shop'] ) ) echo $prfx_stored_meta['heading_about_shop'][0]; ?>" />
	</p>

	<p class="admin_meta_box">
    	<label for="meta-color" class="prfx-row-title"><?php _e( 'Цвет текста и инонки <br>(по-умолчанию белый)', 'storefront-megabuzz' )?></label>
    	<input name="meta-color" type="text" value="<?php if ( isset ( $prfx_stored_meta['meta-color'] ) ) echo $prfx_stored_meta['meta-color'][0]; ?>" class="meta-color" />
	</p>

	<div class="admin_meta_box">
	    <label for="meta-image" class="prfx-row-title"><?php _e( 'Изображение', 'storefront-megabuzz' )?></label>
	    <div class="img_news_admin" style="width: 150px; height: 150px; background-size: cover; background-image: url('<?php if ( isset ( $prfx_stored_meta['meta-image'] ) ) echo $prfx_stored_meta['meta-image'][0]; ?>');"></div>
	    <input type="hidden" name="meta-image" id="meta-image" value="<?php if ( isset ( $prfx_stored_meta['meta-image'] ) ) echo $prfx_stored_meta['meta-image'][0]	; ?>" />
	    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Выбрать', 'storefront-megabuzz' )?>" />
	</div>

	<p class="admin_meta_box">
	    <label for="icon_about_shop" class="prfx-row-title"><?php _e( 'Иконка (вставьте класс элемента i)', 'storefront-megabuzz' )?></label>
	    <input type="text" name="icon_about_shop" id="icon_about_shop" value="<?php if ( isset ( $prfx_stored_meta['icon_about_shop'] ) ) echo $prfx_stored_meta['icon_about_shop'][0]; ?>" />
	    <a class="link_admin_meta" href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">Иконки</a>
	</p>

	<p class="admin_meta_box">
    	<label for="link_about_shop" class="prfx-row-title"><?php _e( 'Ссылка', 'storefront-megabuzz' )?></label>
    	<input type="text" name="link_about_shop" id="link_about_shop" value="<?php if ( isset ( $prfx_stored_meta['link_about_shop'] ) ) echo $prfx_stored_meta['link_about_shop'][0]; ?>" />
	</p>

	<?php
}


// новости/новинки
function news_new_megabuzz_meta( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
	$prfx_stored_meta = get_post_meta( $post->ID );
	?>

	<p>
		<label for="heading_newnews" class="prfx-row-title"><?php _e( 'Заголовок', 'storefront-megabuzz' )?></label>
		<input type="text" name="heading_newnews" id="heading_newnews" value="<?php if ( isset ( $prfx_stored_meta['heading_newnews'] ) ) echo $prfx_stored_meta['heading_newnews'][0]; ?>" />
	</p>

	
	<div class="img_news_admin" style="width: 150px; height: 150px; background-size: cover; background-image: url('<?php if ( isset ( $prfx_stored_meta['image_newnews'] ) ) echo $prfx_stored_meta['image_newnews'][0]; ?>');"></div>
	<p class="admin_meta_box">
	    <label for="image_newnews" class="prfx-row-title"><?php _e( 'Изображение', 'storefront-megabuzz' )?></label>
	    <input type="hidden" name="image_newnews" id="meta-image" value="<?php if ( isset ( $prfx_stored_meta['image_newnews'] ) ) echo $prfx_stored_meta['image_newnews'][0]	; ?>" />
	    <input type="button" id="meta-image-button" class="button" value="<?php _e( 'Выбрать', 'storefront-megabuzz' )?>" />
	</p>

	<p class="admin_meta_box">
    	<label for="link_newnews" class="prfx-row-title"><?php _e( 'Ссылка', 'storefront-megabuzz' )?></label>
    	<input type="text" name="link_newnews" id="link_newnews" value="<?php if ( isset ( $prfx_stored_meta['link_newnews'] ) ) echo $prfx_stored_meta['link_newnews'][0]; ?>" />
	</p>


	<?php
}

/**
 * Saves the custom meta input
 */
function prfx_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and saves if needed
if( isset( $_POST[ 'meta-color' ] ) ) {
    update_post_meta( $post_id, 'meta-color', $_POST[ 'meta-color' ] );
}

 // Checks for input and saves if needed
if( isset( $_POST[ 'meta-image' ] ) ) {
    update_post_meta( $post_id, 'meta-image', $_POST[ 'meta-image' ] );
}
 
// Checks for input and sanitizes/saves if needed
if( isset( $_POST[ 'heading_about_shop' ] ) ) {
        update_post_meta( $post_id, 'heading_about_shop', sanitize_text_field( $_POST[ 'heading_about_shop' ] ) );
}

// Checks for input and sanitizes/saves if needed
if( isset( $_POST[ 'icon_about_shop' ] ) ) {
        update_post_meta( $post_id, 'icon_about_shop', sanitize_text_field( $_POST[ 'icon_about_shop' ] ) );
}

// Checks for input and sanitizes/saves if needed
if( isset( $_POST[ 'link_about_shop' ] ) ) {
        update_post_meta( $post_id, 'link_about_shop', sanitize_text_field( $_POST[ 'link_about_shop' ] ) );
}
// Checks for input and sanitizes/saves if needed
if( isset( $_POST[ 'heading_newnews' ] ) ) {
        update_post_meta( $post_id, 'heading_newnews', sanitize_text_field( $_POST[ 'heading_newnews' ] ) );
}
// Checks for input and sanitizes/saves if needed
if( isset( $_POST[ 'image_newnews' ] ) ) {
        update_post_meta( $post_id, 'image_newnews', sanitize_text_field( $_POST[ 'image_newnews' ] ) );
}
// Checks for input and sanitizes/saves if needed
if( isset( $_POST[ 'link_newnews' ] ) ) {
        update_post_meta( $post_id, 'link_newnews', sanitize_text_field( $_POST[ 'link_newnews' ] ) );
}

 
}
add_action( 'save_post', 'prfx_meta_save' );



// css
function prfx_admin_styles(){
   wp_enqueue_style( 'prfx_meta_box_styles', plugin_dir_url( __FILE__ ) . '/assets/meta-box.css' );
}
add_action( 'admin_print_styles', 'prfx_admin_styles' );
// js
function prfx_color_enqueue() {
	wp_enqueue_script( 'meta-box-color-js', plugin_dir_url( __FILE__ ) . '/assets/meta-box.js', array( 'wp-color-picker' ) );
}
add_action( 'admin_enqueue_scripts', 'prfx_color_enqueue' );






/**
 * Loads the image management javascript
 */
function prfx_image_enqueue() {
    global $typenow;
    if( $typenow == 'home_about_shop' || 'news_new_megabuzz' ) {
        wp_enqueue_media();
 
        // Registers and enqueues the required javascript.
        wp_register_script( 'meta-box-image', plugin_dir_url( __FILE__ ) . 'meta-box-image.js', array( 'jquery' ) );
        wp_localize_script( 'meta-box-image', 'meta_image',
            array(
                'title' => __( 'Выбрать', 'storefront-megabuzz' ),
                'button' => __( 'Использовать это изображение', 'storefront-megabuzz' ),
            )
        );
        wp_enqueue_script( 'meta-box-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'prfx_image_enqueue' );


// css для сайта
function style_my_post_custom(){
    wp_deregister_style( 'style_my_post_custom' );
    wp_enqueue_style( 'style_my_post_custom', plugin_dir_url( __FILE__ ) . 'assets/style_my_post_custom.css');
}
add_action( 'wp_enqueue_scripts', 'style_my_post_custom' );

///swiper css
function swiper_css(){
    wp_deregister_style( 'swiper-style' );
    wp_enqueue_style( 'swiper-style', plugin_dir_url( __FILE__ ) . 'assets/swiper.css');
}
add_action( 'wp_enqueue_scripts', 'swiper_css' );


// js для сайта
function js_my_post_type() {
	wp_enqueue_script( 'js-my-post-type', plugin_dir_url( __FILE__ ) . 'assets/main-my-post-type.js', array( 'swiper-js' ));
}
add_action( 'wp_enqueue_scripts', 'js_my_post_type' );

///swiper js
function swiper_js() {
	wp_deregister_style( 'swiper-js' );
	wp_enqueue_script( 'swiper-js', plugin_dir_url( __FILE__ ) . 'assets/swiper.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'swiper_js' );



// шорткод новости и новинки
function news_and_new_show() {
    $args = array(
	'post_type' => 'news_new_megabuzz',
	'posts_per_page' => 2,
	);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {

$string .= '<div class="news_new_megabuzz_container">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$string .= '
		<div class="news_new_megabuzz_box" style="background-image:url('. get_post_meta(get_the_ID(), 'image_newnews', true) .')">
			<a href="'. get_post_meta(get_the_ID(), 'link_newnews', true) .'">
				<p>'. get_post_meta(get_the_ID(), "heading_newnews", true) .'</p>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        			<path d="M12 4L10.59 5.41L16.17 11H4V13H16.17L10.59 18.59L12 20L20 12L12 4Z" fill="white"/>
      			</svg>
			</a>
		</div>';
	}
	$string .= '</div>';
	/* Восстанавливаем оригинальные Post Data */
	wp_reset_postdata();
} else {

$string .= 'записей не найдено';
}

return $string;
}
add_shortcode('news_and_new_short', 'news_and_new_show' );

// шорткод о магазине
function abot_shop_show() {
    $args = array(
	'post_type' => 'home_about_shop',
	'posts_per_page' => -1,
	);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {

$string .= '<div class="swiper_about_shop"><div class="swiper-wrapper">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		$string .= '
		<div class="swiper-slide" style="background-image:url('. get_post_meta(get_the_ID(), 'meta-image', true) .')">
			<a href="'. get_post_meta(get_the_ID(), 'link_about_shop', true) .'" style="color:'. get_post_meta(get_the_ID(), 'meta-color', true) .'">
				<i class="'. get_post_meta(get_the_ID(), "icon_about_shop", true) .'"></i>
				<p>'. get_post_meta(get_the_ID(), "heading_about_shop", true) .'</p>
			</a>
		</div>';
	}
	$string .= '</div></div>';
	/* Восстанавливаем оригинальные Post Data */
	wp_reset_postdata();
} else {

$string .= 'записей не найдено';
}

return $string;
}
add_shortcode('abot_shop_short', 'abot_shop_show' );

//function my_short_show() {
//    return 'привет';
//}
//add_shortcode('my_short', 'my_short_show' );


// echo get_post_meta(get_the_ID(), "heading_about_shop", true)



// alex tutorial
function megabuzz_news_icon_add_meta_box(){
	add_meta_box( 'news_icon', 'Иконка', 'megabuzz_news_icon_callback', 'news_new_megabuzz', 'normal', 'high' );
}
function megabuzz_news_icon_callback( $post ){

	wp_nonce_field( 'save_news_icon', 'megabuzz_news_icon_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_news_icon_value_key', true );

	echo '<label for="megabuzz_news_icon_field">User Email Address: </lable>';
	echo '<input type="email" id="megabuzz_news_icon_field" name="megabuzz_news_icon_field" value="' . esc_attr( $value ) . '" size="25" />';

}

add_action( 'add_meta_boxes', 'megabuzz_news_icon_add_meta_box' );
add_action( 'save_post', 'save_news_icon' );

function save_news_icon( $post_id ){

	if( ! isset( $_POST['megabuzz_news_icon_meta_box_nonce'] ) ){
		return;
	}
	
	if( ! wp_verify_nonce( $_POST['megabuzz_news_icon_meta_box_nonce'], 'save_news_icon') ) {
		return;
	}
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}
	
	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	if( ! isset( $_POST['megabuzz_news_icon_field'] ) ) {
		return;
	}
	
	$my_data = sanitize_text_field( $_POST['megabuzz_news_icon_field'] );
	
	update_post_meta( $post_id, '_news_icon_value_key', $my_data );
}