<?php

include "../model/CommunityModel.php";
include "../view/community/communityNav.php";
include "../view/community/communityCard.php";
include "../view/community/communityPostCard.php";
include "../view/community/communityCommentBox.php";
class CommunityController
{
    private $model;

    public function __construct()
    {
        $this->model = new Community();
    }

    // Create a community
    public function create_community($groupName, $description)
    {
        return $this->model->create_community($groupName, $description);
    }

    // Get community info
    public function get_community($communityID = null)
    {
        return $this->model->get_community($communityID);
    }

    // Community template
    public function community_nav($communityName, $communityID)
    {
        return template_community_nav($communityName, $communityID);
    }

    // Render it
    public function show_community($communityName, $desc, $hasJoined, $memberCount, $likeCount, $postContent, $createdAt)
    {
        return template_community($communityName, $desc, $hasJoined, $memberCount, $likeCount, $postContent, $createdAt);
    }

    // Join community
    public function join_community($user_id, $community_id, $role)
    {
        return $this->model->join_community($user_id, $community_id, $role);
    }

    // Validate if user a member of Community
    public function validate_user_community($group_id, $user_id)
    {
        return $this->model->validate_user_community($group_id, $user_id);
    }

    // Leave the group
    public function leave_community($user_id, $community_id)
    {
        return $this->model->leave_community($user_id, $community_id);
    }

    // Create Post
    public function create_post($groupID, $userID, $content, $image)
    {
        return $this->model->create_post($groupID, $userID, $content, $image);
    }

    // Get Post

    public function get_post($groupID = null)
    {
        return $this->model->get_post($groupID);
    }

    // Template for post card
    public function community_post_card($groupName, $author, $content, $date, $image, $groupPostID, $authorID, $hasLiked, $groupID, $likeCount, $commentCounts, $profileImg)
    {
        return template_community_post_card($groupName, $author, $content, $date, $image, $groupPostID, $authorID, $hasLiked, $groupID, $likeCount, $commentCounts, $profileImg);
    }

    // For Liking
    public function like_post($groupPostID, $userID)
    {
        return $this->model->like_post($groupPostID, $userID);
    }

