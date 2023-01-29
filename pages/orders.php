<?php



$orders = new Orders();

// make sure user already logged in
if (!isLoggedIn()) {
  // if user not logged in, redirect to login page
  header('Location: /login');
  exit;
}

$user_id = $_SESSION['user']['id'];

// var_dump( $orders->listOrders( $user_id ) );

// require the header part
require "parts/header.php";

function isLoggedIn()
{
  // if the user is logged in, it will return true
  // if the user is not logged in, it will return false
  return isset($_SESSION['user']);
}

?>
    <div class="container mt-5 mb-2 mx-auto" style="max-width: 900px;">
      <div class="min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="h1">My Orders</h1>
        </div>

        <!-- List of orders placed by user in table format -->
        <table
          class="table table-hover table-bordered table-striped table-light"
        >
          <thead>
            <tr>
              <th scope="col">Order ID</th>
              <th scope="col">Products</th>
              <th scope="col">Total Amount</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach (Orders::listOrders($user_id) as $order): ?>
            <tr>
              <th scope="row">
            <div class="d-flex justify-content-between">
              <div>
                <?php echo $order['id']; ?>
                </div>
              <div>
              


<?php  if (!empty($_POST)) {
    $bill = new Bills();
    $bill_id = $_POST['transaction_id'];  }
?>

              </div>
              </div>
              </th>
  
              
              
              <td>
                <ul class="list-unstyled">
                <?php foreach (Orders::listProductsinOrder($order['id']) as $product): ?>
                  <li><?php echo $product['name'] . ' x' . $product['quantity']; ?></li>
                  <li></li>
                <?php endforeach; ?>
                </ul>
              </td>
              <td><?php echo $order['total_amount']; ?></td>
              <td><?php echo $order['status']; ?> <a href="/bill?bill_id=<?php echo $order['transaction_id']; ?>"  > <button class="custom-btn btn-9 ms-3"> Get bill</button></a> </td>
            </tr>
          <?php endforeach; ?> 
          </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center my-3">

          <a href="/dashboard" > <button class="btn btn-dark btn-sm">Dashboard</button> </a>

        </div>


      </div>

      <!-- footer -->
      <div class="d-flex justify-content-between align-items-center pt-4 pb-2">

        <div class="d-flex align-items-center gap-3">
      <?php if (Authentication::isLoggedIn()): ?>
          <?php else: ?>           

          <a href="/login" class="btn btn-light btn-sm">Login</a>
          <a href="/signup" class="btn btn-light btn-sm">Sign Up</a>
    </div>
    <?php endif; ?>      
  </div>
    </div>

<?php

require "parts/footer.php";