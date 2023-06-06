<?php
include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\user-class.php';

$user = new User();

// get the q parameter from URL
$q = $_GET["q"];
$count = 1;
$hint = '<h3>Search Result(s)</h3>
  <div id="subcontent">
  <table id="data-list">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
    </tr>';

$data = $user->list_users_search($q);
if ($data != false) {
  foreach ($data as $value) {
    extract($value);

    $hint .= '
    <tr>
      <td>'.$count.'</td>
      <td><a href="index.php?page=user&subpage=view&action=profile&id='.$user_id.'">'.$user_lastname.', '.$user_firstname.'</a></td>
      <td>'.$user_email.'</td>
    </tr>';
    $count++;
  }
}

$hint .= '</table></div>';


  // Output "no suggestion" if no hint was found or output correct values
  echo $hint === "" ? "No result(s)" : $hint;
  ?>