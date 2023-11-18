<?php

include "../model/CommunityModel.php";
include "../view/community/communityNav.php";
include "../view/community/communityCard.php";
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
    public function show_community($communityName, $desc, $hasJoined)
    {
        return template_community($communityName, $desc, $hasJoined);
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
    public function create_post($groupID, $userID, $content)
    {
        return $this->model->create_post($groupID, $userID, $content);
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
            $userID = $_POST["userID"];
            $groupID = $_POST["communityID"];
            $content = $_POST["content"];

            echo $community->create_post($groupID, $userID, $content);
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
                echo $community->show_community($groupName, $groupDesc, $hasJoined);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // API for validating is user is member
    // if (isset($_GET["action"]) && $_GET["action"] === "ifMember") {
    //     try {
    //         $groupID = $_GET["communityID"];
    //         $userID = $_GET["userID"];

    //         echo 
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }
}
