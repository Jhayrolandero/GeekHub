<?php

include("../../config/Database.php");
class User extends Database
{

    // Get user's info
    public function get_user($user_id)
    {
        try {
            $sql = "SELECT * FROM users
                    WHERE user_id = ?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$user_id]);

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
}
