<?php
use App\database\helper as help;

trait Insert
{

 public function insert(string $table, array $data)
 {
  $help = new help;


  $status = [
   "error" => 0,
   "msg" => []
  ];

  if ($this->checkTable($table)) {




   // ================================

   $col = array_keys($data);

   $column = "`" . implode("` , `", $col) . "` ";
   // ==============================================


   $val = array_values($data);

   $value = "'" . implode("' , '", $val) . "' ";



   $this->query = "INSERT INTO `{$table}` ({$column})  VALUES ({$value}) ";


   $this->exe = $this->conn->query($this->query);


   if ($this->exe) {

    if ($this->conn->affected_rows > 0) {

     array_push($status["msg"], "DATA HAS BEEN INSERTED");

    } else {

     $status["error"]++;
     array_push($status["msg"], "DATA HAS NOT BEEN  INSERTED {$this->query}");
    
    }
   }else{
    $status["error"]++;
     array_push($status["msg"], "ERROR IN QUERY {$this->query}");
   }

  } else {
   $status["error"]++;
   array_push($status["msg"], "THIS {$table} TABLE IS NOT EXISTED");
  }


  return json_encode($status);

// =========================================================
 }
 // ===========================function end=====================

}
?>