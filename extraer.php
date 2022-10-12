<?php 
// Database connection info 
$dbDetails = array( 
'host' => 'localhost', 
'user' => 'root', 
'pass' => '', 
'db'   => 'db_psicologo'
); 
// mysql db table to use 
$table = 'clientes'; 
// Table's primary key 
$primaryKey = 'id'; 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
array( 'db' => 'nombre', 'dt' => 0 ), 
array( 'db' => 'apellidos',  'dt' => 1 ),
array( 'db' => 'edad',      'dt' => 2 ), 
array( 'db' => 'email',      'dt' => 3 ), 
array( 'db' => 'numero',    'dt' => 4 ), 
array( 'db' => 'mensaje',    'dt' => 5 ),  
 
); 
// Include SQL query processing class 
require 'ssp.class.php'; 
// Output data as json format 
echo json_encode( 
SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);