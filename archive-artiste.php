<?php get_header(); ?>

<main id="artistes-archive">
    <h1>Nos Artistes</h1>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article>
            <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            </a>
        </article>
    <?php endwhile; else : ?>
        <p>Aucun artiste trouvé.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
