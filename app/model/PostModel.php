<?php

include "../../config/Database.php";
class Post extends Database{

   public function add_post($user_id, $content){
    $sql = "INSERT INTO posts (user_id, content)
            VALUES (?, ?)";

    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$user_id, $content]);
}


    public function get_post(){
        
    }

}