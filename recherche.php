<?php

session_start();


if(isset($_GET['search']))
{
  $search=$_GET['search'];
  $search=urlencode($search);


  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.themoviedb.org/3/search/multi?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&query=$search&page=1&include_adult=false",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  //CURLOPT_GETFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

}
else
{
  header("location:index.php");
}
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
<?php require ('include/header.php');?>
<main class="p-5">
  <section class="container-xl justify-content-around p-3">
    
    <?php
    if ($err) 
    {
      echo "cURL Error #:" . $err;
    } 
    else 
    {
      $data=json_decode($response, true);
      $titles=$data["results"];
      ?>

    <h2>Films : </h2>
    <div class="row row-cols-1 row-cols-md-3">

    <?php foreach ($titles as $title)
    {
      if($title["media_type"]=="movie")
      {
        if($title["original_language"]=="fr")
        {
          if(in_array("16",$title["genre_ids"]) OR empty($title["genre_ids"]))
          {
          ?>
          <div class="col mb-4">
            <div class="card h-100">
            <?php if($title["poster_path"]=="")
            {
              ?>
              <img src="assets/logo.png" class="card-img-top" alt="logo"/>
              <?php
            }
            else
            {
            ?>
            <img src="https://image.tmdb.org/t/p/w500<?php echo $title["poster_path"]; ?>" class="card-img-top" alt="poster">
            <?php
            }
            ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo $title["title"];?></h5>
                <p class="card-text"><?php echo $title["overview"];?></p>
                <a href="details.php?id_film=<?php echo $title['id']; ?>" class="btn btn-primary">En voir plus</a>
              </div>
            </div>
          </div>
          <?php
          }  
        }
      }
    }
    
    ?>
     </div> 

      <h2>Séries : </h2>
    <div class="row row-cols-1 row-cols-md-3">

    
    <?php foreach ($titles as $title)
    {
      if($title["media_type"]=="tv")
      {
        if($title["original_language"]=="fr")
        {
          if(in_array("16",$title["genre_ids"]) OR empty($title["genre_ids"]))
          {
          ?>
          <div class="col mb-4">
            <div class="card h-100">
             <?php if($title["poster_path"]=="")
            {
              ?>
              <img src="assets/logo.png" class="card-img-top" alt="logo"/>
              <?php
            }
            else
            {
            ?>
            <img src="https://image.tmdb.org/t/p/w500<?php echo $title["poster_path"]; ?>" class="card-img-top" alt="...">
            <?php
            }
            ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo $title["name"];?></h5>
                <p class="card-text"><?php echo $title["overview"];?></p>
                <a href="details.php?id_serie=<?php echo $title['id']; ?>" class="btn btn-primary">En voir plus</a>
              </div>
            </div>
          </div>
          <?php
          }  
        }
      }
    }
    ?>
    </div>
    <?php
    }
    ?>


  </section>
</main>
  <?php require ('include/footer.php');?>



  <!--SCRIPTS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
