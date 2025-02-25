<?php get_header(); ?>

<main id="archive-artistes">
    <h1>Nos Artistes</h1>

    <!-- Formulaire de filtre AJAX -->
    <form id="filter-artistes">
    <label for="genre">Filtrer par Genre :</label>
    <select id="genre" name="genre">
        <option value="">Tous les genres</option>
        <?php
        $genres = get_terms(array(
            'taxonomy'   => 'genre_musical',
            'hide_empty' => false
        ));

        if (!is_wp_error($genres) && !empty($genres)) {
            foreach ($genres as $genre) {
                echo '<option value="' . esc_attr($genre->slug) . '">' . esc_html($genre->name) . '</option>';
            }
        } else {
            echo '<option value="">Aucun genre trouvé</option>';
        }
        ?>
    </select>
</form>

    <!-- Conteneur AJAX des artistes -->
    <div id="artistes-container">
        <?php get_template_part('template-parts/artistes-list'); ?>
    </div>
</main>

<?php get_footer(); ?>
