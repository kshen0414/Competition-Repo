<?php 
@include 'includes/config.php';
if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    // print_r($file);

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','pdf');

    if(in_array($fileActualExt,$allowed)){
        if ($fileError === 0){
            if($fileSize > 100000){
                // $fileNameNew = uniqid('',true).".".$fileActualExt;
                // $fileDestination = 'uploads/'.$fileNameNew;
                $fileDestination = 'uploads/'.$fileName;
                move_uploaded_file($fileTmpName,$fileDestination);
                header("Location: upload_success.php");

                // insert into database
                $sql = "INSERT INTO files (Title,File) VALUES('$fileName', '$fileActualExt' )" ;
                mysqli_query($conn,$sql);
            }
            else{
                echo "Your file is too big";
            }
        }else{
            echo "There was an error upload file";
        }

    }else{
        echo "You cannot upload files of this type!";
    }

}
?>

