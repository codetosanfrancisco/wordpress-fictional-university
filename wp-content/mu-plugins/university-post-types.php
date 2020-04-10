<?php

function university_post_type() {
    register_post_type('event', array(
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_name' => 'Event'
        ),
        'menu_icon' => 'dashicons-products',
    ));

    register_post_type('program', array(
        // What is slug? A WordPress slug is a text which comes after your domain name as a part of your permalink that is leading to your content
        'supports' => array('title'),
        'rewrite' => array('slug' => 'programs'),
        'public' => true,
        'has_archive' => true,
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Progam',
            'all_items' => 'All Programs',
            'singular_name' => 'Program'
        ),
        'menu_icon' => 'dashicons-awards',
        //'show_in_rest' => true
    ));

    register_post_type('professor', array(
        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => true,
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Progam',
            'all_items' => 'All Professors',
            'singular_name' => 'Professor'
        ),
        'menu_icon' => 'dashicons-welcome-learn-more',
        //'show_in_rest' => true
    ));

    register_post_type('campus', array(
        'capability_type' => 'campus',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor'),
        'public' => true,
        'rewrite' => array('slug' => 'campuses'),
        'has_archive' => true,
        'labels' => array(
            'name' => 'Campus',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_name' => 'Campus'
        ),
        'menu_icon' => 'dashicons-location-alt',
    ));

    // Register New Note Type
    register_post_type('note', array(
        // needed when setting user role & permission
        'capability_type' => 'note',
        'map_meta_cap' => true,
        'supports' => array('title', 'editor'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notes',
            'singular_name' => 'Note'
        ),
        'menu_icon' => 'dashicons-welcome-write-blog',
        // Allow CRUD via REST API
        'show_in_rest' => true
    ));

    register_post_type('like', array(
        'supports' => array('title'),
        'public' => false,
        'show_ui' => true,
        'labels' => array(
            'name' => 'Likes',
            'add_new_item' => 'Add New Like',
            'edit_item' => 'Edit Like',
            'all_items' => 'All Likes',
            'singular_name' => 'Like'
        ),
        'menu_icon' => 'dashicons-heart',
    ));
}

add_action('init', 'university_post_type');