<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        if (have_posts()):
            echo '<div class="post-archive">';
            while (have_posts()):
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                    <?php if (has_post_thumbnail()): ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="post-details">
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="post-excerpt"><?php the_excerpt(); ?></p>
                        <p class="post-meta">
                            <span class="post-author"><?php echo get_the_author(); ?></span>
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                        </p>
                    </div>
                </article>
                <?php
            endwhile;
            echo '</div>';

            // Pagination
        
            the_posts_navigation();
        else:
            echo '<p>No posts found.</p>';
        endif;

        wp_reset_postdata();
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>