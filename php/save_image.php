<?php
require_once "helpers.php";


/* =============================================================================
                              Kill process if...
============================================================================= */


$content_type = get_content_type();


if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
  // http_response_code(405);
  $response = array(
    "result"  => "FAIL",
    "message" => "The server script is meant to work with POST requests only."
  );
  echo json_encode($response);
  die();
}


if ($content_type !== "application/json"){
  // http_response_code(405);
  $response = array(
    "result"  => "FAIL",
    "message" => "The server script is meant to work with JSON data only."
  );
  echo json_encode($response);
  die();
}


$json = json_decode(file_get_contents("php://input"));


if (!isset($json->image)){
  // http_response_code(400);
  $response = array(
    "result"  => "FAIL",
    "message" => "'image' data is required."
  );
  echo json_encode($response);
  die();
}


if (!isset($json->imageName)){
  // http_response_code(400);
  $response = array(
    "result"  => "FAIL",
    "message" => "'imageName' data is required."
  );
  echo json_encode($response);
  die();
}


/* =============================================================================

============================================================================= */


if (!is_dir('../images')){
  mkdir('../images');
  chmod("../images", 0777);
}

mkdir(dirname("../images"));
chmod(dirname("../images"), 0777);

$image_data = decode_file($json->image);
file_put_contents('../images/' . $json->imageName, $image_data['file']);

// http_response_code(200);
$response = array(
  'result'  => 'SUCCESS',
  'message' => 'The POST request was received with JSON data.'
);

echo json_encode($response);
?>
