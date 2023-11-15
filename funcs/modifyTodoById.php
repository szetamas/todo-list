<?php
$id=$_GET['id'];
if( is_numeric($id) && $id >= 0 ) {
  $inputDatas=file_get_contents('php://input');
  $datas=json_decode($inputDatas, true);

  if( isset($datas['name']) || isset($datas['description']) ||
    isset($datas['completed']) ) {
    try {
      $sql="UPDATE list SET ";
      if ( isset($datas['name']) && strlen($datas['name']) > 0 ) {
        $sql.="name = :name, ";
      }
      if ( isset($datas['description']) && strlen($datas['description']) > 0 ) {
        $sql.="description = :description, ";
      }
      if ( isset($datas['completed']) && strlen($datas['completed']) > 0 ) {
        $sql.="completed = :completed, ";
      }

      $sql.="updated_at = :currentTime ";
      $stmt=$db->prepare($sql .   
        "WHERE id = :id");

      if ( isset($datas['name']) && strlen($datas['name']) > 0 ) {
        $stmt->bindParam(':name', $datas['name']);
      }
      if ( isset($datas['description']) && strlen($datas['description']) > 0 ) {
        $stmt->bindParam(':description', $datas['description']);
      }
      if ( isset($datas['completed']) && strlen($datas['completed']) > 0 ) {
        $stmt->bindParam(':completed', $datas['completed']);
      }

      $stmt->bindParam(':currentTime',  date('Y-m-d H:i:s'));
      $stmt->bindParam(':id', $id);
      $stmt->execute();

      if( $stmt->rowCount() === 0 ) {
        $stmtSelect=$db->prepare("SELECT * FROM list 
        WHERE id = :id");
        $stmtSelect->bindParam(':id', $id);
        $stmtSelect->execute();
        $result=$stmtSelect->fetchAll(PDO::FETCH_ASSOC);

        if( sizeof($result) === 0 )
        {
          http_response_code(400);
           echo json_encode(['error' => 'not found']);
          return;
        } else {
          //this could happen at spamming request, else the updatetime will change anyway 
          //TODO: may need check the new datas are really new or not
          http_response_code(200);
          echo json_encode(['succes' => 'data remained the same']);
          return;
        }
      } else {
        http_response_code(200);
        echo json_encode(['succes' => 'data is modified']);
        return;
      }
    } catch(PDOException $error) {
      http_response_code(500);
      echo json_encode(['error' => 'Something went wrong']);
      return;
    }
  } else {
    http_response_code(400);
    echo json_encode(['error' => 'name, description or completed is missing']);
    return;
  }
} else {
  http_response_code(400);
  echo json_encode(['error' => 'id is wrong']);
  return;
}
?>