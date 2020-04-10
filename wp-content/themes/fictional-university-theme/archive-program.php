<?php 
    get_header();

    pageBanner(array(
        'title'=> 'All Programs',
        'subtitle' => "See all the programs what we offered! "
    ))
?>

    <div class="container container--narrow page-section">

        <ul class="link-list min-list">
        <?php 
            while(have_posts()) {
                the_post();

        ?>
            <li><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></li>
        <?php
            }
            echo paginate_links();
        ?>
        </ul>

        <hr class="section-break"/> >

        <a href="<?php echo site_url('/past-events'); ?>">Looking for a recap of past events? Check out our past events!</a>

    </div>
<?php
    get_footer();
?>