<!-- HTML Head Module -->
<?php include "resources/head.php";?>
		<!-- Title -->
		<title>History of Italy - Quiz</title>
		<!-- It's own stylesheet -->
		<link rel="stylesheet" href="css/quiz.css">
	</head>
	<!-- Nav Bar Module -->
	<header><?php include "resources/header.php"?></header>
	<body>
		<!-- Content Start -->
		<div class="quiz-container">
			<div id="breadcrumb"><a href="index.php">Home</a> >> Quiz</div>
			<h2>History of Italy:</h2>
			<div id="question">
					<br><p>Question 1: During which century did the emergence of the Roman Republic occur?</p>
					<input type="radio" name="question1" value="a"> A) 6th century BCE <br>
					<input type="radio" name="question1" value="b"> B) 3rd century BCE <br>
					<input type="radio" name="question1" value="c"> C) 1st century CE <br>
					<input type="radio" name="question1" value="d"> D) 2nd century CE <br> <br>
			</div>
			<div id="question">
					<p>Question 2: Who was the leader responsible for the creation of the Roman Empire in 27 BCE?</p>
					<input type="radio" name="question2" value="a"> A) Julius Caesar <br>
					<input type="radio" name="question2" value="b"> B) Marcus Aurelius <br>
					<input type="radio" name="question2" value="c"> C) Augustus Caesar <br>
					<input type="radio" name="question2" value="d"> D) Nero <br> <br>
			</div>
			<div id="question">
					<p>Question 3: Which period in Italian history was known for its flourishing art, literature, and science?</p>
					<input type="radio" name="question3" value="a"> A) Ancient Italy <br>
					<input type="radio" name="question3" value="b"> B) Medieval Italy <br>
					<input type="radio" name="question3" value="c"> C) Renaissance <br>
					<input type="radio" name="question3" value="d"> D) Italian Unification <br> <br>
			</div>
			<div id="question">
					<p>Question 4: Which Italian city became the major center for cultural and intellectual advancements during the Renaissance?</p>
					<input type="radio" name="question4" value="a"> A) Venice <br>
					<input type="radio" name="question4" value="b"> B) Genoa <br>
					<input type="radio" name="question4" value="c"> C) Milan <br>
					<input type="radio" name="question4" value="d"> D) Florence <br> <br>
			</div>
			<div id="question">
					<p>Question 5: Who were the two leaders associated with the Risorgimento movement for Italian unification?</p>
					<input type="radio" name="question5" value="a"> A) Leonardo da Vinci and Michelangelo <br>
					<input type="radio" name="question5" value="b"> B) Giuseppe Garibaldi and Giuseppe Mazzini <br>
					<input type="radio" name="question5" value="c"> C) Julius Caesar and Augustus Caesar <br>
					<input type="radio" name="question5" value="d"> D) Dante Alighieri and Niccolò Machiavelli <br> <br>
			</div>
			<div id="question">
					<p>Question 6: Which fascist leader came into power in Italy during the 1920s?</p>
					<input type="radio" name="question6" value="a"> A) Adolf Hitler <br>
					<input type="radio" name="question6" value="b"> B) Benito Mussolini <br>
					<input type="radio" name="question6" value="c"> C) Francisco Franco <br>
					<input type="radio" name="question6" value="d"> D) Joseph Stalin <br> <br>
			</div>
			<div id="question">
					<p>Question 7: When did Italy become a republic?</p>
					<input type="radio" name="question7" value="a"> A) 1922 <br>
					<input type="radio" name="question7" value="b"> B) 1946 <br>
					<input type="radio" name="question7" value="c"> C) 1957 <br>
					<input type="radio" name="question7" value="d"> D) 1861 <br> <br>
			</div>
			<div id="question">
					<p>Question 8: Which organization did Italy become one of the founding members of in 1957?</p>
					<input type="radio" name="question8" value="a"> A) NATO <br>
					<input type="radio" name="question8" value="b"> B) United Nations <br>
					<input type="radio" name="question8" value="c"> C) European Union (EU) <br>
					<input type="radio" name="question8" value="d"> D) G7 <br> <br>
			</div>
			<div id="question">
					<p>Question 9: What was the capital of Italy after its unification in 1861?</p>
					<input type="radio" name="question9" value="a"> A) Venice <br>
					<input type="radio" name="question9" value="b"> B) Milan <br>
					<input type="radio" name="question9" value="c"> C) Rome <br>
					<input type="radio" name="question9" value="d"> D) Florence <br> <br>
			</div> 
			<div id="question">
					<p>Question 10: Which century saw the fall of the Roman Empire?</p>
					<input type="radio" name="question10" value="a"> A) 1st century BCE <br>
					<input type="radio" name="question10" value="b"> B) 2nd century CE <br>
					<input type="radio" name="question10" value="c"> C) 5th century CE <br>
					<input type="radio" name="question10" value="d"> D) 10th century CE <br> <br>
			</div>
			<button id="submit">Submit</button>
		</div>

		<div id=video>
			<video width="320" height="240" controls>
  			<source src="images/Congratulations.mp4" type="video/mp4">
		</div>

		<div id="result"></div>
		<!-- Content End -->
		<!-- Script -->
		<script src="scripts/quiz.js"></script>
		<script src="scripts/fadein.js"></script>
		<!-- Footer Module -->
		<?php include "resources/footer.php"?>
	</body>
</html> 