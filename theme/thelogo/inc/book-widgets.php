<?php
class Related_Books_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'related_books_widget',
            __('Related Books', 'text_domain'),
            array('description' => __('Displays related books', 'text_domain'))
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Exclude current post ID if on single book page
        $exclude_id = is_singular('book') ? get_the_ID() : 0;

        // Query for related books
        $query_args = array(
            'post_type' => 'book',
            'posts_per_page' => 3,
            'orderby' => 'rand',
            'post__not_in' => array($exclude_id)
        );
        $related_books = new WP_Query($query_args);

        if ($related_books->have_posts()) {
            echo '<ul class="related-books-list">';
            while ($related_books->have_posts()) {
                $related_books->the_post();
                $author = get_post_meta(get_the_ID(), '_thelogo_book_author', true);
                echo '<li>';
                if (has_post_thumbnail()) {
                    echo '<div class="book-thumbnail"><a href="' . get_the_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'thumbnail') . '</a></div>';
                }
                echo '<div class="book-details">';
                echo '<h3 class="book-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                if (!empty($author)) {
                    echo '<p class="book-author">by ' . esc_html($author) . '</p>';
                }
                echo '<a href="' . get_the_permalink() . '" class="book-more-button">More</a>';
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo 'No related books found.';
        }

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Related Books', 'text_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }
}

function register_related_books_widget()
{
    register_widget('Related_Books_Widget');
}
add_action('widgets_init', 'register_related_books_widget');
