<?php 

namespace App\Database;

use PDO;
use PDOException;
    
class Db {
    /* Development */
    // private $serverName = "localhost";
    // private $dbUsername = "root";
    // private $dbPassword = "";
    // private $dbName = "set-acsproject";

    /* PPE */
    // private $serverName = "localhost";
    // private $dbUsername = "cp261186_acsdev";
    // private $dbPassword = "88Acsdev@88@88";
    // private $dbName = "cp261186_acs-project-ppe";

    /* PROD */
    private $serverName = "localhost";
    private $dbUsername = "cp261186_acsdev";
    private $dbPassword = "88Acsdev@88@88";
    private $dbName = "cp261186_acs-project-prod";

    protected $conn;

    function __construct() {
        $this->conn = $this->connect();
    }

    protected function connect()
    {    
        try {
            $dsn = "mysql:host={$this->serverName}; dbname={$this->dbName}";
            $conn = new PDO($dsn, $this->dbUsername, $this->dbPassword, [PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"]);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
}

?>



