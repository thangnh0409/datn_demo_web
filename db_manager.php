<?php
/**
 * Created by PhpStorm.
 * User: thangnh
 * Date: 4/19/15
 * Time: 4:08 PM
 */

class DbManager {
    protected $server_name = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $db_name = "amobi24_03";
    protected $conn = null;

    public function connect(){
        $conn = mysql_connect($this->$server_name, $this->$username, $this->$password);
        mysql_set_charset('utf8', $conn);
        //check connection
        if(!$conn){
            die("connect fail: ". $conn->connect_error);
        }else {
            mysql_select_db($this->$db_name);
        }
    }


}

?>