jQuery(document).ready(function($) {
    alert("AJAX chargé !"); // Test 1 : Affichage d'une alerte pour voir si le script est bien chargé
    
    $('#genre').change(function() {
        alert("Genre sélectionné : " + $(this).val()); // Test 2 : Vérifie si la sélection fonctionne
        
        var genre = $(this).val();

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_artistes',
                genre: genre
            },
            beforeSend: function() {
                $('#artistes-container').html('<p>Chargement...</p>');
            },
            success: function(response) {
                alert("Réponse AJAX reçue !"); // Test 3 : Vérifie si WordPress répond
                $('#artistes-container').html(response);
            },
            error: function(error) {
                alert("Erreur AJAX ! Vérifie la console.");
                console.log("Erreur AJAX :", error);
            }
        });
    });
});

