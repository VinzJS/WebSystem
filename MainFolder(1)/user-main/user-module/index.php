<?php
include_once 'classes\user-class.php';


/* instantiate class object */
$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';
$user = new User();

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
    xmlhttp.open("GET", "user-main/users-module/search.php?q=" + str, true);
    xmlhttp.send();
  }
}
</script>

<div id="third-submenu">
  <form method="get" action="user-main/user-module/search.php">
    Search <input type="text" id="search" name="q" onkeyup="showResults(this.value)">
    <a href="reports/xl-userrep.php" target="_blank">User Report - Excel</a> ||
    <a href="reports/pdf-user-rep.php" target="_blank">User Report - PDF</a> 
  </form>
</div>
<div id="subcontent">
<link rel="stylesheet" href="stylesheets1.css">
            <?php
            switch($action){
                case 'add':
                    require_once 'create-user.php';
                break; 
                case 'profile':
                    require_once 'user-main/user-module/view-user.php';
                break;
                default:
                    require_once 'main.php';
                break; 
            }
    ?>
  </div>