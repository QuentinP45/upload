<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="row">
        <form method="POST" action="upload.php" enctype="multipart/form-data">
            <input type="file" name="file[]" multiple="multiple"/>
            <button type="submit" name="submit">Upload</button>
        </form>

        <?php

        $themeDir = __DIR__.'/upload';

        $iterator = new FilesystemIterator($themeDir);

        if (isset($_POST['Delete'])) {
            $fichier = 'upload/' . $_POST['vignette'];

            if( file_exists ( $fichier)) {
                unlink( $fichier );
            }
        }

        foreach($iterator as $file) {
            ?>
            <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                    <img src="<?= 'upload/' . $file->getfilename()?>" alt="Fichier" />
                    <p><?= $file->getfilename() ?></p>
                    <form method="post" action="index.php">
                    <input type="hidden" name="vignette" value="<?= $file->getfilename() ?>"/>
                    <button type="submit" name="Delete">Delete</button>
                    </form>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</body>
</html>