<?php

include ("../../config/Database.php");
class User extends Database{

    public function get_user($user_id){
        try{
            $sql = "SELECT * FROM users
                    WHERE user_id = ?";
    
            $stmt = $this->connect()->prepare($sql);
    
            $stmt->execute([$user_id]);
    
            return $stmt->fetchAll();
        }catch(PDOException $e){
            return $e;
        }
    }

}