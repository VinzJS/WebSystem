<?php
include_once 'classes\class.taxi.php';
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
    xmlhttp.open("GET", "taxi-crud/search.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>

<div id="third-submenu">
  <form method="get" action="taxi-crud/search.php">
    Search <input type="text" id="search" name="q" onkeyup="showResults(this.value)">
    <a href="reports/xl-taxirep.php" target="_blank">Taxi Report - Excel</a> ||
    <a href="reports/pdf-taxi-rep.php" target="_blank">Taxi Report - PDF</a>
  </form>
</div>
<div id="subcontent">
    <?php
      switch($action){
                case 'add_taxi':
                    require_once 'create-taxi.php';
                break; 
                case 'update_taxi':
                    require_once 'view-taxi.php';
                break;
                default:
                    require_once 'taxi-crud/main.php';
                break; 
            }
    ?>
  </div>