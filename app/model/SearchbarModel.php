<?php

include("../../config/Database.php");

class Search extends Database
{

    public function search_user($username)
    {
        try {

            $searchQuery = "%" . $username . "%";
            $sql = "SELECT username as name , user_id as ID, user_profile as profile
            FROM users 
            WHERE username LIKE ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$searchQuery]);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function search_community($communityName)
    {
        try {

            $searchQuery = "%" . $communityName . "%";

            $sql = "SELECT group_name as name, group_id as ID, community_profile as profile
            FROM groups 
            WHERE group_name LIKE ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$searchQuery]);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }
}
