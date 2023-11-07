<?php
include "../../config/Database.php";

// // get the ID of the image from the URL
// $id = $_GET['id'];
// // connect to the database
// $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'username', 'password');
// // retrieve the image data from the database
// $stmt = $pdo->prepare("SELECT name, type, data FROM images WHERE id=?");
// $stmt->bindParam(1, $id);
// $stmt->execute();
// // set the content type header
// header("Content-Type: image/jpeg");
// // output the image data
// $row = $stmt->fetch(PDO::FETCH_ASSOC);
// echo $row['data'];

 class image extends Database{

    public function add_img($name, $data){
        try{
            $sql = "INSERT INTO images (name, data) 
            VALUES (?, ?)";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $data]);    

            return "Successful added image";
        } catch(Exception $e){
            return $e->getMessage();
        }  
    }

    public function get_img($id){
        $sql = "SELECT data
                FROM images 
                WHERE id = ?";

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $img = $stmt->fetch();
        return $img;

    }
 }


$image = new image();
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
$name = $_FILES['image']['name'];
// $type = $_FILES['image']['type'];
$data = file_get_contents($_FILES['image']['tmp_name']);

echo $image->add_img($name, $data);
}


if($_SERVER["REQUEST_METHOD"] === "GET") {
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $img = $image->get_img($id);
        echo $img["data"];
    }
}
?>