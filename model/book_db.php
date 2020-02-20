<?php
session_start();
define('UPLOADPATH', '../images/');
define('MAXFILESIZE', 327680);

function get_books()
{
	global $db;
    $query = 'SELECT * FROM books';
    $statement = $db->prepare($query);
    $statement->execute();
    $books = $statement->fetchAll();
    $statement->closeCursor();
    return $books;
}

function delete_book($book_id)
{
    global $db;
    $query = 'DELETE FROM books
              WHERE book_id = :book_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':book_id', $book_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_book($book_title, $book_genre, $book_review, $reviewer_name, $reviewer_email, $book_link, $book_img)
{
	global $db;
    $query = 'INSERT INTO books
                 (book_title, book_genre, book_review, reviewer_name, reviewer_email, book_link, book_img)
              VALUES
                 (:book_title, :book_genre, :book_review, :reviewer_name, :reviewer_email, :book_link, :book_img)';
    $statement = $db->prepare($query);
    $statement->bindValue(':book_title', $book_title);
    $statement->bindValue(':book_genre', $book_genre);
    $statement->bindValue(':book_review', $book_review);
    $statement->bindValue(':reviewer_name', $reviewer_name);
    $statement->bindValue(':reviewer_email', $reviewer_email);
    $statement->bindValue(':book_link', $book_link);
    $statement->bindValue(':book_img', $book_img);
    $statement->execute();
    $statement->closeCursor();
}

function save_registration($username, $password, $confirm)
{
    global $db;
    if($password != $confirm)
    {
        header("Location: index.php?action=register");
        echo 'Password and confirm must match';
    }
    else
    {
        $hashed_password = hash('sha512', $password);

        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        $statement = $db->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $statement->bindParam(':password', $hashed_password, PDO::PARAM_STR, 128);


        $statement->execute();


        $statement->closeCursor();
    }
}

function validate($username, $password)
{
    global $db;

    $sql = "SELECT user_id FROM users WHERE username = :username AND password = :password";


    $statement = $db->prepare($sql);
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);
    $statement->execute();
    $users = $statement->fetchAll();


    if (count($users) >= 1) //Sets the session if a user is found
    {
        foreach  ($users as $user) 
        {
                $_SESSION['user_id'] = $user['user_id'];
        }
    }

   $statement->closeCursor();
}

function logout()
{
    ob_start();

    //Remove any session variables
    session_unset();

    //Terminate the user's active session
    session_destroy();

    ob_flush();
}

function search($keywords, $search_type)
{
    global $db;

    $sql = "SELECT * FROM books";

    // start the WHERE clause MAKING SURE to include spaces around the word WHERE
    $where = " WHERE ";

    // split the keywords into an array of individual words
    $word_list = explode(" ", $keywords);

    // start a counter so we know which element in the array we are at
    $counter = 1;

    // loop through the word list and add each word to the where clause individually
    foreach($word_list as $word) 
    {

        // for the first word OMIT the word OR
        if ($counter == 1) 
        {
            $where .= " book_title LIKE '%$word%' ";
        }
        else 
        {
            $where .= " $search_type book_title LIKE '%$word%' ";
        }

        // increment counter
        $counter++;
    }

    $sql .= $where;
    $sql .= ' ORDER BY book_title';

    $statement = $db->prepare($sql);
    $statement->execute();
    $books = $statement->fetchAll();
    $statement->closeCursor();
    return $books;
}

?>