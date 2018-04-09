<?php
if(isset($_POST['submit'])) {
    if (count($_FILES['file']['name']) > 0) {
        $countFiles = count($_FILES['file']['name']);
        for ($i = 0; $i < $countFiles; $i++) {
            //Get the temp file path
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
            $fileSize = $_FILES['file']['size'][$i];

            if ($fileSize < 100000) {
                $allowed = ['jpg', 'gif', 'png'];
                $shortname = $_FILES['file']['name'][$i];
                $fileExt = explode('.', $shortname);
                if (in_array(end($fileExt), $allowed)) {

                    //save the url and the file
                    $filePath = 'upload/' . uniqid('image', true) . '.' . end($fileExt);

                    //Upload the file into the temp dir
                    if (move_uploaded_file($tmpFilePath, $filePath)) {
                        header("Location: index.php?uploadSuccess");
                    }
                } else {
                    echo 'Les extensions autorisées sont "jpg", "png", "gif"';
                }
            } else {
                echo 'Le fichier ' . $_FILES['file']['name'][$i] . ' est trop gros !';
            }
        }
    }
}

