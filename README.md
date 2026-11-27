# Edwin Chen's portfolio

A PHP portfolio showcasing Edwin's Computing & Information Technology projects,
experience, skills, and education at RIT. No database, Node.js, Composer,
or build step is required. Assets, fonts, and interactions work without a CDN.

## Content and design

- `index.php`: introduction, featured project, experience, skills, education, and contact.
- `data/projects.php`: all seven project cards, technology tags, and contribution details.
- `header.php` / `footer.php`: shared navigation, metadata, and social links.
- `global.css`: the original charcoal (#222831), gray (#393E46), teal (#00ADB5),
  and off-white (#EEEEEE) palette, responsive layouts, and reduced-motion support.
- `assets/favicon.svg`: the text monogram used for the browser icon.
- `images/portrait-cutout.png`: transparent portrait used with a charcoal and teal
  backdrop in the hero; the original photo remains in `images/portrait.jpg`.
- `main.js`: original headline quotes, animated project dialogs and mobile navigation,
  project filters, and current-section links.
- `assets/edwin-chen-resume.pdf`: downloadable resume supplied by Edwin. Replace
  this file when updating the resume.

All seven projects and their details remain accessible with JavaScript disabled.
With JavaScript, project details open in an accessible dialog so cards and their
neighbors keep their size. Close it with the Close button, Escape, or the backdrop;
focus returns to the project button. Without dialog support, inline details remain
available and expand independently of neighboring cards.
Project filtering is enabled when JavaScript is available and applies to the seven
cards below the featured project. The Crafty Studio appears in All projects,
Backend & data, and Web applications. Previews use existing project screenshots;
projects without screenshots show an “Image not available” placeholder.

## Deployment

Deploy the PHP files and assets to a PHP-capable web host. A static preview
extension cannot execute PHP, so use a PHP-capable preview if testing locally.
