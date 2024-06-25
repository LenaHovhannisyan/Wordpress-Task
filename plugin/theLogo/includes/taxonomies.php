<?php
// Register custom taxonomy
function thelogo_register_book_genre_taxonomy() {
    $labels = array(
        'name' => 'Book Genres',
        'singular_name' => 'Book Genre',
        'search_items' => 'Search Book Genres',
        'all_items' => 'All Book Genres',
        'parent_item' => 'Parent Book Genre',
        'parent_item_colon' => 'Parent Book Genre:',
        'edit_item' => 'Edit Book Genre',
        'update_item' => 'Update Book Genre',
        'add_new_item' => 'Add New Book Genre',
        'new_item_name' => 'New Book Genre Name',
        'menu_name' => 'Book Genres',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'book-genre'),
    );

    register_taxonomy('book_genre', array('book'), $args);
}
add_action('init', 'thelogo_register_book_genre_taxonomy');
