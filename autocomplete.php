<?php
echo "[";

for($i=1;$i<=2;$i++)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.themoviedb.org/3/discover/movie?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&sort_by=popularity.desc&include_adult=false&include_video=false&with_genres=16&with_original_language=fr&page=$i",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
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
      if($i!==2)
      {
        $data=json_encode($title,true);
        echo $data.",";
      }
      else
      {
        if(($last_title["id"]!==$title["id"]))
        {
          $data=json_encode($title,true);
          echo $data.",";
        }
        else
        {
          $data=json_encode($title,true);
          echo $data;
        }
      }
  }
  //echo $response;
}

}
echo "]";


?>



