<?php
require_once('dbConnect.php');

class dbFunction
{
    public $db;

    function __construct(){
        $this->db = new dbConnect;
    }

    function __destruct(){
        $this->db->close();
    }
    public function urlValidate($originalUrl){
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$originalUrl)) {
            return false;
          }
        else{
            $originalUrl = mysqli_real_escape_string($this->db->conn, $originalUrl);
            return $originalUrl;
        }
        
    }
    public function genUniqueUrl($id){
        $id = $id + 100000000;
        return base_convert($id, 10, 36);
    }

    public function checkUrlExists($originalUrl){
        
        
        $execute = $this->db->conn->query("SELECT * FROM shorturl WHERE originalUrl = '$originalUrl'");
        $data = mysqli_fetch_array($execute, MYSQLI_ASSOC);
        $rows = mysqli_num_rows($execute);
        
        
        
        if($rows){
            return $data['shortCode'];
        }
        else{
            return $this->createNewShortUrl($originalUrl);
        }
    }

    public function createNewShortUrl($originalUrl){

        //$query = "INSERT INTO shorturl(originalUrl, creation) VALUES('$originalUrl',NOW())";
        //$execute = mysqli_query($this->db->conn, $query);
        $insertData = $this->db->conn->query("INSERT INTO shorturl(originalUrl, creation) VALUES('$originalUrl',NOW())");
        if($insertData){
            
            $getData = $this->db->conn->query("SELECT * FROM shorturl WHERE originalUrl = '$originalUrl'");
            $data = mysqli_fetch_array($getData, MYSQLI_ASSOC);
        }
        else{
            return false;
        }
        $id = $data['id'];
        $uniqueUrl = $this->genUniqueUrl($data['id']);
        $updateData = $this->db->conn->query("UPDATE shorturl SET shortcode = '$uniqueUrl' WHERE id = '$id'");
        return $uniqueUrl;


    }

    public function genShortUrlLink($shortCode){
        $parent_dir = dirname(dirname($_SERVER['SCRIPT_NAME'])) . '/';
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
  		return "<a href='{$protocol}://{$_SERVER['HTTP_HOST']}/{$parent_dir}{$shortCode}' target='_blank'>{$protocol}://{$_SERVER['HTTP_HOST']}/{$parent_dir}{$shortCode}</a>";

    }

    public function getOriginalUrl($shortCode){
        $execute = $this->db->conn->query("SELECT originalUrl FROM shorturl WHERE shortCode = '$shortCode' ");
        $originalUrl = mysqli_fetch_array($execute, MYSQLI_ASSOC);
        return $originalUrl['originalUrl'];
    }
}



?>