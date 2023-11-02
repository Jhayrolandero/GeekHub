<?php
session_start();
include "../model/PostModel.php";
include "../view/postCard.php";

class PostController{

    private $model;
    public function __construct(){
        $this->model = new Post();
    }

    public function add_post($user_id, $content){
        
        try{
            $this->model->add_post($user_id, $content);
            echo "Added Successfully!";
        }catch(PDOException $e){
            echo "Error posting" . $e;
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

}

$post = new PostController();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["action"]) && $_POST["action"] === "addPost"){

        if(empty($_POST["content"])){
            echo "No empty homie";
            die();
        }

        $content = $_POST["content"];
        $user_id = $_SESSION["user"];
        $post->add_post($user_id, $content);
        die();
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
        $hasLiked = $post->has_liked($post_id, $user_id);


        echo template_post($name, $content, $date, $post_id, $like_count, $hasLiked);
    }

   
}
}