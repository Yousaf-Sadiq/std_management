<?php

use App\database\helper as help;

trait Select
{
 public function select(string $table, string $row = "*", string $where = null, string $orderBy = null, string $Limit = null)
 {

  /**
   * as a sample query for extra knowledge
   * SELECT Orders.*,Orders.CustomerID as O_CustomerID , Customers.*,
  *  FROM Orders
  *  INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;


   * SELECT * FROM `table_name`
   * SELECT name,email FROM `table_name` WHERE condition
   * SELECT id FROM `table_name` WHERE condition ORDER BY number DESC/ASC 
   * SELECT * FROM `table_name` WHERE condition ORDER BY number DESC/ASC LIMIT 5 
   *  
   */

  if ($this->checkTable($table)) {

   $this->query = "SELECT {$row} FROM `{$table}`";

   //  if you want to create condition for join then it should be placed before where condition 


   if ($where != null) {
    $this->query .= " WHERE {$where}";
   }


   if ($orderBy != null) {
    $this->query .= " ORDER BY {$orderBy}";
   }

   if ($Limit != null) {
    $this->query .= " LIMIT {$Limit}";
   }

   // echo $this->query;

   $this->exe = $this->conn->query($this->query);

   if ($this->exe) {
    return true;
   } else {
    return false;
   }


  } else {
   return false;
  }

 }


}

?>