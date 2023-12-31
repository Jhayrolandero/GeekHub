<?php
session_start();
include "../model/PostModel.php";
include "../view/home/postCard.php";

class PostController
{

    private $model;
    public function __construct()
    {
        $this->model = new Post();
    }

    // Add post to DB

    public function add_post($user_id, $content, $image)
    {
        try {
            return $this->model->add_post($user_id, $content, $image);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //Fetch Post info
    public function get_post($profileID = null)
    {
        try {
            return $this->model->get_post($profileID);
        } catch (PDOException $e) {
            echo "Error retrieving" . $e;
        }
    }

    // Update post  
    public function edit_post($post_id, $content)
    {
        try {
            $this->model->edit_post($post_id, $content);
        } catch (PDOException $e) {
            echo "Error updating" . $e;
        }
    }

    // Delete Post
    public function delete_post($post_id)
    {
        try {
            $this->model->delete_post($post_id);
        } catch (PDOException $e) {
            throw new Exception($e);
        }
    }

    // Check if user already liked the post
    public function has_liked($post_id, $user_id)
    {
        try {
            $hasLiked = false;

            if ($this->model->has_liked($post_id, $user_id)) {
                $hasLiked = true;
            }

            return $hasLiked;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // Preview IMG
    public function get_img($post_id)
    {
        try {
            return $this->model->get_img($post_id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    // JUst to convert time into more readable format
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

    public static function get_random_suggestion($result)
    {
        // Algo for rendering Recommended div
        $min = 0;
        $max = count($result);

        // Between percent of post you want the recommend to appear
        $percentile = 75;

        $randomNumber = mt_rand($min * $percentile, $max * $percentile) / 100;
        // $recommendDivNumber = (int) $randomNumber;
        $recommendDivNumber = (int) $randomNumber;

        return $recommendDivNumber;
    }
}


$post = new PostController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Adding Post
    if (isset($_POST["action"]) && $_POST["action"] === "addPost") {

        try {

            if (empty($_POST["content"]) && empty($_FILES["image"])) {
                echo 0;
                die();
            }

            $content = $_POST["content"];

            // Validate the image first
            $image = (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) ? $_FILES["image"] : null;

            if ($image) {
                $result = $post::file_validation($image);

                if ($result == -1) {

                    die("Image is only allowed");
                } else if ($result == 0) {

                    die("Size is too large!");
                } else if ($result == 1) {

                    $image = file_get_contents($_FILES['image']['tmp_name']);
                }
            }

            $user_id = $_SESSION["user"];
            $post->add_post($user_id, $content, $image);

            echo "Successfully Added!";
        } catch (Exception $e) {
            echo "" . $e;
        }
    }

    // Update a post
    if (isset($_POST["action"]) && $_POST["action"] === "updatePost") {
        try {
            if (empty($_POST["content"])) {
                echo 0;
                die();
            }

            $content = $_POST["content"];
            $post_id = $_POST["postID"];

            // echo $image;

            $post->edit_post($post_id, $content);

            echo "Successfully updated!";
        } catch (Exception $e) {
            echo "" . $e;
        }
    }

    // Delete a post
    if (isset($_POST["action"]) && $_POST["action"] === "deletePost") {
        try {
            $post_id = $_POST["postID"];
            $post->delete_post($post_id);
            echo "Post deleted";
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    // Picture validation
    if (isset($_POST["action"]) && $_POST["action"] === "validate") {
        try {
            $image = (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) ? $_FILES["image"] : null;

            if ($image) {
                $result = $post::file_validation($image);

                if ($result == -1) {

                    die("Image is only allowed");
                } else if ($result == 0) {

                    die("Size is too large!");
                } else if ($result == 1) {
                    $image = file_get_contents($_FILES['image']['tmp_name']);
                }
            }

            echo $image;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // For showing Post
    if (isset($_GET["action"]) && $_GET["action"] === "getPost") {

        if (empty($_GET["profileID"])) {
            $result = $post->get_post();
        } else {
            $profileID = $_GET["profileID"];
            $result = $post->get_post($profileID);
        }

        // FOR SUGGESTION DIV
        if (empty($_SESSION["recommendDivNum"])) {
            $_SESSION["recommendDivNum"] = $post::get_random_suggestion($result);
            $recommendDivNumber = $_SESSION["recommendDivNum"];
        } else {
            $recommendDivNumber = $_SESSION["recommendDivNum"];
        }


        $count = 0;

        foreach ($result as $items) {
            $name = $items["username"];
            $content = $items["content"];
            $timestamp = $items["created_at"];
            $date = PostController::time_elapsed_string($timestamp);
            $post_id = $items["post_id"];
            $user_id = $_SESSION["user"];
            $like_count = $items["like_count"];
            $post_image = $items["post_image"];
            $hasLiked = $post->has_liked($post_id, $user_id);
            $commentCount = $items["comment_count"];
            $userPost = $items["user_id"];
            $profileImg = $items["user_profile"];

            echo template_post($name, $content, $date, $post_id, $like_count, $hasLiked, $post_image, $commentCount, $userPost, $profileImg);

            if ($count == $recommendDivNumber) {
                echo "<div class='recommend-div'>
                </div>";
            }

            $count++;
        }

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $img = $post->get_img($id);
            echo $img["post_image"];
        }
    }
}
