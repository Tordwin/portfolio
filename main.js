document.documentElement.classList.add('js');

// Restore the quotes supplied with the original portfolio.
const quotes = [
    ['The best error message', 'is the one that never shows up.', 'Thomas Fuchs'],
    ['Deleted code', 'is debugged code.', 'Jeff Sickel'],
    ['Testing leads to failure,', 'and failure leads to understanding.', 'Burt Rutan'],
    ['Make it work, make it right,', 'make it fast.', 'Kent Beck'],
    ['Good code', 'is its own best documentation.', 'Steve McConnell'],
    ['First, solve the problem.', 'Then, write the code.', 'John Johnson']
];
const [quoteStart, quoteEnd, quoteAuthor] = quotes[Math.floor(Math.random() * quotes.length)];
const quoteAccent = document.createElement('span');
quoteAccent.textContent = `${quoteEnd}”`;
document.getElementById('hero-title').replaceChildren(
    document.createTextNode(`“${quoteStart}`), document.createElement('br'), quoteAccent
);
document.getElementById('hero-quote-author').textContent = `— ${quoteAuthor}`;

const menuButton = document.querySelector('.menu-button');
const navigation = document.getElementById('primary-navigation');
const mobileLayout = window.matchMedia('(max-width: 900px)');
const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
navigation.inert = mobileLayout.matches;

function closeMenu({ restoreFocus = false } = {}) {
    navigation.classList.remove('is-open');
    navigation.inert = mobileLayout.matches;
    menuButton.setAttribute('aria-expanded', 'false');
    menuButton.setAttribute('aria-label', 'Open navigation');
    if (restoreFocus) menuButton.focus();
}

menuButton.addEventListener('click', () => {
    const isOpen = navigation.classList.toggle('is-open');
    navigation.inert = mobileLayout.matches && !isOpen;
    menuButton.setAttribute('aria-expanded', String(isOpen));
    menuButton.setAttribute('aria-label', isOpen ? 'Close navigation' : 'Open navigation');
});

navigation.addEventListener('click', (event) => {
    const link = event.target.closest('a');
    if (!link) return;
    const wasOpen = menuButton.getAttribute('aria-expanded') === 'true';
    closeMenu();
    if (link.hash) {
        const destination = document.querySelector(link.hash);
        if (destination) {
            destination.tabIndex = -1;
            destination.focus({ preventScroll: true });
        }
    } else if (wasOpen) {
        menuButton.focus();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && menuButton.getAttribute('aria-expanded') === 'true') {
        closeMenu({ restoreFocus: true });
    }
});

document.addEventListener('click', (event) => {
    if (!event.target.closest('nav')) closeMenu();
});

document.querySelector('nav').addEventListener('focusout', (event) => {
    if (!event.currentTarget.contains(event.relatedTarget)) closeMenu();
});

mobileLayout.addEventListener('change', () => {
    const focusWillBeHidden = mobileLayout.matches && navigation.contains(document.activeElement);
    closeMenu({ restoreFocus: focusWillBeHidden });
});

const filterGroup = document.querySelector('.project-filters');
const filterButtons = [...filterGroup.querySelectorAll('[data-filter]')];
const projects = [...document.querySelectorAll('.projects-grid .project')];
const projectCount = document.getElementById('project-count');

filterGroup.hidden = false;
filterButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const selected = button.dataset.filter;
        filterButtons.forEach((filterButton) => {
            filterButton.setAttribute('aria-pressed', String(filterButton === button));
        });
        projects.forEach((project) => {
            project.hidden = selected !== 'all' && !project.dataset.category.split(' ').includes(selected);
        });
        const count = projects.filter((project) => !project.hidden).length;
        projectCount.textContent = `${count} ${count === 1 ? 'project' : 'projects'}`;
    });
});

// Animate both directions while retaining native details behavior without JS.
document.querySelectorAll('.project-details').forEach((details) => {
    const summary = details.querySelector('summary');
    let animation;
    let expanding;

    summary.addEventListener('click', (event) => {
        if (reducedMotion.matches || !details.animate) return;
        event.preventDefault();

        const startHeight = details.getBoundingClientRect().height;
        expanding = animation ? !expanding : !details.open;
        if (animation) {
            animation.onfinish = null;
            animation.cancel();
        }

        details.open = true;
        const borderHeight = parseFloat(getComputedStyle(details).borderTopWidth);
        const endHeight = expanding
            ? details.getBoundingClientRect().height
            : summary.getBoundingClientRect().height + borderHeight;

        details.classList.add('is-animating');
        animation = details.animate(
            [{ height: `${startHeight}px` }, { height: `${endHeight}px` }],
            { duration: 260, easing: 'cubic-bezier(.2, .7, .2, 1)' }
        );
        animation.onfinish = () => {
            details.open = expanding;
            details.classList.remove('is-animating');
            animation = null;
        };
    });

    reducedMotion.addEventListener('change', () => {
        if (reducedMotion.matches && animation) animation.finish();
    });
});

// Keep navigation in sync with the section being read, without intercepting scrolling.
if ('IntersectionObserver' in window) {
    const sectionLinks = [...navigation.querySelectorAll('a[href^="#"]')];
    const sections = sectionLinks.map((link) => document.querySelector(link.hash)).filter(Boolean);
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            sectionLinks.forEach((link) => {
                if (link.hash === `#${entry.target.id}`) link.setAttribute('aria-current', 'location');
                else link.removeAttribute('aria-current');
            });
        });
    }, { rootMargin: '-15% 0px -65% 0px' });
    sections.forEach((section) => observer.observe(section));
    observer.observe(document.getElementById('home'));
}
