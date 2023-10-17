<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\history;
use App\Models\songsdatabase;
use App\Models\favourite;
use App\Models\FavouriteList;
use Session;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index($q)
    {
        $history = new history;
        $songsdatabase = new songsdatabase;
        $favourite = new favourite;
        $favouriteList = new FavouriteList;
        // including genius api
        require_once('genius.php');

        //checking user input otherwise setting sample input

            //computerID




        //checking whatever right song is being taken (alpha) (not working propelry)

       // $q = preg_replace('/[^A-Za-z0-9 ]/', '', $q);
       // $title = preg_replace('/[^A-Za-z0-9 ]/', '', $array4['title']);

       // if (str_contains($q, $title)) { 
       // } else {
          //  $q = explode(' ', $q);
           // $countq = count($q);
           // for ($x = 0; $x < $countq; $x++) {
            //    $upvoteAnnotation = $genius->getSearchResource()->get($q[$x]);
            //    $array = json_decode(json_encode($upvoteAnnotation), true);
                        
              //  $array2 = $array['hits'];
              //  $array3 = $array2[0];
              //  $array4 = $array3['result'];
                    

               // $upvoteAnnotation2 = $genius->getSongsResource()->get($array4['id']);
               // $array20 = json_decode(json_encode($upvoteAnnotation2), true);
               // $array30 = $array20['song'];
               // $array31 = $array30['media'];
               // if (str_contains($q[$x], $title)) { 
              //      break;
               // }
           // }
      //  }




        $computerId = $_SERVER['REMOTE_ADDR'];

        //setting q based on histroy data
        if(!isset($q)) {
            $historyDataExistance = history::select('song_id')->where('session_id', $computerId)->count();
            if ($historyDataExistance > 0) {
                $historyData = history::select('song_id')->where('session_id', $computerId)->orderBy('id', 'desc')->take(1)->first();
                $selectSongData = songsdatabase::where('song_id', $historyData->song_id)->take(1)->first();
                $q = $selectSongData['song_artist'].' '.$selectSongData['song_title'];
            } else {
                $q = "sample"; 
            }
        }

        $true = 0;

        //old code

       // if (str_contains($q, '@')) { 
            //$q = str_replace("@", "", $q);
          //  $true = 1;
        //} else {
          // $true = 0;
        //}
    

        //retrieving data from genius database

        $upvoteAnnotation = $genius->getSearchResource()->get($q);
        $array = json_decode(json_encode($upvoteAnnotation), true);
                
        $array2 = $array['hits'];
        $array3 = $array2[0];
        $array4 = $array3['result'];
            

        $upvoteAnnotation2 = $genius->getSongsResource()->get($array4['id']);
        $array20 = json_decode(json_encode($upvoteAnnotation2), true);
        $array30 = $array20['song'];
        $array31 = $array30['media'];

        //old code

        //checking whatever q contains favourite set string

        //if ($true == 1) { 
          //  if (Auth::check()) {
               // $checkFavExistance = favourite::where(['song_id' => $array4['id'],'login_id' => Auth::user()->id])->orderBy('id', 'desc')->take(1)->count();
               // if ($checkFavExistance == 0) {
                  //  $favourite->song_id = $array4['id'];
                   // $favourite->login_id = Auth::user()->id;
                   // $favourite->user_id = Auth::user()->name;
                  //  $favourite->save();
              //  }
           // } else {
              //  $product = array();
               // Session::push('key', $array4['id']);
            //}
       // }
        
       // if (Auth::check()) {
          // $values = Session::get('key');
            //if(isset($values)) {
             //   foreach ($values as $value) {
                 //   $checkFavExistance2 = favourite::where(['song_id' => $value,'login_id' => Auth::user()->id])->where('login_id', Auth::user()->id)->orderBy('id', 'desc')->take(1)->count();
                  //  if($checkFavExistance2 == 0) {
                  //      $favourite->song_id = $value;
                  ///      $favourite->login_id = Auth::user()->id;
                   //     $favourite->user_id = Auth::user()->name;
                   //     $favourite->save();
                   // }
                //}
           /// }
        //}
        if (Auth::check()) {
            $countHowManyFavouriteListExists = favouriteList::where('login_id', Auth::user()->id)->count();

        $i = 1;
        $incrementsDataAll5 = array();
        while ($i <= $countHowManyFavouriteListExists) {
            if(isset(FavouriteList::find($i)->favourite)) {
                $retrievingFavouritesinList = FavouriteList::find($i)->favourite;

                //retrieving data based on history data

                foreach ($retrievingFavouritesinList as $favouriteinList) {
                    $SelectingSongs = songsdatabase::where('song_id', $favouriteinList->song_id)->orderBy('id', 'desc')->take(1)->first();;

                    $namelist = FavouriteList::select('list_name')->where('id', $i)->take(1)->first();
                    //$upvoteAnnotation = $genius->getSongsResource()->get($increments->song_id);
                    //$ar = json_decode(json_encode($upvoteAnnotation), true);
                    //$arr = $ar['song'];

                    ///$songartimageurl = $arr['song_art_image_url'];
                    ///$title = $arr['title'];
                    //$artistnames = $arr['artist_names'];

                    //$addArrayIncrementsAll = array($songartimageurl, $title, $artistnames);

                    //$addArrayIncrementsAll = array($songartimageurl, $title, $artistnames);
                    $addArrayIncrementsAll5 = array($namelist->list_name, $SelectingSongs->song_image_url, $SelectingSongs->song_title, $SelectingSongs->song_artist);

                    array_push($incrementsDataAll5, $addArrayIncrementsAll5); 
                }
            }
            $i++;
        }
    } else {
        $retrievingFavouriteList = " ";
        $retrievingFavouritesinList = " ";
        $incrementsDataAll5 = " ";
    }


        //Session('basic_settings')[0]['company_name']

        //retrieving favourite lists
    
        if (Auth::check()) {
            $retrievingFavouriteList = FavouriteList::where('login_id', Auth::user()->id)->orderBy('id', 'desc')->take(8)->get();
        } else {
            $retrievingFavouriteList = "";
        }



        //userloginID

        $userloginID = 0;

         //checking whatever song can be put into own database

         $checkSongExistance = songsdatabase::select('song_id')->where('song_id', $array4['id'])->orderBy('id', 'desc')->take(1)->count();;

 
         if($checkSongExistance == 0) {
             $songsdatabase->song_id = $array4['id'];
             $songsdatabase->song_title = $array4['title'];
             $songsdatabase->song_artist = $array4['artist_names'];
             $songsdatabase->song_image_url = $array4['song_art_image_url'];
             $songsdatabase->save();
         }  
 
         //puttting song in own database if no entry found with matching id


        //checking if latest in database is the same as now

        $incrementIDCount = history::select('song_id')->orderBy('id', 'desc')->take(1)->count();

        if($incrementIDCount == 0) {
            $history->session_id = $computerId;
            $history->song_id = $array4['id'];
            $history->user_id = $userloginID;
            $history->save();
        } else {
            $incrementID = history::select('song_id')->orderBy('id', 'desc')->take(1)->first();

            //inserting history data into database

            if($array4['id'] == $incrementID->song_id || $array4['id'] ==  193369) {
            } else {
            $history->session_id = $computerId;
            $history->song_id = $array4['id'];
            $history->user_id = $userloginID;
            $history->save();
             }
        }



            //return redirect()->back()->with('status','Student Added Successfully');

            //$ramenonderlateststate = ramen::where('waar', 'onder')->orderBy('id', 'desc')->take(1)->get();
        
        //retrieving history data

        $incrementIDall = history::select('song_id')->where('session_id', $computerId)->orderBy('id', 'desc')->take(8)->get();

        //retrieving data based on history data
        $incrementsDataAll = array();

        foreach ($incrementIDall as $increments) {
            $SelectingSongs = songsdatabase::where('song_id', $increments->song_id)->orderBy('id', 'desc')->take(1)->first();;
            //$upvoteAnnotation = $genius->getSongsResource()->get($increments->song_id);
            //$ar = json_decode(json_encode($upvoteAnnotation), true);
            //$arr = $ar['song'];

            ///$songartimageurl = $arr['song_art_image_url'];
            ///$title = $arr['title'];
            //$artistnames = $arr['artist_names'];

            //$addArrayIncrementsAll = array($songartimageurl, $title, $artistnames);

            //$addArrayIncrementsAll = array($songartimageurl, $title, $artistnames);
            $addArrayIncrementsAll = array($SelectingSongs->song_image_url, $SelectingSongs->song_title, $SelectingSongs->song_artist);

            array_push($incrementsDataAll, $addArrayIncrementsAll); 
        }




   // if (Auth::check()) {
        //retrieving favourite data
       // $incrementsData3 = " ";

       // $incrementIDall2 = favourite::select('song_id')->where('login_id', Auth::user()->id)->orderBy('id', 'desc')->take(8)->get();

        //retrieving data based on favouritelist data
       // $incrementsDataAll2 = array();

        //foreach ($incrementIDall2 as $increments2) {
           // $SelectingFavSongs = songsdatabase::where('song_id', $increments2->song_id)->orderBy('id', 'desc')->take(1)->first();;
            //$upvoteAnnotation = $genius->getSongsResource()->get($increments->song_id);
            //$ar = json_decode(json_encode($upvoteAnnotation), true);
            //$arr = $ar['song'];

            ///$songartimageurl = $arr['song_art_image_url'];
            ///$title = $arr['title'];
            //$artistnames = $arr['artist_names'];

            //$addArrayIncrementsAll = array($songartimageurl, $title, $artistnames);

            //$addArrayIncrementsAll = array($songartimageurl, $title, $artistnames);
           // $addArrayIncrementsAll2 = array($SelectingFavSongs->song_image_url, $SelectingFavSongs->song_title, $SelectingFavSongs->song_artist);

            //array_push($incrementsDataAll2, $addArrayIncrementsAll2); 
       //}
    //} else {
      //  $incrementsData3 = "none";
      //  $incrementsDataAll2 = "none";
    //}
if (Auth::check()) {
    $incrementsData3 = "show";
} else {
    $incrementsData3 = "none";
}
  $incrementsDataAll2 = "none";

        //checking in which array key is a youtube url

        if(isset($array31['0'])) {
            if(!sizeof($array31['0']) == 0 ) {
                $array32 = $array31['0'];
                $array33 = $array32['url'];
            }

        if (!str_contains($array33, 'www.youtube')) { 
            if(!sizeof($array31['1']) == 0 ) {
                $array32 = $array31['1'];
                $array33 = $array32['url'];
            }
        }

        if (!str_contains($array33, 'www.youtube')) { 
            if(!sizeof($array31['2']) == 0 ) {
                $array32 = $array31['2'];
                $array33 = $array32['url'];
            }
        }


        if (str_contains($array33, 'www.youtube')) { 
            $show = 1;
        } else {
            $show = 0;
        }

            //print_r($array33);
            // echo $q;

        } else {
            $show = 0;
        }

        if(!sizeof($array31) == 0 ) {
            //making youtube embed url
          
                //$rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                //echo('#' . $rand);


            $urlParts   = explode('/', $array33);
            $vidid      = explode( '&', str_replace('watch?v=', '', end($urlParts) ) );
                
            $finalUrl = 'https://www.youtube.com/embed/' . $vidid[0];

        } else {
            $finalUrl = 0;
        }


        //returning view with all above retrieved data

        return view('welcome')->with('songartimageurl', $array4['song_art_image_url'])
        ->with('artistnames', $array4['artist_names'])->with('headerimageurl', $array4['header_image_url'])
        ->with('title', $array4['title'])->with('show', $show)->with('finalUrl', $finalUrl)
        ->with('show', $show)->with('array4', $incrementsDataAll)->with('array5', $incrementsDataAll2)
        ->with('array6', $incrementsData3)->with('favouriteLists', $retrievingFavouriteList)->with('id', $array4['id'])->with('find', $retrievingFavouritesinList)->with('favorietenlijst', $incrementsDataAll5);
    }
}
