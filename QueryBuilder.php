<?php
class QueryBuilder{
    private $pdo;
//Constructor:
    public function __construct($pdo)
    {
        $this->pdo=$pdo;
     //$this->pdo=new PDO("mysql:host=localhost; dbname=app3","root","root");
    }
//Get All Data from Database:
    public function getAll($table){
        $statement=$this->pdo->prepare("SELECT * FROM {$table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
//Get One Data from Database:
    public function getOne($table,$id){
        $statement=$this->pdo->prepare("SELECT * FROM {$table} WHERE id=:id");
        $statement->bindParam(':id',$id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
//Update:
    public function update($table,$data){
        $keys=array_keys($data);
        $string='';
        foreach ($keys as $key){
            $string.=$key.'=:'.$key.',';
        }
        $keys=rtrim($string,',');
        $sql="UPDATE {$table} SET {$keys} WHERE id=:id";
        $statement=$this->pdo->prepare($sql);
        return $statement->execute($data);
    }
//Store:
    public function create($table,$data){
        $keys=implode(',',array_keys($data));
        $tags=':'.implode(',:',array_keys($data));

        $sql="INSERT INTO {$table} ({$keys}) VALUES ({$tags})";
        $statement=$this->pdo->prepare($sql);
        return $statement->execute($data);
    }
//Delete:
    public function delete($table,$id){
        $sql="DELETE FROM {$table} WHERE id=:id";
        $statement=$this->pdo->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->execute();
    }

}