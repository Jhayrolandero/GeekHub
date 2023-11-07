<?php

include "../../config/Database.php";
class Friend extends Database{

    // Get the user
    public function get_Users($userID){
        try{
            $sql = "SELECT users.username, users.email, users.user_id 
                    FROM users 
                    WHERE users.user_id NOT IN ( 
                        SELECT friendships.friend_id FROM friendships 
                        LEFT JOIN users ON friendships.friend_id = users.user_id 
                        WHERE ( friendships.user_id = :user_id ) AND ( friendships.status = 'accepted' OR friendships.status = 'pending' )
                        UNION SELECT friendships.user_id 
                        FROM friendships 
                        LEFT JOIN users ON friendships.user_id = users.user_id 
                        WHERE ( friendships.friend_id = :user_id ) AND ( friendships.status = 'accepted' OR friendships.status = 'pending' ) ) 
                        AND users.user_id != :user_id";
                    

            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return $e;
        }
    
    }

    // Send friend request
    public function add_Friend($userID, $friendID){
        try {
            $sql = "INSERT INTO friendships (user_id, friend_id)
                    VALUES (?, ?)";
    
            $stmt = $this->connect()->prepare($sql); 
    
            $stmt->execute([$userID, $friendID]);
        } catch(PDOException $e) {
            return $e;
        }
    }

    // Get the ID of the pending friends
    public function get_PendingID($userID){
        try{
            $sql = "SELECT user_id
                    FROM friendships
                    WHERE status = 'pending' AND friend_id = ?";
    
            $stmt = $this->connect()->prepare($sql);
    
            $stmt->execute([$userID]);

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return $e;
        }
    }

    // get the info of the user
    public function show_Pending($userID){
        try{
            $sql = "SELECT users.*, friendships.friendship_id
                    FROM friendships
                    LEFT JOIN users ON friendships.user_id = users.user_id
                    WHERE friendships.status = 'pending' AND friendships.user_id = ?";
    
            $stmt = $this->connect()->prepare($sql);
            
            $stmt->execute([$userID]);

            return $stmt->fetch();
        } catch(PDOException $e) {
            return $e;
        }
    }

    // Accept the user
    public function accept_Friend($friendshipID){
        try {
            $sql = "UPDATE friendships
                    SET status = 'accepted'
                    WHERE friendship_id = ?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$friendshipID]);
        } catch(PDOException $e) {
            return $e;
        }
    }

     // Get the ID of the accepted friends
     public function get_AcceptedID($userID){
        try{
            $sql = "SELECT friendships.friend_id 
                    FROM friendships LEFT JOIN users ON friendships.friend_id = users.user_id 
                    WHERE friendships.user_id = :user_id AND friendships.status = 'accepted' 
                    UNION SELECT friendships.user_id 
                    FROM friendships LEFT JOIN users ON friendships.user_id = users.user_id 
                    WHERE friendships.friend_id = :user_id AND friendships.status = 'accepted'";
    
            $stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll();
        } catch(PDOException $e) {
            return $e;
        }
    }

    // get the info of the accepted user
    public function show_Accepted($userID){
        try{
            $sql = "SELECT * 
                    FROM users
                    WHERE user_id = ?";
    
            $stmt = $this->connect()->prepare($sql);
    
            $stmt->execute([$userID]);

            return $stmt->fetch();
        } catch(PDOException $e) {
            return $e;
        }
    }

}
