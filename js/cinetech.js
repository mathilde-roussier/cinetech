$(document).ready(function () {

    // ********************** PAGINATION **********************

    var chemin = window.location.pathname;
    var decoupe_chemin = chemin.split('/');
    var page_actuel = decoupe_chemin[3];

    $(".page-link").click(function () {
        var id = $(this).attr('id');
        var split_id = id.split('p');
        var page = split_id[1];
        $('#' + page).attr('class', 'page-item active');
        $($(this).parent().siblings()).attr('class', 'page-item');
        $.ajax({
            method: "GET",
            url: "include/requete_" + page_actuel,
            data: "page=" + page,
            datatype: "json",
            success: function (datatype) {
                var data = JSON.parse(datatype);
                console.log(data);
                $('main section').replaceWith("<section class='container row col-12 justify-content-around'></section>");
                $.each(data['results'], function (key, value) {
                    var div_p = "<div id='" + value['id'] + "'class='card col-2 p-0 m-2' style='width: 18rem;'></div>";
                    $('section').append(div_p);
                    console.log(value['poster_path']);
                    if (value['poster_path'] !== null) {
                        var img = "<img src='https://image.tmdb.org/t/p/w500" + value['poster_path'] + "' class='card-img-top' alt='...'>";
                    }
                    else {
                        var img = "<img src='assets/no_img.jpg' class='card-img-top' alt='...'>";
                    }
                    $('#' + value['id']).append(img);
                    var div_i = "<div id='infos" + value['id'] + "'class='card-body'></div>";
                    $('#' + value['id']).append(div_i);
                    var note = "<h6 class='card-subtitle mb-2 text-muted'>" + value['vote_average'] + "</h6>";
                    $('#infos' + value['id']).append(note);
                    if (page_actuel === 'film.php') {
                        var title = "<h5 class='card-title'>" + value['title'] + "</h5>";
                    }
                    else {
                        var title = "<h5 class='card-title'>" + value['name'] + "</h5>";
                    }
                    $('#infos' + value['id']).append(title);
                    if (page_actuel === 'film.php') {
                        var but = "<a href='details.php?id_film=" + value['id'] + "' class='btn btn-primary'>En voir plus</a>";
                    }
                    else {
                        var but = "<a href='details.php?id_serie=" + value['id'] + "' class='btn btn-primary'>En voir plus</a>";
                    }
                    $('#infos' + value['id']).append(but);
                })

            }
        })
    })


    // ********************** Ajouter aux favoris **********************

    var chemin_bis = window.location.href;
    var decoupe_chemin_bis = chemin_bis.split('?');
    var get = decoupe_chemin_bis[1];
    var decoupe_get = get.split('=');
    var champ = decoupe_get[0];
    var id = decoupe_get[1];

    $('#favoris').click(function () {

        console.log('OK');
        console.log(id);
        console.log($('h5').html());
        console.log($('img').attr('src'));
        $.ajax({
            method: "GET",
            url: "include/handler_bdd.php",
            data: { 'function': 'addfav', 'id': id, 'nom': $('h5').html(), 'img': $('img').attr('src'), 'type': champ },
            datatype: "json",
            success: function (datatype) {
                console.log('ok envoyé');
            }
        })
    });

});