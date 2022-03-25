<?php
class Post{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    //Get All Post From Database
    public function getAllPost(){
        $query = "SELECT * FROM post ORDER BY id DESC";

        $result = $this->db->select($query);
        return $result;
    }

    //Create Post
    public function createPost($data, $file){
        $title = mysqli_real_escape_string($this->db->link, $data['post_title']);
        $description = mysqli_real_escape_string($this->db->link, $data['post_description']);

        //File Process
        $image_name = $_FILES["post_image"]["name"];
        $image_type = $_FILES["post_image"]["type"]; // image/jpg - image/jpeg - image/ png
        $image_size = $_FILES["post_image"]["size"];

        $allowed = array(
            "jpg"  => "image/jpg",
            "jpeg" => "image/jpeg",
            "png"  => "image/png",
            "gif"  => "image/gif"
        );

        //Checking any requirment field is empty
        if($title == "" || $image_name == "")
        {
            $msg = "
                    <div class='alert alert-danger mt-3 text-center'>
                        <h4>Please check if any required field is left empty!</h4>
                    </div>
                ";
            return $msg;
        }

        //Checking Allowed File Extension Type 
        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
        if(!array_key_exists($ext,$allowed))
        {
            $msg = "
                <div class='alert alert-danger mt-3 text-center'>
                    <h4>Only jpg/jpeg/png/gif file type is allowed!</h4>
                </div>
            ";
             return $msg;
        }

        //Checking Image Size
        if($image_size > 104867)
        {
            $msg = "
                <div class='alert alert-danger mt-3 text-center'>
                    <h4>Image Size should be less then 1MB!</h4>
                </div>
            ";
            return $msg;
        }

        $image = str_shuffle(time()).'.'.$ext;

        $query = "INSERT INTO `post` (`title`, `description`, `image`)
                    VALUES ('$title', '$description', '$image')
                ";
                    print_r($query);
        $insertPost = $this->db->insert($query);

        if($insertPost)
        {
            //String Image to Server if Data Inserted Successfully
            $dir = "asset/img/";
            if (!file_exists($dir)) 
            {
                mkdir($dir, 0777, true);
            }

            move_uploaded_file($file["post_image"]["tmp_name"], $dir . $image);
            $msg = "
                <div class='alert alert-success mt-3 text-center'>
                    <h4>Post successfully created!</h4>
                </div>
            ";
            return $msg;
        }else{
            $msg = "
                <div class='alert alert-danger mt-3 text-center'>
                    <h4>Something went wrong! Please try again later.</h4>
                </div>
            ";
            
            return $msg;
        }

    }

    //View Single Post
    public function viewSinglePost($id){
        $postQuery = "SELECT * FROM post WHERE id ='$id'";
        $getPost = $this->db->select($postQuery);
        return $getPost;
    }

    //Delete Single Post
    public function deleteSinglePost($id){
        $postQuery = "SELECT * FROM post WHERE id ='$id' ";
        $getPost = $this->db->select($postQuery);

        if($getPost)
        {
            $query = "DELETE FROM post WHERE id ='$id'";
            $deletePost = $this->db->delete($query);

            if($deletePost)
            {
                $msg = "
                    <div class='alert alert-success mt-3 text-center'>
                        <h4>Post deleted successfully!</h4>
                    </div>
                    ";
                return $msg;
            }else{
                $msg = "
                    <div class='alert alert-danger mt-3 text-center'>
                        <h4>Unable to delete the post!</h4>
                    </div>
                    ";
                return $msg;
            }
        }else{
            $msg = "
                <div class='alert alert-success mt-3 text-center'>
                    <h4>The post you want to delete not found!</h4>
                </div>
                ";
            return $msg;
        }
    }

}
?>