<!-- HTML Head Module -->
<?php include "resources/head.php"?>
        <!-- Title -->
        <title>Comments!</title>
        <!-- It's own stylesheet -->
        <link rel="stylesheet" href="css/comments.css">
    </head>
    <!-- Nav Bar Module -->
    <header><?php include "resources/header.php"?></header>
    <body>
        <!-- Content Start -->
        <section class="container">
            <div id="breadcrumb"><a href="index.php">Home</a> >> Comments!</div>
            <div id="form-container">
                <h2>Submit a Review!</h2>
                <form id="commentForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="name">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" placeholder="John Doe"><br>
                    <label for="email">Email:</label>
                    <input type="text" id="address" name="address" placeholder="johndoe@email.com"><br>
                    <label for="rating">Rating:</label>
                    <input type="number" id="rates" name="rates" placeholder="1-100"><br>
                    <label for="comment">Comment:</label><br>
                    <textarea id="message" name="message" rows="5" cols="30" placeholder="Write your review!"></textarea><br>
                    <input type="submit" value="Post!!!">
                </form>
            </div>
    
            <div id="comments-container">
            <h2>Reviews & Comments!</h2>
                <?php
                $conn = new mysqli("localhost", "ec7233", "Resound3!terrorist", "ec7233");

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    // PHP Sanatizing Javascript //
                    $name = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING);
                    $email = filter_var($_POST['address'], FILTER_SANITIZE_EMAIL);
                    $rating = filter_var($_POST['rates'], FILTER_SANITIZE_NUMBER_INT);
                    $comment = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

                    // PHP Validator //
                    // MUST include Full Name, Rating, and Comment //
                    if (empty($name) || empty($rating) || empty($comment)) {
                        echo "Please fill all the required fields!";
                        exit;
                    }

                    // Rating MUST be between 1 - 100 //
                    if ($rating < 1 || $rating > 100) {
                        echo "Please leave a rating between 1 - 100!";
                        exit;
                    } 
                    
                    // Email MUST include '@' and '.com' //
                    if (!preg_match('/@.*\.com$/', $email)) {
                        echo "Please enter a valid email address as it will allow us to reach back to you! It must include an @ symbol and .com";
                        exit;
                    }
                    
                    // SQL Statement and Executions //
                    $sql = "INSERT INTO italycomments (`from`, `email`, `rating`, `message`, `date`) VALUES (?, ?, ?, ?, now())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssis", $name, $email, $rating, $comment);
                    $stmt->execute();
                }

                $sql = "SELECT `from`, `rating`, `message`, `date` FROM italycomments";
                $result = $conn->query($sql);

                // Printing Out the Comments from Database
                echo "<div id='comments'>";
                echo "<ul>";
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<li><font color='lightgreen'>" 
                        . $row["from"] . " </font>" 
                        . $row["rating"] . "/100: "
                        . $row["message"] . " @ <font color='grey'>" 
                        . $row["date"] . "</font></li>";
                    }
                }
                echo "</ul>";
                echo "</div>";
                $conn->close();
                ?>
            </div>
        </section>
		<!-- Content End -->
		<!-- Footer Module -->
        <?php include "resources/footer.php"?>
        <!-- Validation Script -->
        <script>
            document.getElementById("commentForm").addEventListener("submit", function(event) {
                var name = document.getElementById("fullname").value;
                var email = document.getElementById("address").value;
                var rating = document.getElementById("rates").value;
                var comment = document.getElementById("message").value;

                // Email Pattern //
                var pattern = /@.*\.com$/;

                // Must include Full Name, Rating, and Comment //
                if (!name || !rating || !comment) {
                    alert("Please fill all the required fields!");
                    event.preventDefault();
                } 
                // Rating MUST be between 1 - 100 //
                else if (rating < 1 || rating > 100) {
                    alert("Please leave a rating between 1 - 100!");
                    event.preventDefault();
                } 
                // Email MUST include '@' and '.com' //
                else if (!email.match(pattern)) {
                    alert("Please enter a valid email address as it will allow us to reach back to you! It must include an @ symbol and .com");
                    event.preventDefault();
                }
            });
        </script>
    </body>
</html>