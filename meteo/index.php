<?php
$new_tweet = 'muito bpm #bom #mau #leâo sasas ';
$new_tweet = preg_replace('/#(\\w+)/','<a href=./$1>$0</a>',$new_tweet);
$n = preg_replace('/#(\\w+)/','<a href=./$1>$0</a>',$new_tweet) ;

$text= ' muito bom #leão #mama asas';

 /// clean string ///
function clean($string) {
    //$string = str_replace(' ','',$string); 
    $string = strtr(utf8_decode($string), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    $string = strtolower($string); // Convert to lowercase
    return $string;
  }

///procura hastags////
function gethashtags($text){
  //Match the hashtags
   preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ]+)/i', $text, $matchedHashtags);
  $hashtag = '';
  // For each hashtag, strip all characters but alpha numeric
  if(!empty($matchedHashtags[0])) {
    foreach($matchedHashtags[0] as $match) {
      $hashtag .= preg_replace("/[^a-z0-9_àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ]+/i", "", $match).',';
    }
  }
    //to remove last comma in a string
$tag= rtrim($hashtag, ',');
//return $tag;
return clean($tag);
}
$t = clean($text);
echo preg_replace('/#(\\w+)/','<a href=./$1>$0</a>',$t) ;
echo  gethashtags($text);
?>