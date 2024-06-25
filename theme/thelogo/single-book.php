<?php get_header(); ?>

<div id="primary" class="content-area">
    <main class="single-post-continer">
        <?php
        while (have_posts()):
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header single-book-header">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="book-thumbnail">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="book-detals">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <p>by
                            <?php echo esc_html(get_post_meta(get_the_ID(), '_thelogo_book_author', true)); ?>
                        </p>

                        <div class="book-description">
                            <?php the_content(); ?>
                        </div>
                    </div>

                </header><!-- .entry-header -->

                <div class="entry-content">
                    <div class="book-meta">
                        <p><strong>ISBN:</strong>
                            <?php echo esc_html(get_post_meta(get_the_ID(), '_thelogo_book_isbn', true)); ?></p>

                        <p><strong>Publication Year:</strong>
                            <?php echo esc_html(get_post_meta(get_the_ID(), '_thelogo_book_publication_year', true)); ?>
                        </p>

                        <p><strong>Genre:</strong> <?php the_terms(get_the_ID(), 'book_genre', '', ', ', ''); ?></p>
                    </div>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
        endwhile;

        //get_sidebar();
        dynamic_sidebar('books-widget-area');
        ?>
    </main><!-- #main -->

    <h3 class="other-books-title">You might also enjoy</h3>
    <?php
    $exclude_id = get_the_ID();

    // Custom Query
    $args = array(
        'post_type' => 'book',
        'post__not_in' => array($exclude_id),
        'posts_per_page' => 4, 
    );

    $query = new WP_Query($args);

    // Display books
    if ($query->have_posts()):
        echo '<div class="book-list">';
        while ($query->have_posts()):
            $query->the_post();
            $post_permalink = get_permalink();
            echo '<a href="' . esc_url($post_permalink) . '">';
            echo '<div class="book-item">';
            if (has_post_thumbnail()) {
                echo '<div class="book-thumbnail">' . get_the_post_thumbnail(get_the_ID(), 'large') . '</div>';
            }
            echo '<div class="book-details">';
            the_title('<h3>', '</h3>');
            echo '<p>by ' . get_post_meta(get_the_ID(), '_thelogo_book_author', true) . '</p>';

            echo '</div>';
            echo '</div>';
            echo '</a>';
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    else:
        echo '<p>No books found.</p>';
    endif;
    ?>


</div><!-- #primary -->

<?php get_footer(); ?>