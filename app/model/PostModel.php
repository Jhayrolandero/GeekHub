<?php

include "../../config/Database.php";
class Post extends Database
{

    // Make a post
    public function add_post($user_id, $content, $post_image = null)
    {
        try {
            $sql = "INSERT INTO posts (user_id, content, post_image)
                    VALUES (?, ?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $content, $post_image]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Update a Post
    public function edit_post($postID, $content)
    {
        try {
            $sql = "UPDATE posts
                    SET content = ?
                    WHERE post_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$content, $postID]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Delete a post
    public function delete_post($postID)
    {
        try {
            $sql = "DELETE FROM posts
                    WHERE post_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$postID]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    // Get data for the template
    public function get_post($UserID = null)
    {
        // By default get all post for newsfeed
        $sql = "SELECT
        users.username,
        users.user_id,
        users.user_profile,
        posts.content,
        posts.created_at,
        posts.post_id,
        (
            SELECT COUNT(like_id)
            FROM likes
            WHERE likes.post_id = posts.post_id
        ) AS like_count,
        (
            SELECT COUNT(comment_id)
            FROM comments
            WHERE comments.post_id = posts.post_id
        ) AS comment_count,
        posts.post_image
        FROM
            users
        JOIN
            posts ON users.user_id = posts.user_id";

        // Add this query when ID is given
        if ($UserID != null) {
            $sql .= " WHERE posts.user_id = ?";
        }

        $sql .= " ORDER BY posts.created_at DESC";

        $stmt = $this->connect()->prepare($sql);

        if ($UserID != null) {
            $stmt->execute([$UserID]);
        } else {
            $stmt->execute();
        }

        $result = $stmt->fetchAll();

        return $result;
    }

    // Validation if the user already liked the post
    public function has_liked($post_id, $user_id)
    {
        try {
            $sql = "SELECT COUNT(*) FROM likes 
            WHERE post_id = ? AND user_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$post_id, $user_id]);

            $likeCount = $stmt->fetchColumn();

            return $likeCount;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Preview image
    public function get_img($id)
    {
        $sql = "SELECT post_image
                FROM posts 
                WHERE post_id = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $img = $stmt->fetch();

        return $img;
    }
}
