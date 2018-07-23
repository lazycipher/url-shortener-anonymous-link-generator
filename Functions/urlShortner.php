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
        if (!preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i',$originalUrl)) {
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
        
        
        $execute = $this->db->conn->query("SELECT * FROM shorten WHERE originalUrl = '$originalUrl'");
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

        $userIP = $this->get_client_ip();
        $insertData = $this->db->conn->query("INSERT INTO shorten(originalUrl, creation, userIP) VALUES('$originalUrl',NOW(), '$userIP')");
        if($insertData){
            
            $getData = $this->db->conn->query("SELECT * FROM shorten WHERE originalUrl = '$originalUrl'");
            $data = mysqli_fetch_array($getData, MYSQLI_ASSOC);
        }
        else{
            return false;
        }
        $id = $data['id'];
        $uniqueUrl = $this->genUniqueUrl($id);
        $updateData = $this->db->conn->query("UPDATE shorten SET shortCode = '$uniqueUrl' WHERE id = '$id'");
        return $uniqueUrl;


    }

    // public function genShortUrlLink($shortCode){
    //     $parent_dir = dirname(dirname($_SERVER['SCRIPT_NAME'])) . '/';
    //     $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
  	// 	return "{$protocol}://{$_SERVER['HTTP_HOST']}/{$parent_dir}{$shortCode}";

    // }

    public function getOriginalUrl($shortCode){
        $shortCode = mysqli_real_escape_string($this->db->conn, $shortCode);
        $execute = $this->db->conn->query("SELECT originalUrl, hits FROM shorten WHERE shortCode = '$shortCode' ");
        $originalUrl = mysqli_fetch_array($execute, MYSQLI_ASSOC);
        $hits = $originalUrl['hits']+1;
        $hitsCounter = $this->db->conn->query("UPDATE shorten SET hits = '$hits' WHERE shortCode = '$shortCode'");
        return $originalUrl['originalUrl'];
    }
    // Function to get the client IP address
    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}



?>