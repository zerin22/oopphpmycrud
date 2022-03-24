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