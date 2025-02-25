<div class="artistes-list">
    <?php
    $artistes = new WP_Query(array(
        'post_type' => 'artiste',
        'posts_per_page' => -1
    ));

    if ($artistes->have_posts()) :
        while ($artistes->have_posts()) : $artistes->the_post(); ?>
            <article class="artiste-card">
                <a href="#" class="artiste-modal-trigger" data-id="<?php the_ID(); ?>">
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

<!-- Modale pour afficher les détails d'un artiste -->
<div id="artiste-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modal-data"></div>
    </div>
</div>
