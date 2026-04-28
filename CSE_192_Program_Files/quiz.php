<?php
session_start();
include("db.php"); // ✅ make sure this has your DB connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$subject = isset($_GET['subject']) ? $_GET['subject'] : '';

// ✅ Questions for each subject
$questions = [
    "science" => [
        ["q" => "What is the chemical symbol of water?", "options" => ["O2", "H2O", "CO2", "NaCl"], "answer" => "H2O"],
        ["q" => "Who proposed the theory of relativity?", "options" => ["Newton", "Einstein", "Bohr", "Tesla"], "answer" => "Einstein"],
        ["q" => "Which gas is essential for breathing?", "options" => ["Oxygen", "Carbon Dioxide", "Nitrogen", "Helium"], "answer" => "Oxygen"],
        ["q" => "What is the SI unit of force?", "options" => ["Newton", "Pascal", "Joule", "Watt"], "answer" => "Newton"],
        ["q" => "Which planet is known as the Red Planet?", "options" => ["Earth", "Mars", "Venus", "Jupiter"], "answer" => "Mars"],
        ["q" => "DNA stands for?", "options" => ["Deoxyribonucleic Acid", "Dynamic Network Analysis", "Digital Numeric Array", "None"], "answer" => "Deoxyribonucleic Acid"],
        ["q" => "What is the speed of light?", "options" => ["3x10^8 m/s", "1x10^6 m/s", "300 m/s", "3x10^5 km/s"], "answer" => "3x10^8 m/s"],
        ["q" => "Which blood group is universal donor?", "options" => ["A", "B", "O-", "AB+"], "answer" => "O-"],
        ["q" => "What is the powerhouse of the cell?", "options" => ["Nucleus", "Mitochondria", "Ribosome", "Cytoplasm"], "answer" => "Mitochondria"],
        ["q" => "Which metal is liquid at room temperature?", "options" => ["Mercury", "Iron", "Gold", "Sodium"], "answer" => "Mercury"]
    ],
    "commerce" => [
        ["q" => "What does GDP stand for?", "options" => ["Gross Domestic Product", "Global Development Plan", "General Data Processing", "Government Development Policy"], "answer" => "Gross Domestic Product"],
        ["q" => "Who is known as the Father of Economics?", "options" => ["Adam Smith", "Karl Marx", "Milton Friedman", "John Keynes"], "answer" => "Adam Smith"],
        ["q" => "Double-entry accounting was developed in which country?", "options" => ["India", "Italy", "USA", "England"], "answer" => "Italy"],
        ["q" => "What does 'CA' stand for?", "options" => ["Chartered Accountant", "Company Analyst", "Certified Auditor", "Cost Accountant"], "answer" => "Chartered Accountant"],
        ["q" => "Which tax is applied on income?", "options" => ["GST", "Income Tax", "Excise Duty", "Sales Tax"], "answer" => "Income Tax"],
        ["q" => "What is the full form of MBA?", "options" => ["Master of Business Administration", "Major Business Accounting", "Market Banking Association", "None"], "answer" => "Master of Business Administration"],
        ["q" => "Stock market regulator in India?", "options" => ["RBI", "SEBI", "IRDA", "NABARD"], "answer" => "SEBI"],
        ["q" => "Balance Sheet shows?", "options" => ["Assets & Liabilities", "Only Profit", "Only Loss", "Sales"], "answer" => "Assets & Liabilities"],
        ["q" => "Banking term NPA stands for?", "options" => ["Non Performing Asset", "New Product Account", "National Payment Authority", "None"], "answer" => "Non Performing Asset"],
        ["q" => "Which is India’s central bank?", "options" => ["SBI", "ICICI", "RBI", "HDFC"], "answer" => "RBI"]
    ],
    "arts" => [
        ["q" => "Who wrote 'Hamlet'?", "options" => ["Charles Dickens", "William Shakespeare", "Leo Tolstoy", "Mark Twain"], "answer" => "William Shakespeare"],
        ["q" => "Psychology is the study of?", "options" => ["Mind & Behavior", "Plants", "Animals", "Matter"], "answer" => "Mind & Behavior"],
        ["q" => "Which is the official language of the UN?", "options" => ["English", "Spanish", "French", "All of these"], "answer" => "All of these"],
        ["q" => "Sociology is the study of?", "options" => ["Society", "Cells", "Economy", "Physics"], "answer" => "Society"],
        ["q" => "Who painted the Mona Lisa?", "options" => ["Van Gogh", "Picasso", "Da Vinci", "Rembrandt"], "answer" => "Da Vinci"],
        ["q" => "Indian national anthem was written by?", "options" => ["Rabindranath Tagore", "Bankim Chandra", "Mahatma Gandhi", "Sarojini Naidu"], "answer" => "Rabindranath Tagore"],
        ["q" => "Who is called the Father of History?", "options" => ["Aristotle", "Herodotus", "Socrates", "Plato"], "answer" => "Herodotus"],
        ["q" => "Which dance form is from Kerala?", "options" => ["Bharatanatyam", "Kathakali", "Odissi", "Kuchipudi"], "answer" => "Kathakali"],
        ["q" => "Which book is written by George Orwell?", "options" => ["1984", "Hamlet", "War & Peace", "Divine Comedy"], "answer" => "1984"],
        ["q" => "Who is the author of ‘Discovery of India’?", "options" => ["Nehru", "Ambedkar", "Gandhi", "Tagore"], "answer" => "Nehru"]
    ]
];

