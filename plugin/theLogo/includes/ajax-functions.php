<?php
// AJAX handler for loading more books
function thelogo_load_more_books()
{
    if (!isset($_POST['page'])) {
        wp_send_json_error('Page parameter is missing');
    }

    $paged = intval($_POST['page']);

    $args = array(
        'post_type' => 'book',
        'posts_per_page' => 4,
        'paged' => $paged,
    );

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {
        ob_start();
        echo '<div class="book-list">';
        while ($the_query->have_posts()) {
            $the_query->the_post();
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
        }
        echo '</div>';
        $response = ob_get_clean();
        wp_send_json_success($response);
    } else {
        wp_send_json_error('No more books found');
    }

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_thelogo_load_more_books', 'thelogo_load_more_books');
add_action('wp_ajax_nopriv_thelogo_load_more_books', 'thelogo_load_more_books');


// Enqueue script for AJAX
function thelogo_enqueue_scripts()
{
    wp_enqueue_script('thelogo-ajax', plugins_url('../admin/js/ajax.js', __FILE__), array('jquery'), null, true);
    wp_localize_script(
        'thelogo-ajax',
        'thelogo_ajax_obj',
        array(
            'ajaxurl' => admin_url('admin-ajax.php')
        )
    );
}
add_action('wp_enqueue_scripts', 'thelogo_enqueue_scripts');