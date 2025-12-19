<?php
    include("header.php");
?>

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

<section id="welcome">
    <div class="about-picture">
        <img src="images/portrait.jpg" alt="Portrait of Edwin Chen" />
    </div>
        <div class="about-me">
            <h1>About Me</h1>
            <p> 
                Welcome! My name is Edwin and I am a Computing & Information Technology student at Rochester Institute of Technology.
                I am passionate about software development, web applications, database integrations, and website creation.
                I have hands-on experience with languages such as Python, JavaScript, SQL, PHP, React and much more!
                I enjoy applying my skills to projects that allow for creativity and problem-solving with real life applications.
                Having experienced RIT's co-op programs, I have developed and strengthened my communication and leadership abilities.
                I am enthusiastic about technology and I enjoy bringing ideas to life through the fingertips.
            </p>
            <h1>Outside the Computer</h1>
            <p>I'm someone who enjoys creativity and the technical sides of life. When I'm not coding and diving into the world of tech you'll find me 
                cooking and experimenting with new recipes, playing multiple games, or leisurely playing the violin. To stay active within this deskbound life
                I play competitive sports like volleyball, badminton, and recently bowling.
            </p>
        </div>

        <div class="extras-container">
            <div class="funfact">
                <h1>Fun Fact</h1>
                <p>My birthday is the 22nd of February, which just so happens to the be same birthday as the first president of the United States, George Washington.</p>
            </div>
            <div class="hobbies">
                <h1>My Hobbies</h1>
                <ul>
                    <li>Cooking</li>
                    <li>Games</li>
                    <li>Violin</li>
                    <li>Volleyball</li>
                    <li>Badminton</li>
                    <li>Bowling</li>
                    <li>Tech</li>
                    <li>Camping</li>
                    <li>Fishing</li>
                </ul>
            </div>
        </div>
</section>

<section id="projects">
    <h2 style="color:#00ADB5">My Projects</h2>
    <div class="projects-container">
        <div class="job-application-program">
            <img src="images/elementor-placeholder-image.jpg" alt="Placeholder">
            <h3>Job Application Tracking Program<br>Back-End Development</h3>
            <ul>
                <li>Built a full-stack program that features a Java-based GUI that would streamline tracking job applications</li>
                <li>Utilized Adminer to implement a SQL database that would store application details</li>
                <li>Programmed an automated reminder that would alert a user for a follow-up time frame</li>
                <li>Wrote optimized SQL queries to reliably and efficiently retrieve and send data</li>
                <li>Designed an intuitive Java GUI that support data entry, efficient navigation, and visualization of the job applications</li>
            </ul>
        </div>

        <div class="sfghc-program">
            <img src="images/sfghc-program.png" alt="Placeholder">
            <h3>Student Faculty Guest Help Center<br>Back-End Development</h3>
            <ul>
                <li>Designed database architecture using Lucidchart to ensure clear relationships and promote efficient data flow</li>
                <li>Built and configured database to support architecture and application authentications</li>
                <li>Populated database with data to enable testing, feature validations, and early development</li>
                <li>Implemented secure passwords by encrypting sensitive data to promote security standards</li>
                <li>Optimized the command-line interface to improve usability and a better user experience</li>
                <li>Reviewed feedback and applied the corrections for better efficiency, performance, and future proofing</li>
            </ul>
        </div>

        <div class="sdsaf-website">
            <img src="images/sdsaf-website.png" alt="Placeholder">
            <h3>Senior Development Self-Assessment Form<br>Full-End Development</h3>
            <ul>
                <li>Developed backend logic to calculate and evaluate responses from candidate and generate personalized insight</li>
                <li>Collaborated with Senior Development faculty to align the assessment to the program’s objectives</li>
                <li>Utilized and programmed the integration with Adminer to collect user data based on SQL injections</li>
                <li>Implemented accurate scoring and seamless user experience across all devices</li>
            </ul>
        </div>

        <div class="ischool-website">
            <img src="images/ischool-website.png" alt="ISchool Website">
            <h3>ISchool Website<br>Full-Stack Development</h3>
            <ul>
                <li>Developed a dynamic web application utilizing Vite and JSX, showcasing proficiency in modern web development by fetching and displaying data from an API.</li>
                <li>Enhanced user experience by integrating external modules that show progress, an advanced data visualization table, breadcrumbs for navigation, etc.</li>
                <li>Implemented modular styled frontend development utilizing JavaScript and React that incorporates frameworks and third-party libraries</li>
            </ul>
        </div>

        <div class="healthncare-program">
            <img src="images/healthncare-program.png" alt="HealthNCare Program">
            <h3>HealthNCare<br>Back-End Development</h3>
            <ul>
                <li>Designed and implemented a controller using the Model-View-Controller pattern to facilitate seamless communication between logging and user interaction modules</li>
                <li>Developed a caloric algorithm that calculates exercise-specific calorie expenditure based on the user’s weight and exercise time</li>
                <li>Collaborated with team members by refactoring and modifying existing code to integrate the exercise features ensuring a smooth implementation across the GUI</li>
            </ul>
        </div>

        <div class="italy-website">
            <img src="images/italy-website.png" alt="Italy Travel Guide Website">
            <h3>Italy Travel Guide<br>Front-End Development</h3>
            <ul>
                <li>Designed and developed a professional travel homepage for Italy to showcase travel destinations, food, services, activities, and more</li>
                <li>Utilized PHP to incorporate modular efficiency for code reuse and maintainability, JavaScript for dynamic form creation, animations, and handling user interactions, and CSS to
                    ensure a visually appealing and responsive design throughout all devices for all users</li>
            </ul>
        </div>
</section>

<section id="contact" class="contact">
    <div class="row">
        <div class="contact-block">
            <h1 class="contact-title">Contact Me!</h1>
            <p><i class="fa-solid fa-envelope"></i>Email: <a href="mailto:chenedwin6@gmail.com">chenedwin6@gmail.com</a></p>
            <p><i class="fa-solid fa-phone"></i>Phone: 929-264-1896</p>
        </div>
    </div>
</section>

<?php
    include ("footer.php");
?>