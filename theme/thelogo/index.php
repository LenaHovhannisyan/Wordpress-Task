<?php
/**
 * The main template
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
	if (have_posts()):

		while (have_posts()):
			the_post();

			get_template_part('template-parts/content', get_post_type());

		endwhile;

		the_posts_navigation();

		thelogo_custom_pagination();

	endif;
	?>

</main>

<?php
get_footer();