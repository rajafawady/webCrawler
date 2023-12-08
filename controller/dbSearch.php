<?php
include_once("../config/connection.php");
class DBSearch{
    public function addKeyword($keyword) {
        global $conn;
        
        // Using a prepared statement to avoid SQL injection
        $sql = "INSERT IGNORE INTO keywords (keyword) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $keyword);

        if ($stmt->execute()) {
            $lastInsertedID = $stmt->insert_id;
            $stmt->close(); 
            return $lastInsertedID;
        } else {
            $stmt->close(); 
            return $conn->error;
        }
    }
    public function check($keyword) {
        global $conn;
        $sql = "SELECT * FROM keywords WHERE keyword = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $keyword);
    
        // Execute the statement
        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close(); 
            return $conn->error;
        }
    }

    public function search($url) {
        global $conn;
    
        // Using a prepared statement to avoid SQL injection
        $sql = "SELECT * FROM keywords WHERE keyword = ?";
        $stmt = $conn->prepare($sql);
    
        // Bind the parameter
        $stmt->bind_param("s", $url);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $searchResults = [];
                $row =$result->fetch_assoc();
                if(isset($row['keyword_id'])){
                    return $row['keyword_id'];
                }
            } else {
                return null; 
            }
        } else {
            $stmt->close(); 
            return $conn->error;
        }
    }
    
}


?>