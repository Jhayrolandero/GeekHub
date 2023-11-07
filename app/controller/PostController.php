<?php
session_start();
include "../model/PostModel.php";
include "../view/home/postCard.php";

class PostController{

    private $model;
    public function __construct(){
        $this->model = new Post();
    }

    public function add_post($user_id, $content, $image){
        try{
            return $this->model->add_post($user_id, $content, $image);

        } catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function get_post(){
        try{
            return $this->model->get_post();
        }catch(PDOException $e){
            echo "Error retrieving" . $e;
        }
    }
    
     // Check if user already liked the post
     public function has_liked($post_id, $user_id){
        try{
            $hasLiked = false;

            if($this->model->has_liked($post_id, $user_id)){
                $hasLiked = true;
            }
    
            return $hasLiked;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function get_img($post_id) {
        try{
            return $this->model->get_img($post_id);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}

$post = new PostController();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["action"]) && $_POST["action"] === "addPost"){

        try {
            if(empty($_POST["content"])){
                echo 0;
                die();
            }

            $content = $_POST["content"];
            $image = (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) ? file_get_contents($_FILES['image']['tmp_name']) : null;
            $user_id = $_SESSION["user"];
            
            echo $image;

            $post->add_post($user_id, $content, $image);

            echo "Successfully Added!";
        } catch(Exception $e) {
            echo "". $e;
        }
       
    }
}

if($_SERVER["REQUEST_METHOD"] === "GET") {
    if( isset($_GET["action"]) && $_GET["action"] === "getPost" ) {
       // Assuming $post->get_post() retrieves data and returns an associative array
       $result = $post->get_post();

       foreach ($result as $items) {

        $name = $items["username"];
        $content = $items["content"];
        $date = $items["created_at"];
        $post_id = $items["post_id"];
        $user_id = $_SESSION["user"];
        $like_count = $items["like_count"];
        $post_image = $items["post_image"];
        $hasLiked = $post->has_liked($post_id, $user_id);

        echo template_post($name, $content, $date, $post_id, $like_count, $hasLiked, $post_image);
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $img = $post->get_img($id);
        echo $img["post_image"];
    }

}
}