@extends('layouts.app')
 
@section('content')

<?php 

echo '<div class="background-container dark-container p-5 m-5 mt-0 rounded-4">';
echo '<form action="/search" method="POST" role="search">';
      echo csrf_field();
      echo '<input type="text" class="form-control" name="q"';
      echo 'placeholder="Zoek naar muziek..."><span class="zoek">';
      echo '<button type="submit" class="btn btn-default"></button>';
      echo '<br><br>';
echo '</form>';

echo '<div class="container bg-dark p-5 rounded-4" style="background-image: url('.$headerimageurl.');    background-size: cover; ">';
    echo '<div class="row align-items-center">';
      echo '<div class="col">';
        if(is_int($checkFavouritesListUser)) {
          echo '<img id="clickFavourite" src="'.$songartimageurl.'" style="width: 100%; height:100%; max-width:300px;max-height:300px; box-shadow: 5px 5px 4px rgba(0, 0, 0, 0.4);" onclick="Favourite('.$id.')"/>';
        } else {
          echo '<img id="clickFavourite" src="'.$songartimageurl.'" style="width: 100%; height:100%; max-width:300px;max-height:300px; box-shadow: 5px 5px 4px rgba(0, 0, 0, 0.4);" onclick="Favourite('.$id.', '.$checkFavouritesListUser->id.')"/>';
        }
      echo '</div>';
      echo '<div class="col">';
        echo '<h1 class="text-white h1-title" style="text-shadow: 0 0 10px rgba(0,0,0,0.7);">'.$title.'</h1>';
        echo '<h2 class="text-white h2-title" style="text-shadow: 0 0 10px rgba(0,0,0,0.7);">'.$artistnames.'</h2>';
          if($show == 1) { 
          echo '<div class="yt-iframe-desktop">';
            echo '<iframe width="420" height="236" src="'.$finalUrl.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="yt-video">></iframe>';
          echo '</div>';
        echo '</div>';
        echo '<div class="col-new">';
          echo '<div class="yt-iframe-phone">';
              echo '<iframe width="420" height="236" src="'.$finalUrl.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="yt-video">></iframe>';
          echo '</div>';
          }
        echo '</div>';
    echo '</div>';
echo '</div>';

echo '<br><br><br>';

echo '<div class="container mt-4 rounded-4">';
  echo '<h1 class="text-white">Geschiedenis</h1>';
  echo '<div class="row h-100 justify-content-center align-items-center">';
    for ($x = 0; $x <= 3; $x++) {
      if(isset($array4[$x])) {
        $f1 = $array4[$x]; 
          echo '<div class="col p-3">';
          $searchString = $f1[2].' '.$f1[1];
          $cleanStr = preg_replace('/[^A-Za-z0-9 ]/', '', $searchString);
            echo '<a href="'.route('index',['q'=> $cleanStr]).'"><img src="'.$f1[0].'" class="" style="width:100%;height:100%; min-width: 100px; min-height: 100px; max-width: 290px; max-height: 290px; box-shadow: 5px 5px 4px rgba(0, 0, 0, 0.4);"></a>';
              echo '<div class="fixed_size_padding">';
                echo '<h5 class="text-white" style="margin-top: 10px;">'.$f1[1].'</h1>';
                echo '<h6 class="text-white">'.$f1[2].'</h2>';
              echo '</div>';
          echo '</div>';
        } 
    }

  echo '</div>';
  echo '<div class="row h-100 justify-content-center align-items-center">';
    for ($x = 4; $x <= 7; $x++) {
      if(isset($array4[$x])) {
        $f1 = $array4[$x]; 
          echo '<div class="col p-3">';
          $searchString = $f1[2].' '.$f1[1];
          $cleanStr = preg_replace('/[^A-Za-z0-9 ]/', '', $searchString);
            echo '<a href="'.route('index',['q'=> $cleanStr]).'"><img src="'.$f1[0].'" class="" style="width:100%;height:100%; min-width: 100px; min-height: 100px; max-width: 290px; max-height: 290px; box-shadow: 5px 5px 4px rgba(0, 0, 0, 0.4);"></a>';
              echo '<div class="fixed_size_padding">';
                echo '<h5 class="text-white" style="margin-top: 10px;">'.$f1[1].'</h1>';
                echo '<h6 class="text-white">'.$f1[2].'</h2>';
              echo '</div>';
          echo '</div>';
        } 
    }

  echo '</div>';
