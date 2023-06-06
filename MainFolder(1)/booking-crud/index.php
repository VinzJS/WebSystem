<?php
include_once 'classes\class.booking.php';
include_once 'classes\class.taxi.php';
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
    xmlhttp.open("GET", "booking-crud/search.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>

<div id="third-submenu">
  <form method="get" action="booking-crud/search.php">
    Search <input type="text" id="search" name="q" onkeyup="showResults(this.value)">
    <a href="reports/xl-bookingrep.php" target="_blank">Booking Report - Excel</a> ||
    <a href="reports/pdf-booking-rep.php" target="_blank">Customer Report - PDF</a>
  </form>
</div>
<div id="subcontent">
    <?php
      switch($action){
                case 'new_booking':
                    require_once 'create-booking.php';
                break;
                case 'update_booking':
                    require_once 'view-booking.php';
                break;
                default:
                    require_once 'main.php';
                break; 
            }
    ?>
  </div>