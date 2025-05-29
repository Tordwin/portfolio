// Cookies!!
function setCookie(name, value, date){
    const now = new Date();
    now.setTime(now.getTime() + (date * 24 * 60 * 60 * 1000));
    const expiration = "Expires on " + now.toUTCString();
    document.cookie = name + "=" + value + ";" + expiration + ";path=/"
}

// Used to create form for each prompts
function createForm(id, text, options, nextQNum){
    // Creates wrapper <div>
    const wrap = document.createElement('div');
    // Creates label <label>
    const label = document.createElement('label');
    // Setting attributes for
    label.setAttribute('for', id);
    // Setting name for the label
    label.textContent = text;
    // Creates select <select>
    const select = document.createElement('select');
    // Setting attributes for id, name, and adding an Event Listener
    select.setAttribute('id',id);
    select.setAttribute('name',id);
    select.addEventListener('change', function(){
        localStorage.setItem(id, select.value)
        next(nextQNum)
    });
    // Creates option <option>
    const onStart = document.createElement('option');
    // Setting the value of option
    onStart.value = '';
    // Setting the default selected value
    onStart.textContent = 'Select an answer below...'
    // Appending onStart to select object
    select.appendChild(onStart);
    // Loop to create more options
    for (const value in options){
        const option = document.createElement('option');
        option.value = value;
        option.textContent = options[value];
        select.appendChild(option);
    }
    // Wrapping label and select in <div>
    wrap.appendChild(label);
    wrap.appendChild(select);
    // Returns wrap <div>
    return wrap;
}

// Used to create result sentence
function createResult(text){
    // Create <p>
    const para = document.createElement('p');
    // Inserts 'text' into <p>
    para.textContent = text;
    // Returns <p> object
    return para
}

// Function to build sentence
function buildResult(){
    // Starting prompt
    let result = "You are looking for a ";
    // Men
    if (localStorage.getItem('question1') === 'men') {
        result += "MAN";
    }
    // Women
    else if (localStorage.getItem('question1') === 'women') {
        result += "WOMAN";
    }

    if (localStorage['question2']) {
        // Facial hair
        if (localStorage.getItem('question2') === 'yes'){
            result += " WITH facial hair";
        }
        else if (localStorage.getItem('question2') === 'no'){
            result += " WITHOUT facial hair";
        }
        // Blonde or brunette
        else if (localStorage.getItem('question2') === 'blonde'){
            result += " with BLONDE hair";
        }
        else if (localStorage.getItem('question2') === 'brunette'){
            result += " with BRUNETTE hair";
        }
    }

    if (localStorage['question3']){
        // Complextion
        if (localStorage.getItem('question3') === 'light'){
            result += " and LIGHT complextion.";
        }
        else if (localStorage.getItem('question3') === 'dark'){
            result += " and DARK complextion.";
        }
        // Build
        else if (localStorage.getItem('question3') === 'bulky'){
            result += " and a BULKY build.";
        }
        else if (localStorage.getItem('question3') === 'skinny'){
            result += " and a SKINNY build. ";
        }
        // Height
        else if (localStorage.getItem('question3') === 'tall'){
            result += " and a TALL figure. ";
        }
        else if (localStorage.getItem('question3') === 'short'){
            result += " and a SHORT figure. ";
        }
        // Eye color
        else if (localStorage.getItem('question3') === 'brown'){
            result += " and BROWN eyes. ";
        }
        else if (localStorage.getItem('question3') === 'blue'){
            result += " and BLUE eyes. ";
        }
    }
    // Returns result output (sentence)
    return result;
}

