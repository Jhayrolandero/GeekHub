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
        $sql = "SELECT users.username, posts.content
                FROM users 
                INNER JOIN posts on users.user_id = posts.user_id"; 

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

}