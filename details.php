<?php 

if(isset($_GET['id_serie']))
{
    include 'include/requete_serie.php';
    // var_dump($_GET['id_serie']);
}

if(isset($_GET['id_film']))
{
    include 'include/requete_film.php';
    // var_dump($_GET['id_film']);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Details</title>
</head>
<body>

<?php var_dump($data_decode); ?>
    
</body>
</html>