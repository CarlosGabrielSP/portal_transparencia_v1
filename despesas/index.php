<?php
function get_contents() {
  file_get_contents("http://localhost/portal/despesas/");
  var_dump($http_response_header);
}
get_contents();
var_dump($http_response_header);
?>