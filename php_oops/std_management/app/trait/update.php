<?php

trait Update
{
 public function update(string $table, array $data, string $where)
 {


  $status = [
   "error" => 0,
   "msg" => []
  ];

  // UPDATE `table` SET `col`='[value-1]' ,`col`='[value-1]   WHERE 1

  if ($this->checkTable($table)) {
                                   
   $updates = "";


   foreach ($data as $key => $value) {
    $updates .= " `{$key}`='{$value}' ,";
   }
                                   
   $updates = rtrim($updates, ",");

   $this->query = "UPDATE `{$table}` SET {$updates} WHERE {$where} ";

   $this->exe = $this->conn->query($this->query);

   if ($this->exe) {

    if ($this->conn->affected_rows > 0) {

     array_push($status["msg"], "DATA HAS BEEN UPDATED");
    
    } else {
     $status["error"]++;

     array_push($status["msg"], "DATA REMAIN SAME");
     
    }
   } else {
    $status["error"]++;
    array_push($status["msg"], "QUERY ERROR {$this->query}");
   }


  } else {
   $status["error"]++;
   array_push($status["msg"], "This {$table} table is not existed");
  }


  return json_encode($status);
 }

}
?>