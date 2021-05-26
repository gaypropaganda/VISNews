<!DOCTYPE html>
<html>

<head>
    <title>Новости</title>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/c1e74d5c92.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">


<body>
    <header class="header">
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <a href="/"><img src="img/logo.png" alt="logo" width="180" height="70"></a>
                </div>
                <div class="nav">
                    <ul class="menu">
                        <li><a href="/">Главная</a></li>
                        <li><a class="drop" href="#">Категории <i class="fas fa-caret-down"></i></a></li>
                        <div class="wrapper">
                            <ul class="menu-bar">
                                <?php
                                require __DIR__ . '/templates/functions.php';
                                $rubArr = getRubric();
                                foreach ($rubArr as $rub) : ?>
                                    <li><a href="index.php?page=rubric&id=<?php echo $rub[0] ?>"><?php echo $rub[1] ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </ul>
                </div>
                <div>
                    <a class="enter-btn" href="#">Войти</a>
                </div>
            </div>
        </div>
    </header>
    <script>
        const drop_btn = document.querySelector(".drop");
        const menu = document.querySelector('.wrapper');
        drop_btn.onclick = () => {
            menu.classList.toggle('show');
        };
    </script>
    <!--Header-->
    <main class="main">
        <div class="container">
            <?php

            if (!isset($_GET['page'])) {
                require __DIR__ . '/templates/loadNews.php';
            } elseif ($_GET['page'] == 'news') {
                $id = $_GET['id'];
                require __DIR__ . '/templates/opened.php';
            } elseif ($_GET['page'] == 'rubric') {
                
                require __DIR__ . '/templates/rubricFilter.php';
            }
            ?>

        </div>
    </main>
    <!--Main-->
    <footer class="footer">
        <div class="copyright">COPYRIGHT 2021</div>
        <div class="footer-logo">
            <img src="img/logo.png" alt="" width="170">
        </div>
    </footer>
</body>

</html>