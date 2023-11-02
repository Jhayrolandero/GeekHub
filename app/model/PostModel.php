<?php

include "../../config/Database.php";
class Post extends Database{

   public function add_post($user_id, $content){
        $sql = "INSERT INTO posts (user_id, content)
                VALUES (?, ?)";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $content]);
    }

// Add some filtering
    public function get_post(){
        $sql = "SELECT users.username, posts.content, posts.created_at, posts.post_id, COUNT(likes.like_id) as like_count
                FROM users
                JOIN posts ON users.user_id = posts.user_id
                LEFT JOIN likes ON posts.post_id = likes.post_id
                GROUP BY posts.post_id"; 

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    public function has_liked($post_id, $user_id) {
        try{
            $sql = "SELECT COUNT(*) FROM likes 
            WHERE post_id = ? AND user_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$post_id, $user_id]);

            $likeCount = $stmt->fetchColumn();

            return $likeCount;
        } catch(PDOException $e){
            return $e->getMessage();
        }
    }

}