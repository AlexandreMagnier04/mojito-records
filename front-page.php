<?php get_header(); ?>

<main id="homepage">
    <!-- Présentation du label -->
    <section id="presentation">
        <div class="container">
            <h1>Bienvenue chez Mojito Records</h1>
            <p>
                Mojito Records est un label dédié au rap sous toutes ses formes : 
                Old School, Drill, Trap, Mélodique et bien plus encore. Nous mettons en avant 
                les talents les plus prometteurs pour façonner l’avenir du rap français.
            </p>
        </div>
    </section>

    <!-- Section Artistes -->
    <section id="artistes-label">
        <div class="container">
            <h2>Artistes du Label</h2>
            <div class="grid-artistes">
                <?php
                $artistes = new WP_Query(array(
                    'post_type' => 'artiste',
                    'posts_per_page' => 4,
                    'orderby' => 'rand'
                ));

                if ($artistes->have_posts()) :
                    while ($artistes->have_posts()) : $artistes->the_post(); ?>
                        <article class="artiste-card">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
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
        </div>
    </section>

    <!-- Section Albums -->
    <section id="albums-label">
        <div class="container">
            <h2>Albums du Label</h2>
            <div class="grid-albums">
                <?php
                $albums = new WP_Query(array(
                    'post_type' => 'album',
                    'posts_per_page' => 4,
                    'orderby' => 'rand'
                ));

                if ($albums->have_posts()) :
                    while ($albums->have_posts()) : $albums->the_post(); ?>
                        <article class="album-card">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
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
        </div>
    </section>
</main>

<?php get_footer(); ?>
