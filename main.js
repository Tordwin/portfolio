document.documentElement.classList.add('js');

const menuButton = document.querySelector('.menu-button');
const navigation = document.getElementById('primary-navigation');
const mobileLayout = window.matchMedia('(max-width: 900px)');

function closeMenu({ restoreFocus = false } = {}) {
    navigation.classList.remove('is-open');
    menuButton.setAttribute('aria-expanded', 'false');
    menuButton.setAttribute('aria-label', 'Open navigation');
    if (restoreFocus) menuButton.focus();
}

menuButton.addEventListener('click', () => {
    const isOpen = navigation.classList.toggle('is-open');
    menuButton.setAttribute('aria-expanded', String(isOpen));
    menuButton.setAttribute('aria-label', isOpen ? 'Close navigation' : 'Open navigation');
});

navigation.addEventListener('click', (event) => {
    if (event.target.closest('a')) closeMenu();
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

const quotes = [
    '“The best error message is the one that never shows up.” — Thomas Fuchs',
    '“Deleted code is debugged code.” — Jeff Sickel',
    '“Testing leads to failure, and failure leads to understanding.” — Burt Rutan',
    '“Make it work, make it right, make it fast.” — Kent Beck',
    '“Good code is its own best documentation.” — Steve McConnell',
    '“First, solve the problem. Then, write the code.” — John Johnson'
];
document.getElementById('quote').textContent = quotes[Math.floor(Math.random() * quotes.length)];
