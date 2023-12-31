<?php
header('Content-Type: application/json');
include_once '../funcs/databaseConnect.php';

$method=$_SERVER['REQUEST_METHOD'];
switch ($method) {
  case 'GET':
    if ( isset($_GET['id']) ) {
      include_once '../funcs/getTodoById.php';
    } else {
      include_once '../funcs/getTodos.php';
    }
    break;
  case 'POST':
    include_once '../funcs/addTodo.php';
    break;
  case 'DELETE':
    include_once '../funcs/removeTodoById.php';
    break;
  case 'PATCH':
    include_once '../funcs/modifyTodoById.php';
    break;
  default:
    http_response_code(400);
    echo json_encode(['error' => 'wrong request method']);
    break;
}
//database closing
$db=null;
?>