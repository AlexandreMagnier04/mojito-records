<?php get_header(); ?>

<main id="artiste-single">
    <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

        <p><strong>Début de carrière :</strong> <?php echo SCF::get('debut_carriere'); ?></p>
        <p><strong>Biographie :</strong> <?php echo SCF::get('biographie'); ?></p>
        <p><strong>Pays d’origine :</strong> <?php echo get_the_terms(get_the_ID(), 'pays_origine')[0]->name; ?></p>
        <p><strong>Genre musical :</strong> <?php echo get_the_terms(get_the_ID(), 'genre_musical')[0]->name; ?></p>

        <?php if (SCF::get('site_web')) : ?>
            <p><strong>Site officiel :</strong> <a href="<?php echo SCF::get('site_web'); ?>" target="_blank">Voir le site</a></p>
        <?php endif; ?>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
