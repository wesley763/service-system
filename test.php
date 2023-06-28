<!DOCTYPE html>

<html>

<head>

    <title>Image Upload in PHP</title>

    <! link the css file to style the form >

    <link rel="stylesheet" type="text/css" href="style.css" />

</head>

<body>

    <div id="wrapper">

        <! specify the encoding type of the form using the 

                enctype attribute >

        <form method="POST" action="" enctype="multipart/form-data">        

            <input type="file" name="choosefile" value="" />

            <div>

                <button type="submit" name="uploadfile">

                UPLOAD

                </button>

            </div>

        </form>

    </div>

</body>

</html>

#wrapper{

width: 50%;

margin: 20px auto;

border: 2px solid #dad7d7;

}

form{

width: 50%;

margin: 20px auto;

}

form div{

margin-top: 5px;

}

img{

float: left;

margin: 5px;

width: 280px;

height: 120px;

}

#img_div{

width: 70%;

padding: 5px;

margin: 15px auto;

border: 1px solid #dad7d7;

}

#img_div:after{

content: "";

display: block;

clear: both;

}

<?php

error_reporting(0);

?>

<?php

$msg = ""; 

// check if the user has clicked the button "UPLOAD" 

if (isset($_POST['uploadfile'])) {

    $filename = $_FILES["choosefile"]["name"];

    $tempname = $_FILES["choosefile"]["tmp_name"];  

        $folder = "img/".$filename;   

      

        // Add the image to the "image" folder"

        if (move_uploaded_file($tempname, $folder)) {

            $msg = "Image uploaded successfully";

        }else{

            $msg = "Failed to upload image";

    }

}



?>