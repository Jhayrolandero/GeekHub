<?php

include "../../config/Database.php";

class Like extends Database
{

    public function add_like($post_id, $user_id)
    {
        try {
            $sql = "INSERT INTO likes (post_id, user_id)
                    VALUES (?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$post_id, $user_id]);

            return "Post Liked!";
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function delete_like($post_id, $user_id)
    {
        try {
            $sql = "DELETE FROM likes
                    WHERE post_id = ? AND user_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$post_id, $user_id]);

            return "Post Unliked!";
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function get_likes($post_id)
    {
        try {
            $sql = "SELECT COUNT(like_id) AS like_count
                FROM likes
                WHERE likes.post_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$post_id]);

            $result = $stmt->fetch();

            return $result;
        } catch (PDOException $e) {
            return $e;
        }
    }
}
