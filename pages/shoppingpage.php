<?php


// require "includes/class-products.php";
// make sure only admin can access
if ( !Authentication::whoCanAccess('user') ) {
  header('Location: /dashboard');
  exit;
}

// step 1: set CSRF token
CSRF::generateToken( 'add_products_form' );

// step 2: make sure post request
if ( $_SERVER["REQUEST_METHOD"] === 'POST' ) {

  // step 3: do error check
   $rules = [
    'name' => 'required',
    'content' => 'required'

  ];

  $error = FormValidation::validate(
    $_POST,
    $rules
  );


  // make sure there is no error
  if ( !$error ) {

    // step 4 = add new user
    Products::add(
      $_POST['name'],
      $_POST['price'],
      $_SESSION['user']['id']
  
    );

    // step 5: remove the CSRF token
    CSRF::removeToken( 'add_products_form' );

    // step 6: redirect to manage users page
    header("Location: /manage-products");
    exit;

  } // end - $error


} // end - $_SERVER["REQUEST_METHOD"]

    // call the Products class
    $products = new Products();

    // list out the products
    $products_list = $products->listAllProducts();

    function isLoggedIn()
{
    // if the user is logged in, it will return true
    // if the user is not logged in, it will return false
    return isset( $_SESSION['user'] );
}


require dirname(__DIR__) . '/parts/header.php';

?>
    <div class="container mt-5 mb-2 mx-auto" style="max-width: 900px;">
      <div class="h-75">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="h1">The Store</h1>
 
          <div class="d-flex align-items-center justify-content-end gap-3">
            <a href="/dashboard" ><button class="custom-btn btn-3" style="background-color:#1B263B"> Dashboard</button> </a>
          </div>
        </div>

        <!-- products -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php foreach( $products_list as $product) : ?>
          <div class="col">
            <div class="card h-100">
              <img
                src= "<?php echo $product['image_url']; ?>"
                class="card-img-top"
                alt="Product 1"
              />
              <div class="card-body text-center">
                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                <p class="card-text"><?php echo '$' . $product['price']; ?></p>
                <!-- when button is clicked, user will go to cart page -->
                <form 
                  method="POST"
                  action="/cart"
                >
                  <!-- product id will pass to the cart page -->
                  <input 
                    type="hidden" 
                    name="product_id" 
                    value="<?php echo $product['id']; ?>"
                  >
                  <button class="custom-btn btn-3">Add to cart</button>
                </form>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>


      <?php if ( isLoggedIn() ) : ?>

      <div class="d-flex justify-content-center  mt-5">
      <div class=" align-items-center ms-3">
           <a href="/orders">  <button class = "custom-btn btn-2" > <i class="bi bi-receipt"> Orders </i></button> 
          </div>
        <div class=" align-items-center ms-3">
           <a href="/cart">  <button class = "custom-btn btn-2" > <i class="bi bi-bag"> Cart </i></button> 
          </div>
      <div>
      </div>
      </div>
      <?php endif; ?>

      <!-- footer -->
      <div class="d-flex justify-content-ce align-items-center pt-4 pb-2">

        <div class=" align-items-center gap-3">
        <?php if ( isLoggedIn() ) : ?>
          <a href="/logout" class="btn btn-dark btn-sm">Logout</a>
        <?php else : ?>
          <a href="/login" class="btn btn-dark btn-sm">Login</a>
          <a href="/signup" class="btn btn-dark btn-sm">Sign Up</a>
        <?php endif; ?>
        </div>
      </div>
    </div>

<?php

    require "parts/footer.php";