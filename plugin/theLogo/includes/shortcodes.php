<?php
// Shortcode for displaying book list with pagination or ajax

function thelogo_book_list_shortcode($atts)
{
    $a = shortcode_atts(
        array(
            'type' => 'pagination'
        ),
        $atts
    );

    ob_start();

    if ($a['type'] == 'pagination') {
        echo '<div id="thelogo-book-list-pagination">';
        thelogo_display_books_with_pagination();
        echo '</div>';
    } else if ($a['type'] == 'ajax') {
        echo '<div id="thelogo-book-list">';
        thelogo_display_books_with_ajax();
        echo '</div>';
        echo '<div class="load-more-btn-container"><button id="thelogo-load-more">More Books</button></div>';
    }

    return ob_get_clean();
}
add_shortcode('book_list', 'thelogo_book_list_shortcode');

// Function to display books with pagination
function thelogo_display_books_with_pagination()
{
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'book',
        'posts_per_page' => 8,
        'paged' => $paged,
    );

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {
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

        // Pagination
        $big = 999999999;
        echo '<div class="pagination">';
        echo paginate_links(
            array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $the_query->max_num_pages
            )
        );
        echo '</div>';
    } else {
        echo '<p>No books found</p>';
    }

    wp_reset_postdata();
}

// Function to display books with AJAX
function thelogo_display_books_with_ajax()
{
    $args = array(
        'post_type' => 'book',
        'posts_per_page' => 4,
        'paged' => 1,
    );

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {
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
    } else {
        echo '<p>No books found</p>';
    }

    wp_reset_postdata();
}