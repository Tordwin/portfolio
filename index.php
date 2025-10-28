<?php
    include("header.php");
?>

<link rel="stylesheet" href="styles/welcome.css">
<div class="top-block">
    <p id="quote"></p>

    <script>
        // List of quotes to display
        const quotes = [
            "“You should name a variable using the same care with which you name a first-born child.” — Robert C. Martin",
            "“Clean code always looks like it was written by someone who cares.” — Robert C. Martin",
            "“Practice, Practice, Practice! Musicians don’t only play when they are on stage in front of an audience.”— Michael Toppa",
            "“Perfection is achieved not when there is nothing more to add, but rather when there is nothing more to take away.” — Antoine de Saint-Exupery",
            "“Any fool can write code that a computer can understand. Good programmers write code that humans can understand.” — Martin Fowler",
            "“Programming isn't about what you know; it's about what you can figure out.” — Chris Pine"
        ];
        // Selecting random quote to display
        const quote = document.getElementById("quote");
        const ranIndex = Math.floor(Math.random() * quotes.length);
        quote.textContent = quotes[ranIndex];
    </script>
</div>

<div class="about-block">
    <div class="about-me">
        <h1>About Me</h1>
        <p> 
            Welcome! I am Edwin Chen, a Computing & Information Technology student at Rochester Institute of Technology.
            I am passionate about software development, web applications, database integrations, and website creation.
            I have hands-on experience with languages such as Python, JavaScript, SQL, PHP, React and much more!
            I enjoy applying my skills to projects that allow for creativity and problem-solving with real life applications.
            Having experienced RIT's co-op programs, I have developed and strengthened my communication and leadership abilities.
            I am enthusiastic about technology and I enjoy bringing ideas to life through the fingertips.
        </p>
    </div>
    <div class="about-picture">
        <img src="images/portrait.jpg" alt="Portrait of Edwin Chen" />
    </div>
</div>

<?php
    include ("footer.php");
?>