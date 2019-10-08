<?php
   
    require_once("includes/header.php"); 
    require_once("includes/init.php"); 
    $photos = Photo::find_all();
?>

    <body id="galery">

        <?php require_once("includes/navigation.php") ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="thumbnails row">
                        <?php
                            foreach ($photos as $photo) {
                        ?>
                            <div class="col-xs-6 col-md-4">
                                <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                                    <img src="admin/<?php echo $photo->picture_path()?>" alt="">
                                </a>
                            </div>
                        <?php        
                            }
                        ?>
                    </div>
                </div>
            </div>

        <?php require_once("includes/footer.php"); ?>
    </body>
</html>
    