<?php get_header(); ?>

<main id="front-page">
    <section id="presentation">
        <h1>Bienvenue chez Mojito Records</h1>
        <p>Label indépendant de rap français, spécialisé dans divers genres comme l'Old School, la Drill, le Mainstream, la Trap et le Rap mélancolique/mélodique.</p>
    </section>

    <div class="container">
        <section id="artistes">
            <h2>Artistes du label</h2>
            <div class="grid-artistes">
                <?php
                $artistes = new WP_Query(array(
                    'post_type' => 'artiste',
                    'posts_per_page' => 3,
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
                            <h3><?php the_title(); ?></h3>
                        </article>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p>Aucun artiste trouvé.</p>
                <?php endif; ?>
            </div>
            <a href="<?php echo get_post_type_archive_link('artiste'); ?>" class="btn">Voir tous les artistes</a>
        </section>

        <section id="albums">
            <h2>Nos albums</h2>
            <div class="grid-albums">
                <?php
                $albums = new WP_Query(array(
                    'post_type' => 'album',
                    'posts_per_page' => 3,
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
            <a href="<?php echo get_post_type_archive_link('album'); ?>" class="btn">Voir tous les albums</a>
        </section>
    </div>
</main>

<?php get_footer(); ?>
