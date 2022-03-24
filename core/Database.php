<?php
    include 'config.php';
?>

<?php

class Database{
    public $host    = DB_HOST;
    public $user    = DB_USER;
    public $pass    = DB_PASS;
    public $dbName  = DB_NAME;

    public $link;
    public $error;

    public function __construct(){
        $this->connectionDB();
    }
    private function connectionDB(){
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbName);
        if(!$this->link){
            $this->error = "Connection fail:" .$this->link->connect_error;
        }
    }

    //Select or Read Data
    public function select($query)
    {
        $result = $this->link->query($query) or die($this->link->error.__Line__);
        if($result->num_rows > 0){
            return $result;
        }else{
            return false;
        }
    }

    //Insert Data
    public function insert($query)
    {
        $insert_row = $this->link->query($query) or die($this->link->error.__Line__);
        if($insert_row->num_rows > 0){
            return $insert_row;
        }else{
            return false;
        }
    }

    //Update Data
    public function update($query)
    {
        $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($update_row->num_rows > 0){
            return $update_row;
        }else{
            return false;
        }
    }

    //Delete Data
    public function delete($query)
    {
        $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($delete_row){
            return $delete_row;
        }else{
            return false;
        }
    }
    
}

?>