<!DOCTYPE html>
<html lang="en">
    <div class="wrapper">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edwin's Portfolio</title>
            <link rel="stylesheet" href="../styles/global.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        </head>
        <body>
            <header>
                <nav>
                    <ul class="sidebar">
                        <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="work.php">Work</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                    <ul>
                        <li><a href="welcome.php">Edwin Chen</a></li>
                        <li class="hideOnMobile"><a href="about.php">About</a></li>
                        <li class="hideOnMobile"><a href="work.php">Work</a></li>
                        <li class="hideOnMobile"><a href="contact.php">Contact</a></li>
                        <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
                    </ul>
                </nav>

                <script>
                    function showSidebar() {
                        const sidebar = document.querySelector(".sidebar");
                        sidebar.style.display = 'flex';
                    }

                    function hideSidebar() {
                        const sidebar = document.querySelector(".sidebar");
                        sidebar.style.display = 'none';
                    }
                </script>
            </header>
