<?php
// Parse quiz file
$quizFile = __DIR__ . '/Quiz.txt';
$questions = [];

if (file_exists($quizFile)) {
    $content = file_get_contents($quizFile);
    $lines = explode("\n", $content);
    
    $currentQuestion = null;
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        
        if (preg_match('/^[A-Z]\./', $line)) {
            // Option line
            if ($currentQuestion) {
                $currentQuestion['options'][] = $line;
            }
        } elseif (strpos($line, 'ANSWER:') === 0) {
            // Answer line
            if ($currentQuestion) {
                $answers = str_replace('ANSWER:', '', $line);
                $currentQuestion['answers'] = array_map('trim', explode(',', $answers));
                $questions[] = $currentQuestion;
                $currentQuestion = null;
            }
        } else {
            // Question line
            if ($currentQuestion) {
                $questions[] = $currentQuestion;
            }
            $currentQuestion = ['text' => $line, 'options' => [], 'answers' => []];
        }
    }
}

$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
$score = 0;
$totalQuestions = count($questions);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Thi Trắc Nghiệm Android</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📝 Bài Thi Trắc Nghiệm Android</h1>
        <div class="quiz-info">
            Tổng số câu hỏi: <strong><?php echo $totalQuestions; ?></strong>
        </div>

        <?php if ($submitted): ?>
            <?php
            // Calculate score
            foreach ($questions as $index => $question) {
                $questionName = "question_" . $index;
                $userAnswers = isset($_POST[$questionName]) ? (array)$_POST[$questionName] : [];
                
                $correctAnswers = [];
                foreach ($question['options'] as $option) {
                    $optionLetter = substr($option, 0, 1);
                    foreach ($question['answers'] as $answer) {
                        if (trim($answer) === $optionLetter) {
                            $correctAnswers[] = $optionLetter;
                        }
                    }
                }
                
                $isCorrect = count($userAnswers) === count($correctAnswers) && 
                             count(array_intersect($userAnswers, $correctAnswers)) === count($correctAnswers);
                
                if ($isCorrect) {
                    $score++;
                }
            }
            $percentage = round(($score / $totalQuestions) * 100);
            ?>
            
            <div class="result-container">
                <div class="result-score">Kết quả: <?php echo $score; ?>/<?php echo $totalQuestions; ?></div>
                <div class="result-percentage">Tỷ lệ đúng: <?php echo $percentage; ?>%</div>
            </div>

            <?php foreach ($questions as $index => $question): ?>
                <?php
                $questionName = "question_" . $index;
                $userAnswers = isset($_POST[$questionName]) ? (array)$_POST[$questionName] : [];
                
                $correctAnswers = [];
                foreach ($question['options'] as $option) {
                    $optionLetter = substr($option, 0, 1);
                    foreach ($question['answers'] as $answer) {
                        if (trim($answer) === $optionLetter) {
                            $correctAnswers[] = $optionLetter;
                        }
                    }
                }
                
                $isCorrect = count($userAnswers) === count($correctAnswers) && 
                             count(array_intersect($userAnswers, $correctAnswers)) === count($correctAnswers);
                ?>
                <div class="question-result <?php echo $isCorrect ? '' : 'incorrect'; ?>">
                    <div class="question-number">Câu <?php echo $index + 1; ?></div>
                    <div class="question-text"><?php echo htmlspecialchars($question['text']); ?></div>
                    <div class="result-answer <?php echo $isCorrect ? 'correct' : 'incorrect'; ?>">
                        <?php 
                        if ($isCorrect) {
                            echo "✓ Đúng - Đáp án: " . implode(', ', $correctAnswers);
                        } else {
                            echo "✗ Sai - Đáp án đúng: " . implode(', ', $correctAnswers) . " | Bạn chọn: " . (empty($userAnswers) ? 'Không chọn' : implode(', ', $userAnswers));
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="btn-container">
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn-retry">Làm lại</a>
            </div>

        <?php else: ?>
            <form method="POST">
                <?php foreach ($questions as $index => $question): ?>
                    <div class="question-block">
                        <div class="question-number">Câu <?php echo $index + 1; ?></div>
                        <div class="question-text"><?php echo htmlspecialchars($question['text']); ?></div>
                        <div class="options">
                            <?php 
                            $isMultiple = count($question['answers']) > 1;
                            $inputType = $isMultiple ? 'checkbox' : 'radio';
                            $name = "question_" . $index;
                            
                            foreach ($question['options'] as $option): 
                                $optionLetter = substr($option, 0, 1);
                                $optionText = substr($option, 3);
                            ?>
                                <div class="option">
                                    <input type="<?php echo $inputType; ?>" 
                                           name="<?php echo $name; ?>[]" 
                                           value="<?php echo htmlspecialchars($optionLetter); ?>" 
                                           id="opt_<?php echo $index; ?>_<?php echo $optionLetter; ?>">
                                    <label for="opt_<?php echo $index; ?>_<?php echo $optionLetter; ?>">
                                        <?php echo htmlspecialchars($optionText); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="btn-container">
                    <button type="submit" class="btn-submit">Nộp bài</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
