<?php 
    get_header();

    pageBanner(array(
        'title' => get_the_title(),
        'subtitle' => 'Recap of out last event.'
    ))
?>

    <div class="container container--narrow page-section">
        <?php 
            $pastEvents = new WP_Query(array('post_type' => 'event', 'posts_per_page' => 10, 'paged'=> get_query_var('paged', 1))
            );


            while($pastEvents->have_posts()) {
                $pastEvents->the_post();
                get_template_part('template_parts/content-event');
            }
            echo paginate_links(array(
                'total' => $pastEvents->max_num_pages,
            ));
        ?>
    </div>
<?php
    get_footer();
?>