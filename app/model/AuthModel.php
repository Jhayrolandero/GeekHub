<?php
include "../../config/Database.php";

class AuthModel extends Database{
    public function add_user($username, $email, $password){

        try{
            $sql = "INSERT INTO users (username, email, password)
                    VALUES (?, ?, ?)";
    
            $stmt = $this->connect()->prepare($sql);    
            $stmt->execute([$username, $email, $password]);

            echo "Added Successfully!";
        }catch(PDOException $e){
            echo "Error adding user" . $e;
        }
    }

    public function check_email($email){
        try{
            $sql = "SELECT email 
                    FROM users
                    WHERE email = ?";
    
            $stmt = $this->connect()->prepare($sql);
    
            $stmt->execute([$email]);        
    
            $count_row = $stmt->rowCount();
    
            return $count_row;

        }catch(PDOException $_){
            echo "Error in registering user!";
            die();
        }
    }
    // Validate if user exist in the DB
    public function validate_user($email){
        try{
            $sql = "SELECT email, password, user_id
            FROM users
            WHERE email = ?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$email]);        

            $count_row = $stmt->rowCount();

            if($count_row > 0){ // User exist
                return $stmt->fetchAll();
            }

            else return false; // Not

        }catch(PDOException $e){
            echo "Error logging in " . $e;
            die();
        }
    }
}
?>
