document.addEventListener("DOMContentLoaded", function () {
    let genreFilter = document.getElementById("filter-genre");

    genreFilter.addEventListener("change", function () {
        let genre = this.value;
        let data = new FormData();
        data.append("action", "filter_albums");
        data.append("genre", genre);

        fetch(mojito_ajax.ajaxurl, {
            method: "POST",
            body: data
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById("albums-list").innerHTML = data;
        });
    });
});
