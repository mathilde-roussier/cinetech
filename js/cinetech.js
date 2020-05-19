$(document).ready(function () {

    // ********************** PAGINATION **********************

    pagination();

    function pagination() {
        $(".page-link").click(function () {
            var chemin = window.location.pathname;
            var decoupe_chemin = chemin.split('/');
            var page_actuel = decoupe_chemin[decoupe_chemin.length-1];
            console.log(page_actuel);
            // var nbpage = $(this).parent().parent().attr('id');

            var id_next = $(this).parent().next().attr('name');
            console.log(id_next);

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
                    $('#catalogue').replaceWith("<section id='catalogue' class='container row col-12 justify-content-around text-center'></section>");
                    $.each(data['results'], function (key, value) {
                        var div_p = "<div id='" + value['id'] + "'class='card col-10 col-sm-8 col-md-4 col-lg-2 p-0 m-2'></div>";
                        $('#catalogue').append(div_p);
                        if (value['poster_path'] !== null) {
                            var img = "<img src='https://image.tmdb.org/t/p/w500" + value['poster_path'] + "' class='card-img-top' alt='...'>";
                        }
                        else {
                            var img = "<img src='assets/no_img.jpg' class='card-img-top' alt='...'>";
                        }
                        $('#' + value['id']).append(img);
                        var div_i = "<div id='infos" + value['id'] + "'class='card-body'></div>";
                        $('#' + value['id']).append(div_i);
                        var note = "<h6 class='card-subtitle mb-2 text-muted'>" + value['vote_average'] + " / 10</h6>";
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

                        if (id_next === 'nop') {
                            console.log(page);

                            var prec_page = parseInt(page) - 14;
                            if (prec_page <= 0) {
                                prec_page = 1;
                            }

                            $('#nbpage' + data['total_pages']).replaceWith('<div id="nbpage' + data['total_pages'] + '" class="d-flex justify-content-center"></div>');
                            
                            if (page != data['total_pages'] - 1 && page != 1) {
                                var plage = parseInt(page) + ((1 / 4) * data['total_pages']);
                            }
                            else if (page == 1) {
                                var plage = ((1 / 4) * data['total_pages']);
                            }
                            else {
                                var plage = parseInt(page) + 1;
                            }
                            console.log(plage);
                            for (var i = page; i <= plage; i++) {
                                var li = "<li id='" + i + "' class='page-item'><a id='p" + i + "' class='page-link'>" + i + "</a></li>";
                                $('#nbpage' + data['total_pages']).append(li);
                            }

                            if (page != data['total_pages'] - 1) {
                                $('#nbpage' + data['total_pages']).append('<li name="nop" class="page-item disabled"><a class="page-link" tabindex="-1" aria-disabled="true">...</a></li>');
                                var li = "<li id='" + data['total_pages'] + "' class='page-item'><a id='p" + data['total_pages'] + "' class='page-link'>" + data['total_pages'] + "</a></li>";
                                $('#nbpage' + data['total_pages']).append(li);
                            }
                            if (page != 1) {
                                $('#nbpage' + data['total_pages']).prepend('<li name="nop" class="page-item disabled"><a class="page-link" tabindex="-1" aria-disabled="true">...</a></li>');
                                var li = "<li id='" + prec_page + "' class='page-item'><a id='p" + prec_page + "' class='page-link'>" + prec_page + "</a></li>";
                                $('#nbpage' + data['total_pages']).prepend(li);
                            }

                            $('#' + page).attr('class', 'page-item active');
                        }
                    })
                    pagination();
                }
            })
        })
    }



    // ********************** Ajouter aux favoris **********************

    $('#favoris').click(function () {

        var chemin_bis = window.location.href;
        var decoupe_chemin_bis = chemin_bis.split('?');
        var get = decoupe_chemin_bis[1];
        var decoupe_get = get.split('=');
        var champ = decoupe_get[0];
        var id = decoupe_get[1];

        $.ajax({
            method: "GET",
            url: "include/handler_bdd.php",
            data: { 'function': 'addfav', 'id': id, 'nom': $('h5').html(), 'img': $('#img_media').attr('src'), 'type': champ },
            datatype: "json",
            success: function (datatype) {
                console.log('ajouté');
                $('#favoris').replaceWith('<button type="button" class="btn btn-primary disabled">Favori <svg class="bi bi-star-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path d = "M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" /></svg ></button > ');
            }
        })
    });

    // ********************** Afficher les favoris **********************

    affichefav();

    function affichefav() {
        $('#div_favori').replaceWith('<div class="row col-12 justify-content-around" id="div_favori"></div>');
        $.ajax({
            method: 'GET',
            url: 'include/handler_bdd.php',
            data: { 'function': 'getfav' },
            datatype: "json",
            success: function (datatype) {
                var data = JSON.parse(datatype);
                console.log(data);
                $.each(data, function (key, value) {
                    $('#div_favori').append('<div id="fav' + value['id_media'] + '" class="card d-flex m-2" style="width: 18rem;"></div>')
                    $('#fav' + value['id_media']).append('<img src="' + value['img_media'] + '" class="card-img-top" alt="...">');
                    $('#fav' + value['id_media']).append('<div id="ss' + value['id_media'] + '" class="card-body"></div>');
                    $('#ss' + value['id_media']).append('<h5 class="card-title">' + value['nom_media'] + '</h5>');
                    $('#ss' + value['id_media']).append('<aside class="d-flex justify-content-between" id="btn' + value['id_media'] + '"></aside>');
                    $('#btn' + value['id_media']).append('<a class="btn btn-primary" href="details.php?' + value['type_media'] + '=' + value['id_media'] + '">Voir plus</a>');
                    $('#btn' + value['id_media']).append('<button class="btn btn-danger suppr">Supprimer</button>');
                })

                // ********************** Supprimer de la liste des favoris **********************

                $('.suppr').click(function () {
                    var id_pa = $(this).parent().parent().parent().attr('id');
                    var split_id = id_pa.split('fav');
                    var id_suppr = split_id[1];
                    console.log(id_suppr);
                    $.ajax({
                        method: 'GET',
                        url: 'include/handler_bdd.php',
                        data: { 'function': 'supprfav', 'id': id_suppr },
                        datatype: "json",
                        success: function (datatype) {
                            $('#fav' + id_suppr).remove();
                            affichefav();
                        }
                    })
                });
            }
        });
    }

    // ********************** Commentaire **********************
    $('.reply').click(function () {
        var $form = $('#form-comment');
        var $this = $(this);
        var parent_id = $this.data('id');
        var $comment = $('#comment-'+ parent_id);

        $form.find('h4').text('Répondre à ce commentaire');
        $('#parent_id').val(parent_id);
        $comment.after($form);
    })

});