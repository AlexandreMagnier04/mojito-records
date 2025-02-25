<?php get_header(); ?>

<main id="album-single">
    <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>

        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>

        <p><strong>Artiste :</strong>
            <?php
            $artisteLinked = get_field('artiste');
            foreach ($artisteLinked as $artiste) {
                echo '<a href="' . get_permalink($artiste) . '">' . get_the_title($artiste) . '</a>';
            };
            ?>
        </p>

        <p><strong>Date de sortie :</strong> <?php echo get_field('annee_de_sortie'); ?></p>


        <h3>Liste des pistes :</h3>
        <ul>
            <?php
            $pistes = get_field('pistes');
            if ($pistes) :
                foreach ($pistes as $piste) :
                    echo '<li>' . $piste['nom_de_la_piste'] . '-' . $piste['duree'] . '</li>';
                endforeach;
            else :
                echo '<p>Aucune piste trouvée.</p>';
            endif;
            ?>
        </ul>

        <p><strong>Genre musical :</strong> 
            <?php 
            $genres = get_field('genre_musical');
            if (!empty($genres)) {
                if (is_array($genres)) {
                    $genres_list = array();
                    foreach ($genres as $genre) {
                        $genres_list[] = esc_html($genre->name); 
                    }
                    echo implode(', ', $genres_list);
                } else {
                    echo esc_html($genres->name); 
                }
            } else {
                echo 'Non classé';
            }
            ?>


    <?php endwhile; ?>
</main>

<?php get_footer(); ?>