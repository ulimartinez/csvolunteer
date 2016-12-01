<?php
class Event{
    protected $_id;    // using protected so they can be accessed
    protected $_skills; // and overidden if necessary
    protected $_slots;

    protected $_event;     // stores the user data

    public function __construct($id, $slots, $skills) {
       $this->_id = $id;
       $this->_skills = $skills;
       $this->_slots = $this->createSlots($slots);
    }
    function createSlots($slot_array){
      include_once 'TimeSlot.class.php';
      $slots = array();
      for($i = 0; $i < count($slot_array); $i++){
        array_push($slots, new TimeSlot($this->_id, json_decode($slot_array[$i], true)));
      }
      return $slots;
    }
    protected function storeSkills(){
      require('config.php');
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
      if ($conn -> connect_error) {
          die("Connection failed: " . $conn -> connect_error);
      }
      $sql = "INSERT INTO event_skills VALUES ";
      for($i = 0; $i < count($this->_skills); $i++){
        $skill = $conn->real_escape_string($this->_skills[$i]);
        if($i == count($this->_skills)-1){
          $sql .= "(".$this->_id.", '$skill');";
        }
        else{
          $sql .= "(".$this->_id.", '$skill'),";
        }
      }
      $result = $conn->query($sql);
      $conn->close();
      return $result;
    }
    protected function storeSlots(){
      require('config.php');
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
      if ($conn -> connect_error) {
          die("Connection failed: " . $conn -> connect_error);
      }
      $sql = "INSERT INTO time_slots (event_id, start_time, end_time, spots_needed, spots_filled, hours) VALUES ";
      for($i = 0; $i < count($this->_slots); $i++){
        if($i == count($this->_slots)-1){
          $sql .= $this->_slots[$i]->getSQLValues().";";
        }
        else{
          $sql .= $this->_slots[$i]->getSQLValues().",";
        }
      }
      $result = $conn->query($sql);
      $conn->close();
      return $result;
    }
    public function addData(){
      return ($this->storeSkills() AND $this->storeSlots());
    }
    public function getData(){
      require('config.php');
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
      if ($conn -> connect_error) {
          die("Connection failed: " . $conn -> connect_error);
      }
      $sql = "SELECT * FROM events WHERE id=". $this->_id;
      $result = $conn->query($sql);
      $this->_event = $result->fetch_assoc();
      return $this->_event;
    }

}
?>
