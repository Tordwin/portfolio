// Fade in animation script //
window.onload = function() {
    var quiz = document.querySelectorAll('.quiz-container');
    quiz.forEach(function(container) {
        container.classList.add('fade-in');
    });
};