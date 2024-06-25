<?php
/**
 * Template part for displaying posts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="post-header">
		<?php
		if (is_singular()):
			the_title('<h1 class="post-title">', '</h1>');
		else:
			the_title('<h2 class="post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;
		?>
	</header><!-- .post-header -->

	<div class="post-content">
		<?php
		the_content();
		?>
	</div><!-- .post-content -->

</article><!-- #post-<?php the_ID(); ?> -->