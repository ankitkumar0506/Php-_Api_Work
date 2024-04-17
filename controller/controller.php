<?php
//   echo "con page";
require_once('model/model.php');
// $_SERVER('PATH_INFO');
class controller extends model
{
    public function __construct()
    {
        parent::__construct();
        if (isset($_SERVER['PATH_INFO'])) {
            switch ($_SERVER['PATH_INFO']) {
                case "/home":

                    require_once('view/home.php');
                    break;

                case "/register":
                    // print_r($_REQUEST);
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $FormDataObject = json_decode(file_get_contents('php://input'));
                        $FormDataObject = array(
                            "name" => $_POST['name'],
                            // "name" => $FormDataObject->name,
                            "email" => $_POST['email'],
                            // "email" => $FormDataObject->email,
                            "password" => $_POST['password'],
                            // "password" => $FormDataObject->password,
                        );
                        $Response = $this->insert("users", $FormDataObject);
                        // echo json_encode($Response);    
                    } else {
                    }
                    require_once('view/register.php');
                    break;

                case "/login":
                    $data = json_decode(file_get_contents('php://input'));
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $this->login($email, $password);
                        echo json_encode($data);
                        header('location:home');
                    } else {
                    }
                    require_once('view/login.php');
                    break;

                case "/upload":


                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        // print_r($_REQUEST);
                        // print_r($_FILES);

                        $location = "C:/xampp/htdocs/Laravel/Laravel-assg-assessment/Assignments/Webservices/images/" . basename($_FILES["images"]["name"]);
                        // print_r($location);
                        // 
                        move_uploaded_file($_FILES["images"]["tmp_name"], $location);
                        $ImageName = $_FILES["images"]["name"];
                        // print_r($ImageName);

                        $data = array(
                            "name" => $_POST['name'],
                            "images" => $ImageName,
                        );
                        print_r($data);
                        $Response = $this->insert("images", $data);
                        header('location:home');
                        // echo json_encode($Response);
                    } else {
                        // Handle error case 
                    }
                    require_once('view/upload.php');
                    break;

                case "/gallery":

                    $Response = $this->select('images');
                    require_once('view/gallery.php');
                    break;

                default:
                    # code...
                    break;
            }
        } else {
            header('location:home');
        }
    }
}

$objj = new controller;
