<?php
   function mysqlTest($dbinfo) {
      $dbhost = null;
      $dbuname = null;
      $dbpass = null;
      $dbname = null;
      global $coreTableCount;
      ini_set('mysql.connect_timeout',120);
      require_once($dbinfo);
      $desc = 'MySQLi Server Connection';
      echo '<tr>';
      echo '<td class="item">' . $desc . '</td>';
      echo '<td align="left">';
      echo mysqli_connect($dbhost,$dbuname,$dbpass) ? '<span style="color:green; font-weight:bold;">Pass</span>' : '<span style="color:red; font-weight:bold;">Fail - ' . mysql_error() . '</span>' . '</td>';
      echo '</tr>';

      $desc = 'Database Connection';
      echo '<tr>';
      echo '<td class="item">' . $desc . '</td>';
      echo '<td align="left">';
      echo mysqli_select_db($dbname) ? '<span style="color:green; font-weight:bold;">Pass</span>' : '<span style="color:red; font-weight:bold;">Fail - ' . mysql_error() . '</span>' . '</td>';
      echo '</tr>';

      $desc = 'Database Core Table Count';
      echo '<tr>';
      echo '<td class="item">' . $desc . '</td>';
      echo '<td align="left">';
      $rc = mysqli_query('SHOW TABLES');
      $cnt = 0;
      while ($row = mysqli_fetch_row($rc)) { $cnt++; }
      echo $coreTableCount==$cnt ? '<span style="color:green; font-weight:bold;">Pass</span>' : '<span style="color:red; font-weight:bold;">Fail - Expecting ' . $coreTableCount . ' - Counted ' . $cnt . '</span>' . '</td>';
      echo '</tr>';
}
?>