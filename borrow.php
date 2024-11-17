<?php
include 'db.php';

// Kontrollo nëse është bërë kërkesa me metodën POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];

    // Kontrollo nëse libri ekziston dhe ka sasi të mjaftueshme
    $book_query = "SELECT * FROM books WHERE id = $book_id";
    $book_result = $conn->query($book_query);

    if ($book_result->num_rows > 0) {
        $book = $book_result->fetch_assoc();

        if ($book['quantity'] > 0) {
            // Përditëso sasinë e librit
            $new_quantity = $book['quantity'] - 1;
            $update_query = "UPDATE books SET quantity = $new_quantity WHERE id = $book_id";

            if ($conn->query($update_query)) {
                echo "<script>alert('Book borrowed successfully!'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Error borrowing the book.'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('Book is not available.'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Book not found.'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='index.php';</script>";
}
?>
