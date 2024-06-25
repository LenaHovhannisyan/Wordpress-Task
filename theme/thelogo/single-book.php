<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while (have_posts()):
            the_post();
            ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php if (has_post_thumbnail()): ?>
                <div class="book-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
                <?php endif; ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <p>by
                    <?php echo esc_html(get_post_meta(get_the_ID(), '_thelogo_book_author', true)); ?>
                </p>


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

                <div class="book-description">
                    <?php the_content(); ?>
                </div>
            </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>