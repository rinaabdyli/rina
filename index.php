<?php
session_start(); // Nis sesionin

// Kontrolloni nëse përdoruesi është i kyçur
if (!isset($_SESSION['username'])) {
    // Përdoruesi nuk është i kyçur, mund të ridrejtohet në faqen e hyrjes
    header("Location: login.php");
    exit(); 
}

// Merr librat nga baza e të dhënave
include 'db.php';
$books_query = "SELECT * FROM books";
$books_result = $conn->query($books_query);

// Kontrollo nëse ka gabim në kërkesën SQL
if (!$books_result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="main-title">Welcome to the Library</h1>
        <h2>Available Books</h2>

        <!-- Butoni i Logout -->
        <a href="logout.php" class="btn-logout">Logout</a>

        <div class="books-list">
            <?php while ($book = $books_result->fetch_assoc()) { ?>
                <div class="book-item">
                    <h3><?php echo $book['title']; ?></h3>
                    <p>Author: <?php echo $book['author']; ?></p>
                    <p>Available Quantity: <?php echo $book['quantity']; ?></p>
                    <!-- Forma për butonin Borrow -->
                    <?php if ($book['quantity'] > 0) { ?>
                        <form action="borrow.php" method="post">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <button type="submit">Borrow</button>
                        </form>
                    <?php } else { ?>
                        <p style="color: red;">Not Available</p>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>

