<?php
/*
 * @package      Meridian-function
 * @version      1.0
 * @author       DaoJing Gao <me@gaodaojing.com>
 * @copyright    2014 all rights reserved
 * @license:     GNU General Public License v2 or later
 * @license URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 */

function meridian_meta() { ?>
  <?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title><?php } ?>
  <?php if ( is_search() ) { ?><title><?php _e('搜索 &#34;');the_search_query();echo "&#34;";?> - <?php bloginfo('name'); ?></title><?php } ?>
  <?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title><?php } ?>
  <?php if ( is_author() ) { ?><title><?php wp_title(""); ?> - <?php bloginfo('name'); ?></title><?php } ?>
  <?php if ( is_archive() ) { ?><title><?php single_cat_title(); ?> - <?php bloginfo('name'); ?></title><?php } ?>
  <?php if ( is_year() ) { ?><title><?php the_time('Y'); ?> - <?php bloginfo('name'); ?></title><?php } ?>
  <?php if ( is_month() ) { ?><title><?php the_time('F'); ?> - <?php bloginfo('name'); ?></title><?php } ?>
  <?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?> - <?php bloginfo('name'); ?></title><?php } ?>
  <?php if ( is_404() ) { ?><title>404 - <?php bloginfo('name'); ?></title><?php } ?>
  <?php
  $options = get_option('meridian_options');
  global $post;
  if (is_home()){
    $keywords = $options['keywords'];
    $description = $options['description'];
  }elseif (is_single()){
    $keywords = get_post_meta($post->ID, "keywords", true);
    if($keywords == ""){
      $tags = wp_get_post_tags($post->ID);
      foreach ($tags as $tag){
        $keywords = $keywords.$tag->name.",";
      }
      $keywords = rtrim($keywords, ', ');
    }
    $description = get_post_meta($post->ID, "description", true);
    if($description == ""){
      if($post->post_excerpt){
        $description = $post->post_excerpt;
      }else{
        $description = mb_strimwidth(strip_tags($post->post_content),0,200,'');
      }
    }
  }elseif (is_page()){
    $keywords = get_post_meta($post->ID, "keywords", true);
    $description = get_post_meta($post->ID, "description", true);
  }elseif (is_category()){
    $keywords = single_cat_title('', false);
    $description = category_description();
  }elseif (is_tag()){
    $keywords = single_tag_title('', false);
    $description = tag_description();
  }
  $keywords = trim(strip_tags($keywords));
  $description = trim(strip_tags($description));
?>

  <meta name="keywords" content="<?php echo $keywords; ?>" />
  <meta name="description" content="<?php echo $description; ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
  <link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.png" type="image/x-icon" />

<?php } ?>