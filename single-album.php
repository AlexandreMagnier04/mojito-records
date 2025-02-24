<?php get_header(); ?>

<main id="album-single">
    <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

        <p><strong>Année de sortie :</strong> <?php echo SCF::get('annee_sortie'); ?></p>
        <p><strong>Nombre de pistes :</strong> <?php echo SCF::get('nombre_pistes'); ?></p>

        <p><strong>Genre musical :</strong> 
            <?php
            $genres = get_the_terms(get_the_ID(), 'genre_musical');
            if ($genres) {
                foreach ($genres as $genre) {
                    echo '<a href="' . get_term_link($genre) . '">' . esc_html($genre->name) . '</a> ';
                }
            } else {
                echo 'Non classé';
            }
            ?>
        </p>

        <p><strong>Écouter sur Spotify :</strong> <a href="<?php echo SCF::get('lien_spotify'); ?>" target="_blank">Clique ici</a></p>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
