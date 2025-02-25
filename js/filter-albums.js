jQuery(document).ready(function($) {
    $('#genre').change(function() {
        var genre = $(this).val();
        
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_albums',
                genre: genre
            },
            beforeSend: function() {
                $('#albums-container').html('<p>Chargement...</p>');
            },
            success: function(response) {
                $('#albums-container').html(response);
            },
            error: function() {
                $('#albums-container').html('<p>Une erreur est survenue.</p>');
            }
        });
    });
});
