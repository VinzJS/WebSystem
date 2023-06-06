<?php
include_once 'classes\class.driver.php';
?>
<script>
function showResults(str) {
  if (str.length == 0) {
    document.getElementById("search-result").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("search-result").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "driver-crud/search.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>

<div id="third-submenu">
  <form method="get" action="driver-crud/search.php">
    Search <input type="text" id="search" name="q" onkeyup="showResults(this.value)">
    <a href="reports/xl-driverrep.php" target="_blank">Driver Report - Excel</a> ||
    <a href="reports/pdf-driver-rep.php" target="_blank">Driver Report - PDF</a>
  </form>
</div>
<div id="subcontent">
    <?php
      switch($action){
                case 'add_driver':
                    require_once 'create-driver.php';
                break; 
                case 'update_driver':
                    require_once 'view-driver.php';
                break;
                default:
                    require_once 'driver-crud/main.php';
                break; 
            }
    ?>
  </div>