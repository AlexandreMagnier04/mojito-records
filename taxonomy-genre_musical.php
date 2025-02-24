<?php get_header(); ?>

<main id="albums-par-genre">
    <h1>Albums - <?php single_term_title(); ?></h1>

    <div class="albums-list">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article class="album-card">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
                    <p><strong>Année :</strong> <?php echo SCF::get('annee_sortie'); ?></p>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Aucun album trouvé dans cette catégorie.</p>
        <?php endif; ?>
    </div>

</main>

<?php get_footer(); ?>
