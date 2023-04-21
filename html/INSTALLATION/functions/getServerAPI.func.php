<?php
function getServerAPI() {
   // Returns true if CGI, false if not
   return str_starts_with(php_sapi_name(), 'cgi') ? true : false;
}
?>