echo '</div>';

echo '<br>';

if (Auth::check()) {
  if(is_int($find)) {
  } else {
    if($array6 == 'none') {
    } else { 
        $uniqueArray=array();

        for ($x = 200; $x >= 0; $x--) {
          if(isset($favorietenlijst[$x])) {
            $f1 = $favorietenlijst[$x];
            array_push($uniqueArray, $f1[0]);
          }
        } 
      } 

      $UniqueArrayRemovedDuplicates = array_unique($uniqueArray);   
      $renumberedArray = array_values($UniqueArrayRemovedDuplicates); 

      $countValuesInArray = count($renumberedArray);

      $countAmountOfSongs2 = count($uniqueArray);

    $i = 0; 

    $arrayCount = $countValuesInArray - 1;

    //limit amounts of favorite lists
  if($arrayCount > 3) {
    $increments = 3;
  } else {
    $increments = $arrayCount;
  }

    echo '<div class="container mt-4 rounded-4">';
    echo '<div class="row align-items-start">';
    echo '<h1 class="text-white">Favorieten</h1>';
    echo '</div>';
    echo '<div class="row align-items-start">';
        while($i <= $increments) { 
          echo '<div style="max-width: 300px;" class="col fixed-height bg-opacity rounded-3 m-3 p-3">';
          echo '<h1 class="text-white m-3">'.$renumberedArray[$i].'</h1>';
          for ($x = 0; $x <= 200; $x++) {
            if(isset($favorietenlijst[$x])) {
              $f1 = $favorietenlijst[$x];
              if($f1[0] == $renumberedArray[$i]) { 
                echo '<div class="row m-2 align-items-start">';
                  echo '<div style="" class="col">';
                  $searchString = $f1[3].' '.$f1[2];
                  $cleanStr = preg_replace('/[^A-Za-z0-9 ]/', '', $searchString);
                      echo '<a href="'.route('index',['q'=> $cleanStr]).'"><img src="'.$f1[1].'" class="" style="width: 100px; box-shadow: 5px 5px 4px rgba(0, 0, 0, 0.4);"/></a>';
                  echo '</div>';
                  echo '<div style="max-height: 100px; overflow: scroll;" class="col overflow-hide">';
                    echo '<h5 class="text-white">'.$f1[2].'</h5>';
                    echo '<h6 class="text-white" style="margin-top: -4px;">'.$f1[3].'</h6>';
                  echo '</div>';
                echo '</div>';
              }
            }
          } 
          $i++; 
          echo '</div>';
        } 
    echo '</div>';
    echo '<h6 style="margin-left: 10px;" class="text-white">Je hebt in totaal '.$countAmountOfSongs2.' favorieten</h6>';
    echo '</div>';
  }
}


