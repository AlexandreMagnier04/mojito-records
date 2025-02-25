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
                <p><strong>Année de sortie :</strong> <?php echo SCF::get('annee_sortie') ? SCF::get('annee_sortie') : 'Non précisé'; ?></p>
                <p><strong>Genre :</strong> 
                    <?php
                    $genres = get_the_terms(get_the_ID(), 'genre_musical');
                    if (!is_wp_error($genres) && !empty($genres)) {
                        foreach ($genres as $genre) {
                            echo '<a href="' . get_term_link($genre) . '">' . esc_html($genre->name) . '</a> ';
                        }
                    } else {
                        echo 'Non classé';
                    }
                    ?>
                </p>
            </article>
        <?php endwhile;
        wp_reset_postdata();
    else : ?>
        <p>Aucun album trouvé.</p>
    <?php endif; ?>
</div>
