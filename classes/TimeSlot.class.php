<?php
class TimeSlot{
    protected $_start;    // using protected so they can be accessed
    protected $_end; // and overidden if necessary
    protected $_spots;
    protected $_hours;
    protected $_event_id;

    public function __construct($event_id, $data) {
       $this->_event_id = $event_id;
       $this->_start = $data['start'];
       $start_time = strtotime($this->_start);
       $end_time = strtotime($data['end']);
       if($end_time > $start_time){
         $this->_end = $data['end'];
       }
       $this->_spots = $data['num'];
       $this->_hours = intdiv($end_time - $start_time, 3600);
    }
    public function getSQLValues(){
      $str = "(".$this->_event_id.", '".$this->_start."', '".$this->_end."', ".$this->_spots.", 0, ".$this->_hours.")";
      return $str;
    }

}
?>