if ($checkFavouriteUser == 1) {
  echo '<div id="return" class="overlayFavouriteList">';
  echo '<div class="container favourite-container margin-auto bg-dark p-5 m-5 rounded-4">';
    if (Auth::check()) { 
      echo '<p class="text-white">Welkom '.Auth::user()->name.'</p>';
      echo '<form method="post" action="'.route('logout').'">';
      echo csrf_field();
      echo '<button class="btn btn-xs btn-info pull-right" type="submit">Logout</button>';
      echo '</form><br><br>';
    echo '<h1 class="text-white">Favorietenlijst</h1><br>';
      echo '<div id="user_input_choose_favourite_list">';
      echo '<p class="text-white mt-3">Verwijder uw favoriet.</p>';
      echo '</div>';
        echo '<div class="row">';
          echo '<div class="col">';
              echo '<form action="/DeleteFavouriteInList" method="POST" role="DeleteFavourite">';
              echo csrf_field();
              echo '<input style="color: white;" type="text" id="my" name="song_id"/>';
              echo '<button style="margin-left: 0px;" type="submit" class="btn bg-white btn-default">Verwijder favoriet</button>';
              echo '</form>';
          echo '</div>';
        echo '</div>';

        echo '<div class="mt-5" id="user_input_choose_favourite_list">';
        echo '<p class="text-white mt-3">Verwijder desbetreffende favoriete lijst en favorieten.</p>';
        echo '</div>';
          echo '<div class="row">';
            echo '<div class="col">';
                echo '<form action="/DeleteFavouriteList" method="POST" role="DeleteFavourite">';
                echo csrf_field();
                echo '<input style="color: white;" type="text" id="myg" name="id"/>';
                echo '<button style="margin-left: 0px;" type="submit" class="btn bg-white btn-default">Verwijder lijst</button>';
                echo '</form>';
            echo '</div>';
          echo '</div>';

      echo '<div id="user_input_choose_favourite_list_to_delete">';
      echo '</div>';
      echo '<div id="check_user_is_sure_to_delete">';
    echo '</div>';
  } else {
      echo '<h1 class="text-white">U heeft geen rechten</h1>';
      echo '<a href="'.route('login').'" class="btn btn-xs btn-info pull-right">inloggen</a>';
  } 
  echo '</div>';
  echo '</div>';
} else {
  echo '<div id="return" class="overlayFavouriteList">';
  echo '<div class="container favourite-container margin-auto bg-dark p-5 m-5 rounded-4">';
    if (Auth::check()) { 
      echo '<p class="text-white">Welkom '.Auth::user()->name.'</p>';
      echo '<form method="post" action="'.route('logout').'">';
      echo csrf_field();
      echo '<button class="btn btn-xs btn-info pull-right" type="submit">Logout</button>';
      echo '</form><br><br>';
    echo '<h1 class="text-white">Favorietenlijst</h1><br>';
    echo '<div id="user_input_add_favourite_list">';
      echo '<p class="text-white">Voeg een lijst toe waarin u uw favoriete muziekjes kunt plaatsen.</p>';
    echo '</div>';
      echo '<form action="/favouritelist" method="POST" role="search">';
        echo csrf_field();
        echo '<input style="margin-left: -10px;" type="text" class="form-control" name="list_name"';
        echo 'placeholder="Voeg een lijst toe..."><span class="zoek">';
        echo '<button type="submit" class="btn btn-default"></button>';
      echo '</form>';
      echo '<div id="user_input_choose_favourite_list">';
      echo '<p class="text-white mt-3">Kies in welke lijst u uw favoriete muziekje wilt plaatsen.</p>';
      echo '</div>';
        echo '<div class="row">';
          echo '<div class="col">';
              echo '<form action="/addFavouriteToList" method="POST" role="addFavourite">';
              echo csrf_field();
              echo '<select name="favourite_name" id="fav">';
                foreach ($favouriteLists as $list) {
                  echo '<option value="'.$list['id'].'">'.$list['list_name'].'</option>';
                }
              echo '</select>';
              echo '<input style="color: white;" type="text" id="my" name="song_id"/>';
              echo '<button type="submit" class="btn bg-white btn-default">Voeg toe</button>';
              echo '</form>';
          echo '</div>';
        echo '</div>';
      echo '<div id="user_input_choose_favourite_list_to_delete">';
      echo '</div>';
      echo '<div id="check_user_is_sure_to_delete">';
    echo '</div>';
  } else {
      echo '<h1 class="text-white">U heeft geen rechten</h1>';
      echo '<a href="'.route('login').'" class="btn btn-xs btn-info pull-right">inloggen</a>';
  } 
  echo '</div>';
  echo '</div>';
}

echo '</div>';

?>

@endsection


