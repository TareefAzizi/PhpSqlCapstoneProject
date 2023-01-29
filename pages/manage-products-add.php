<?php

// make sure only admin can access
if (!(Authentication::whoCanAccess('admin') || Authentication::whoCanAccess('editor'))) {
  header('Location: /dashboard');
  exit;
}



// step 1: set CSRF token
CSRF::generateToken('add_products_form');

// step 2: make sure post request
if ($_SERVER["REQUEST_METHOD"] === 'POST') {

  // step 3: do error check
  $rules = [
    'name' => 'required',
    'price' => 'required',
    'image_url' => 'required'

  ];

  $error = FormValidation::validate(
    $_POST,
    $rules
  );


  // make sure there is no error
  if (!$error) {

    // step 4 = add new user
    Products::add(
      // $_POST['id'],
      $_POST['name'],
      $_POST['price'],
      $_POST['image_url'],

    );

    // step 5: remove the CSRF token
    CSRF::removeToken('add_products_form');

    // step 6: redirect to manage users page
    header("Location: /manage-products");
    exit;

  } // end - $error


} // end - $_SERVER["REQUEST_METHOD"]

require dirname(__DIR__) . '/parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Add New Product</h1>
      </div>
      <div class="card mb-2 p-4">
      <?php require dirname(__DIR__) . '/parts/error_box.php'; ?>
        <form
          method="POST"
          action="<?php echo $_SERVER["REQUEST_URI"]; ?>"
          >
          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="name" class="form-label"> Product Name</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="name"
                  name="name"
                  />
              </div>
            </div>
          </div>

          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="price" class="form-label">Price</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="price"
                  name="price"
                  />
              </div>
            </div>
          </div>

          <div class="mb-3">
            <div class="row">
              <div class="col">
                <label for="image_url" class="form-label">Image</label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="image_url"
                  name="image_url"
                  />
              </div>
            </div>
          </div>



          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Add Product</button>
          </div>
          <input
            type="hidden"
            name="csrf_token"
            value="<?php echo CSRF::getToken('add_products_form'); ?>"
            />
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-products" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Users</a
        >
      </div>
    </div>
    <?php

require dirname(__DIR__) . '/parts/footer.php';