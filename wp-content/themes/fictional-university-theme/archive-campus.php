<?php 
    get_header();

    pageBanner(array(
        'title'=> 'Our Campuses',
        'subtitle' => "We have several conveniently located campuses!"
    ))
?>

    <div class="container container--narrow page-section">
        <div class="acf-map">
            <?php 
                while(have_posts()) {
                    the_post();
                    $mapLocation = get_field('map_location');
            ?>
                <div data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>" class="marker">
                    <h3><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php echo $mapLocation['address']; ?>
                </div>
            <?php
                }
            ?>
        </div>

        <hr class="section-break"/> >

        <a href="<?php echo site_url('/past-events'); ?>">Looking for a recap of past events? Check out our past events!</a>

    </div>
<?php
    get_footer();
?>