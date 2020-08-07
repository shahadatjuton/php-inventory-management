<?php
 Class Database{

public $host   = DB_HOST;
public $user   = DB_USER;
public $pass   = DB_PASS;
public $dbname = DB_NAME;

public $link;
public $error;

public function __construct(){
    $this->conn();
}

private function conn(){
   $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
   if(!$this->link){
       $this->error = "Connection failed!!".$this->link->connect_error;
   }
}

// Select / Retrieve Data

public function retrieve($sql){
    $result = $this->link->query($sql) or die ($this->link->error.__LINE__);
    if($result->num_rows > 0){
        return $result;
    }else{
        return false;
    }
}
// ===============Insert Data=============

public function insert($sql){
    $insert = $this->link->query($sql) or die ($this->link->error.__LINE__);
    if($insert){
        return $insert;
    }else{
        return false;
    }
}
//===============Update Data =====================
    public function update($sql){
        $update = $this->link->query($sql) or die ($this->link->error.__LINE__);
        if($update){
            return $update;
        }else{
            return false;
        }
    }
    //===============Delete Data =====================
    public function delete($sql){
        $delete = $this->link->query($sql) or die ($this->link->error.__LINE__);
        if($delete){
            return $delete;
        }else{
            return false;
        }
    }
}

?>