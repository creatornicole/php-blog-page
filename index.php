<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Blog</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EAEDF8;
            margin: 0;
        }

        .cover {
            background-color: #343434;
            background-image: url('img/cover-articles.jpg');
            background-size: cover;
            height: 40vh;
            width: 100%;
            position: relative;
        }

        .cover h1 {
            color: white;
            font-size: 47px;
            text-shadow: black 5px 0 10px;
            /* position cover headline in the bottom right corner */
            position: absolute;
            right: 20px;
            bottom: 0px;
            margin-bottom: 10px;
        }

        .cover-pic {
            height: 100%;
            width: 100%;
        }

        .menubar {
            background-color: rgba(192,48,48, 0.9);
            text-align: right;
            padding: 20px;
            padding-right: 0;
            
        }

        .menubar a {
            color: white;
            text-decoration: none;
            padding: 20px;
        }

        .menubar a:hover {
            background-color: rgba(192,48,48,0.2);
        }

        form {
            background-color: white;
            border-radius: 3px;
            width: 400px;
            padding: 30px 130px;
            margin: 35px auto;
        }

        form input,
        form textarea {
            width: 100%;
            margin-bottom: 20px;
        }

        button[type='submit'] {
            font-family: 'Poppins', sans-serif;
            background-color: rgba(192,48,48,0.9);
            color: white;
            border: none;
            border-radius: 3px;
            width: 100px;
            padding: 7px;
        }

        button[type='submit']:hover {
            background-color: rgba(192,48,48,1);
            cursor: pointer;
        }

        .entry {
            background-color: white;
            border-radius: 3px;
            max-height: 400px;
            width: 650px;
            margin: 35px auto;
        }

        .entry-header {
            background-color: rgba(192,48,48,0.9);
            color: white;
            border-radius: 3px 3px 0px 0px;
            padding: 1px 25px;
        }

        .entry-text {
            border-radius: 0px 0px 3px 3px;
            padding: 15px 25px;
        }


        .add-call-out {
            color: green;
            /* try to replicate position and behavior of entry container */
            /* display according to entry containers */
            width: 650px;
            margin: 35px auto;           
        }

        
    </style>
</head>
<body>
    <!-- Cover -->
    <div class="cover">
        <?php
            $headline = 'Blog Entries';

            //Change Properties if Add Entry Page is Loaded
            if($_GET['page'] == 'add') {
                $headline = 'Add Blog Entry';
            } 

            echo '<h1>' . $headline . '</h1>';
        ?>
    </div>

    <!-- Menubar -->
    <div class="menubar">
        <a href="index.php?page=articles">Articles</a>
        <a href="index.php?page=add">Add Articles</a>
    </div>

    <!-- Content -->
    <div>
        <?php
            $entries = [];

            //check if textfile for saving blog entries already exists
            if(file_exists('entries.txt')) {
                //if textfile already exists, do not overwrite it
                //instead add existing content to entries array

                //get text from textfile
                $text = file_get_contents('entries.txt', true);
                //paste text to textfile, note: convert back to text first
                $entries = json_decode($text, true);
            }

            //check POST parameters
            if(isset($_POST['title']) && isset($_POST['text'])) {
                echo '<p class="add-call-out">New blog entry ' . $_POST['title'] . ' was added.';
                //create table entry
                $newEntry = [
                    'title' => $_POST['title'],
                    'text' => $_POST['text']
                ];
                //push new table entry to entries array
                array_push($entries, $newEntry);
                //paste entries array into textfile
                //json_encode -> transform array into text
                file_put_contents('entries.txt', json_encode($entries, JSON_PRETTY_PRINT));
            } 

            //display content according to page
            if($_GET['page'] == 'articles') {
                //display all existing blog entries
                foreach($entries as $row) {
                    $title = $row['title'];
                    $text = $row['text'];

                    echo "
                        <div class='entry'>
                            <div class='entry-header'>
                                <h3>$title</h3>
                            </div>
                            <div class='entry-text'>
                                <p>$text</p>
                            </div>
                        </div>
                    ";
                }
            }

            if($_GET['page'] == 'add') {
                //contains form to add more entries
                //TODO: Add Date automatically and let user choose category
                echo "
                    <form action='?page=articles' method='POST'>
                        <h2>Add New Blog Entry</h2>
                        <label for='title'>Title</label>
                        <input type='text' id='title' name='title' placeholder='Title...'></input>
                    
                        <label for='text'>Text</label>
                        <textarea id='text' name='text' rows='10' cols='55' placeholder='Text...'></textarea>

                        <button type='submit'>Upload</button>
                    </form>
                ";
            }
        ?>
    </div>
</body>
</html>