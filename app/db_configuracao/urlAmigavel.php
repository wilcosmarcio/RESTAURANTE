<?php
    $url = (isset($_GET['url'])) ? $_GET['url']:'index';
    $url = array_filter(explode('/',$url));
    
    $url1   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $url[1]);
    $url2   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $url[2]);
    $url3   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $url[3]);
    $url4   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $url[4]);
    $url5   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $url[5]);
    $url6   = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $url[6]);
    $busca  = str_replace(array("#", "'", ";", "*", "=", "INSERT", "insert", "delete", "DELETE", "where", "WHERE", "update", "UPDATE"), '', $_POST['busca']);
?>