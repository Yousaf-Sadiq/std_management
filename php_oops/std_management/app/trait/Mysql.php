<?php

trait Mysql
{

 public function Mysql(string $q, bool $checkRow = false)
 {
  $this->query = $q;

  $this->exe = $this->conn->query($this->query);

  if ($this->exe) {

   if ($checkRow) {

    if ($this->exe->num_rows > 0) {
     return true;
    } else {
     return false;
    }

   }

   return true;

  } else {

   return false;
  }


 }
}

?>