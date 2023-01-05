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
            /* position cover headline in the bottom right corner */
            position: absolute;
            right: 20px;
            bottom: 10px;
        }

        .cover-pic {
            height: 100%;
            width: 100%;
        }

        .menubar {
            background-color: rgba(192,48,48, 0.7);
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
</body>
</html>