<?php
$id=$_GET['id'];
if( is_numeric($id) && $id >= 0 ) {

  try {
    $stmt=$db->prepare(
      "SELECT * FROM list 
      WHERE id = :id");

    $stmt->bindParam(':id', $id);

    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if( sizeof($result) === 0 ) {
      http_response_code(400);
      echo json_encode(['error' => 'not found']);
      return;
    }
    http_response_code(200);
    echo json_encode($result);
    return;
  } catch(PDOException $error) {
    http_response_code(500);
    echo json_encode(['error' => 'Something went wrong']);
    return;
  }

} else {
  http_response_code(400);
  echo json_encode(['error' => 'id is wrong']);
  return;
}
?>