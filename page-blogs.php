<?php
/**
 * Template Name: Blogs PAGE
 */
get_header();
?>
<div class="all-article-list recommond">
	<h3><span>Recommond</span></h3>
  <div class="row">
 <?php
      $args4 = array(
          'post_type' => 'blogs',
          'showposts' => 4,
          'tax_query' => array(
              array(
                  'taxonomy' => 'blogs_category',
                  'terms' => 26
                  ),
              )
          );
      $my_query = new WP_Query($args4);
      if( $my_query->have_posts() ) {
          while ($my_query->have_posts()) : $my_query->the_post();?>
           <?php $thumb_t = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); $url_t = $thumb_t['0'];?>
            <div class="newsPage-content col-md-3 col-3 ">
              <div class="newsPage-item">
                <a href="<?php echo get_permalink($post->ID) ?>">
                    <div class="newsPage-img">
                    <div class="newsPage-imgBox">
                      <img src="<?php bloginfo('template_url')?>/timthumb.php?src=<?php echo $url_t ?>&amp;w=320;&amp;h=213;&amp;zc=1" width="320" height="213" alt="<?php the_title();?>"/>
                    </div>
                    </div>
                    <div class=" newsPage-back-info ">
                      <h5> <?php the_title();?></h5>
                    </div>
                </a>
              </div>
            </div>
          <?php endwhile; wp_reset_query();
         } ?>
  </div>
</div>
  

<div class="all-article-list ">
	<h3><span>The Latest</span></h3>
	<?php
      $page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
      $serviceArgs=array(
        'post_type' => 'blogs',
        'order' => 'DESC',                            
        'posts_per_page' => '6',
        'paged'       =>  $page,);
        query_posts($serviceArgs);
        while ( have_posts() ) : the_post();
          ?>
          <?php $thumb_t = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); $url_t = $thumb_t['0'];?>
            <div class="newsPage-content">
              <div class="newsPage-item">
                <a href="<?php echo get_permalink($post->ID) ?>">
                  <div class="row align-items-center" >
                    <div class="col-md-3  col-sm-3  col-12 newsPage-img">
                    <div class="newsPage-imgBox">
                      <img src="<?php bloginfo('template_url')?>/timthumb.php?src=<?php echo $url_t ?>&amp;w=240;&amp;h=180;&amp;zc=1" width="240" height="180" alt="<?php the_title();?>"/>
                    </div>
                    </div>
                    <div class="col-md-9  col-sm-9  col-12newsPage-back-info ">
                      <h5> <?php the_title();?></h5>
                      <?php if(has_excerpt()): ?>
                      <p><?php the_excerpt(); ?></p>
                      <?php else: ?>
                      <p><?php the_content(); ?></p>
                      <?php endif; ?>
                      <time><?php the_time('m-j-y');?></time>
                    </div>
                  </div>
                </a>
              </div>
            </div>
    <?php endwhile;?>
  </div>

<?php wp_pagenavi();?>
<?php wp_reset_query();?>
<?php get_footer();?>