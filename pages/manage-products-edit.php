<?php
// load post data
$products = Products::getProductsById($_GET['id']);
// step 1: set CSRF token
CSRF::generateToken('edit_products_form');
// step 2: make sure post request
if ( $_SERVER["REQUEST_METHOD"] === 'POST' ) {
  // step 3: do error check
  $rules = [
    'name' => 'required',
    'price' => 'required',
    'image_url' => 'required',
    'status' => 'required',
    'csrf_token' => 'edit_products_form_csrf_token'
  ];
  $error = FormValidation::validate(
    $_POST,
    $rules
  );
  // make sure there is no error
  if ( !$error ){
    // step 4: update post
    Products::update(
      $products['id'], // id
      $_POST['name'], // title
      $_POST['price'], // content
      $_POST['image_url'], // url
      $_POST['status']// status
      
    );
    // step 5: remove CSRF token
    CSRF::removeToken('edit_products_form');
    // step 6: redirect back to manage posts page
    header("Location: /manage-products");
    exit;
  }
}
require dirname(__DIR__) . "/parts/header.php";
?>


  <body>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Products</h1>
      </div>
      <div class="card mb-2 p-4">
        <?php require dirname( __DIR__ ) . '/parts/error_box.php'; ?>
        <form
          method="POST"
          action="<?php echo $_SERVER['REQUEST_URI']; ?>"
        >
          <div class="mb-3">
            <label for="products-title" class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              id="products-title"
              name="name"
              value="<?php echo $products ['name']; ?>"
            />
          </div>

          <div class="mb-3">
            <label for="products-price" class="form-label">Price</label>
            <input
              type="text"
              class="form-control"
              id="products-content"
              name="price"
              value="<?php echo $products ['price']; ?>"
            />
          </div>
          <div class="mb-3">
            <label for="products-content" class="form-label">Content</label>
            <textarea class="form-control" id="products-content" name="image_url" rows="10"><?php echo $products['image_url']; ?></textarea>
          </div>
          <div class="mb-3">
            <label for="products-content" class="form-label">Status</label>
            <select class="form-control" id="products-status" name="status">
            <?php if ( $_SESSION['user']['role'] == 'user' ) : ?>
              <option value="pending" <?php echo ( $products['status'] == 'pending' ? 'selected' : '' ); ?>>pending</option>
            <?php else: ?>
              <option value="publish" <?php echo ( $products['status'] == 'publish' ? 'selected' : '' ); ?>>Published</option>
            <?php endif; ?>
            </select>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
          <input
            type="hidden"
            name="csrf_token"
            value="<?php echo CSRF::getToken('edit_products_form'); ?>"
            />
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-products" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to products</a
        >
      </div>
    </div>
    <?php require dirname(__DIR__) . "/parts/footer.php"; ?>