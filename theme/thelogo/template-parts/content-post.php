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
        <p class="post-meta">
            <span class="post-date"><?php echo get_the_date(); ?></span>
            <span class="post-read-time"><?php echo get_reading_time(get_the_ID()); ?></span>
        </p>
    </div>
</article>