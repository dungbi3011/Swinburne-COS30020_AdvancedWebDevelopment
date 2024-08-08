<?php   
class HitCounter {
    private $host;
    private $user;
    private $pswd;
    private $dbnm;
    private $table;
    private $hits;
    private $conn; 

    // Constructor to initialize the database connection
    public function __construct($host, $user, $pswd, $dbnm, $tablename) {
        $this->conn = mysqli_connect($host, $user, $pswd, $dbnm);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        $this->host = $host;
        $this->user = $user;
        $this->pswd = $pswd;
        $this->dbnm = $dbnm;
        $this->table = $tablename;
    }

    //to get and display hits on the page
    public function getHits() {
        $select = "SELECT hits FROM $this->table";
        $result = $this->conn->query($select);
        $row = $result->fetch_assoc();
        $this->hits = $row['hits'];
        return $this->hits;
    }

    //to add 1 to hits, also update the table
    public function setHits($newHits) {
        $delete = "DELETE FROM $this->table";
        $this->conn->query($delete);
        
        $insert = "INSERT INTO $this->table VALUES (1, $newHits)";
        $this->conn->query($insert);
        
        $this->hits = $newHits;
    }

    // Close the database connection
    public function closeConnection() {
        $this->conn->close();
    }

    // Optionally: Set hits back to zero
    public function startOver() {
        $delete = "DELETE FROM $this->table";
        $this->conn->query($delete);
        $insert = "INSERT INTO $this->table VALUES (1, 0)";
        $this->conn->query($insert);
        $this->hits = 0;
    }
}
?>