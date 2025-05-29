document.addEventListener("DOMContentLoaded", function() {
    // Answer key //
    const answerKey = {
        question1: "a",
        question2: "c",
        question3: "c",
        question4: "d",
        question5: "b",
        question6: "b",
        question7: "b",
        question8: "c",
        question9: "c",
        question10: "c"
    };

    // Function that fades out the table //
    function fadeOut() {
        // Fades out quiz //
        const quiz = document.querySelector('.quiz-container');
        quiz.style.transition = "opacity 1s ease-in-out";
        quiz.style.opacity = 0;
        quiz.style.display = "none";
        
        // Fades in video //
        const video = document.querySelector('#video');
        video.style.display = "flex";
        video.style.justifyContent = "center";
        video.style.alignItems = "center";
        video.style.height = "100vh";
    }

    // Function that calculates and displays the result //
    function displayResults() {
        let score = 0;
        for (let i = 1; i <= 10; i++) {
            const answer = document.querySelector(`input[name=question${i}]:checked`);
            correctAnswer = answerKey[`question${i}`];
            if (answer) {
                // Adds to score and changes question to color green //
                if (answer.value === correctAnswer) {
                    score++;
                    answer.parentNode.style.color = "green";
                // Changes color to red when wrong //
                } else {
                    answer.parentNode.style.color = "red";
                }
            // If not answered changes color to grey //
            } else {
                const noAnswer = document.querySelector(`input[name=question${i}]`);
                noAnswer.parentNode.style.color = "gray";
            }
        }
        // Displays an alert for score //
        if (score == 10) {
            alert(`You scored full points!!!!!`);
            fadeOut();
        } else {
            let wrong = 10 - score;
            alert(`Your score is ${score} out of 10. You got ${wrong} questions wrong.`);
        }
    }
    // Submit button listener //
    const submitButton = document.getElementById("submit");
    submitButton.addEventListener("click", displayResults);
});