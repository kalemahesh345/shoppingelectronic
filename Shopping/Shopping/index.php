<?php
include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

// Redirect to login if the user is not logged in
if (!isset($user_id)) {
    header('location:login.php');
}

// Logout functionality
if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:login.php');
}

// Add to cart functionality
if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Product already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO cart(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
        $message[] = 'Product added to cart!';
    }
}

// Get the cart count
$cart_count_query = mysqli_query($conn, "SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = '$user_id'") or die('query failed');
$cart_count = mysqli_fetch_assoc($cart_count_query)['cart_count'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
            body {
        padding-top: 56px; /* Adjust based on the height of your navbar */
    }
        .hero {
            background: linear-gradient(to right, #ff9a9e, #fad0c4);
            color: white;
            padding: 50px 20px;
            text-align: center;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            transition: 0.3s;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #007bff;">
    <div class="container">
        <a class="navbar-brand text-white" href="#">E-Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                    <a class="nav-link position-relative text-white" href="cart.php">
                        <i class="fas fa-shopping-cart"></i> Cart
                        <?php if ($cart_count > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?php echo $cart_count; ?>
                            </span>
                        <?php endif; ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="login.php">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="register.php">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to logout?');">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- NAV END -->





    <!-- Hero Section -->
    <div class="hero">
        <h1>Welcome to E-Shop</h1>
        <p>Your one-stop shop for everything!</p>
    </div>

    <!-- Latest Products -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Latest Products</h2>
        <div class="row g-4">
            <?php
            $select_product = mysqli_query($conn, "SELECT * FROM products") or die('query failed');
            if (mysqli_num_rows($select_product) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($select_product)) {
            ?>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <img src="images/<?php echo $fetch_product['image']; ?>" class="card-img-top img-fluid" alt="<?php echo $fetch_product['name']; ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $fetch_product['name']; ?></h5>
                                <p class="card-text">$<?php echo $fetch_product['price']; ?></p>
                                <form method="post">
                                    <input type="number" min="1" name="product_quantity" value="1" class="form-control mb-2">
                                    <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                    <button type="submit" name="add_to_cart" class="btn btn-primary w-100">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
<footer class="text-center text-lg-start bg-dark text-white mt-auto">
    <div class="container p-4">
        <!-- Social Media Section -->
        <section class="mb-4">
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button">
                <i class="fab fa-twitter"></i>
            </a>
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button">
                <i class="fab fa-instagram"></i>
            </a>
            <a class="btn btn-outline-light btn-floating m-1" href="#" role="button">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </section>

        <!-- Links Section -->
        <section class="">
            <div class="row">
                <!-- About Us -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="text-uppercase">About Us</h5>
                    <p>
                        E-Shop is your trusted online destination for quality products and exceptional service.
                    </p>
                </div>
                <!-- Quick Links -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="text-uppercase">Quick Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">Shop</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                        <li><a href="#" class="text-white">FAQ</a></li>
                    </ul>
                </div>
                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="text-uppercase">Contact Info</h5>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> 123 E-Shop St, Shopping City<br>
                        <i class="fas fa-phone"></i> +123 456 7890<br>
                        <i class="fas fa-envelope"></i> support@eshop.com
                    </p>
                </div>
            </div>
        </section>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © <?php echo date("Y"); ?> E-Shop. All rights reserved.
    </div>
</footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
