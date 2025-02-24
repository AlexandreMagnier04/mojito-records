<?php get_header(); ?>

<main id="artiste-single">
    <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
        <p><?php the_content(); ?></p>

        <p><strong>Pays d’origine :</strong>
            <?php
            $pays = get_the_terms(get_the_ID(), 'pays_origine');
            if ($pays) {
                echo esc_html($pays[0]->name);
            }
            ?>
        </p>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
