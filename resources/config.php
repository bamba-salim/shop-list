  <?php
  session_start();
  require_once('./resources/dao/Request.php');
  require_once('./resources/controllers/Results.php');
  
  date_default_timezone_set('UTC');
  define('SITE_NAME', 'SHOP LIST');
