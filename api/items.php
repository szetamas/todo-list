<?php
header('Content-Type: application/json');
include_once '../funcs/databaseConnect.php';

$method=$_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'POST':
    include_once '../funcs/addTodo.php';
    break;
  default:
    http_response_code(400);
    echo json_encode(['error' => 'wrong request method']);
    break;
}
//database closing
$db=null;
?>