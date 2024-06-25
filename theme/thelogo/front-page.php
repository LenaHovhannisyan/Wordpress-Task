<?php
/**
 * Front page template
 */

get_header();
?>

<main id="front-page" class="site-main">

    <?php
    $latest_post_query = new WP_Query(
        array(
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC'
        )
    );

    if ($latest_post_query->have_posts()) {
        while ($latest_post_query->have_posts()) {
            $latest_post_query->the_post();
            $post_id = get_the_ID();
            $title = get_the_title();
            $date = get_the_date();
            $link = get_permalink();
            $image = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id) : '';

            ?>

    <div id="last-post-link" class="latest-post-banner" data-href="<?php echo $link ?>">
        <div class="latest-post-thumbnail" style="background-image: url(<?php echo $image ?>);"></div>
        <div class="overlay"></div>
        <div class="latest-post-info">
            <p class="latest-post-date"> <?php echo $date ?> </p>
            <h2 class="latest-post-title"> <?php echo $title ?> </h2>
        </div>
    </div>
    <?php
        }
    }

    wp_reset_postdata();
    ?>

    <section class="last-news">
        <h2 class="section-title"><?php esc_html_e('Latest News', 'thelogo'); ?></h2>

        <div class="last-news-container">
            <?php
            $latest_post_id = get_posts()[0]->ID;

            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => array($latest_post_id),
                'orderby' => 'date',
                'order' => 'DESC',
            );

            $custom_query = new WP_Query($args);

            if ($custom_query->have_posts()):
                while ($custom_query->have_posts()):
                    $custom_query->the_post();
                    $reading_time = get_reading_time(get_the_ID());
                    ?>
            <div class="post-card">
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                    </a>
                </div>
                <div class="post-content">
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                    <span class="post-read-time"><?php echo $reading_time; ?></span>
                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo 'No posts found';
            endif;
            ?>
        </div>
    </section>

    <?php the_content(); ?>

</main><!-- #front page -->

<?php
get_footer();