<?php

trait Delete
{
 public function delete(string $table, string $where)
 {
  $status = [
   "error" => 0,
   "msg" => []
  ];

  if ($this->checkTable($table)) {

   $this->query = "DELETE FROM `{$table}` WHERE {$where}";

   $this->exe = $this->conn->query($this->query);

   if ($this->exe) {

    if ($this->conn->affected_rows > 0) {
     array_push($status["msg"], "DATA HAS BEEN DELETED");
    } else {
     $status["error"]++;
     array_push($status["msg"], "DATA HAS NOT BEEN DELETED  {$this->query}");
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
 }
}

?>