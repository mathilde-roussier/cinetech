<?php

// URL de base https://api.themoviedb.org/3/discover/tv?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&with_genres=16&with_original_language=fr

$cle = "21265361ae3ee1f790c63a3a2973a4f2";

// create curl resource
$ch1 = curl_init();

$url = "http://api.themoviedb.org/3/discover/tv?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&with_genres=16&with_original_language=fr";

if (!isset($_GET['page'])) {

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

    $page = $_GET['page'];

    // set url
    curl_setopt($ch1, CURLOPT_URL, $url . '&page=' . $page);

    //return the transfer as a string
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch1);

    echo $output;

    // close curl resource to free up system resources
    curl_close($ch1);
}