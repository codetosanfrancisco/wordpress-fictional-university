<?php 
    get_header();
    pageBanner(array(
        'title' => 'All Events',
        'subtitle' => "See what's going on in our world!"
    ))
?>

    <div class="container container--narrow page-section">
        <?php 
            while(have_posts()) {
                the_post();
                get_template_part('template_parts/content-event');
            }
            echo paginate_links();
        ?>

        <hr class="section-break"/> >

        <a href="<?php echo site_url('/past-events'); ?>">Looking for a recap of past events? Check out our past events!</a>

    </div>
<?php
    get_footer();
?>