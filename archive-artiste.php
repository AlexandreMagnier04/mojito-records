<?php get_header(); ?>

<main id="archive-artistes">
    <h1>Nos Artistes</h1>

    <div class="artistes-grid">
        <?php
        $artistes = new WP_Query(array(
            'post_type'      => 'artiste',
            'posts_per_page' => -1,
        ));

        if ($artistes->have_posts()) :
            while ($artistes->have_posts()) : $artistes->the_post(); ?>
                <article class="artiste-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/default-artist.jpg" alt="Image par défaut">
                        <?php endif; ?>
                    </a>
                    <h2><?php the_title(); ?></h2>
                </article>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Aucun artiste trouvé.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
