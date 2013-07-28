<?php
include("lib/class.MyYoutube.php");

// grap Video by it id
$youtube = new MyYoutube;
$youtube->video("Urdlvw0SSEc");

//Object->method()
echo $youtube->getTitle();
echo '<br />';
echo $youtube->getThumbnail();

//and so on 
