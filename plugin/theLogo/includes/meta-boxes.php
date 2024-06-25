<?php
// Add meta box
function thelogo_add_book_meta_box()
{
    add_meta_box(
        'thelogo_book_meta',
        'Book Details',
        'thelogo_book_meta_box_callback',
        'book'
    );
}
add_action('add_meta_boxes', 'thelogo_add_book_meta_box');

// Meta box callback
function thelogo_book_meta_box_callback($post)
{
    // Add nonce for security
    wp_nonce_field('thelogo_save_book_meta_box_data', 'thelogo_book_meta_box_nonce');

    $author = get_post_meta($post->ID, '_thelogo_book_author', true);
    $publication_year = get_post_meta($post->ID, '_thelogo_book_publication_year', true);
    $isbn = get_post_meta($post->ID, '_thelogo_book_isbn', true);

    echo '<label for="thelogo_book_author">Author</label>';
    echo '<input type="text" id="thelogo_book_author" name="thelogo_book_author" value="' . esc_attr($author) . '" size="25" />';

    echo '<label for="thelogo_book_publication_year">Publication Year</label>';
    echo '<input type="number" id="thelogo_book_publication_year" name="thelogo_book_publication_year" value="' . esc_attr($publication_year) . '" size="4" />';

    echo '<label for="thelogo_book_isbn">ISBN</label>';
    echo '<input type="text" id="thelogo_book_isbn" name="thelogo_book_isbn" value="' . esc_attr($isbn) . '" size="13" />';
}

// Save meta box data
function thelogo_save_book_meta_box_data($post_id)
{
    if (!isset($_POST['thelogo_book_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['thelogo_book_meta_box_nonce'], 'thelogo_save_book_meta_box_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['post_type']) && 'book' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (!isset($_POST['thelogo_book_author']) || !isset($_POST['thelogo_book_publication_year']) || !isset($_POST['thelogo_book_isbn'])) {
        return;
    }

    $author = sanitize_text_field($_POST['thelogo_book_author']);
    $publication_year = sanitize_text_field($_POST['thelogo_book_publication_year']);
    $isbn = sanitize_text_field($_POST['thelogo_book_isbn']);

    update_post_meta($post_id, '_thelogo_book_author', $author);
    update_post_meta($post_id, '_thelogo_book_publication_year', $publication_year);
    update_post_meta($post_id, '_thelogo_book_isbn', $isbn);
}
add_action('save_post', 'thelogo_save_book_meta_box_data');