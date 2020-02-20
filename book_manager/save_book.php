<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Book Details</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../main.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<main>

<h1>Book Details</h1>

<a href="index.php?/action=list_games" title="Game Listings">View Books</a>

<form action="index.php" method="post" id="add_book_form" enctype="multipart/form-data">
    <fieldset>
        <label for="book_title" class="col-sm-2">Title:</label>
        <input name="book_title" id="book_title" placeholder="Enter Book Here" required />
    </fieldset>
    <fieldset>
        <label for="book_genre" class="col-sm-2">Genre:</label>
        <input name="book_genre" id="book_genre" placeholder="Genre Here" required />
    </fieldset>
    <fieldset>
        <label for="book_review" class="col-sm-2">Review:</label>
        <textarea name="book_review" id="book_review" placeholder="Review Here" required></textarea>
    </fieldset>
    <fieldset>
        <label for="reviewer_name" class="col-sm-2">Your Name:</label>
        <input name="reviewer_name" id="reviewer_name" placeholder="Name Here" required />
    </fieldset>
    <fieldset>
        <label for="reviewer_email" class="col-sm-2">Your E-mail:</label>
        <input name="reviewer_email" id="reviewer_email" placeholder="E-mail Here" required />
    </fieldset>
    <fieldset>
        <label for="book_link" class="col-sm-2">Book Link:</label>
        <input name="book_link" id="book_link" placeholder="Enter Link Here" required />
    </fieldset>
    <fieldset>
        <label for="book_img" class="col-sm-2">Book Image:</label>
        <input type="file" name="book_img" id="book_img" required />
    </fieldset>
    <input name="book_id" id="book_id"
        type="hidden" value="Add Book" />
        <input type="hidden" name="action" value="save_book" />
        <input type="submit" value="Submit Book" class="btn btn-primary col-sm-offset-2">
    <!--<button class="btn btn-primary col-sm-offset-2">Save</button>-->
</form>
</main>