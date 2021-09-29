<?php

use Illuminate\Support\Str;
define("LISTPAGE", "liste");
define("CREATEFORMPAGE", "create");
define("EDITFORMPAGE", "edit");
define("RESETPAGE", "reset");
define("DEFAULTPASSOWRD", "password");
function setMenuClass($route, $classe){
    $routeActuel = request()->route()->getName();

    if(contains($routeActuel, $route) ){
        return $classe;
    }
    return "";
}
function setMenuActive($route){
    $routeActuel = request()->route()->getName();

    if($routeActuel === $route ){
        return "active";
    }
    return "";
}

function contains($container, $contenu){
    return Str::contains($container, $contenu);
}