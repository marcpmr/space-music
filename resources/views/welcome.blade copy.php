@extends('layouts.app')
 
@section('content')

<?php 
//print_r($array1);
//$array6 = $array5[0];
//print_r($checkFavouriteUser);
?>
<div class="background-container dark-container p-5 m-5 mt-0 rounded-4">
<form action="/search" method="POST" role="search">
    {{ csrf_field() }}
      <input type="text" class="form-control" name="q"
      placeholder="Zoek naar muziek..."><span class="zoek">
      <button type="submit" class="btn btn-default"></button>
      <br><br>
</form>

<div class="container bg-dark p-5 rounded-4" style='background-image: url("<?= $headerimageurl ?>");    background-size: cover; '>
    <div class="row align-items-center">
      <div class="col">
        <img id="clickFavourite" src="<?php echo $songartimageurl ?>" style="width: 100%; height:100%; max-width:300px;max-height:300px; box-shadow: 5px 5px 4px rgba(0, 0, 0, 0.4);" onclick="Favourite({{$id}})"/>
      </div>
      <div class="col">
        <h1 class="text-white h1-title" style="text-shadow: 0 0 10px rgba(0,0,0,0.7);"><?php echo $title ?></h1>
        <h2 class="text-white h2-title" style="text-shadow: 0 0 10px rgba(0,0,0,0.7);"><?php echo $artistnames ?></h2>
          <?php if($show == 1) { ?>
          <div class="yt-iframe-desktop">
            <iframe width="420" height="236" src="<?php echo $finalUrl?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="yt-video">></iframe>
          </div>
          </div>
        <div class="col-new">
          <div class="yt-iframe-phone">
              <iframe width="420" height="236" src="<?php echo $finalUrl?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="yt-video">></iframe>
            </div>
            <?php } ?>
          </div>
    </div>
</div>

<br><br><br>

<div class="container mt-4 rounded-4">
  <h1 class="text-white">Geschiedenis</h1>
  <div class="row h-100 justify-content-center align-items-center">
    <?php 
    for ($x = 0; $x <= 3; $x++) {
      if(isset($array4[$x])) {
        $f1 = $array4[$x]; ?>
          <div class="col p-3">
            <a href="{{route('index',['q'=> $f1[2].' '.$f1[1]])}}"><img src="<?php echo $f1[0]; ?>" class="" style="width:100%;height:100%; min-width: 100px; min-height: 100px; max-width: 290px; max-height: 290px; box-shadow: 5px 5px 4px rgba(0, 0, 0, 0.4);"></a>
              <div class="fixed_size_padding">
                <h5 class="text-white" style="margin-top: 10px;"><?php echo $f1[1]?></h1>
                <h6 class="text-white"><?php echo $f1[2] ?></h2>
              </div>
          </div>
        <?php } 
    }
     ?>
  </div>
  <div class="row h-100 justify-content-center align-items-center">
  <?php 
    for ($x = 4; $x <= 7; $x++) {
      if(isset($array4[$x])) {
        $f1 = $array4[$x]; ?>
          <div class="col p-3">
            <a href="{{route('index',['q'=> $f1[2].' '.$f1[1]])}}"><img src="<?php echo $f1[0]; ?>" class="" style="width:100%;height:100%; min-width: 100px; min-height: 100px; max-width: 290px; max-height: 290px; box-shadow: 5px 5px 4px rgba(0, 0, 0, 0.4);"></a>
              <div class="fixed_size_padding">
                <h5 class="text-white" style="margin-top: 10px;"><?php echo $f1[1]?></h1>
                <h6 class="text-white"><?php echo $f1[2] ?></h2>
              </div>
          </div>
        <?php } 
    }
     ?>
  </div>
</div>

<br><br><br> 

<?php if (Auth::check()) {
if($array6 == 'none') {
} else { ?>
    <?php 
    //getting unique array with first key
    $uniqueArray=array();

    for ($x = 150; $x >= 1; $x--) {
      if(isset($favorietenlijst[$x])) {
        $f1 = $favorietenlijst[$x];
        array_push($uniqueArray, $f1[0]);
      }
    } 
  } 


  $UniqueArrayRemovedDuplicates = array_unique($uniqueArray);   // $f1 = $array5[$x]; 
  $renumberedArray = array_values($UniqueArrayRemovedDuplicates); 

  $countValuesInArray = count($renumberedArray);

  $countAmountOfSongs = count($uniqueArray) + 1;


  //limit amounts of favorite lists
  //if($countValuesInArray > 3) {
    //$increments = 3;
 // } else {
   // $increments = $countValuesInArray;
  //}

$i = 0; 

$arrayCount = $countValuesInArray - 1;

echo '<div class="container mt-4 rounded-4">';
echo '<h1 class="text-white">Favorieten</h1>';
echo '<div class="row align-items-start">';
    while($i <= $arrayCount) { 
      echo '<div style="max-width: 300px;" class="col fixed-height bg-opacity rounded-3 m-3 p-3">';
      echo '<h1 class="text-white m-3">'.$renumberedArray[$i].'</h1>';
      for ($x = 150; $x >= 0; $x--) {
        if(isset($favorietenlijst[$x])) {
          $f1 = $favorietenlijst[$x];
          if($f1[0] == $renumberedArray[$i]) { 
            echo '<div class="row m-2 align-items-start">';
              echo '<div style="" class="col">';
                  echo '<a href="'.route('index',['q'=> $f1[3].' '.$f1[2]]).'"><img src="'.$f1[1].'" class="" style="width: 100px; box-shadow: 5px 5px 4px rgba(0, 0, 0, 0.4);"/></a>';
              echo '</div>';
              echo '<div style="max-height: 100px; overflow: scroll;" class="col">';
                echo '<p class="text-white">'.$f1[2].'</p>';
                echo '<p class="text-white" style="margin-top: -15px;">'.$f1[3].'</p>';
              echo '</div>';
            echo '</div>';
          }
        }
      } 
      $i++; 
      echo '</div>';
    } 
echo '</div>';
echo '<h6 style="margin-left: 10px;" class="text-white">Je hebt in totaal '.$countAmountOfSongs.' favorieten</h6>';
echo '</div>';
}



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
      echo '<input type="text" class="form-control" name="list_name"';
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
            echo '<input type="text" id="my" name="song_id"/>';
            echo '<button type="submit" class="btn bg-white btn-default"></button>';
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
   ?>

<div class="container mt-4 bg-dark rounded-4">

</div>
</div>

@endsection


