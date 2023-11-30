<?php

include "../../config/Database.php";

class Community extends Database
{

    // Create Community 
    public function createAndJoinCommunity($groupName, $description, $user_id, $role = 'owner')
    {
        try {
            $pdo = $this->connect();
            $pdo->beginTransaction();

            // Create Community
            $createCommunitySQL = "INSERT INTO groups (group_name, description) VALUES (?, ?)";
            $createCommunityStmt = $pdo->prepare($createCommunitySQL);
            $createCommunityStmt->execute([$groupName, $description]);

            // Get the last inserted ID of the created community
            $community_id = $pdo->lastInsertId();

            // Join Community
            $joinCommunitySQL = "INSERT INTO user_group (user_id, group_id, role) VALUES (?, ?, ?)";
            $joinCommunityStmt = $pdo->prepare($joinCommunitySQL);
            $joinCommunityStmt->execute([$user_id, $community_id, $role]);

            // commit
            $pdo->commit();

            return "Successfully Created and Joined!";
        } catch (PDOException $e) {
            // If an error occurs, rollback the transaction
            $pdo->rollBack();
            return $e;
        }
    }

    // Check if user is owner
    public function is_community_owner($user_id, $group_id)
    {
        try {
            $sql = "SELECT COUNT(*) as count
                FROM user_group
                WHERE group_id = ? AND user_id = ? AND role = 'owner'";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$group_id, $user_id]);

            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return $e->getMessage(); // Handle the exception as needed
        }
    }


    // For creating Community
    // public function create_community($groupName, $description)
    // {
    //     try {
    //         $sql = "INSERT INTO groups (group_name, description)
    //                 VALUES (?, ?)";

    //         $stmt = $this->connect()->prepare($sql);
    //         $stmt->execute([$groupName, $description]);

    //         // Get the last inserted ID
    //         $lastInsertId = $this->connect()->lastInsertId();

    //         return $lastInsertId;
    //     } catch (PDOException $e) {
    //         return $e;
    //     }
    // }

    // Get Community

