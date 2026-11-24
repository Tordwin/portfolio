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

// Show contributions without changing the card grid. Native details remain as a fallback.
const projectDialog = document.getElementById('project-dialog');
if (typeof projectDialog.showModal === 'function') {
    const dialogTitle = document.getElementById('project-dialog-title');
    const dialogBody = document.getElementById('project-dialog-body');
    let dialogOpener;
    let dialogAnimation;
    let closing = false;
    let backdropPointerDown = false;

    document.documentElement.classList.add('project-dialogs');
    document.querySelectorAll('.project-details').forEach((details) => {
        const project = details.closest('.project');
        const trigger = document.createElement('button');
        trigger.type = 'button';
        trigger.className = 'project-details-trigger';
        trigger.setAttribute('aria-haspopup', 'dialog');
        trigger.setAttribute('aria-controls', 'project-dialog');
        trigger.setAttribute('aria-label', `View details for ${project.querySelector('h3').textContent}`);
        trigger.innerHTML = '<span></span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="4" y="3" width="16" height="18" rx="3"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>';
        trigger.querySelector('span').textContent = details.querySelector('summary').textContent;
        details.before(trigger);
        details.hidden = true;

        trigger.addEventListener('click', () => {
            if (projectDialog.open) return;
            dialogOpener = trigger;
            dialogTitle.textContent = project.querySelector('h3').textContent;

            const discipline = document.createElement('p');
            discipline.className = 'project-dialog-meta';
            discipline.textContent = project.querySelector('.project-role, .project-discipline').textContent;
            const date = details.querySelector('.project-date');
            if (date) discipline.textContent += ` · ${date.textContent}`;

            const description = project.querySelector('.featured-description, .project-description').cloneNode(true);
            description.className = 'project-dialog-description';
            const contributionTitle = document.createElement('h3');
            contributionTitle.textContent = 'My contribution';
            dialogBody.replaceChildren(
                discipline, description, project.querySelector('.tags').cloneNode(true),
                contributionTitle, details.querySelector('ul').cloneNode(true)
            );

            projectDialog.showModal();
            document.documentElement.classList.add('project-dialog-open');
            projectDialog.scrollTop = 0;
            dialogTitle.focus({ preventScroll: true });
            if (!reducedMotion.matches && projectDialog.animate) {
                dialogAnimation = projectDialog.animate(
                    [{ opacity: 0, transform: 'translate3d(0, 6px, 0)' }, { opacity: 1, transform: 'translate3d(0, 0, 0)' }],
                    { duration: 140, easing: 'ease-out', fill: 'both' }
                );
            }
        });
    });

    function closeProjectDialog() {
        if (!projectDialog.open || closing) return;
        closing = true;
        if (reducedMotion.matches || !dialogAnimation) {
            projectDialog.close();
            return;
        }
        // Reverse from the current frame, including when closed during the entrance.
        dialogAnimation.reverse();
        dialogAnimation.updatePlaybackRate(-1.4);
        dialogAnimation.finished.then(() => projectDialog.close(), () => {});
    }

    projectDialog.querySelector('form').addEventListener('submit', (event) => {
        event.preventDefault();
        closeProjectDialog();
    });
    projectDialog.addEventListener('cancel', (event) => {
        event.preventDefault();
        closeProjectDialog();
    });
    function isOutsideDialog(event) {
        const rect = projectDialog.getBoundingClientRect();
        return event.clientX < rect.left || event.clientX > rect.right
            || event.clientY < rect.top || event.clientY > rect.bottom;
    }
    projectDialog.addEventListener('pointerdown', (event) => {
        backdropPointerDown = event.target === projectDialog && isOutsideDialog(event);
    });
    projectDialog.addEventListener('click', (event) => {
        if (backdropPointerDown && event.target === projectDialog && isOutsideDialog(event)) closeProjectDialog();
        backdropPointerDown = false;
    });
    projectDialog.addEventListener('close', () => {
        if (dialogAnimation) dialogAnimation.cancel();
        dialogAnimation = null;
        closing = false;
        document.documentElement.classList.remove('project-dialog-open');
        if (dialogOpener) dialogOpener.focus({ preventScroll: true });
    });
    reducedMotion.addEventListener('change', () => {
        if (reducedMotion.matches && dialogAnimation) dialogAnimation.finish();
    });
}

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
