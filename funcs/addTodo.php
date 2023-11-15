<?php
$inputDatas=file_get_contents('php://input');
$datas=json_decode($inputDatas, true);

//TODO: may here need <img> too, but it is MAY has a risk (xss)
$enabledHtml='<div><b><strong><i><em><u><a><ul><ol><li><p><br><span>';

if( isset($datas['name']) ) {
  $name=strip_tags($datas['name'], $enabledHtml);
  
  if( isset($datas['description']) ) {
    $description=strip_tags($datas['description'], $enabledHtml);
  }
  if( strlen($name) > 0 && strlen($name) <= 80 ) {

    if( strlen($description) > 750 ) {
      http_response_code(400);
      echo json_encode(['error' => 'Description more than 750 char']);
      return;
    }

    try {
      $stmt=$db->prepare(
        "INSERT INTO list (name, description)
        VALUES (:name, :description)");

      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':description', $description);

      $stmt->execute();
      http_response_code(200);
      echo json_encode(['succes' => 'data is created']);
      return;
    } catch(PDOException $error) {
      http_response_code(500);
      //DONT SEND $error, may it could has some sensitive data
      echo json_encode(['error' => 'Something went wrong']);
      return;
    }

  } else {
    http_response_code(400);
    echo json_encode(['error' => 'Name has 0 or more than 80 char']);
    return;
  }
} else {
  http_response_code(400);
  echo json_encode(['error' => 'Name is missing']);
  return;
}
?>