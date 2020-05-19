<!doctype html>

<?php

session_start();


//TODO : FONCTIONS A METTRE DANS UNE CLASSE

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.themoviedb.org/3/discover/tv?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=release_date.desc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr&page=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 1,
  CURLOPT_TIMEOUT => 2,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HEADER => false,
  //CURLOPT_GETFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $series = json_decode($response, true);

  //On construit un tableau avec des séries qui ont un poster
  $series_posters = [];
  for ($i = 0; $i <= 19; $i++) {
    if (strcmp($series["results"][$i]["poster_path"], "")) {
      array_push($series_posters, $series["results"][$i]);
    }
  }
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.themoviedb.org/3/discover/movie?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=release_date.desc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr&page=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 1,
  CURLOPT_TIMEOUT => 2,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HEADER => false,
  //CURLOPT_GETFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $films = json_decode($response, true);

  //On construit un tableau avec des films qui ont un poster
  $films_posters = [];
  for ($i = 0; $i <= 19; $i++) {
    if (strcmp($films["results"][$i]["poster_path"], "")) {
      array_push($films_posters, $films["results"][$i]);
    }
  }
}

//TODO : affichage carroussel pour mobile ?

?>

<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>L'Animatek - Films et séries d'animations francophones</title>
</head>

<body>
  <?php require('include/header.php'); ?>
  <main class="p-4">
    <section class="container-xl justify-content-around p-3">
      <div class="row justify-content-center justify-items-center d-flex align-content-stretch m-5">
        <h1 class="display-4 text-center m-2">Bienvenue sur l'Animatek</h1>
        <p class="lead text-center m-2">Retrouve ici les films et séries d'animations francophones !</p>
      </div>

      <h3 class="h2 text-center mb-4">Nouveautés séries</h3>

      <div id="recipeCarousel1" class="carousel slide w-100 p-2" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
          <div class="carousel-item row active">
            <?php for ($i = 0; $i <= 3; $i++) {
            ?>
              <a href="details.php?id_serie=<?php echo $series_posters[$i]['id'];?>"><div class="col-3 float-left"><img class="img-fluid" src="https://image.tmdb.org/t/p/w500<?php echo $series_posters[$i]["poster_path"]; ?>"></div></a>
            <?php
            }
            ?>
          </div>
          <div class="carousel-item row">
            <?php for ($i = 4; $i <= 7; $i++){
            ?>
              <a href="details.php?id_serie=<?php echo $series_posters[$i]['id'];?>"><div class="col-3 float-left"><img class="img-fluid" src="https://image.tmdb.org/t/p/w500<?php echo $series_posters[$i]["poster_path"]; ?>"></div></a>
            <?php
            }
            ?>
          </div>
        </div>
        <a class="carousel-control-prev" href="#recipeCarousel1" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#recipeCarousel1" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Suivant</span>
        </a>
      </div>

      <h3 class="h2 text-center mt-5 mb-4">Nouveautés films</h3>

      <div id="recipeCarousel2" class="carousel slide w-100 p-2 mb-4" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
          <div class="carousel-item row active">
            <?php for ($i = 0; $i <= 3; $i++) {
            ?>
              <a href="details.php?id_film=<?php echo $films_posters[$i]['id'];?>"><div class="col-3 float-left"><img class="img-fluid" src="https://image.tmdb.org/t/p/w500<?php echo $films_posters[$i]["poster_path"]; ?>"></div></a>
            <?php
            }
            ?>
          </div>
          <div class="carousel-item row">
            <?php for ($i = 4; $i <= 7; $i++) {
            ?>
              <a href="details.php?id_film=<?php echo $films_posters[$i]['id'];?>"><div class="col-3 float-left"><img class="img-fluid" src="https://image.tmdb.org/t/p/w500<?php echo $films_posters[$i]["poster_path"]; ?>"></div></a>
            <?php
            }
            ?>
          </div>
        </div>
        <a class="carousel-control-prev" href="#recipeCarousel2" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#recipeCarousel2" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Suivant</span>
        </a>
      </div>

    </section>
  </main>
  <?php require('include/footer.php'); ?>

  <!--SCRIPTS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>