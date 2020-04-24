<?php
    if (!defined('ABSPATH')) exit;

    $query = new WP_Query( array(
        'post_type' => 'business-cards',
        'posts_per_page' => -1,
    ) );


?>

<?php if($query->have_posts()) : ?>
    <?php while($query->have_posts()) : $query->the_post(); ?>

        <div class="business-cards-container">
            <?php if (!empty(get_post_meta(get_the_ID(), 'bc-name')[0])): ?>
                <div class="section-title">
                    <h1>
                        <?php echo esc_attr(get_post_meta(get_the_ID(), 'bc-name', true)); ?>
                    </h1>
                </div>
            <?php endif ?>


            <div class="section-content">
                <div class="section-description">

                    <?php if (!empty(get_post_meta(get_the_ID(), 'bc-role')[0])): ?>
                        <p class="role">
                            <span>
                                Role:
                            </span>
                            <?php echo esc_attr(get_post_meta(get_the_ID(), 'bc-role', true)); ?>
                        </p>
                    <?php endif ?>

                    <?php if (!empty(get_post_meta(get_the_ID(), 'bc-phone')[0])): ?>
                        <p class="phone">
                            <span>
                                Phone:
                            </span>
                            <?php echo esc_attr(get_post_meta(get_the_ID(), 'bc-phone', true)); ?>
                        </p>
                    <?php endif ?>
                </div>

                <div class="section-aside">
                    <?php if (!empty(get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' )[0])): ?>
                        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ?>" alt="">
                    <?php endif ?>
                </div>
            </div>

        </div>



    <?php endwhile; ?>
<?php endif; wp_reset_query(); ?>