// Used to proceed to the next question
function next(questionNum){
    // Stores the value of question1 into answers object
    localStorage.setItem('question1', document.getElementById('question1').value);
    // Grabs <div> id = nextQuestions so it can be appended later
    const questions = document.getElementById('nextQuestions');
    // Creating empty variable named nextDrop
    let nextDrop;
    // Checking question1
    if (questionNum === 1) {
        const getValue = document.getElementById('question1').value;
        // Creates cookie
        setCookie('question1', getValue, 7);
        if (getValue === 'men') {
            nextDrop = createForm('question2', 'Question 2 - Facial Hair? ', {yes: 'Yes', no: 'No'}, 2);
        }
        else if (getValue === 'women') {
            nextDrop = createForm('question2', 'Question 2 - Blonde or Brunette? ', {blonde: 'Blonde', brunette: 'Brunette'}, 2)
        }
    }
    // Checking question2
    else if (questionNum === 2) {
        const getValue = document.getElementById('question2').value;
        // Creates cookie
        setCookie('question2', getValue, 7);
        if (getValue === 'yes') {
            nextDrop = createForm('question3', 'Question 3 - Complexion? ', {light: 'Light', dark: 'Dark'}, 3);
        }
        else if (getValue === 'no') {
            nextDrop = createForm('question3', 'Question 3 - Build? ', {bulky: 'Bulky', skinny: 'Skinny'}, 3);
        }
        else if (getValue === 'blonde'){
            nextDrop = createForm('question3', 'Question 3 - Height? ', {tall: 'Tall', short: 'Short'}, 3);
        }
        else if (getValue === 'brunette'){
            nextDrop = createForm('question3', 'Question 3 - Eyes? ', {brown: 'Brown', blue: 'Blue'}, 3);
        }
    }
    // Appends nextDrop to <div> id = nextQuestions wrapper
    if (nextDrop){
        questions.appendChild(nextDrop);
    }
    // Checks if question is up to 3 (which is the max) and builds response and sets nextDrop
    else if (questionNum === 3) {
        const getValue = document.getElementById('question3').value;
        // Creates cookie
        setCookie('question3', getValue, 7);
        const results = document.getElementById('results');
        const resultOutput = createResult(buildResult());
        results.appendChild(resultOutput);
        // Image output
        let imageResult;
        // Id of outputImage
        let image = document.getElementById('outputImage');
        // If statements for different outputs
        if (getValue === "light"){
            imageResult = "media/light man.jpg"
        }
        else if (getValue === "dark"){
            imageResult = "media/dark man.jpg"
        }
        else if (getValue === "bulky"){
            imageResult = "media/bulky man.jpg"
        }
        else if (getValue === "skinny"){
            imageResult = "media/skinny man.jpg"
        }
        else if (getValue === "tall"){
            imageResult = "media/tall woman.jpg"
        }
        else if (getValue === "short"){
            imageResult = "media/short woman.jpg"
        }
        else if (getValue === "brown"){
            imageResult = "media/brown eyes woman.jpg"
        }
        else if (getValue === "blue"){
            imageResult = "media/blue eyes woman.jpg"
        }
        // Fades out default image
        outFade();
        // Function to input throught setTimeout
        function changeSRC(){
            image.src = imageResult;
            console.log('img');
            inFade();
            console.log('infade');
            threesixty(image);
            console.log('360');
        }
        // Times out for 2 seconds before running changeSRC()
        setTimeout(changeSRC,2000);
        // Sets image in localStorage and Cookies
        localStorage.setItem('outputImage', imageResult);
        setCookie('outputImage', imageResult);
    }
}

// Reset button
function resetForm(){
    const question1 = document.getElementById('question1');
    question1.value = 'default';

    const nextQuestions = document.getElementById('nextQuestions');
    while (nextQuestions.firstChild){
        nextQuestions.removeChild(nextQuestions.firstChild);
    }
    // Resets localStorage
    localStorage.clear();
    // Resets cookies
    document.cookie = 'question1=; expires=Fri, 01 Nov 2024 00:00:00 UTC; path=/;'
    document.cookie = 'question2=; expires=Fri, 01 Nov 2024 00:00:00 UTC; path=/;'
    document.cookie = 'question3=; expires=Fri, 01 Nov 2024 00:00:00 UTC; path=/;'
    document.cookie = 'outputImage=; expires=Fri, 01 Nov 2024 00:00:00 UTC; path=/;'
    document.cookie = 'age=; expires=Fri, 01 Nov 2024 00:00:00 UTC; path=/;'
    document.cookie = 'email=; expires=Fri, 01 Nov 2024 00:00:00 UTC; path=/;'
    document.cookie = 'name=; expires=Fri, 01 Nov 2024 00:00:00 UTC; path=/;'
}

// Validate user info
function validate(event){
    // Prevents page from refreshing
    event.preventDefault();
    // Getting Id's
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    var emailPattern = /\S+@\S+\.\S+/;
    const age = document.getElementById('age').value;
    // Checks if name is blank
    if (name != ""){
        // Checks if pattern works
        if (emailPattern.test(email) != false){
            // Checks if age is greater than or equal to 18
            if (age >= 18) {
                setCookie('name', name, 7);
                setCookie('email', email, 7);
                setCookie('age', age, 7);
                localStorage.setItem('name', name);
                localStorage.setItem('email', email);
                localStorage.setItem('age', age);
                document.getElementById('validateButton').style.color = '#008000';
                alert('Thank you for submitting your information!')
                return true;
            }
        }
    }
    // Checks if name is blank
    if (name == ""){
        document.getElementById('validateButton').style.color = '#FF0000';
        alert('Please input a name.');
        return false;
    }
    // Checks if pattern works
    if (emailPattern.test(email) == false){
        document.getElementById('validateButton').style.color = '#FF0000';
        alert('Please input an email address.');
        return false;
    }
    // Checks if age is less than 18
    if (age < 18){
        document.getElementById('validateButton').style.color = '#FF0000';
        alert('You must be 18 years or older to continue.');
        return false;
    }
}

// Animation
function threesixty(element){
    let angle = 0;
    function rotate(){
        angle += 1;
        element.style.transform = 'rotate(' + angle + 'deg)';
        if (angle < 360){
            requestAnimationFrame(rotate);
        } else {
            cancelAnimationFrame(requestAnimationFrame(rotate));
            angle = 0;
        }
    }
    requestAnimationFrame(rotate)
}

// Fade out animation
function outFade(){
    let element = document.getElementById('outputImage');
    function fadeOut(){
        element.style.opacity = 0;
        element.style.transition = "opacity 2s ease-in";
        requestAnimationFrame(fadeOut);
    }
    requestAnimationFrame(fadeOut)
}

// Fade in animation
function inFade() {
    let element = document.getElementById('outputImage');
    function fadeIn() {
        element.style.opacity = 1;
        element.style.transition = "opacity 2s ease-in";
        requestAnimationFrame(fadeIn);
    }
    requestAnimationFrame(fadeIn);
}
