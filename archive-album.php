<?php get_header(); ?>

<main id="albums-archive">
    <h1>Discographie</h1>

    <!-- 🔍 Filtres AJAX par Genre -->
    <label for="filter-genre">Filtrer par Genre :</label>
    <select id="filter-genre">
        <option value="">Tous les genres</option>
        <?php
        $terms = get_terms('genre_musical');
        foreach ($terms as $term) {
            echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
        }
        ?>
    </select>

    <form id="filter-albums">
    <label for="genre">Filtrer par Genre :</label>
    <select id="genre" name="genre">
        <option value="">Tous les genres</option>
        <?php
        $genres = get_terms(array('taxonomy' => 'genre_musical', 'hide_empty' => false));
        foreach ($genres as $genre) {
            echo '<option value="' . $genre->slug . '">' . $genre->name . '</option>';
        }
        ?>
    </select>
</form>

<div id="albums-container">
    <?php get_template_part('template-parts/albums-list'); ?>
</div>

    <!-- Contenu AJAX -->
    <div id="albums-list">
        <?php
        $query = new WP_Query(array('post_type' => 'album', 'posts_per_page' => 9));
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <article class="album">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                        <h2><?php the_title(); ?></h2>
                    </a>
                </article>
            <?php endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Aucun album trouvé.</p>';
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
