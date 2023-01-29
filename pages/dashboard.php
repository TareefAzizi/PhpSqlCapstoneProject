<?php

// make sure the user has a valid role
if (!Authentication::whoCanAccess('user')) {
    header('Location: /login');
    exit;
}

require dirname(__DIR__) . '/parts/header.php';
echo "<link rel='stylesheet' type='text/css' href='/part/style.css' />";
?>
<div class="  mx-auto ">
 
      <h1 class="h1 mb-4 mt-5 text-white text-center"><span class="span-header" >My Dashboard</span></h1>
      </div><!-- .row -->

      <div class="dashboard-container">

        <div class="dashboard-card">
            <div class="face face1">
                <div class="content">
                    <img src="shop.svg" style="width:150px;">
                    <h3>Access the Store</h3>
                </div>
            </div>

            <div class="face face2">
                <div class="content">
                    <p>Access the stores main page and buy items that are for sale.</p>
                        <a href="/shopping-page"  ><button class ="custom-btn btn-7"> Access</button> </a>
                </div>
            </div>
        </div>
        <!-- manage users start -->
        <?php if (Authentication::whoCanAccess('admin')): ?>


          <div class="dashboard-card">
            <div class="face face1">
                <div class="content">
                    <img src="/people.svg" style="width:150px">
                    <h3>Manage Users</h3>
                </div>
            </div>

            <div class="face face2">
                <div class="content">
                    <p>Manage Users, Edit User roles, Delete User Roles. <br> Use your power wisely. </p>
                    <a href="/manage-users"  ><button class ="custom-btn btn-7"> Access</button> </a>
                </div>
            </div>
        </div>
       
          <?php endif; ?>  <!-- manage users end -->

   
<?php if (Authentication::whoCanAccess('admin') || Authentication::whoCanAccess('editor')): ?>

          <div class="dashboard-card">
            <div class="face face1">
                <div class="content">
                    <img src="/file-binary-fill.svg" style="width:150px">
                    <h3>Manage Products</h3>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                    <p>Add Products, Edit Product details, Delete Products. <br> Use your power wisely. </p>
                    <a href="/manage-products"  ><button class ="custom-btn btn-7"> Access</button> </a>
                </div>
            </div>
        </div>
        <?php endif; ?> 

        <div class="dashboard-card">
            <div class="face face1">
                <div class="content">
                    <img src=  "/bag.svg" style="width:150px">
                    <h3>Go to cart</h3>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                    <p>Access your cart</p>
                    <a href="/cart"  ><button class ="custom-btn btn-7"> Access</button> </a>
                </div>
            </div>
        </div>

        

    
      </div>

 
 



      

    <div class="mt-4 d-flex justify-content-center">
      <?php if (Authentication::isLoggedIn()): ?>
        <a href="/logout" class="btn btn-link btn-sm text-center"><button class="custom-btn btn-10" >  Logout </button></a>
      <?php
else: ?>
        <a href="/login" class="btn btn-link btn-sm"><button class="custom-btn btn-10" >  Login </button></a>
        <a href="/signup" class="btn btn-link btn-sm"><button class="custom-btn btn-10" >  Sign Up </button></a>
      <?php
endif; ?>
      </div>

    </div>

    <?php


require dirname(__DIR__) . '/parts/footer.php';
