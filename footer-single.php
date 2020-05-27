<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

						// Widgets area inside page content
						electroserv_create_widgets_area('widgets_below_content');
						?>	
						<?php while ( have_posts() ) : the_post();?>
							<?php $post_related = get_field('related_product');?>
							<?php if($post_related):?>  
							 
								<div class="relative-pro">
									<div class="relative-pro-title">
										<h3>You may also find these topics interesting</h3>
									</div>
									<div class="relative-container">
										<div class="swiper-wrapper row">
											<?php foreach( $post_related as $p ): ?>
											<?php $thumb_t = wp_get_attachment_image_src( get_post_thumbnail_id($p->ID), 'full' ); $url_t = $thumb_t['0'];?>
											<div class="swiper-slide col-lg-3 col-md-3">
												<div class="pro-product item_block">
													<a class="item_img" title="<?php the_title(); ?>" href="<?php echo get_permalink( $p->ID ); ?>">   
														<?php if ($url_t) : ?>        
															<img class="img-responsive" src="<?php bloginfo('template_url')?>/timthumb.php?src=<?php echo $url_t ?>&w=420;&h=368;&zc=1" alt="<?php the_title();?>">
														<?php else : ?>  
															<img class="img-responsive" width="420" height="368" alt='<?php the_title() ;?>' src="<?php bloginfo('template_url')?>/timthumb.php?src=/wp-content/themes/wintechrapid/images/logo.png&w=420;&h=368;&zc=1"/>
														<?php endif; ?>
													</a> 
													<a class="item_img product-a" title="<?php the_title(); ?>" href="<?php echo get_permalink( $p->ID ); ?>">
														<div><?php echo get_the_title( $p->ID ); ?></div>
													</a>
												</div>
												<a class="relative-btn" title="<?php the_title(); ?>" href="<?php echo get_permalink( $p->ID ); ?>">
													<div>FIND OUT MORE</div>
												</a>
											</div>
											<?php endforeach; ?>
										</div>
									</div>
									
								</div>
							
					<?php endif;?>
					<?php endwhile;?>			
					</div><!-- </.content> -->
					<?php get_sidebar()?>
						
					<?php
					// Show main sidebar

					//去除原文本得sidebar
					// get_sidebar();

					// Widgets area below page content
					electroserv_create_widgets_area('widgets_below_page');

					$electroserv_body_style = electroserv_get_theme_option('body_style');
					if ($electroserv_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$electroserv_footer_type = electroserv_get_theme_option("footer_type");
			if ($electroserv_footer_type == 'custom' && !electroserv_is_layouts_available())
				$electroserv_footer_type = 'default';
			get_template_part( "templates/footer-{$electroserv_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (electroserv_is_on(electroserv_get_theme_option('debug_mode')) && electroserv_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(electroserv_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>
	<?php if (is_single()) { ?>
	<script src="https://cdn.bootcdn.net/ajax/libs/jquery-smooth-scroll/2.2.0/jquery.smooth-scroll.min.js"></script>
	<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme.js"></script>	
	<?php } ?>
</body>
</html>