<!DOCTYPE html>
<html lang="fr">

<head>
        <meta charset="UTF-8">

        <!-- css boostrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>film</title>
</head>

<body>
        <main class="container row col-12 justify-content-around">

                <?php

                // URL de base http://api.themoviedb.org/3/discover/movie?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr

                $domaine = "http://api.themoviedb.org/3/";
                $cle = "21265361ae3ee1f790c63a3a2973a4f2";
                $categorie_film = "\/movie/";
                $categorie_serie = "\/movie/";

                // create curl resource
                $ch = curl_init();

                // set url
                curl_setopt($ch, CURLOPT_URL, "http://api.themoviedb.org/3/discover/movie?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr");

                //return the transfer as a string
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                // $output contains the output string
                $output = curl_exec($ch);

                // close curl resource to free up system resources
                curl_close($ch);

                $data = JSON_decode($output);
                // var_dump($data);

                $data_decode = get_object_vars($data);

                foreach ($data_decode['results'] as $film) {
                        $film = get_object_vars($film);
                ?>
                        <div class="card col-2 p-0 m-2" style="width: 18rem;">
                                <img src="<?php echo "https://image.tmdb.org/t/p/w500" . $film["poster_path"]; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $film['vote_average']; ?></h6>
                                        <h5 class="card-title"><?php echo $film['title']; ?></h5>
                                        <a href="#" class="btn btn-primary">En voir plus</a>
                                </div>
                        </div>
                <?php
                }

                ?>
                <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <?php for($i=1; $i <= $data_decode['total_pages'];$i++) {?>
                                <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                                <?php } ?>
                                <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                </li>
                        </ul>
                </nav>

        </main>

</body>

</html>