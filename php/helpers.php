<?php
/* =============================================================================

============================================================================= */


function get_content_type(){
  $content_type = $_SERVER["CONTENT_TYPE"] ?? '';
  if ($content_type){ $content_type = explode(';', $content_type)[0]; }
  return $content_type;
}


/* =============================================================================

============================================================================= */


function decode_file($data){
  list($mime_type, $data) = explode(';', $data);
  $parsed_mime_type       = explode('/', $mime_type)[1]; // => e.g., jpeg (not a reliable way of getting file extension).
  list(, $data)           = explode(',', $data);
  $data                   = base64_decode($data);
  return array('parsed_mime_type' => $parsed_mime_type, 'file' => $data);
}
