<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>CineTech</title>
</head>

<body>

    <main>

        <?php

        // URL de base http://api.themoviedb.org/3/discover/movie?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr

        $domaine = "http://api.themoviedb.org/3/";
        $cle = "21265361ae3ee1f790c63a3a2973a4f2";
        $categorie_film = "\/movie/";
        $categorie_serie = "\/movie/";

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "http://api.themoviedb.org/3/discover/movie?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=en-FR");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        echo $output; 
        ?>
        
    </main>

</body>

</html>