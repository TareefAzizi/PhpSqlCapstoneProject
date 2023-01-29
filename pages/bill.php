<?php



    function isLoggedIn()
{
    // if the user is logged in, it will return true
    // if the user is not logged in, it will return false
    return isset( $_SESSION['user'] );
}

    // make sure it's POST request
    if ( $_SERVER["REQUEST_METHOD"] === 'GET' ) {

        // do error check
        // make sure cart is not empty


        // make sure user is already logged in
        if ( !isLoggedIn() ) {
            $error = "You must be logged in to checkout";
        }

        // only proceed if there are no errors
        if ( !isset( $error ) ) {
            // proceed with bill creation
            $orders = new Bills();
  

            // create new bill
            $bill_url = $orders->getBills(
                $_SESSION['user']['id'], // $user_id
                $_GET['bill_id'] , // $user_id
                // [BILLPLZ_COLLECTION_ID], // $user_id

              );
              // var_dump($bill_id);
              echo '<div class ="container spacing">';
              echo '<table class="bill-table">';
              foreach ($bill_url as $key => $value) {
                if ($key != "reference_1_label" && $key != "reference_1" && $key != "reference_2_label" && $key != "reference_2" && $key != "redirect_url" && $key != "callback_url"&& $key != "url") {
                  echo '<tr class="bill-row">';
                  echo '<td class="bill-key">' . $key . ':','</td>';
                  echo '<td class="bill-value">' . $value . '</td>';
                  echo '</tr>';
                }
              }
              echo '</table>';
              echo '</div>';
              

            // make sure bill url is valid url


        }

    }

    require "parts/header.php";
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <a href="/orders" ><button class="custom-btn btn-2" > Orders</button>
</a>
            </div>
        </div>
    </div><!-- .container -->
    <?php
        require "parts/footer.php";