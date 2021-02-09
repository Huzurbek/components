<?php
class Connection{
    //Here we make function which make connect with Database:
    public static function makeConnect(){
        return new PDO("mysql:host=localhost; dbname=app3","root","root");
    }
}