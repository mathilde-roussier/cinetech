$(document).ready(function () {

    var chemin = window.location.pathname;
    var r = chemin.split('/');
    var page_actuel = r[3];

    $(".page-link").click(function () {
        var id = $(this).attr('id');
        var split_id = id.split('p');
        var page = split_id[1];
        $('#' + page).attr('class', 'page-item active');
        $($(this).parent().siblings()).attr('class', 'page-item');
        $.ajax({
            method: "GET",
            url: "include/requete_"+page_actuel,
            data: "page=" + page,
            datatype: "json",
            success: function (datatype) {
                var data = JSON.parse(datatype);
                console.log(data);
                $('main section').replaceWith("<section class='container row col-12 justify-content-around'></section>");
                $.each(data['results'], function (key, value) {
                    var div_p = "<div id='" + value['id'] + "'class='card col-2 p-0 m-2' style='width: 18rem;'></div>";
                    $('section').append(div_p);
                    var img = "<img src='https://image.tmdb.org/t/p/w500" + value['poster_path'] + "' class='card-img-top' alt='...'>";
                    $('#' + value['id']).append(img);
                    var div_i = "<div id='infos" + value['id'] + "'class='card-body'></div>";
                    $('#' + value['id']).append(div_i);
                    var note = "<h6 class='card-subtitle mb-2 text-muted'>" + value['vote_average'] + "</h6>";
                    $('#infos' + value['id']).append(note);
                    if( page_actuel === 'film.php')
                    {
                        var title = "<h5 class='card-title'>" + value['title'] + "</h5>";
                    }
                    else{
                        var title = "<h5 class='card-title'>" + value['name'] + "</h5>";
                    }
                    $('#infos' + value['id']).append(title);
                    if( page_actuel === 'film.php')
                    {
                        var but = "<a href='details.php?id_film="+value['id']+"' class='btn btn-primary'>En voir plus</a>";
                    }
                    else{
                        var but = "<a href='details.php?id_serie="+value['id']+"' class='btn btn-primary'>En voir plus</a>";
                    }
                    $('#infos' + value['id']).append(but);
                })

            }
        })
    })

});