<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

get_header(); ?>
	<?php while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>
	<?php endwhile; ?>
<?php get_template_part( 'templates/footer-single' );?>

