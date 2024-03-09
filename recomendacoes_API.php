<?php
$apiKey = '976f9dd7e5b7a6ad8f7632a2d65fc8e9'; // Replace with your TMDB API key

// Function to make an API request
function requestAPI($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

$categories = ['ação', 'romance', 'fantasia', 'terror', 'comédia', 'história', 'guerra', 'ficção científica' /*'sports'*/]; //&with_genres=$category
$genreIds = [28, 10749, 14, 27, 35, 36, 10752, 878]; //10770
$moviesPerCategory = 3;
$filmes_ids = array();
$filmes_acao = array();
$filmes_romance = array();
$filmes_fantasia = array();
$filmes_horror = array();
$filmes_comedia = array();
$filmes_historia = array();
$filmes_guerra = array();
$filmes_scifi = array();

$filmes_imagens = array();
$filmes_acao_imagens = array();
$filmes_romance_imagens = array();
$filmes_fantasia_imagens = array();
$filmes_horror_imagens = array();
$filmes_comedia_imagens = array();
$filmes_historia_imagens = array();
$filmes_guerra_imagens = array();
$filmes_scifi_imagens = array();

//foreach ($categories as $category) {
foreach($genreIds as $genreId){
    for($i=0;$i<$moviesPerCategory;$i++){
        $pagina = rand(1,500);
        //echo "PAGINAAAAAAAAA =$pagina<br>";
        // Get the movies in the specified category
        $moviesUrl = "https://api.themoviedb.org/3/discover/movie?api_key=$apiKey&with_genres=$genreId&page=$pagina";
        $moviesResponse = requestAPI($moviesUrl);
        $moviesData = json_decode($moviesResponse, true);

        if (isset($moviesData['results']) && count($moviesData['results']) > 0) {
            $movies = $moviesData['results'];

            // Display the movie details
           // echo "Random Movies in $ category$genreId category:<br>";
            //for ($i = 0; $i < $moviesPerCategory; $i++) {
                $randomIndex = array_rand($movies);
                $randomMovie = $movies[$randomIndex];
                $randomId = $randomMovie['id'];

              //  echo "Movie Title: " . $randomMovie['title'] . "<br>";
               // echo "Movie ID: " . $randomMovie['id'] . "<br>";
               // echo "Overview: " . $randomMovie['overview'] . "<br>";
               // echo "<br>";

                if($genreId == 28){
                    array_push($filmes_acao,$randomId);
                }else if($genreId == 10749){
                    array_push($filmes_romance,$randomId);
                }else if($genreId == 14){
                    array_push($filmes_fantasia,$randomId);
                }else if($genreId == 27){
                    array_push($filmes_horror,$randomId);
                }else if($genreId == 35){
                    array_push($filmes_comedia,$randomId);
                }else if($genreId == 36){
                    array_push($filmes_historia,$randomId);
                }else if($genreId == 10752){
                    array_push($filmes_guerra,$randomId);
                }else if($genreId == 878){
                    array_push($filmes_scifi,$randomId);
                }

                $imagesUrl = "https://api.themoviedb.org/3/movie/$randomId/images?api_key=$apiKey";
                $imagesResponse = requestAPI($imagesUrl);
                $imagesData = json_decode($imagesResponse, true);
            
                if (!empty($imagesData['posters'])) {
                    $posters = $imagesData['posters'];
        
                    foreach($posters as $poster) {
                        $posterUrl = 'https://image.tmdb.org/t/p/original' . $poster['file_path'];
                        if($genreId == 28){
                            array_push($filmes_acao_imagens,$posterUrl);
                        }else if($genreId == 10749){
                            array_push($filmes_romance_imagens,$posterUrl);
                        }else if($genreId == 14){
                            array_push($filmes_fantasia_imagens,$posterUrl);
                        }else if($genreId == 27){
                            array_push($filmes_horror_imagens,$posterUrl);
                        }else if($genreId == 35){
                            array_push($filmes_comedia_imagens,$posterUrl);
                        }else if($genreId == 36){
                            array_push($filmes_historia_imagens,$posterUrl);
                        }else if($genreId == 10752){
                            array_push($filmes_guerra_imagens,$posterUrl);
                        }else if($genreId == 878){
                            array_push($filmes_scifi_imagens,$posterUrl);
                        }
                        //echo "<a href='filmes2.php?filme=$movieid'><img src='$posterUrl' alt='Movie Poster' style='width: 50px;heigth: 75px'></a><br><br>";
                        break;
                    }
                }else{
                    if($genreId == 28){
                        array_push($filmes_acao_imagens,"filmes/null.png");
                    }else if($genreId == 10749){
                        array_push($filmes_romance_imagens,"filmes/null.png");
                    }else if($genreId == 14){
                        array_push($filmes_fantasia_imagens,"filmes/null.png");
                    }else if($genreId == 27){
                        array_push($filmes_horror_imagens,"filmes/null.png");
                    }else if($genreId == 35){
                        array_push($filmes_comedia_imagens,"filmes/null.png");
                    }else if($genreId == 36){
                        array_push($filmes_historia_imagens,"filmes/null.png");
                    }else if($genreId == 10752){
                        array_push($filmes_guerra_imagens,"filmes/null.png");
                    }else if($genreId == 878){
                        array_push($filmes_scifi_imagens,"filmes/null.png");
                    }
                    //echo "<a href='filmes2.php?filme=$movieid'><img src='null.png' alt='a sua mae' style='width: 50px;heigth: 75px'></a><br><br>";
                }

                // Remove the chosen movie from the list to avoid duplicates
                unset($movies[$randomIndex]);
            //}
        } else {
            //echo "No movies found in $ category category.<br>";
            $i--;
        }
    }
   // echo "<br><hr><br>";
}

array_push($filmes_ids,$filmes_acao);
array_push($filmes_ids,$filmes_romance);
array_push($filmes_ids,$filmes_fantasia);
array_push($filmes_ids,$filmes_horror);
array_push($filmes_ids,$filmes_comedia);
array_push($filmes_ids,$filmes_historia);
array_push($filmes_ids,$filmes_guerra);
array_push($filmes_ids,$filmes_scifi);// FAZER A CENA DE METER ISTO NO INICIO E EM VEZ DO IF TODO QUE TENHO PRA VER O ID APENAS FAZER PUSH NO ARRAY ..[$i]

array_push($filmes_imagens,$filmes_acao_imagens);
array_push($filmes_imagens,$filmes_romance_imagens);
array_push($filmes_imagens,$filmes_fantasia_imagens);
array_push($filmes_imagens,$filmes_horror_imagens);
array_push($filmes_imagens,$filmes_comedia_imagens);
array_push($filmes_imagens,$filmes_historia_imagens);
array_push($filmes_imagens,$filmes_guerra_imagens);
array_push($filmes_imagens,$filmes_scifi_imagens);
?>