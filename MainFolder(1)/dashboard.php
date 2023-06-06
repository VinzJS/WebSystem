<?php 
include_once 'C:\web\Xampp\htdocs\MainFolder(1)\classes\user-class.php';
include_once 'classes\class.driver.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.booking.php';
include 'C:\web\Xampp\htdocs\MainFolder(1)\classes\class.taxi.php';

$user = new User();
$driver = new driver();
$booking = new booking();
$taxi = new taxi();
?>
<body>
<link rel="stylesheet" href="stylesheets1.css">

<style>
  body{
    background-color:#CBC7C7;
  }
  .dashboard-container {
    display: flex;
    justify-content: left;
    margin: 100px;
  }

  .dashboard-tile {
    background: linear-gradient(to right, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.1));
    box-shadow: 0 0 10px rgba(0, 0, 0, 10);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    width: 250px;
    display: flex;
    align-items: center;
    margin-left:120px;
  }

  .dashboard-tile h2 {
    font-size: 18px;
    margin: 0;
  }

  .dashboard-tile p {
    font-size: 24px;
    margin: 5px 0 0 0;
  }

  .dashboard-tile:hover {
    transform: scale(1.05);
  }
  
  .dashboard-tile-driver {
    background: linear-gradient(to right, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.1));
    box-shadow: 0 0 10px rgba(0, 0, 0, 50);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    width: 250px;
    display: flex;
    align-items: center;
    margin-left:125px;
  }
  .dashboard-tile-driver h2 {
    font-size: 18px;
    margin: 0;
  }

  .dashboard-tile-driver p {
    font-size: 24px;
    margin: 5px 0 0 0;
  }



  .userpng {
    height: 40px;
    margin-right: 10px;
  }
.dashboard-tile-driver:hover {
    transform: scale(1.05);
  }

  .dashboard-container-booking {
  display: flex;
  justify-content: center;
  margin: 10px;
  position: absolute;
  bottom: -400px;
  left: 410px;
}

.dashboard-tile-booking {
  background: linear-gradient(to right, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.1));
  box-shadow: 0 0 10px rgba(0, 0, 0, 10);
  border-radius: 10px;
  padding: 20px;
  text-align: center;
  width: 1000px;
  height: auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.dashboard-tile-booking h2 {
  font-size: 18px;
  margin: 0;
}

.dashboard-tile-booking p {
  font-size: 24px;
  margin: 5px 0 20px 0;
}

.graph {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: flex-end;
  height: 300px;
}
.bar-fill:hover {
  background-color: black;
}

.bar-fill:hover::after {
  content:"Error";
  display: block;
  position: absolute;
  top: 102%;
  left: 50%;
  transform: translateX(-50%);
  background-color: #CBC7C7;
  color: black;
  padding: 5px 10px;
  border-radius: 5px;
  font-size: 14px;
}

.bar-graph {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 50px;
}

.bar {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.bar-fill {
  background-color: #0077cc;
  height: 0;
  width: 40px;
  transition: height 0.5s ease;
}

.bar-label {
  margin-top: 5px;
  font-size: 12px;
  text-align: center;
  transform: rotate(-90deg);
}

  
</style>
<?php
$email = $user-> get_user_email($id);
$user_id = $user->get_user_id($email);
if($user->list_users() != false){
  foreach($user->list_users() as $value){
     extract($value);
     
  }
}
?>







<div class="dashboard-container">
  <a href = "index.php?page=user&subpage=view">
  <div class="dashboard-tile">
    <img src="img/user.png" alt="userpng" class="userpng">
    <div>
      <h2>Total number of users</h2>
      <?php
      $count = 0;
      $user_list = $user->list_users();
      $count = count($user_list);
      ?>
      <p><?php echo $count; ?></p>
</a>
    </div>
  </div>
  <div class="dashboard-tile-driver">
  <a href="index.php?page=user&subpage=driverview">
    <img src="img/user.png" alt="userpng" class="userpng">
    <div>
      <h2>Total number of drivers</h2>
      <?php
      $count = 0;
      $driver_list = $driver->list_driver();
      $count = count($driver_list);
      ?>
      <p><?php echo $count; ?></p>
</a>
    </div>
  </div>
  <div class="dashboard-tile-driver">
  <a href="index.php?page=user&subpage=taxiview">
    <img src="img/user.png" alt="userpng" class="userpng">
    <div>
      <h2>Total number of taxis</h2>
      <?php
      $count = 0;
      $taxi_list = $taxi->list_taxi();
      $count = count($taxi_list);
      ?>
      <p><?php echo $count; ?></p>
</a>
    </div>
  </div>
  <div class="dashboard-container-booking">
  <div class="dashboard-tile-booking">
    <h2>Total of Booking Prices</h2>
    <p>₱<?php echo $booking->get_total_price(); ?></p>
    <div class="graph">
      <?php
        $prices_by_month = $booking->get_booking_prices_by_month();
        $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $max_price = max($prices_by_month);
        $total_price = $booking->get_total_price();
        
        foreach ($months as $index => $month) {
          $price = isset($prices_by_month[$index + 1]) ? $prices_by_month[$index + 1] : 0;
          $height = ($price / $total_price) * 250;
      ?>
        <div class="bar" data-price="<?php echo $price; ?>">
          <div class="bar-fill" style="height: <?php echo $height; ?>px;"></div>
          <div class="bar-label"><?php echo $month; ?></div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>



</body>