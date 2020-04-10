<?php

require get_theme_file_path("/inc/search-route.php");
require get_theme_file_path("/inc/like-route.php");

function university_custom_rest() {
    register_rest_field('post', 'authorName', array(
        'get_callback' => function() {
            return get_the_author();
        }
    ));

    register_rest_field('note', 'userNoteCount', array(
        'get_callback' => function() {
            return count_user_posts( get_current_user_id(), 'note');
        }
    ));
}

add_action('rest_api_init', 'university_custom_rest');

function pageBanner($args = NULL) {

?>

<div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php 
            $pageBannerImage = get_field('page_banner_background_image');
            echo $pageBannerImage ? $pageBannerImage['sizes']['pageBanner'] : get_theme_file_uri('/images/barksalot.jpg');
        ?>);"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'] ? $args['title'] : get_the_title(); ?></h1>
        <div class="page-banner__intro">
            <p><?php echo $args['subtitle'] ? $args['subtitle'] : get_field('page_banner_subtitle'); ?></p>
        </div>
        </div>  
    </div>  

<?php }

function university_map_key( $api ){
	$api['key'] = 'AIzaSyAbDHTrsP4XfFdiWD7UGJmnmOBkyQmVpYk';
	return $api;
}


function university_files () {
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime()); // Only include css files in theme files only, not including login and signup
    wp_enqueue_script('googleMap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAbDHTrsP4XfFdiWD7UGJmnmOBkyQmVpYk', NULL, 1.0);
    wp_enqueue_script( 'main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL , microtime() , true ); //use microtime to create unique version number to prevent caching
    // Interception between js and php
    wp_localize_script( 'main-university-js', 'universityData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features() {
    register_nav_menu( 'HeaderMenuLocation', 'Header Menu Location');
    register_nav_menu( 'FooterLocationOne', 'Footer Location One');
    register_nav_menu( 'FooterLocationTwo', 'Footer Location Two');
    add_theme_support( 'title-tag');
    add_theme_support( 'post-thumbnails');
    // Customise image size
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}

function university_adjust_queries($query) {
    // !is_admin is to make sure it is not happening at admin dashboard
    // is_post_type_archive see whether the query is from the archive
    // is_main_query to make sure it is default quey, because pre_get_posts events is fired everytime the WP_Query is called.
    if(!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
        $query->set('posts_per_page', -1);
    }


    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
    
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) { //is_main_query means default query only
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'DESC');
        $query->set('meta_query', array(
            array(
                'key'=> 'event_date',
                'compare' => '>=',
                'value' => $today,
            )
            ));
    }
}

add_action('after_setup_theme', 'university_features');

// Before the wordpress query for posts
add_action('pre_get_posts', 'university_adjust_queries');

// For google map api key setting
add_filter('acf/fields/google_map/api', 'university_map_key');

// Redirect subscriber out of admin to homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
    $ourCurrentUser = wp_get_current_user(  );

    if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}

//Remove Admin Bar

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
    $ourCurrentUser = wp_get_current_user(  );

    if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}


// Customise login screen

add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
    return esc_url(site_url( '/'));
}

// Add css to login screen

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL, microtime());
}

add_filter("login_headertitle", "ourLoginTitle");

function ourLoginTitle() {
    return "Fictional University";
}

//Force notes post to be private
// 10 is the priority order in case there is another function attached to the event
// 2 means the number of arguments exposed for the callback
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

function makeNotePrivate($data, $postarr) 
{      
    if($data['post_type'] == 'note') {
        if(count_user_posts( get_current_user_id(), 'note') >= 2 AND !$postarr['ID']) {
            die("You have reached your note limit!");
        }

        $data['post_content'] = sanitize_textarea_field($data['post_content']);
        $data['post_title'] = sanitize_text_field( $data['post_title'] );
    }

    if($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
        $data['post_status'] = 'private';
    }
    return $data;
}
