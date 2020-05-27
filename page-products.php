<?php
/**
 * Template Name: Product PAGE
 */
get_header();
?>

<div class="all-product-list">
  <div class="row">
 <?php
       $page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
      $serviceArgs=array(
        'post_type' => 'post',
        'order' => 'DESC',                            
        'posts_per_page' => '6',
        'paged'       =>  $page,);
        query_posts($serviceArgs);
      while ( have_posts() ) : the_post();?>
           <?php $thumb_t = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); $url_t = $thumb_t['0'];?>
            <div class="newsPage-content col-md-4 col-sm-4  col-12 ">
              <div class="newsPage-item">
                <a href="<?php echo get_permalink($post->ID) ?>">
                    <div class=" newsPage-back-info ">
                      <h5> <?php the_title();?></h5>
                    </div>
                    <div class="newsPage-img">
                      <div class="newsPage-imgBox">
                        <img src="<?php bloginfo('template_url')?>/timthumb.php?src=<?php echo $url_t ?>&amp;w=320;&amp;h=213;&amp;zc=1" width="320" height="213" alt="<?php the_title();?>"/>
                      </div>
                    </div>
                    <!-- <span class="badge badge-primary"><i class="fa fa-angle-right" aria-hidden="true"></i>VIEW</span> -->
                </a>
              </div>
            </div>
      <?php endwhile;?>
      </div>
   <?php wp_pagenavi();?>
  <?php wp_reset_query();?>
</div>
  

<?php get_template_part( 'templates/footer-category' );?>