<?php
    include("../header.php");
?>

<link rel="stylesheet" href="../styles/contact.css">
<div class="contact">
    <div class="row">
        <div class="contact-left">
            <h1 class="contact-title">Contact Me!</h1>
            <p><i class="fa-solid fa-envelope"></i>Email: chenedwin6@gmail.com</p>
            <p><i class="fa-solid fa-phone"></i>Phone: 929-264-1896</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/chenedwin6/"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/tordwin/"><i class="fa-brands fa-square-instagram"></i></a>
                <a href="https://www.linkedin.com/in/chenedwin6"><i class="fa-brands fa-linkedin"></i></a>
                <a href="https://github.com/Tordwin"><i class="fa-brands fa-github"></i></a>
            </div>
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


<!-- Contact Me!
Email & Phone Number
Main Email - chenedwin6@gmail.com
School Email - ec7233@g.rit.edu
Phone - 9292641896

Socials
Instagram - @tordwin
Discord - tordwin -->

<?php
    include ("../footer.php");
?>