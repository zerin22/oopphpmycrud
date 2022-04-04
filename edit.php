<?php 
    require_once('header.php');

    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
      $post_id = $_GET['id'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_post']))
    {
      $updatePost = $post->updatePost($post_id, $_POST,$_FILES);
    }
?>

<body>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <div>
        <?php
          //isset function checking if the variable is set or not
          if(isset($updatePost))
          {
            echo($updatePost);
            header( "refresh:5;url=index.php" );
          }
        ?>
          <div class="mt-2">
            <a href="index.php" class="d-block text-right">All Post</a>
          </div>
        <?php 
          if(isset($_GET['id']) && is_numeric($_GET['id']))
          {
            $id = $_GET['id'];

            $getPost = $post->editSinglePost($id);

            if($getPost != NULL)
            {
              $data = $getPost->fetch_assoc();

        ?>
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                  <label for="postTitle">Post Title</label>
                  <input id="postTitle" class="form-control" type="text" name="post_title" placeholder="Post Title" value="<?php echo $data['title'];?>" required>
              </div>

              <div class="form-group">
                <label for="postDescription">Post Description</label>
                <textarea id="postDescription" class="form-control" name="post_description" cols="30" rows="5" placeholder="Post Description"><?php echo $data['description'];?></textarea>
              </div>

              <div class="form-group">
                <label for="postImage">Image</label>
                <img src="asset/img/<?php echo $data['image']; ?>" alt="Not Found" class="image-fluid">
                <input id="postImage" class="form-control" type="file" name="post_image" placeholder="Post Image" >
              </div>

                <div class="form-group">
                  <input type="submit" name="update_post" class="btn btn-primary float-right" value="UPDATE">
                </div>
              </form>
        <?php
              
            }else{
        ?>
              <div class="alert alert-danger text-center" role="alert">
                    Post not found!
              </div>
        <?php    
            }
          }else{
        ?>
            <div class="alert alert-danger text-center" role="alert">
              Something went wrong! Please try again later.
            </div>
        <?php
          }
        ?>
        
        </div>
      </div>
    </div>
  </div>    

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
  -->
</body>
</html>