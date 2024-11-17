<?php
include 'db.php';

// Fshij librin nëse është dërguar kërkesa për fshirje
if (isset($_POST['delete_book'])) {
    $book_id = $_POST['book_id'];
    $delete_query = "DELETE FROM books WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $stmt->close();

    header("Location: admin.php"); // Rifresko faqen pas fshirjes
    exit();
}

// Merr librat për panelin e administratorit
$books_query = "SELECT * FROM books";
$books_result = $conn->query($books_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="main-title">Admin Panel</h1>
        <h2>Manage Books</h2>
        <div class="books-list">
            <?php while ($book = $books_result->fetch_assoc()) { ?>
                <div class="book-item">
                    <h3><?php echo $book['title']; ?></h3>
                    <p>Author: <?php echo $book['author']; ?></p>
                    <p>Available Quantity: <?php echo $book['quantity']; ?></p>
                    <form action="admin.php" method="POST">
                        <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                        <button type="submit" name="delete_book" class="delete-button">Delete</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
