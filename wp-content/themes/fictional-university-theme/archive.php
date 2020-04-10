<?php 
    get_header();

    pageBanner(array(
        'subtitle' => get_the_archive_description(),
        'title' => get_the_archive_title()
    ))
?>

    <div class="container container--narrow page-section">
        <?php 
            while(have_posts()) {
                the_post();

        ?>
            <div class="post-item">
                <h2 class="headline headline--medium headline--post-title"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>

                <div class="metabox">
                    <p>Posted by <?php echo the_author_posts_link(); ?> on <?php echo the_time('n.j.Y'); ?> in 
                    <?php echo get_the_category_list(', '); ?>
                    </p>
                </div>

                <div class="generic-content">
                    <?php echo the_excerpt(); ?>
                    <p><a class="btn btn--blue" href="<?php echo the_permalink(); ?>">Read more</a></p>
                </div>
            </div>
        <?php
            }
            echo paginate_links();
        ?>
    </div>
<?php
    get_footer();
?>