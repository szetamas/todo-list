<?php
try {
  $sql="SELECT * FROM list ";
  if ( isset($_GET['name']) && strlen($_GET['name']) > 0 ) {
    $sql.="WHERE name LIKE :name ";
    if ( isset($_GET['completed']) && strlen($_GET['completed']) > 0 ) {
      $sql.="AND completed LIKE :completed ";
    }
  } else if ( isset($_GET['completed']) && strlen($_GET['completed']) > 0 ) {
    $sql.="WHERE completed LIKE :completed ";
  }

  $limit=( isset($_GET['per_page']) && $_GET['per_page'] > 0 ) ? $_GET['per_page'] : 25;
  $page=( isset($_GET['page']) && $_GET['page'] > 0 ) ? $_GET['page'] : 1;
  $offset=($page-1)*$limit;
  $sql.="LIMIT :limit OFFSET :offset";
 
  $stmt=$db->prepare($sql);

  if ( isset($_GET['name']) && strlen($_GET['name']) > 0 ) {
    $name="%".$_GET['name']."%";
    $stmt->bindParam(':name', $name);
  }
  if ( isset($_GET['completed']) && strlen($_GET['completed']) > 0 ) {
    $stmt->bindParam(':completed', $_GET['completed']);
  }
  $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
  $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

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
  echo json_encode(['error' => $error]);
  return;
}
?>