<?php get_header(); ?>

<main id="archive-albums">
    <div class="container">
        <h1>Tous les Albums</h1>

        <!-- Formulaire de filtre AJAX -->
        <form id="filter-albums">
            <label for="genre">Filtrer par Genre :</label>
            <select id="genre" name="genre">
                <option value="">Tous les genres</option>
                <?php
                $genres = get_terms(array(
                    'taxonomy' => 'genre_musical',
                    'hide_empty' => false
                ));

                if (!is_wp_error($genres) && !empty($genres)) {
                    foreach ($genres as $genre) {
                        echo '<option value="' . esc_attr($genre->slug) . '">' . esc_html($genre->name) . '</option>';
                    }
                }
                ?>
            </select>
        </form>

        <!-- Conteneur AJAX pour afficher les albums -->
        <div id="albums-container">
            <?php get_template_part('template-parts/albums-list'); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
