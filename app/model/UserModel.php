<?php

include("../../config/Database.php");
class User extends Database
{

    // Get user's info
    public function get_user($user_id = null)
    {
        try {
            $sql = "SELECT users.* ";

            if ($user_id != null) {
                $sql = "SELECT users.*, 
                (
                    SELECT 
                    COUNT(friendships.friendship_id)
                    FROM friendships
                    WHERE (friendships.user_id = :user_id OR friendships.friend_id = :user_id)
                    AND friendships.status = 'accepted'
                ) AS buddy_count,
                (
                    SELECT
                    COUNT(posts.post_id)
                    FROM posts
                    WHERE posts.user_id = :user_id
                ) AS post_count,
                (
                    SELECT
                    COUNT(likes.like_id)
                    FROM likes
                    WHERE likes.post_id IN(
                    SELECT posts.post_id
                    FROM posts
                    WHERE posts.user_id = :user_id
                )
                ) AS like_count";
            }

            $sql .= " FROM users";

            if ($user_id != null) {
                $sql .= " WHERE users.user_id = :user_id";
            }

            $stmt = $this->connect()->prepare($sql);

            if ($user_id != null) {
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            }

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }



    // Set BIO
    public function add_bio($userID, $userBio)
    {
        try {
            $sql = "UPDATE users
            SET user_bio = ?
            WHERE user_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$userBio, $userID]);

            return "Successfully Added";
        } catch (PDOException $e) {
            return $e;
        }
    }

    // For search bar functionality
    public function search_user($username)
    {
        try {
            $sql = "SELECT username, user_id 
            FROM users 
            WHERE username LIKE ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Update a Post
    public function edit_profile($userID, $username, $profileImg, $profileBG)
    {
        try {
            $sql = "UPDATE users 
                    SET username = ?";

            if ($profileImg != null) {
                $sql .= ", user_profile = ?";
            }

            if ($profileBG != null) {
                $sql .= ", profile_background = ?";
            }

            $sql .= " WHERE user_id = ?";

            $stmt = $this->connect()->prepare($sql);

            if ($profileImg != null && $profileBG != null) {
                $stmt->execute([$username, $profileImg, $profileBG, $userID]);
            } else if ($profileImg != null) {
                $stmt->execute([$username, $profileImg, $userID]);
            } else if ($profileBG != null) {
                $stmt->execute([$username, $profileBG, $userID]);
            } else {
                $stmt->execute([$username, $userID]);
            }

            return "Profile Update Successfully!";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
