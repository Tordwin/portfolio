<?php
    $projects = require __DIR__ . '/data/projects.php';
    function escapeHtml(string $value): string {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    require __DIR__ . '/header.php';
?>

<main id="main-content" tabindex="-1">
    <section class="hero" id="home" aria-labelledby="hero-title">
        <div class="container hero-layout">
            <div class="hero-copy">
                <p class="eyebrow hero-eyebrow">Computing &amp; Information Technology</p>
                <h1 id="hero-title">“The best error message<br><span>is the one that never shows up.”</span></h1>
                <p class="hero-quote-author" id="hero-quote-author">— Thomas Fuchs</p>
                <p class="hero-intro">Hi, I’m <strong>Edwin Chen</strong>. I build web applications, design databases, and connect the systems behind them.</p>
                <p class="hero-description">A Computing and Information Technology B.S. graduate of Rochester Institute of Technology.</p>
                <div class="hero-actions">
                    <a class="button button-primary" href="#projects">Explore my work</a>
                    <a class="button button-outline" href="assets/edwin-chen-resume.pdf" download="Edwin-Chen-Resume.pdf">Download resume <span class="file-label">PDF</span></a>
                </div>
                <div class="hero-location">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M20 10c0 6-8 11-8 11S4 16 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                    <span>Brooklyn, NY <span class="location-divider" aria-hidden="true">/</span> Rochester Institute of Technology</span>
                </div>
            </div>
        </div>
        <div class="container hero-footnote">
            <p>From the interface to the infrastructure.</p>
            <ul aria-label="Areas of focus"><li>Web applications</li><li>Backend &amp; databases</li><li>IT systems</li></ul>
        </div>
    </section>

    <section id="projects" class="section work-section" aria-labelledby="work-title">
        <div class="container">
            <div class="section-heading">
                <div><p class="eyebrow">Selected work</p><h2 id="work-title">Ideas put into practice.</h2></div>
                <p>A selection of academic and personal projects, with a focus on useful software and the systems that make it work.</p>
            </div>
            <article class="featured-project project" data-category="backend web" aria-labelledby="crafty-title">
                <div class="featured-content">
                    <p class="eyebrow">Featured project <span aria-hidden="true">/</span> Aug 2026 – Present</p>
                    <h3 id="crafty-title">The Crafty Studio</h3>
                    <p class="project-role">Backend Developer &amp; Database Engineer</p>
                    <p class="featured-description">A makerspace management platform that brings member access, reservations, and staff operations together.</p>
                    <ul class="tags" aria-label="Technologies"><li>TypeScript</li><li>Node.js</li><li>Express</li><li>PostgreSQL</li><li>Vitest</li></ul>
                    <details class="project-details">
                        <summary>My contribution</summary>
                        <ul>
                            <li>Designed PostgreSQL schemas and role-based permissions for member accounts, waivers, certifications, and staff actions.</li>
                            <li>Built profile and reservation APIs with scheduling conflict detection and booking cooldown rules.</li>
                            <li>Implemented bcrypt password hashing, versioned digital waivers, and check-in eligibility checks.</li>
                            <li>Developed searchable, tamper-resistant audit logging and validated backend logic with Vitest.</li>
                        </ul>
                    </details>
                </div>
                <div class="featured-image">
                    <img src="images/crafty-studio.png" alt="The Crafty Studio makerspace member portal login screen" loading="lazy" width="1905" height="908">
                </div>
            </article>

            <div class="project-toolbar">
                <div class="project-filters" role="group" aria-label="Filter projects" hidden>
                    <button class="filter-button" type="button" data-filter="all" aria-pressed="true">All projects</button>
                    <button class="filter-button" type="button" data-filter="backend" aria-pressed="false">Backend &amp; data</button>
                    <button class="filter-button" type="button" data-filter="web" aria-pressed="false">Web applications</button>
                </div>
                <p class="project-count" id="project-count" role="status" aria-live="polite"><?= count($projects) ?> projects</p>
            </div>

            <div class="projects-grid">
                <?php foreach ($projects as $project): ?>
                <article class="project-card project" data-category="<?= escapeHtml($project['category']) ?>">
                    <div class="project-image">
                        <?php if ($project['image'] && is_file(__DIR__ . '/' . $project['image'])): ?>
                            <img src="<?= escapeHtml($project['image']) ?>" alt="<?= escapeHtml($project['alt']) ?>" loading="lazy" width="900" height="540">
                        <?php else: ?>
                            <div class="image-placeholder">
                                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="5" y="7" width="38" height="34" rx="3"/><circle cx="16" cy="18" r="4"/><path d="m6 34 11-10 8 7 7-10 11 13"/></svg>
                                <p>Image not available</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="project-card-content">
                        <p class="project-discipline"><?= escapeHtml($project['discipline']) ?></p>
                        <h3><?= escapeHtml($project['title']) ?></h3>
                        <p class="project-description"><?= escapeHtml($project['description']) ?></p>
                        <ul class="tags" aria-label="Technologies"><?php foreach ($project['tags'] as $tag): ?><li><?= escapeHtml($tag) ?></li><?php endforeach; ?></ul>
                        <details class="project-details">
                            <summary>Project details</summary>
                            <?php if ($project['date']): ?><p class="project-date"><?= escapeHtml($project['date']) ?></p><?php endif; ?>
                            <ul><?php foreach ($project['highlights'] as $highlight): ?><li><?= escapeHtml($highlight) ?></li><?php endforeach; ?></ul>
                        </details>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            <div class="work-footer"><p>More of what I’m working on.</p><a class="text-link" href="https://github.com/Tordwin">Find me on GitHub</a></div>
        </div>
    </section>

    <section id="experience" class="section experience-section" aria-labelledby="experience-title">
        <div class="container experience-layout">
            <div class="experience-intro"><p class="eyebrow">Experience</p><h2 id="experience-title">Hands-on.<br>On both sides<br>of the screen.</h2><p>Building applications and working with real infrastructure through RIT’s Creative, Innovative, or Research Experience program.</p></div>
            <div class="experience-list">
                <article class="experience-item">
                    <div class="experience-meta"><span>Rochester Institute of Technology</span><span>Aug – Dec 2025</span></div>
                    <h3>Software Developer</h3>
                    <p>Developed a web-based Myers-Briggs assessment platform to help faculty evaluate student responses and form balanced teams.</p>
                    <ul><li>Implemented backend scoring and presented results to faculty and administrators.</li><li>Built a plant-monitoring dashboard with interactive charts for sensor readings, water intake, and lifespan metrics.</li></ul>
                </article>
                <article class="experience-item">
                    <div class="experience-meta"><span>Rochester Institute of Technology</span><span>Sep – Dec 2025</span></div>
                    <h3>IT Technician</h3>
                    <p>Helped repurpose approximately 20 decommissioned lab servers and personally configured around 10 for redeployment.</p>
                    <ul><li>Performed secure data wipes, factory resets, BIOS and firmware updates, and hardware troubleshooting.</li><li>Configured administrator accounts and documented setup and maintenance procedures for faculty.</li></ul>
                </article>
            </div>
        </div>
    </section>

    <section id="skills" class="section skills-section" aria-labelledby="skills-title">
        <div class="container">
            <div class="section-heading"><div><p class="eyebrow">Technical toolkit</p><h2 id="skills-title">The tools behind the work.</h2></div><p>A foundation across software, data, and infrastructure, developed through coursework and practical projects.</p></div>
            <div class="skills-grid">
                <article class="skill-group"><span class="skill-icon" aria-hidden="true">&lt;/&gt;</span><h3>Software &amp; web</h3><p>Java · Python · TypeScript · JavaScript · C# · PHP · React · Vite · HTML · CSS</p></article>
                <article class="skill-group"><span class="skill-icon" aria-hidden="true">{ }</span><h3>Backend &amp; data</h3><p>Node.js · Express · PostgreSQL · MySQL · SQL · REST APIs · Authentication · RBAC</p></article>
                <article class="skill-group"><span class="skill-icon" aria-hidden="true">[ ]</span><h3>Systems &amp; networks</h3><p>Windows · Windows Server · macOS · Rocky Linux · VMware · pfSense · Wireshark</p></article>
                <article class="skill-group"><span class="skill-icon" aria-hidden="true">~/</span><h3>Workflow &amp; quality</h3><p>Git · Vitest · Bash · Adminer · Lucidchart · VS Code · Visual Studio</p></article>
            </div>
        </div>
    </section>

    <section id="welcome" class="section about-section" aria-labelledby="about-title">
        <div class="container about-layout">
            <div class="about-copy"><p class="eyebrow">A little about me</p><h2 id="about-title">Curious by nature.<br>Practical by approach.</h2><p>I’m Edwin, a Computing and Information Technology student at RIT. I enjoy turning an idea into something people can actually use, whether that means shaping a database, connecting an API, or figuring out why a system isn’t working.</p><p>Through team projects and hands-on experience, I’ve strengthened the communication, collaboration, and problem-solving skills that help bring technical work together.</p><p class="personal-note">Away from the keyboard, you’ll find me trying a new recipe, playing violin or games, or staying active with volleyball, badminton, and bowling. I also enjoy camping and fishing.</p></div>
            <aside class="education-card" aria-labelledby="education-title">
                <div class="education-top"><span class="rit-mark" aria-hidden="true">RIT</span><span>Education</span></div>
                <h3 id="education-title">Rochester Institute<br>of Technology</h3>
                <p class="degree">B.S. in Computing and<br>Information Technology</p>
                <dl class="education-facts"><div><dt>GPA</dt><dd>3.5</dd></div><div><dt>Dean’s List</dt><dd>Spring 2023 – Spring 2025</dd></div></dl>
                <a class="education-resume" href="assets/edwin-chen-resume.pdf" download="Edwin-Chen-Resume.pdf">Download full resume <span class="file-label">PDF</span></a>
            </aside>
        </div>
    </section>

    <section id="contact" class="section contact-section" aria-labelledby="contact-title">
        <div class="container contact-layout">
            <div><p class="eyebrow">Let’s connect</p><h2 id="contact-title">Let’s build<br>something useful.</h2><p>Have a role, a project, or a question in mind?<br>I’d love to hear from you.</p></div>
            <div class="contact-links"><a class="contact-email" href="mailto:chenedwin6@gmail.com">chenedwin6@gmail.com</a><div class="contact-socials"><a class="button button-outline" href="https://www.linkedin.com/in/chenedwin6">LinkedIn</a><a class="button button-outline" href="https://github.com/Tordwin">GitHub</a></div><a class="contact-phone" href="tel:+19292641896">(929) 264-1896</a><p class="contact-location">Based in Brooklyn, New York</p></div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/footer.php'; ?>
