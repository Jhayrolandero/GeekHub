<?php
session_start();
include "../model/AuthModel.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
class Auth
{
    private $model;
    private static $mail;
    private static $OTP;
    public function __construct()
    {
        $this->model = new AuthModel();
        self::$mail  = new PHPMailer(true);
    }
    public function show_auth_page()
    {
        // Construct the URL of the login page
        $login_page_URL = "/socmed/app/view/authpage.php";
        // Return the URL as a JSON response
        echo json_encode(array("url" => $login_page_URL));
        exit();
    }

    public function show_register_page()
    {
        // Construct the URL of the register page
        $register_page_URL = "/socmed/app/view/registerpage.php";

        // Return the URL as a JSON response
        echo json_encode(array("url" => $register_page_URL));
        exit();
    }

    public function add_user($username, $email, $password)
    {
        $this->model->add_user($username, $email, $password);
    }

    public function check_email($email)
    {
        $result = $this->model->check_email($email);

        return $result;
    }

    public function validate_user($email, $password)
    {
        $user_credentials = $this->model->validate_user($email);

        $user_password = $user_credentials[0]["password"];
        $user_id = $user_credentials[0]["user_id"];


        $user_id = password_verify($password, $user_password) ? $user_id : false;
        return $user_id;
    }

    // Sending OTP for emial verification
    public static function sendOTP($email)
    {
        // Send random 4 digit number
        $OTP = rand(1000, 9999);

        try {

            // Server settings
            self::$mail->isSMTP();                                            // Send using SMTP
            self::$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            self::$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            self::$mail->Username   = 'xjaylandero@gmail.com';                     // SMTP username
            self::$mail->Password   = 'gabrblnyalrhmimv';                               // SMTP password
            self::$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            self::$mail->Port       = 465;

            // Recipients
            self::$mail->setFrom('xjaylandero@gmail.com', 'Mailer');
            self::$mail->addAddress($email, 'Joe User');     // Add a recipient

            // Content
            self::$mail->isHTML(true);                                  // Set email format to HTML
            self::$mail->Subject = 'Verify your account GeekHub';
            self::$mail->Body    = "Your OTP is <b>$OTP</b>, make sure to verify your account";

            self::$mail->send();

            return $OTP;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$e}";
        }
    }

    public static function validateOTP($userOTP)
    {
        return $userOTP === self::$OTP;
    }
}

$auth = new Auth();

// Redirect user if he/she click register instead
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "register") {
    $auth->show_register_page();
    die();
}

// Redirect user if he/she click login instead
if (empty($_SESSION["user"]) && $_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "login") {
    $auth->show_auth_page();
    die();
}

// Give OTP
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["request"]) && $_POST["request"] === "otp") {

    if ($auth->check_email($_POST["email"])) {
        echo "Email already Exist!";
        die();
    }

    $email = $_POST["email"];
    $otp = $auth::sendOTP($email);

    echo $otp;
}

// Adding user
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["request"]) && $_POST["request"] === "register") {

    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        echo "Fill up the empty field/s!";
        die();
    }

    // CHeck if email exixts
    if ($auth->check_email($_POST["email"])) {
        echo "Email already Exist!";
        die();
    }

    $OTP = (int) $_POST["otp"];
    $givenOTP = (int) $_POST["givenOTP"];

    if ($OTP != $givenOTP) {
        // echo "OTP: " . $OTP . "Given: " . $givenOTP;
        die("Given OTP doesn't match");
    }


    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $auth->add_user($username, $email, $password);
    // $auth::sendOTP($email);
}

// Loggin in user
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["request"]) && $_POST["request"] === "login") {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        echo json_encode(array("url" => "empty"));
        die();
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!$auth->check_email($email)) {
        echo json_encode(array("url" => "notFound"));
        die();
    }

    if ($user_id = $auth->validate_user($email, $password)) {
        $_SESSION["user"] = $user_id;
        $url = "../../index.php";
        echo json_encode(array("url" => $url));
        exit();
    } else {
        echo "Incorrect Password";
        die();
    }
}
