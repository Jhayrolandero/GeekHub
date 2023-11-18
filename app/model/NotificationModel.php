<?php

include "../../config/Database.php";

class Notification extends Database
{
    public function add_notification($user_id, $target_id, $message, $type, $post_id = null)
    {
        try {
            $sql = "INSERT INTO notifications (user_id, target_id, message, type, post_id)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $target_id, $message, $type, $post_id]);

            return "Notif Add";
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function get_notification($user_id)
    {
        try {
            $sql = "SELECT users.username, notifications.message, notifications.created_at
                    FROM notifications 
                    LEFT JOIN users ON users.user_id = notifications.user_id 
                    WHERE notifications.target_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id]);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function has_liked_notif($post_id, $user_id)
    {
        try {
            $sql = "SELECT COUNT(*) FROM notifications
            WHERE post_id = ? AND user_id = ? AND type = 'like'";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$post_id, $user_id]);

            $count = $stmt->fetchColumn();

            return $count;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
