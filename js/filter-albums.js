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
            success: function(response) {
                $('#albums-container').html(response);
            }
        });
    });
});
