<?php
session_start();
include 'db.php';

// Kontrollo nëse përdoruesi është regjistruar si admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Përditësimi i sasisë së librave
if (isset($_POST['update_quantity'])) {
    $book_id = $_POST['book_id'];
    $new_quantity = $_POST['quantity'];

    // Sigurohuni që $new_quantity është një numër i vlefshëm
    if (is_numeric($new_quantity) && $new_quantity >= 0) {
        // Query për përditësimin e sasisë
        $update_query = "UPDATE books SET quantity = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $new_quantity, $book_id);

        // Ekzekuto queryn
        if ($stmt->execute()) {
            $_SESSION['notification'] = "Quantity updated successfully!";
        } else {
            $_SESSION['notification'] = "Error updating quantity: " . $conn->error;
        }
        $stmt->close();
    } else {
        $_SESSION['notification'] = "Please enter a valid quantity.";
    }

    // Ridrejto në admin_dashboard.php për të shfaqur mesazhin
    header("Location: admin_dashboard.php");
    exit();
}

// Merr librat nga baza e të dhënave
$books_query = "SELECT * FROM books";
$books_result = $conn->query($books_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Admin Dashboard</h1>

        <!-- Notifikimi i suksesit/gabimit -->
        <?php if (isset($_SESSION['notification'])) { ?>
            <div class="notification">
                <?php echo $_SESSION['notification']; ?>
                <?php unset($_SESSION['notification']); ?>
            </div>
        <?php } ?>

        <!-- Librat dhe mundësia për të përditësuar sasinë -->
        <h2>Manage Books</h2>
        <div class="books-list">
            <?php while ($book = $books_result->fetch_assoc()) { ?>
                <div class="book-item">
                    <h3><?php echo $book['title']; ?></h3>
                    <p>Author: <?php echo $book['author']; ?></p>
                    <p>Current Quantity: <?php echo $book['quantity']; ?></p>

                    <!-- Formë për përditësimin e sasisë -->
                    <form action="admin_dashboard.php" method="POST">
                        <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                        <input type="number" name="quantity" value="<?php echo $book['quantity']; ?>" min="0" required>
                        <button type="submit" name="update_quantity">Update Quantity</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>


