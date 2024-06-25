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

            <?php

            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('PREVIOUS ARTICLE', 'thelogo') . '</span> <svg width="17" height="28" viewBox="0 0 17 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.578837 12.5661L11.7648 1.09466C12.538 0.301781 13.7881 0.301781 14.5531 1.09466L16.4119 3.00094C17.1851 3.79381 17.1851 5.07591 16.4119 5.86036L8.49126 14L16.4201 22.1312C17.1933 22.9241 17.1933 24.2062 16.4201 24.9906L14.5613 26.9053C13.7881 27.6982 12.538 27.6982 11.773 26.9053L0.587062 15.4339C-0.194311 14.6411 -0.194311 13.359 0.578837 12.5661Z" fill="#4CE0D7"/>
                </svg> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__('NEXT ARTICLE', 'thelogo') . '</span> <span class="nav-title">%title</span> <svg width="17" height="28" viewBox="0 0 17 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.4212 15.4339L5.2352 26.9053C4.46205 27.6982 3.21185 27.6982 2.44693 26.9053L0.588085 24.9991C-0.185062 24.2062 -0.185062 22.9241 0.588086 22.1396L8.50874 14L0.579863 5.86879C-0.193285 5.07591 -0.193285 3.79381 0.579863 3.00937L2.43871 1.09466C3.21186 0.301781 4.46205 0.301782 5.22697 1.09466L16.4129 12.5661C17.1943 13.3589 17.1943 14.641 16.4212 15.4339Z" fill="#4CE0D7"/>
                </svg>
                ',
                )
            );
            ?>

        </article>
        <?php

        get_sidebar();

    endwhile;
    ?>
</main>

<?php
get_footer();