<?php

include "../../config/Database.php";

class Like extends Database {

    public function add_like($post_id, $user_id) {
        try{
            $sql = "INSERT INTO likes (post_id, user_id)
                    VALUES (?, ?)";
    
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$post_id, $user_id]);

            return "Post Liked!";
        } catch(PDOException $e){
            return $e;
        }
    }

    public function delete_like($post_id, $user_id) {
        try{
            $sql = "DELETE FROM likes
                    WHERE post_id = ? AND user_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$post_id, $user_id]);

            return "Post Unliked!";
        } catch(PDOException $e){
            return $e;
        }
    }


}