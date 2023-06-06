<?php
include_once 'classes\class.customer.php';
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
    xmlhttp.open("GET", "customer-crud/search.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>

<div id="third-submenu">
  <form method="get" action="customer-crud/search.php">
    Search <input type="text" id="search" name="q" onkeyup="showResults(this.value)">
    <a href="reports/xl-customerrep.php" target="_blank">Customer Report - Excel</a> ||
    <a href="reports/pdf-customer-rep.php" target="_blank">Customer Report - PDF</a>
  </form>
</div>
<div id="subcontent">
    <?php
      switch($action){
                case 'add_customer':
                    require_once 'create-customer.php';
                break; 
                case 'update_customer':
                    require_once 'view-customer.php';
                break;
                default:
                    require_once 'main.php';
                break; 
            }
    ?>
  </div>