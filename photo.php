
<?php 
require_once("includes/header.php");
require_once("admin/includes/init.php");

if (empty($_GET['id'])) {
    redirect('index.php');
}
  

$photo = Photo::find_by_id([$_GET['id']]);


if (isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::create_comment($photo->id, $author, $body);
    
    if ($new_comment && $new_comment->save()) {
        redirect("photo.php?id={$photo->id}");
    } else {
        $message = "Comment not saved";
    }
} else {
    $author = "";
    $body = "";
}

$comments = Comment::find_comments($photo->id);

?>

<body>

    <!-- Navigation -->
    <?php require_once("includes/navigation.php") ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Uros Todorovic</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><i class="fa fa-clock-o"></i> Posted on August 24, 2019 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <a href="admin/<?php echo $photo->picture_path(); ?>"><img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt=""></a>

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption; ?></p>
                <p><?php echo $photo->description; ?></p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->



                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                        <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="body">Comment</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                
            
               <?php  if ($comments === false) {
                   return false; 
               } else {
                    foreach ($comments as $comment) {
               
                ?>
                    
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <small>August 25, 2019 at 9:30 PM</small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>

               <?php } 
                } ?>
              

            </div>

            <?php
                /* require_once('includes/sidebar.php'); */
            ?>

        </div>
        <!-- /.row -->

        <hr>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php require_once("includes/footer.php") ?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
