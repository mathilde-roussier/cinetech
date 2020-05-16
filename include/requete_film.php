<?php

// URL de base http://api.themoviedb.org/3/discover/movie?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr

$cle = "21265361ae3ee1f790c63a3a2973a4f2";

// create curl resource
$ch = curl_init();

$url = "http://api.themoviedb.org/3/discover/movie?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr";

if (empty($_GET)) {

    // set url
    curl_setopt($ch, CURLOPT_URL, $url);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

    $data = JSON_decode($output);
    // var_dump($data);

    $data_decode = get_object_vars($data);
} else {

    foreach ($_GET as $champ => $info) {
        if ($champ == 'page') {
            // set url
            $newurl = $url . '&' . $champ . "=" . $info;
            // echo $newurl;
        } elseif ($champ == 'id_film') {
            // set url
            $newurl = "http://api.themoviedb.org/3/movie/" . $info . "?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR";
            $newurl_credit = "http://api.themoviedb.org/3/movie/" . $info . "/credits?api_key=21265361ae3ee1f790c63a3a2973a4f2";
            // echo $newurl;
        }

        curl_setopt($ch, CURLOPT_URL, $newurl);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        if ($champ == 'page') {
            echo $output;
        } elseif ($champ == 'id_film') {
            curl_setopt($ch, CURLOPT_URL, $newurl_credit);

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // $output contains the output string
            $output_credit = curl_exec($ch);

            $data_credit= JSON_decode($output_credit);
            // var_dump($data);

            $data_credit_decode = get_object_vars($data_credit);
        }

        $data_detail = JSON_decode($output);
        // var_dump($data);

        $data_detail_decode = get_object_vars($data_detail);
    }

    // close curl resource to free up system resources
    curl_close($ch);
}
