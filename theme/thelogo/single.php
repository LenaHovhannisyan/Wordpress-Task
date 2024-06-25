<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<main class="single-post-continer">
    <?php
	while (have_posts()):
		the_post();

		?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
        <div class="post-details">
            <p class="post-meta">
                <span class="post-date"><?php echo get_the_date(); ?></span>
                <span class="post-read-time"><?php echo get_reading_time(get_the_ID()); ?></span>
            </p>
        </div>

        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php if (has_post_thumbnail()): ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        </div>
        <?php endif; ?>

        <div class="post-content">
            <?php the_content(); ?>
        </div>

    </article>
    <?php

		get_sidebar();

		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'thelogo') . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'thelogo') . '</span> <span class="nav-title">%title</span>',
			)
		);

	endwhile;
	?>
</main>

<?php
get_footer();