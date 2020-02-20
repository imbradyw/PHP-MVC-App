<?php
require('../model/database.php');
require('../model/book_db.php');

$action = filter_input(INPUT_POST, 'action');
        if ($action == NULL) 
        {
            $action = filter_input(INPUT_GET, 'action');
            if ($action == NULL) 
            {
                $action = 'list_books';
            }
        }

//Checks to see if user_id is set in the session
if(isset($_SESSION['user_id']))
{
    if($_SESSION['user_id'] == 1) //Checks if the user id is 1 (admin)
    {
        if ($action == 'list_books')
        {
            $books = get_books();
            include('admin.php');
        }

        else if($action == 'delete_book')
        {
            $book_id = filter_input(INPUT_POST, 'book_id',
                    FILTER_VALIDATE_INT);
            if ($book_id == NULL || $book_id == FALSE)
            {
            } 
            else
            { 
                delete_book($book_id);
                header("Location: index.php");
            }
        }

        else if($action == 'add_book')
        {
            include('save_book.php');
        }

        else if($action == 'save_book')
        {
            $book_title = filter_input(INPUT_POST, 'book_title');
            $book_genre = filter_input(INPUT_POST, 'book_genre');
            $book_review = filter_input(INPUT_POST, 'book_review');
            $reviewer_name = filter_input(INPUT_POST, 'reviewer_name');
            $reviewer_email = filter_input(INPUT_POST, 'reviewer_email');
            $book_link = filter_input(INPUT_POST, 'book_link');
            $book_img = $_FILES['book_img']['name'];

            $photo = $_FILES['book_img']['name'];
            $photo_type = $_FILES['book_img']['type'];
            $photo_size = $_FILES['book_img']['size'];

            if($book_title == null || $book_genre == null || $book_review == null || $reviewer_name == null || $reviewer_email == null || $book_link == null)
            {
                echo 'YOU SUCK';
            }

            else
            {
                if (!(($photo_type == 'image/gif') || ($photo_type == 'image/jpg') || ($photo_type == 'image/jpeg') || ($photo_type == 'image/png')))
                {
                    echo 'THIS IS THE OTHER TIME YOU SUCK';
                }
                else
                {
                    $target = UPLOADPATH . $photo;
                    if(move_uploaded_file($_FILES['book_img']['tmp_name'], $target));
                    add_book($book_title, $book_genre, $book_review, $reviewer_name, $reviewer_email, $book_link, $book_img);
                    header("Location: index.php");
                }
            }
        }

        else if($action == 'logout')
        {
            logout();
            header('Location: index.php');
        }

        else if($action == 'search')
        {
            $keywords = $_GET['keywords'];
            $search_type = $_GET['search_type'];

            if(!empty($keywords))
            {
                $books = search($keywords, $search_type);
                include('book_list.php');
            }
            else
            {
                $books = get_books();
                include('book_list.php');
            }
        }
    }


    else //Where regular users will be sent
    {
        //All of these check what action is set to and open the correct page/perform the action
        if ($action == 'list_books')
        {
            $books = get_books();
            include('book_list.php');
        }

        else if($action == 'add_book')
        {
        	include('save_book.php');
        }

        else if($action == 'save_book')
        {
            $book_title = filter_input(INPUT_POST, 'book_title');
            $book_genre = filter_input(INPUT_POST, 'book_genre');
            $book_review = filter_input(INPUT_POST, 'book_review');
            $reviewer_name = filter_input(INPUT_POST, 'reviewer_name');
            $reviewer_email = filter_input(INPUT_POST, 'reviewer_email');
            $book_link = filter_input(INPUT_POST, 'book_link');
            $book_img = $_FILES['book_img']['name'];

            $photo = $_FILES['book_img']['name'];
            $photo_type = $_FILES['book_img']['type'];
            $photo_size = $_FILES['book_img']['size'];

            if($book_title == null || $book_genre == null || $book_review == null || $reviewer_name == null || $reviewer_email == null || $book_link == null)
            {
            	echo 'YOU SUCK';
            }

            else
            {
                if (!(($photo_type == 'image/gif') || ($photo_type == 'image/jpg') || ($photo_type == 'image/jpeg') || ($photo_type == 'image/png')))
                {
                    echo 'THIS IS THE OTHER TIME YOU SUCK';
                }
                else
                {
                    $target = UPLOADPATH . $photo;
                    if(move_uploaded_file($_FILES['book_img']['tmp_name'], $target));
                	add_book($book_title, $book_genre, $book_review, $reviewer_name, $reviewer_email, $book_link, $book_img);
                	header("Location: index.php");
                }
            }
        }

        else if($action == 'logout')
        {
            logout();
            header('Location: index.php');
        }

        else if($action == 'search')
        {
            $keywords = $_GET['keywords'];
            $search_type = $_GET['search_type'];

            if(!empty($keywords))
            {
                $books = search($keywords, $search_type);
                include('book_list.php');
            }
            else
            {
                $books = get_books();
                include('book_list.php');
            }
        }
    }
}

else
{
    if(!($action == 'register' || $action == 'validate' || $action == 'do_register' || $action == 'register_fail'))
    {
        $action ='login';
    }

    if($action == 'login')
    {
        include('login.php');
    }

    else if($action == 'register')
    {
        include('register.php');
    }

    else if($action == 'register_fail')
    {
        include('register.php');
        echo 'Passwords must match.';
    }

    else if($action == 'validate')
    {
        $username = filter_input(INPUT_POST, 'username');
        $password = hash('sha512', $_POST['password']);
        validate($username, $password);
        header("Location: index.php");
    }

    else if($action == 'do_register')
    {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $confirm = filter_input(INPUT_POST, 'confirm');
        if($password != $confirm)
        {
            header("Location: index.php?action=register_fail");
        }
        else
        {
            save_registration($username, $password, $confirm);
            header("Location: index.php?action=login");
        }
    }
}

?>