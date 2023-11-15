<?php
$id=$_GET['id'];
if( is_numeric($id) && $id >= 0 ) {
  try {
    $stmt=$db->prepare("DELETE FROM list
      WHERE id = :id");

    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if( $stmt->rowCount() === 0 ) {
      http_response_code(400);
      echo json_encode(['error' => 'not found']);
      return;
    } else {
      http_response_code(200);
      echo json_encode(['succes' => 'data removed']);
      return;
    }
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