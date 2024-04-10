<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Math Quiz Game</h2>
    <div id="timer">Time left: <span id="countdown">15</span> seconds</div>
    <?php
    // Function to generate random arithmetic question
    function generateQuestion() {
        $operators = array('+', '-', '*', '/');
        $operator = $operators[array_rand($operators)];
        $num1 = rand(1, 20);
        $num2 = rand(1, 20);
        
        switch ($operator) {
            case '+':
                $answer = $num1 + $num2;
                break;
            case '-':
                $answer = $num1 - $num2;
                break;
            case '*':
                $answer = $num1 * $num2;
                break;
            case '/':
                $answer = $num1 / $num2;
                break;
        }
        
        return "$num1 $operator $num2";
    }
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user's answer and correct answer
        $userAnswer = $_POST['answer'];
        $correctAnswer = $_POST['correctAnswer'];
        
        // Check if user's answer is correct
        if ($userAnswer == $correctAnswer) {
            echo "<p style='color: green;'>Correct! Well done.</p>";
        } else {
            echo "<p style='color: red;'>Incorrect. The correct answer is: $correctAnswer</p>";
        }
    }
    
    // Generate new question
    $question = generateQuestion();
    $questionParts = explode(' ', $question);
    $correctAnswer = eval("return $question;");
    $roundedAnswer = round($correctAnswer, 3);
    ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="question"><?php echo $question; ?> = </label>
        <input type="text" id="answer" name="answer" required autocomplete="off">
        <input type="hidden" name="correctAnswer" value="<?php echo $roundedAnswer; ?>">
        <button type="submit">Submit</button>
    </form>
    <input type="button" value="Home" onclick="location.href='index.html'"/>
    <p>*for questions where the answer is a decimal round to 3 decimal places.</p>
    <script>
        var timeleft = 15;
        var countdownElement = document.getElementById('countdown');
        var countdownTimer = setInterval(function(){
            timeleft--;
            countdownElement.textContent = timeleft;
            if(timeleft <= 0){
                clearInterval(countdownTimer);
                document.querySelector('form').submit();
                window.location.href = 'index.html';
            }
        }, 1000);
    </script>
</body>
</html>
