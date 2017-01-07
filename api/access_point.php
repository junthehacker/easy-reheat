<?php
//http://localhost/usb/microwave-time/api/?action=upload_image
    // error_reporting(E_ALL);

    // Helper function to generate a v4 UUID
    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    // Convert base64 string to image file
    function base64_to_image($base64_string, $output_file) {
        if(true){ //base64_get_extension($base64_string)
            $ifp = fopen($output_file, "wb");
            $data = explode(',', $base64_string);
            fwrite($ifp, base64_decode($data[1]));
            fclose($ifp);
            return true;
            } else {
            return false;
        }
    }

    include "include/app.php";

    $app = new App();

    $app->add("upload_image", function(){
        $targetDir = "images/";
        $targetFile = gen_uuid();
        if(base64_to_image($_POST["file"], $targetDir . $targetFile)){
            echo $targetDir . $targetFile;
        } else {
            echo "500";
        }
    });

    $app->add("score_image", function(){

    });

    $app->add("food_info", function(){

    });

    $app->route($_GET["action"]);
?>