<?php

if(!file_exists("data.txt"));
unlink("data.txt");

echo "[";
file_put_contents ('data.txt' ,"[", FILE_APPEND );


//FILMS
$total_pages_f=56;

for($i=1;$i<=$total_pages_f;$i++)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.themoviedb.org/3/discover/movie?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=original.title.asc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr&page=$i",
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

  //Récupération du nombre total de pages
  $data=json_decode($response, true);
  $titles=$data["results"];
  //var_dump($data["results"]);
  //$total_pages=$data["total_pages"];
  $last_title=end($titles);

  if ($err) 
  {
    echo "cURL Error #:" . $err;
  } 
  else {
    foreach ($titles as $title) {
        $data=json_encode($title["title"],true);
        echo $data.",";
        file_put_contents ('data.txt' , $data.",", FILE_APPEND );

      }
  }
  //echo $response;
}



//SERIES
$total_pages_s=12;

for($i=1;$i<=$total_pages_s;$i++)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.themoviedb.org/3/discover/tv?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=original.title.asc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr&page=$i",
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

  //Récupération du nombre total de pages
  $data=json_decode($response, true);
  $titles=$data["results"];
  //var_dump($data["results"]);
  //$total_pages=$data["total_pages"];
  $last_title=end($titles);

  if ($err) 
  {
    echo "cURL Error #:" . $err;
  } 
  else {
    foreach ($titles as $title) {
      if($i!==$total_pages_s)
      {
        $data=json_encode($title["name"],true);
        echo $data.",";
        file_put_contents ('data.txt' , $data.",", FILE_APPEND );

      }
      else
      {
        if(($last_title["id"]!==$title["id"]))
        {
          $data=json_encode($title["name"],true);
          echo $data.",";
          file_put_contents ('data.txt' , $data.",", FILE_APPEND );

        }
        else
        {

          $data=json_encode($title["name"],true);
          echo $data;
          file_put_contents ('data.txt' , $data, FILE_APPEND );

        }
      }
  }
  //echo $response;
  }
}

echo "]";
file_put_contents ('data.txt' , "]", FILE_APPEND );

?>



