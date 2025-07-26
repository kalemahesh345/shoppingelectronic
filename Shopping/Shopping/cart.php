<?php
include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

// Handle cart updates
if (isset($_POST['update_cart'])) {
    $update_quantity = $_POST['cart_quantity'];
    $update_id = $_POST['cart_id'];
    mysqli_query($conn, "UPDATE cart SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
    $message[] = 'Cart quantity updated successfully!';
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$remove_id'") or die('query failed');
    header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add this in the head section for Font Awesome icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #007bff;">
    <div class="container">
        <a class="navbar-brand text-white" href="#">E-Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                <li class="nav-item">
                    <button class="btn btn-light btn-sm ms-2 mt-1" onclick="window.location.href='index.php';">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>





    <!-- Cart Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Shopping Cart</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cart_query = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'") or die('query failed');
                $grand_total = 0;
                if (mysqli_num_rows($cart_query) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
                        $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                        $grand_total += $sub_total;
                ?>
                    <tr>
                        <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="50" alt=""></td>
                        <td><?php echo $fetch_cart['name']; ?></td>
                        <td>$<?php echo $fetch_cart['price']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                <input type="number" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>" class="form-control w-50 mx-auto">
                                <button type="submit" name="update_cart" class="btn btn-sm btn-secondary mt-2">Update</button>
                            </form>
                        </td>
                        <td>$<?php echo $sub_total; ?></td>
                        <td>
                            <a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Remove item from cart?');">Remove</a>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="6">No items in the cart</td></tr>';
                }
                ?>
                <tr class="table-info">
                    <td colspan="4"><strong>Grand Total:</strong></td>
                    <td><strong>$<?php echo $grand_total; ?></strong></td>
                    <td>
                        <a href="cart.php?delete_all" class="btn btn-danger btn-sm <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>" onclick="return confirm('Delete all items from cart?');">Delete All</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Button to Generate Bill -->
    <div class="d-flex justify-content-center">
        <a href="generate_bill.php?user_id=<?php echo $user_id; ?>" class="btn btn-primary btn-lg mt-3" <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>>Generate Bill</a>
    </div>

</div>

    
    <!-- link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
