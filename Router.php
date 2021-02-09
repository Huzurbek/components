<?php
class Router{

    public static function path($requestIRL,$path){
        if(array_key_exists($requestIRL,$path)){
            include $path[$requestIRL]; exit;
        }
        var_dump(404);
    }
}