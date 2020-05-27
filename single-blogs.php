<?php
/**
 * The template for displaying academy pages
 *
 */
get_header(); ?>

<div class="newsPage">
	<?php while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</div>
<?php get_footer();?>
