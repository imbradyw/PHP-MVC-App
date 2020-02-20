<?php include '../view/header.php'; ?>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Book Listings</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../main.css">
</head>
<main>

<h1>Books</h1>

<a href="?action=add_book" title="Add a Book">Add a New Book</a>
<a href="?action=logout" title="Add a Book">Logout</a>

<div class="col-sm-6">
    <form method="get" action="index.php">
        <label for="keywords">Enter Keywords to Search:</label>
        <input name="keywords" type="text"/>
        <select name="search_type">
            <option value="OR">Any Keyword</option>
            <option value="AND">All Keywords</option>
        </select>
        <input type="hidden" name="action" value="search" />
        <button type="submit" class="btn btn-success">Search</button>
     </form>
</div>


    <table class="table table-striped"><thead><th>Title</th><th>Genre</th>
    <th>Review</th><th>Name</th><th>Email</th><th>Link</th><th>Image</th></thead><tbody>
<?php foreach($books as $book) : ?>
        <tr>
        <td><?php echo $book['book_title']; ?></td>
        <td><?php echo $book['book_genre']; ?></td>
        <td><?php echo $book['book_review']; ?></td>
        <td><?php echo $book['reviewer_name']; ?></td>
        <td><?php echo $book['reviewer_email']; ?></td>
        <td><div id="imgbox"><img class="myimg" src=<?php echo '"' . UPLOADPATH . $book['book_img'] . '"'; ?> alt = "User Image"/></div></td>
        <td><?php echo $book['book_img']; ?></td>
        </tr>
        <?php endforeach; ?>
</tbody></table>
</main>
<?php include '../view/footer.php'; ?>