    public function get_community($communityID = null, $userID = null)
    {
        try {

            $sql = "SELECT groups.* ";

            // For recommendation nav for community nav
            if ($communityID != null) {
                $sql = "SELECT groups.*, ";
            }

            if ($communityID != null) {
                $sql .= "(
                    SELECT COUNT(user_group.user_id)
                    FROM user_group
                    WHERE user_group.group_id = :group_id
                ) AS member_count,
                (
                    SELECT COUNT(group_posts.group_post_id)
                    FROM group_posts
                    WHERE group_posts.group_id = :group_id
                ) AS post_count,
                (
                    SELECT COUNT(group_post_likes.like_id)
                    FROM group_post_likes
                    WHERE group_post_likes.group_post_id IN (
                        SELECT group_posts.group_post_id
                        FROM group_posts
                        WHERE group_posts.group_id = :group_id
                    )
                ) AS like_count";
            }

            $sql .= " FROM groups";

            // For user community nav
            if ($userID != null) {
                $sql .= " JOIN user_group ON groups.group_id = user_group.group_id 
                        WHERE user_group.user_id = :user_id";
            }

            if ($communityID != null) {
                $sql .= " WHERE groups.group_id = :group_id";
            }

            $stmt = $this->connect()->prepare($sql);

            if ($communityID != null) {
                $stmt->bindParam(':group_id', $communityID, PDO::PARAM_INT);
            }

            if ($userID != null) {
                $stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
            }

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Join community
    public function join_community($user_id, $community_id, $role = "member")
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
    public function create_post($groupID, $userID, $content = null, $picture = null)
    {
        try {
            $sql = "INSERT INTO group_posts (group_id, user_id, content, picture)
                    VALUES (?, ?, ?, ?)";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$groupID, $userID, $content, $picture]);

            return "Added Post";
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Delete a post
    public function delete_post($groupPostID)
    {
        try {
            $sql = "DELETE FROM group_posts
                    WHERE group_post_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$groupPostID]);

            return "Post Deleted";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Update a Post
    public function edit_post($groupPostID, $content)
    {
        try {
            $sql = "UPDATE group_posts
                       SET content = ?
                       WHERE group_post_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$content, $groupPostID]);
            return "Post Updated!";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Get info of community post
    public function get_post($groupID = null)
    {
        try {
            $sql = "SELECT users.username, 
                    users.user_profile,
                    group_posts.content, 
                    group_posts.created_at, 
                    group_posts.group_post_id, 
                    group_posts.picture,
                    group_posts.user_id,
                    groups.group_name,
                    groups.group_id,    
                    (
                    SELECT COUNT(like_id)
                    FROM group_post_likes
                    WHERE group_post_likes.group_post_id = group_posts.group_post_id
                    ) AS like_count,
                    (
                    SELECT COUNT(comment_id)
                    FROM group_post_comments
                    WHERE group_post_comments.group_post_id = group_posts.group_post_id
                    ) AS comment_count
                    FROM users 
                    JOIN group_posts ON users.user_id = group_posts.user_id
                    JOIN groups ON groups.group_id = group_posts.group_id";

            if ($groupID != null) {
                $sql .= " WHERE groups.group_id = ?";
            }

            $sql .= " ORDER BY group_posts.created_at DESC";

            $stmt = $this->connect()->prepare($sql);

            if ($groupID != null) {
                $stmt->execute([$groupID]);
            } else {
                $stmt->execute();
            }

            $results = $stmt->fetchAll();

            return $results;
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Liking a Post
    public function like_post($groupPostID, $userID)
    {
        try {
            $sql = "INSERT INTO group_post_likes (group_post_id, user_id)
                    VALUES (?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$groupPostID, $userID]);

            return "Post Liked!";
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Unlike
    public function delete_like($groupPostID, $user_id)
    {
        try {
            $sql = "DELETE FROM group_post_likes
                    WHERE group_post_id = ? AND user_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$groupPostID, $user_id]);

            return "Post Unliked!";
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Validation if the user already liked the post
    public function has_liked($groupPostID, $user_id)
    {
        try {
            $sql = "SELECT COUNT(*) FROM group_post_likes 
               WHERE group_post_id = ? AND user_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$groupPostID, $user_id]);

            $likeCount = $stmt->fetchColumn();

            return $likeCount;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Add comment
    public function add_Comment($user_id, $groupPostID, $comment)
    {
        try {
            $sql = "INSERT INTO group_post_comments (user_id, group_post_id, content)
                    VALUES (?, ?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $groupPostID, $comment]);

            return "You commented!";
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function delete_comment($commentID)
    {
        try {
            $sql = "DELETE FROM group_post_comments
                    WHERE comment_id = ?";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$commentID]);

            return "Comment Deleted!";
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Get comment INFO
    public function show_comment($groupPostID)
    {
        try {
            $sql = "SELECT group_post_comments.content, group_post_comments.created_at, group_post_comments.comment_id, group_post_comments.group_post_id, users.username, users.user_id, users.user_profile
                    FROM group_post_comments
                    LEFT JOIN users ON group_post_comments.user_id = users.user_id
                    WHERE group_post_comments.group_post_id = ?
                    ORDER BY group_post_comments.created_at DESC";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$groupPostID]);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $e;
        }
    }

    // Update Community
    public function edit_community($groupID, $groupName, $communityProfile, $communityBG, $communityDesc)
    {
        try {
            $sql = "UPDATE groups
            SET group_name = ?";

            $params = [$groupName];

            if ($communityProfile !== null) {
                $sql .= ", community_profile = ?";
                $params[] = $communityProfile;
            }

            if ($communityBG !== null) {
                $sql .= ", community_background = ?";
                $params[] = $communityBG;
            }

            if ($communityDesc !== null) {
                $sql .= ", description = ?";
                $params[] = $communityDesc;
            }

            $sql .= " WHERE group_id = ?";
            $params[] = $groupID;

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute($params);

            return "Community Update Successfully!";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
