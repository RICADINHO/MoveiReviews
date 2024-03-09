<!--                                       TIRAR VALORES DA API                                                                  -->
<?php
$apiKey = "976f9dd7e5b7a6ad8f7632a2d65fc8e9";
$movieId = $_GET["filme"];// = 'avengers endgame'; // Change the movie title as desired
$imagens = array();
$trailers_array = array();
// Function to make an API request
function requestAPI($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

$generos = array();
$diretores= array();
$escritores = array();
$destaque = array();

    $filmeUrl = "https://api.themoviedb.org/3/movie/$movieId?api_key=$apiKey";
    $filmeResponse = requestAPI($filmeUrl);
    $filmes = json_decode($filmeResponse,true);

    $trailerUrl = "https://api.themoviedb.org/3/movie/$movieId/videos?api_key=$apiKey";
    $trailerResponse = requestAPI($trailerUrl);
    $trailers = json_decode($trailerResponse, true);

    if (!empty($trailers['results'])) {
        $trailerof= array("N/A");
        $trailernaoof = array("N/A");

        foreach ($trailers['results'] as $trailer) {
            if($trailer['type']=="Trailer"&&$trailer['official']==true){
                array_push($trailerof,$trailer['key']);
                array_push($trailerof," - ");
                array_push($trailers_array,$trailer['key']);
            }
        }

        if(sizeof($trailerof)==1){
            
        }else{
            array_pop($trailerof);
            $trailer_teste = $trailerof[1];
          
        }
    }

    $genresUrl = "https://api.themoviedb.org/3/movie/$movieId?api_key=$apiKey&append_to_response=genres%20status%20runtime";
    $genresResponse = requestAPI($genresUrl);
    $movieDetails = json_decode($genresResponse, true);

    if (!empty($movieDetails['genres'])) {
        $genres = $movieDetails['genres'];
        

        
        foreach ($genres as $genre) {
            //echo $genre['name'] . " ";
            array_push($generos,$genre['name']);
            array_push($generos," - ");
        }


    }
    if(empty($generos)){
        array_push($generos,"N/A");
    }else{
        array_pop($generos);
       // echo "escritores: ";
        for($i=1;$i<sizeof($generos);$i++){
           // echo $generos[$i]." ";
        }
       // echo "<br>";
    }
   // echo "Runtime: ".$movieDetails['runtime']."<br>";
    //echo "Status: ".$movieDetails['status']."<br>";
   // echo "Average score: meter cenas na bd para isso<br>";

    $imagesUrl = "https://api.themoviedb.org/3/movie/$movieId/images?api_key=$apiKey";
    $imagesResponse = requestAPI($imagesUrl);
    $imagesData = json_decode($imagesResponse, true);

    if (!empty($imagesData['posters'])) {
        $posters = $imagesData['posters'];

       // echo "Movie Posters:<br>";
        foreach ($posters as $poster) {
            //echo $poster['file_path'] . "<br>";
            $posterUrl = 'https://image.tmdb.org/t/p/original' . $poster['file_path'];
            //echo "<img src='$posterUrl' alt='Movie Poster' width='225' height='318'><br>";
           // break;
           array_push($imagens,$posterUrl);
        }
    } else {
      //  echo "No movie posters found.<br>";
    }

    $castUrl = "https://api.themoviedb.org/3/movie/$movieId/credits?api_key=$apiKey";
    $castResponce = requestAPI($castUrl);
    $castData = json_decode($castResponce, true);

    if(!empty($castData['crew'])){


        foreach($castData['crew'] as $crew){
            if($crew['job']=="Director"){
                array_push($diretores,$crew['name']);
                array_push($diretores," - ");
            }
            if($crew['department']=="Writing"){
                array_push($escritores,$crew['name']);
                array_push($escritores," - ");
            }
        }


    }else{
      //  echo "no cast found<br>";
    }
    if(empty($diretores)){
        array_push($diretores,"N/A");
    }else{
        array_pop($diretores);
      //  echo "Diretores: ";
        for($i=1;$i<sizeof($diretores);$i++){
            //echo $diretores[$i]." ";
        }
       // echo "<br>";
    }
    
    if(empty($escritores)){
        array_push($escritores,"N/A");
    }else{
        array_pop($escritores);
        //echo "escritores: ";
        for($i=1;$i<sizeof($escritores);$i++){
          //  echo $escritores[$i]." ";
        }
        //echo "<br>";
    }
    if(!empty($castData['cast'])){
  

        foreach($castData['cast'] as $cast){
            if($cast['order']<5){
                array_push($destaque,$cast['name']);
                array_push($destaque," - ");
            }else{
                break;
            }
        }

    }else{
       // echo "no cast found<br>";
    }
    if(empty($destaque)){
        array_push($destaque,"N/A");
    }else{
      //  echo "Atores destaque: ";
        array_pop($destaque);
        for($i=1;$i<sizeof($destaque);$i++){
       ///     echo $destaque[$i];
        }
       // echo "<br>";
    }
    function verscore($id_filme){
        $url = "http://localhost/projeto/API_BD.php?id_filme=$id_filme";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($curl_response);
        $media = 0.0;
        $quant = 0.0;
        if($data == null){
            return 0.0;
        }
        foreach($data as $zaza){
            $media += $zaza->pontuacao;
            $quant++;
        }
        return number_format((float)($media/$quant),2,'.','');
    }
?>