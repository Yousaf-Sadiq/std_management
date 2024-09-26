<?php 

trait CheckTable{
 protected function checkTable(string $table)
 {

  $this->query = "SELECT * 
  FROM information_schema.tables
  WHERE table_schema = '{$this->db}' 
      AND table_name = '{$table}'
  LIMIT 1;";


  $this->exe = $this->conn->query($this->query);

  if ($this->exe->num_rows == 1) {
   return true;
  } else {
   return false;
  }


 }
 // ==========================================================
}

?>