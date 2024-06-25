<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                if (is_category()) {
                    single_cat_title();
                } elseif (is_tag()) {
                    single_tag_title();
                } elseif (is_author()) {
                    the_post();
                    printf(__('Author: %s', 'textdomain'), get_the_author());
                    rewind_posts();
                } elseif (is_day()) {
                    printf(__('Day: %s', 'textdomain'), get_the_date());
                } elseif (is_month()) {
                    printf(__('Month: %s', 'textdomain'), get_the_date(_x('F Y', 'monthly archives date format', 'textdomain')));
                } elseif (is_year()) {
                    printf(__('Year: %s', 'textdomain'), get_the_date(_x('Y', 'yearly archives date format', 'textdomain')));
                } else {
                    _e('Archives', 'textdomain');
                }
                ?>
            </h1>
        </header><!-- .page-header -->

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10, // Number of posts per page
            'paged' => $paged,
        );

        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) :
            echo '<div class="post-archive">';
            while ($the_query->have_posts()) : $the_query->the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
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
            $big = 999999999; // need an unlikely integer
            echo '<div class="pagination">';
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $the_query->max_num_pages
            ));
            echo '</div>';
        else :
            echo '<p>No posts found.</p>';
        endif;

        wp_reset_postdata();
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
