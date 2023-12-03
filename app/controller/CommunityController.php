<?php

include "../model/CommunityModel.php";
include "../view/community/communityNav.php";
include "../view/community/communityCard.php";
include "../view/community/communityPostCard.php";
include "../view/community/communityCommentBox.php";
include "../view/discover/discoverCard.php";
include "../view/community/topMembersCard.php";

// session_start();
class CommunityController
{
    private $model;

    public function __construct()
    {
        $this->model = new Community();
    }

    // Creating COmmunity
    public function createAndJoinCommunity($groupName, $description, $user_id, $role)
    {
        return $this->model->createAndJoinCommunity($groupName, $description, $user_id, $role);
    }

    // Checking for ownership

    public function is_community_owner($user_id, $group_id)
    {
        return $this->model->is_community_owner($user_id, $group_id);
    }

    // Get top members
    public function get_top_members($groupID)
    {
        return $this->model->get_top_members($groupID);
    }

    // Get community info
    public function get_community($communityID = null, $userID = null, $random = false, $limit = null)
    {
        return $this->model->get_community($communityID, $userID, $random, $limit);
    }

    // Community template
    public function community_nav($communityName, $communityID, $groupPic)
    {
        return template_community_nav($communityName, $communityID, $groupPic);
    }

    // Render it
    public function show_community($communityName, $desc, $hasJoined,  $createdAt, $groupID, $groupPic, $groupBG, $isOwner)
    {
        return template_community($communityName, $desc, $hasJoined,  $createdAt, $groupID, $groupPic, $groupBG, $isOwner);
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

    // Update Community
    public function edit_community($groupID, $groupName, $communityProfile, $communityBG, $communityDesc)
    {
        return $this->model->edit_community($groupID, $groupName, $communityProfile, $communityBG, $communityDesc);
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
    public function community_post_card($groupName, $author, $content, $date, $image, $groupPostID, $authorID, $hasLiked, $groupID, $likeCount, $commentCounts, $profileImg, $isOwner = 0)
    {
        return template_community_post_card($groupName, $author, $content, $date, $image, $groupPostID, $authorID, $hasLiked, $groupID, $likeCount, $commentCounts, $profileImg, $isOwner);
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

    // Delete Comment
    public function delete_comment($commentID)
    {
        return $this->model->delete_comment($commentID);
    }

    // Template for comment box
    public function template_commentBox($username, $time, $content, $userID, $comment_id, $groupPostID, $profileImg)
    {
        return template_commentBox($username, $time, $content, $userID, $comment_id, $groupPostID, $profileImg);
    }

    // Showing comment
    public function show_comment($groupPostID)
    {
        return $this->model->show_comment($groupPostID);
    }

    // Delete post
    public function delete_post($groupPostID)
    {
        return $this->model->delete_post($groupPostID);
    }

    // Update Post

    public function edit_post($groupPostID, $content)
    {
        return $this->model->edit_post($groupPostID, $content);
    }

    // Discover card template
    public function show_discover_community($groupName, $desc, $hasJoined, $createdAt, $groupID, $groupPic, $groupBG, $isOwner)
    {
        return template_discover($groupName, $desc, $hasJoined, $createdAt, $groupID, $groupPic, $groupBG, $isOwner);
    }

    // Show top Members
    public function show_top_members($username, $userID, $profilePic, $postCount)
    {
        return template_top_members($username, $userID, $profilePic, $postCount);
    }

    // Delete Community 
    public function delete_community($userID, $groupID)
    {
        return $this->model->delete_community($userID, $groupID);
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

    // File validation
    public static function file_validation($file)
    {
        // Check if the file input is set and not empty
        if (isset($file["name"]) && !empty($file["name"])) {

            // Get file information
            $fileName = basename($file["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Check if the file is an image
            $isImage = getimagesize($file["tmp_name"]);

            if ($isImage === false) {
                return -1;
            }

            if ($file["size"] > 5000000) {
                return 0;
            }

            return 1;
        }
    }
}

$community = new CommunityController();

/*
==============
POST REQUEST
==============
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // API for creating community
    if (isset($_POST["action"]) && $_POST["action"] === "createCommunity") {
        try {

            $groupName = $_POST["groupName"];
            $groupDesc = $_POST["groupDesc"];
            $userID = $_SESSION["user"];

            echo $community->createAndJoinCommunity($groupName, $groupDesc, $userID, "owner");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Deleting Community
    if (isset($_POST["action"]) && $_POST["action"] === "deleteCommunity") {
        try {

            $userID = $_POST["userID"];
            $groupID = $_POST["groupID"];

            $result = $community->delete_community($userID, $groupID);

            if ($result == -1) {
                echo "You aren't the owner!";
            } else {
                echo "Community Deleted";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }



    // For Updating Community
    if (isset($_POST["action"]) && $_POST["action"] === "updateCommunity") {
        try {

            $communityID = $_POST["communityID"];
            $communityName = $_POST["communityName"];
            // $image = (isset($_FILES["communityPic"]) && $_FILES["communityPic"]["error"] === 0) ? file_get_contents($_FILES['communityPic']['tmp_name']) : null;
            // $imageBG = (isset($_FILES["communityBG"]) && $_FILES["communityBG"]["error"] === 0) ? file_get_contents($_FILES['communityBG']['tmp_name']) : null;
            $communityDesc = $_POST["communityDesc"];

            $image = (isset($_FILES["communityPic"]) && $_FILES["communityPic"]["error"] === 0) ? $_FILES["communityPic"] : null;

            if ($image) {
                $result = $community::file_validation($image);

                if ($result == -1) {

                    die("Image is only allowed");
                } else if ($result == 0) {

                    die("Size is too large!");
                } else if ($result == 1) {

                    $image = file_get_contents($_FILES['communityPic']['tmp_name']);
                }
            }
            // $imageBG = (isset($_FILES["profileBG"]) && $_FILES["profileBG"]["error"] === 0) ? file_get_contents($_FILES['profileBG']['tmp_name']) : null;
            // Same with BG
            $imageBG = (isset($_FILES["communityBG"]) && $_FILES["communityBG"]["error"] === 0) ? $_FILES["communityBG"] : null;

            if ($imageBG) {
                $result = $community::file_validation($imageBG);

                if ($result == -1) {

                    die("Image is only allowed");
                } else if ($result == 0) {

                    die("Size is too large!");
                } else if ($result == 1) {

                    $imageBG = file_get_contents($_FILES['communityBG']['tmp_name']);
                }
            }

            echo $community->edit_community($communityID, $communityName, $image, $imageBG, $communityDesc);
            // echo $user->edit_profile($userID, $username, $image, $imageBG);
        } catch (Exception $e) {
            echo $e;
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

            $status =  $community->leave_community($userID, $groupID);

            if ($status == -1) {
                echo "You cannot leave the community!";
            }
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
            // $image = (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) ? file_get_contents($_FILES['image']['tmp_name']) : null;

            $image = (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) ? $_FILES["image"] : null;

            if ($image) {
                $result = $community::file_validation($image);

                if ($result == -1) {

                    die("Image is only allowed");
                } else if ($result == 0) {

                    die("Size is too large!");
                } else if ($result == 1) {

                    $image = file_get_contents($_FILES['image']['tmp_name']);
                }
            }

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

    // Delete a Comment
    if (isset($_POST["action"]) && $_POST["action"] === "deleteCommentCommunity") {
        try {
            $commentID = $_POST["commentID"];

            echo $community->delete_comment($commentID);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // API for deleting
    if (isset($_POST["action"]) && $_POST["action"] === "deleteCommunityPost") {
        try {
            $groupPostID = $_POST["groupPostID"];
            echo $community->delete_post($groupPostID);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    // API for Updating
    if (isset($_POST["action"]) && $_POST["action"] === "updateCommunityPost") {
        try {
            $groupPostID = $_POST["groupPostID"];
            $content = $_POST["content"];

            echo $community->edit_post($groupPostID, $content);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}

/*
==============
GET REQUEST
==============
*/
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // API for show nav in home
    if (isset($_GET["action"]) && $_GET["action"] === "showCommunityNav") {
        try {
            $results = $community->get_community(null, null, null, 5);

            foreach ($results as $result) {

                $groupName = $result["group_name"];
                $groupID = $result["group_id"];
                $groupPic = $result["community_profile"];

                echo $community->community_nav($groupName, $groupID, $groupPic);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // API for show nav recommendations
    if (isset($_GET["action"]) && $_GET["action"] === "showRecommendCommunityNav") {
        try {
            $results = $community->get_community(null, null, true, 5);

            foreach ($results as $result) {

                $groupName = $result["group_name"];
                $groupID = $result["group_id"];
                $groupPic = $result["community_profile"];

                echo $community->community_nav($groupName, $groupID, $groupPic);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // API for showing community in profile 
    if (isset($_GET["action"]) && $_GET["action"] === "showProfileCommunityNav") {
        try {

            $userID = $_GET["userID"];
            $results = $community->get_community(null, $userID);

            foreach ($results as $result) {

                $groupName = $result["group_name"];
                $groupID = $result["group_id"];
                $groupPic = $result["community_profile"];

                echo $community->community_nav($groupName, $groupID, $groupPic);
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
            $isOwner = $community->is_community_owner($userID, $communityID);

            foreach ($results as $result) {

                $groupName = $result["group_name"];
                $groupDesc = $result["description"];
                $createdAt = $result["created_at"];
                $groupPic = $result["community_profile"];
                $groupBG = $result["community_background"];

                $date = $community::month_day($createdAt);

                $groupID = $result["group_id"];

                echo $community->show_community($groupName, $groupDesc, $hasJoined, $date, $groupID, $groupPic, $groupBG, $isOwner);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // For rendering discover cards
    if (isset($_GET["action"]) && $_GET["action"] === "showDiscoverCard") {
        try {

            $userID = $_SESSION["user"];
            $results = $community->get_community(null, null, true);


            foreach ($results as $result) {

                $groupName = $result["group_name"];
                $groupDesc = $result["description"];
                $createdAt = $result["created_at"];
                $groupPic = $result["community_profile"];
                $groupBG = $result["community_background"];

                $date = $community::month_day($createdAt);

                $groupID = $result["group_id"];
                $hasJoined = $community->validate_user_community($groupID, $userID);
                $isOwner = $community->is_community_owner($userID, $groupID);

                echo $community->show_discover_community($groupName, $groupDesc, $hasJoined, $date, $groupID, $groupPic, $groupBG, $isOwner);
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
                $isOwner = 0;
                if (!empty($_GET["groupID"])) {
                    $isOwner = $community->is_community_owner($authorID, $groupID);
                }

                echo $community->community_post_card($groupName, $author, $content, $timestamp, $image, $groupPostID, $authorID, $hasLiked, $groupID, $likeCounts, $commentCounts, $profileImg, $isOwner);
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

                $username = $result["username"];
                $content = $result["content"];
                $userID = $result["user_id"];
                $commentID = $result["comment_id"];
                $groupPostID = $result["group_post_id"];
                $profileImg = $result["user_profile"];

                echo $community->template_commentBox($username, $date, $content, $userID, $commentID, $groupPostID, $profileImg);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Get community stat
    if (isset($_GET["action"]) && $_GET["action"] === "getCommunityStat") {
        try {
            $groupID = $_GET["groupID"];
            $result = $community->get_community($groupID);

            $memberCount = $result[0]["member_count"];
            $likeCount = $result[0]["like_count"];
            $postCount = $result[0]["post_count"];

            $stat = array(
                "member_count" => $memberCount,
                "like_count" => $likeCount,
                "post_count" => $postCount
            );

            $statJSON = json_encode($stat);

            // Set the Content-Type header to application/json
            header('Content-Type: application/json');

            // Send the JSON response
            echo $statJSON;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // Get community stat
    if (isset($_GET["action"]) && $_GET["action"] === "getTopMembers") {
        try {
            $groupID = $_GET["groupID"];

            $results = $community->get_top_members($groupID);

            // var_dump($results);
            foreach ($results as $result) {
                $username = $result["username"];
                $profileImg = $result["user_profile"];
                $userID = $result["user_id"];
                $postCount = $result["post_count"];

                echo $community->show_top_members($username, $userID, $profileImg, $postCount);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
