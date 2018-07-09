<?php
  /**
   * CLass dbCon will be called to make a connection to DataBase
   *
   */
  class dbConnect
  {

    public $conn;
    public function __construct()
    {
      require('dbConfig.php');
      $this->conn = mysqli_connect(db_host,db_user,db_pass,db_database);
      if(!$this->conn){
        echo "Database Connection Error.";
      }
      else {


        return $this->conn;
      }
    }
    public function close(){
      mysqli_close($this->conn);
    }
  }


?>
