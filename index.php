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
    ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="question"><?php echo $question; ?> = </label>
        <input type="text" id="answer" name="answer" required autocomplete="off">
        <input type="hidden" name="correctAnswer" value="<?php echo $correctAnswer; ?>">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
