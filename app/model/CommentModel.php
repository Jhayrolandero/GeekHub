<?php
include "../../config/Database.php";

class Comment extends Database
{

    // Add comment
    public function add_Comment($user_id, $post_id, $comment)
    {
        try {
            $sql = "INSERT INTO comments (user_id, post_id, comment)
                    VALUES (?, ?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $post_id, $comment]);

            return "You commented!";
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Render Comment
    public function show_comment($postID)
    {
        try {
            $sql = "SELECT comments.comment, comments.created_at, comments.comment_id, comments.post_id, users.username, users.user_id
                    FROM comments
                    LEFT JOIN users ON comments.user_id = users.user_id
                    WHERE comments.post_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$postID]);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Delete a comment
    public function delete_comment($commentID)
    {
        try {
            $sql = "DELETE FROM comments
                    WHERE comment_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$commentID]);
        } catch (PDOException $e) {
            return $e;
        }
    }
}