    // Unlike
    public function unlike_post($groupPostID, $userID)
    {
        return $this->model->delete_like($groupPostID, $userID);
    }
    // Check if user already liked the post
    public function has_liked($groupPostID, $user_id)
    {
        try {
            $hasLiked = false;

            if ($this->model->has_liked($groupPostID, $user_id)) {
                $hasLiked = true;
            }

            return $hasLiked;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Add comment
    public function add_Comment($user_id, $groupPostID, $comment)
    {
        return $this->model->add_Comment($user_id, $groupPostID, $comment);
    }

    // Template for comment box
    public function template_commentBox($username, $time, $content, $userID, $comment_id, $groupPostID)
    {
        return template_commentBox($username, $time, $content, $userID, $comment_id, $groupPostID);
    }

    // Showing comment
    public function show_comment($groupPostID)
    {
        return $this->model->show_comment($groupPostID);
    }

    // Time formatter
    public static function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime("", new DateTimeZone('Asia/Manila'));
        $dateTime = new DateTime($datetime, new DateTimeZone('Asia/Manila'));
        $diff = $now->diff($dateTime);

        $diff_str = '';

        if ($diff->y > 0) {
            $diff_str .= $diff->y . ' year';
            if ($diff->y > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->m > 0) {
            $diff_str .= $diff->m . ' month';
            if ($diff->m > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->d > 0) {
            $diff_str .= $diff->d . ' day';
            if ($diff->d > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->h > 0) {
            $diff_str .= $diff->h . ' hour';
            if ($diff->h > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->i > 0) {
            $diff_str .= $diff->i . ' minute';
            if ($diff->i > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } elseif ($diff->s > 0) {
            $diff_str .= $diff->s . ' second';
            if ($diff->s > 1) {
                $diff_str .= 's';
            }
            $diff_str .= ' ago';
        } else {
            $diff_str = 'Just now';
        }

        return $diff_str;
    }

    // Covert into MOnth Dat
    public static function month_day($date)
    {
        // Create a DateTime object from the string
        $dateTime = new DateTime($date);

        // Format the DateTime object as "F j" (Month Day)
        $formattedDate = $dateTime->format("F j");

        // Output the result
        return $formattedDate;
    }
}

$community = new CommunityController();

// API for creating community
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "createCommunity") {
        try {

            $groupName = $_POST["groupName"];
            $groupDesc = $_POST["groupDesc"];

            echo $community->create_community($groupName, $groupDesc);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // API for joining community
    if (isset($_POST["action"]) && $_POST["action"] === "joinCommunity") {
        try {
            $userID = $_POST["userID"];
            $groupID = $_POST["groupID"];
            $role = $_POST["role"];

            echo $community->join_community($userID, $groupID, $role);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // API for leaving community
    if (isset($_POST["action"]) && $_POST["action"] === "leaveCommunity") {
        try {
            $userID = $_POST["userID"];
            $groupID = $_POST["groupID"];

            echo $community->leave_community($userID, $groupID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // API for creating Post
    if (isset($_POST["action"]) && $_POST["action"] === "createPostCommunity") {
        try {

            if (empty($_POST["content"]) && empty($_FILES["image"])) {
                echo 0;
                die();
            }

            $userID = $_POST["userID"];
            $groupID = $_POST["communityID"];
            $content = (isset($_POST["content"])) ? $_POST["content"] : null;
            $image = (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) ? file_get_contents($_FILES['image']['tmp_name']) : null;



            echo $community->create_post($groupID, $userID, $content, $image);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // API for liking
    if (isset($_POST["action"]) && $_POST["action"] === "likeCommmunityPost") {
        try {

            $groupPostID = $_POST["groupPostID"];
            $userID = $_POST["userID"];

            echo $community->like_post($groupPostID, $userID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // API unliking
    if (isset($_POST["action"]) && $_POST["action"] === "unlikeCommmunityPost") {
        try {

            $groupPostID = $_POST["groupPostID"];
            $userID = $_POST["userID"];

            echo $community->unlike_post($groupPostID, $userID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Api for Commenting
    if (isset($_POST["action"]) && $_POST["action"] === "addCommentCommmunityPost") {
        try {

            $groupPostID = $_POST["groupPostID"];
            $userID = $_POST["userID"];
            $comment = $_POST["comment"];

            echo $community->add_Comment($userID, $groupPostID, $comment);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // API for show nav
    if (isset($_GET["action"]) && $_GET["action"] === "showCommunityNav") {
        try {
            $results = $community->get_community();

            foreach ($results as $result) {

                $groupName = $result["group_name"];
                $groupID = $result["group_id"];
                echo $community->community_nav($groupName, $groupID);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // For rendering community page
    if (isset($_GET["action"]) && $_GET["action"] === "showCommunity") {
        try {

            $communityID = $_GET["communityID"];
            $userID = $_SESSION["user"];

            $results = $community->get_community($communityID);

            $hasJoined = $community->validate_user_community($communityID, $userID);

            foreach ($results as $result) {

                $groupName = $result["group_name"];
                $groupDesc = $result["description"];
                $memberCount = $result["member_count"];
                $likeCount = $result["like_count"];
                $postCount = $result["post_count"];
                $createdAt = $result["created_at"];

                $date = $community::month_day($createdAt);

                echo $community->show_community($groupName, $groupDesc, $hasJoined, $memberCount, $likeCount, $postCount, $date);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Api for showing community post
    if (isset($_GET["action"]) && $_GET["action"] === "getCommunityPost") {
        try {

            if (empty($_GET["groupID"])) {
                $results = $community->get_post();
            } else {
                $groupID = $_GET["groupID"];
                $results = $community->get_post($groupID);
            }

            foreach ($results as $result) {
                $groupName = $result["group_name"];
                $author = $result["username"];
                $content = $result["content"];
                $date = $result["created_at"];
                $timestamp = CommunityController::time_elapsed_string($date);
                $image = $result["picture"];
                $groupPostID = $result["group_post_id"];
                $authorID = $result["user_id"];
                $hasLiked = $community->has_liked($groupPostID, $_SESSION["user"]);
                $groupID = $result["group_id"];
                $likeCounts = $result["like_count"];
                $commentCounts = $result["comment_count"];
                $profileImg = $result["user_profile"];

                echo $community->community_post_card($groupName, $author, $content, $timestamp, $image, $groupPostID, $authorID, $hasLiked, $groupID, $likeCounts, $commentCounts, $profileImg);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Get comment info
    if (isset($_GET["action"]) && $_GET["action"] === "showCommunityComment") {
        try {
            $groupPostID = $_GET["groupPostID"];

            $results = $community->show_comment($groupPostID);

            foreach ($results as $result) {
                $timestamp = $result["created_at"];
                $date = CommunityController::time_elapsed_string($timestamp);

                echo $community->template_commentBox($result["username"], $date, $result["content"], $result["user_id"], $result["comment_id"], $result["group_post_id"]);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
