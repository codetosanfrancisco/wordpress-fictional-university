<!-- For individual Page -->

<?php 
    get_header();

    while(have_posts()) {
        the_post(); // Behave like the loop variable that controlled the loop and also means, if there is next item, get the next item (set the pointer to the next item)
        pageBanner();
    ?>

    <div class="container container--narrow page-section">
        <?php 
            $theParent = wp_get_post_parent_id(get_the_ID());
        if($theParent){ ?>
            <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_the_permalink($theParent) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
            </div>

        <?php } ?>

        <?php 
        $test_array = get_pages(array(
            'child_of' => get_the_ID(),
        ));
        if($theParent or $test_array) { ?>
            <div class="page-links">
                <h2 class="page-links__title"><a href="<?php echo get_the_permalink($theParent)?>"><?php echo get_the_title($theParent); ?></a></h2>
                <ul class="min-list">
                    <?php 
                        if($theParent) {
                            $findChildrenOf = $theParent;
                        } else  {
                            $findChildrenOf = get_the_ID();
                        }

                        wp_list_pages(array(
                            'title_li' => NULL,
                            'child_of' => $findChildrenOf,
                            'sort_column' => 'menu_order'
                        )); 
                    ?>
                </ul>
            </div>
         <?php } ?>

        <div class="generic-content">
            <?php get_search_form(); ?>
        </div>

    </div>

<?php
    }

    get_footer();
?>

