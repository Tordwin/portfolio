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

<div class="welcome">
    <div class="about-picture">
        <img src="images/portrait.jpg" alt="Portrait of Edwin Chen" />
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
            <h1>Outside the Computer</h1>
            <p>I'm someone who enjoys creativity and the technical sides of life. When I'm not coding and diving into the world of tech you'll find me 
                cooking and experimenting with new recipes, playing multiple games, or leisurely playing the violin. To stay active within this deskbound life
                I play competitive sports like volleyball, badminton, and recently bowling.
            </p>

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
        </div>
    </div>
</div>

<section id="projects">
    <h2>My Projects</h2>
    <div class="projects-container">
        <div class="dating-website">
            <img src="images/elementor-placeholder-image.jpg" alt="Placeholder">
            <h3>Dating Website</h3>
            <ul>
                <li>Developed a dynamic, interactive web form using JavaScript by implementing form generation to dynamically create menus and handle user interactions</li>
                <li>Implemented the management of localStorage and cookies allowing for seamless user experience that preserves data across browser sessions</li>
                <li>Incorporated robust client-side validation methods that include email pattern matching, age verification, and error handling</li>
                <li>Created a custom JavaScript animation for image transitions for fade-in/fade-out effects along with a 360-degree rotation that optimizes the performance for UI interactions</li>
            </ul>
        </div>

        <div class="ischool-website">
            <img src="images/elementor-placeholder-image.jpg" alt="Placeholder">
            <h3>ISchool Website</h3>
            <ul>
                <li>Developed a dynamic web application utilizing Vite and JSX, showcasing proficiency in modern web development by fetching and displaying data from an API</li>
                <li>Enhanced user experience by integrating external modules that show progress, an advanced data visualization table, breadcrumbs for navigation, etc.</li>
                <li>Implemented modular styled frontend development utilizing JavaScript and React that incorporates frameworks and third-party libraries</li>
            </ul>
        </div>

        <div class="healthncare-website">
            <img src="images/elementor-placeholder-image.jpg" alt="Placeholder">
            <h3>HealthNCare</h3>
            <ul>
                <li>Designed and implemented a controller using the Model-View-Controller pattern to facilitate seamless communication between logging and user interaction modules</li>
                <li>Developed a caloric algorithm that calculates exercise-specific calorie expenditure based on the user’s weight and exercise time</li>
                <li>Collaborated with team members by refactoring and modifying existing code to integrate the exercise features ensuring a smooth implementation across the GUI</li>
            </ul>
        </div>

        <div class="italy-travel-guide">
            <img src="images/elementor-placeholder-image.jpg" alt="Placeholder">
            <h3>Italy Travel Guide</h3>
            <ul>
                <li>Designed and developed a professional travel homepage for Italy to showcase travel destinations, food, services, activities, and more</li>
                <li>Utilized PHP to incorporate modular efficiency for code reuse and maintainability, JavaScript for dynamic form creation, animations, and handling user interactions, and CSS to
                    ensure a visually appealing and responsive design throughout all devices for all users</li>
            </ul>
        </div>

        <div class="spotify-wireframe">
            <img src="images/elementor-placeholder-image.jpg" alt="Placeholder">
            <h3>Spotify Wireframe Design</h3>
            <p>write about your creativity and how you can create a better user experience based on the design i made</p>
        </div>
</section>

<div class="contact">
    <div class="row">
        <div class="contact-left">
            <h1 class="contact-title">Contact Me!</h1>
            <p><i class="fa-solid fa-envelope"></i>Email: chenedwin6@gmail.com</p>
            <p><i class="fa-solid fa-phone"></i>Phone: 929-264-1896</p>
        </div>
        <div class="contact-right">
            <form>
                <input type="text" name="Name" placeholder="John Doe" required>
                <input type="email" name="Email" placeholder="johndoe@email.com" required>
                <textarea name="Message" rows="6" placeholder="Your message here..." required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</div>

<?php
    include ("footer.php");
?>