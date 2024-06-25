<?php
/**
 * The template for displaying all pages
 */

get_header();
?>

<main id="primary" class="">
    <header class="page-header">
        <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .page-header -->

    <?php
	while (have_posts()):
		the_post();

		get_template_part('template-parts/content', 'page');

	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();