$score = 0;
$details = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answers = $questions[$subject];

    foreach ($answers as $index => $q) {
        $userAnswer = isset($_POST["q$index"]) ? $_POST["q$index"] : "Not Answered";
        $correctAnswer = $q["answer"];

        if ($userAnswer == $correctAnswer) {
            $score++;
            $details[] = ["q" => $q["q"], "your" => $userAnswer, "correct" => $correctAnswer, "status" => "✅ Correct"];
        } else {
            $details[] = ["q" => $q["q"], "your" => $userAnswer, "correct" => $correctAnswer, "status" => "❌ Wrong"];
        }
    }

    // Save result in DB
    $stmt = $conn->prepare("INSERT INTO quiz_results (user_id, subject, score) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $user_id, $subject, $score);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($subject); ?> Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4 p-4 bg-white shadow rounded">
    <h2 class="text-success"><?php echo ucfirst($subject); ?> Quiz</h2>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h4 class="mt-3">📊 Detailed Report</h4>
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Question</th>
                    <th>Your Answer</th>
                    <th>Correct Answer</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($details as $d): ?>
                    <tr>
                        <td><?php echo $d['q']; ?></td>
                        <td><?php echo $d['your']; ?></td>
                        <td><?php echo $d['correct']; ?></td>
                        <td><?php echo $d['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="alert alert-info mt-3">
            <h5>Final Score: <?php echo $score . " / " . count($questions[$subject]); ?></h5>
            <?php
            if ($score >= 7) {
                echo "<b>Suggestion:</b> 🌟 You are well-suited for the " . ucfirst($subject) . " stream!";
            } elseif ($score >= 4) {
                echo "<b>Suggestion:</b> 👍 You have moderate interest. With effort, you can succeed in " . ucfirst($subject) . ".";
            } else {
                echo "<b>Suggestion:</b> ⚠️ This stream may not be your best fit. Explore other options.";
            }
            ?>
        </div>

        <a href="dashboard.php" class="btn btn-primary mt-3">⬅ Back to Dashboard</a>
    <?php else: ?>
        <form method="post">
            <?php foreach ($questions[$subject] as $index => $q): ?>
                <div class="mb-3">
                    <p><b><?php echo ($index+1) . ". " . $q["q"]; ?></b></p>
                    <?php foreach ($q["options"] as $option): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q<?php echo $index; ?>" value="<?php echo $option; ?>">
                            <label class="form-check-label"><?php echo $option; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success">Submit Quiz</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
