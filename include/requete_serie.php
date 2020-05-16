<?php

// URL de base https://api.themoviedb.org/3/discover/tv?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&with_genres=16&with_original_language=fr

$cle = "21265361ae3ee1f790c63a3a2973a4f2";

// create curl resource
$ch1 = curl_init();

$url = "http://api.themoviedb.org/3/discover/tv?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&with_genres=16&with_original_language=fr";

if (empty($_GET)) {

    // set url
    curl_setopt($ch1, CURLOPT_URL, $url);

    //return the transfer as a string
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch1);

    // close curl resource to free up system resources
    curl_close($ch1);

    $data = JSON_decode($output);
    // var_dump($data);

    $data_decode = get_object_vars($data);
} else {

    foreach ($_GET as $champ => $info) {
        if($champ == 'page')
        {
            // set url
            $newurl = $url . '&' . $champ ."=".$info;
            // echo $newurl;
        }
        elseif($champ == 'id_serie')
        {
            // set url
            $newurl = "http://api.themoviedb.org/3/tv/".$info."?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR";
            // echo $newurl;
        }
        
        curl_setopt($ch1, CURLOPT_URL, $newurl);
    
    //return the transfer as a string
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch1);
    
        if($champ == 'page')
        {
            echo $output;
        }

    $data = JSON_decode($output);
    // var_dump($data);

    $data_decode = get_object_vars($data);
    }

    // close curl resource to free up system resources
    curl_close($ch1);
}