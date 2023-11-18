<?php

include "../../config/Database.php";

class Community extends Database
{

    // For creating Community
    public function create_community($groupName, $description)
    {
        try {
            $sql = "INSERT INTO groups (group_name, description)
                    VALUES (?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$groupName, $description]);

            return "Successfully Created";
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Get Community

    public function get_community($communityID = null)
    {
        try {
            $sql = "SELECT * FROM groups";

            if ($communityID != null) {
                $sql .= " WHERE group_id = ?";
            }

            $stmt = $this->connect()->prepare($sql);

            if ($communityID != null) {
                $stmt->execute([$communityID]);
            } else {
                $stmt->execute();
            }

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Join community
    public function join_community($user_id, $community_id, $role)
    {
        try {
            $sql = "INSERT INTO user_group (user_id, group_id, role)
                    VALUES (?, ?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $community_id, $role]);

            return "Successfully Joined!";
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Leave Community
    public function leave_community($user_id, $community_id)
    {
        try {
            $sql = "DELETE FROM user_group 
                    WHERE user_id = ? AND group_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $community_id]);

            return "You left the Group";
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Validate if User already joined the community
    public function validate_user_community($group_id, $user_id)
    {
        try {
            $sql = "SELECT COUNT(*) FROM user_group 
                    WHERE group_id = ? AND user_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$group_id, $user_id]);

            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Create a Post for community
    public function create_post($groupID, $userID, $content)
    {
        try {
            $sql = "INSERT INTO group_posts (group_id, user_id, content)
                    VALUES (?, ?, ?)";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$groupID, $userID, $content]);

            return "Added Post";
        } catch (PDOException $e) {
            return $e;
        }
    }
}
