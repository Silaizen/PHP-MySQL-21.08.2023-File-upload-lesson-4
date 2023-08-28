<?php
require_once "./functions/main.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/Course.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?page=contacts">Contacts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?page=uploads">Uploads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?page=Course_purchase">Course</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <?php if (isUserAuthenticated()) : ?>
                            <li class="nav-item">
                                <form method="POST" action="index.php">
                                    <button>Выход</button>
                                    <input type="hidden" name="action" value="exitUser">
                                </form>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./index.php?page=Sign-in">Вход</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./index.php?page=Registration">Регистрация</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">

        <?php
        $page = $_GET['page'] ?? 'home';

        if (file_exists("./pages/$page.php"))
            require_once "./pages/$page.php";
        else {
            echo "<h1> Page Not Found </h1>";
        }
        OldInputs::remove();
        ?>
    </div>


    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>