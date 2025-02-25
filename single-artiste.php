<?php get_header(); ?>

<main id="artiste-single">
    <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>

        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>

        <p><strong>Début de carrière :</strong> <?php echo get_field('debut_de_carriere'); ?></p>
        <p><strong>Biographie :</strong> <?php echo get_field('biographie'); ?></p>

        <p><strong>Pays d’origine :</strong>
            <?php
            $pays = get_field('pays_dorigine')->name;
            echo (!empty($pays)) ? esc_html($pays) : "Non renseigné";
            ?>
        </p>

        <p><strong>Genre musical :</strong> 
            <?php 
            $genres = get_field('genre_musical');
            if (!empty($genres)) {
                if (is_array($genres)) {
                    $genres_list = array();
                    foreach ($genres as $genre) {
                        $genres_list[] = esc_html($genre->name); // 
                    }
                    echo implode(', ', $genres_list);
                } else {
                    echo esc_html($genres->name);
                }
            } else {
                echo 'Non classé';
            }
            ?>
        </p>
        
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>