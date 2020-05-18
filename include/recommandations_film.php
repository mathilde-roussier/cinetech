<?php

//FILMS

if(isset($_GET["id_film"]))
{
  $id_film=$_GET["id_film"];
}
$total_pages_f=5;
$reco=[];

for($i=1;$i<=$total_pages_f;$i++)
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.themoviedb.org/3/movie/$id_film/similar?api_key=21265361ae3ee1f790c63a3a2973a4f2&language=fr-FR&page=$i",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 1,
    CURLOPT_TIMEOUT => 15,
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
  $total_pages=$data["total_pages"];
  if ($err) 
  {
    echo "cURL Error #:" . $err;
  } 
  else 
  {
    foreach ($data["results"] as $title) {
      if($title["original_language"]=="fr")
      {
        if(in_array("16",$title["genre_ids"]) OR empty($title["genre_ids"]))
        {
          if(count($reco)<=2)
          {
            array_push($reco,$title);
          }
        }
      }
    }
  }
}

?>



