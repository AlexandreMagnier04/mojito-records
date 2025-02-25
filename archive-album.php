<?php get_header(); ?>

<main id="archive-albums">
    <h1>Les Albums</h1>

    <div class="albums-list">
        <?php
        $albums = new WP_Query(array(
            'post_type'      => 'album',
            'posts_per_page' => -1
        ));

        if ($albums->have_posts()) :
            while ($albums->have_posts()) : $albums->the_post(); ?>
                <article class="album-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/default-album.jpg" alt="Image par défaut">
                        <?php endif; ?>
                    </a>
                    <h3><?php the_title(); ?></h3>
                </article>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Aucun album trouvé.</p>
        <?php endif; ?>
    </div>

</main>

<?php get_footer(); ?>
