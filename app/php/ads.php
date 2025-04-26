<?php
    include('urls.php');
    include('app/helpers/ads/class.ads.php');
    
    $object_ads = new ads;
    
    if($url[1] == "clique"){
        $object_ads->clique();
    }
?>















