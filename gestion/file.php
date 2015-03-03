<?php
$upload_dir = "../uploads/";
$start = true;
for ($i = 1; $i < 150; $i++) {
        echo $i;
    if (isset($_FILES["file" . $i])) {
        if ($_FILES["file" . $i]["error"] > 0) {
            echo "Error: " . $_FILES["file" . $i]["error"] . "<br>";
        } else {
            move_uploaded_file($_FILES["file" . $i]["tmp_name"], $upload_dir . $_FILES["file" . $i]["name"]);
            echo "Uploaded File :" . $_FILES["file" . $i]["name"];
            echo "<pre>";
            print_r($_POST);
            print_r($_FILES);
        }
    }else{
        echo 'FIle :'.$_FILES["file" . $i]." not here";
        break;
    }
}
?>