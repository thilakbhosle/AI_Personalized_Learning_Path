<?php
$subject = isset($_GET['name']) ? $_GET['name'] : '';

// Subject details
$details = [
    "science" => [
        "title" => "Science Stream",
        "overview" => "Science is the study of the natural world through experiments and observations. Students can explore Physics, Chemistry, Biology, and Mathematics.",
        "advantages" => [
            "Opens career opportunities in engineering, medicine, research, and technology.",
            "Develops problem-solving and analytical skills.",
            "Highly respected and versatile stream."
        ],
        "disadvantages" => [
            "Requires hard work and consistent study.",
            "Competitive exams can be stressful.",
            "Subjects are sometimes tough to master."
        ],
        "courses" => ["B.Tech / Engineering", "MBBS / BDS", "B.Sc (Physics, Chemistry, Biology, Mathematics)", "Pharmacy / Biotechnology"],
        "careers" => ["Engineer", "Doctor", "Scientist", "Pharmacist", "Researcher"]
    ],
    "commerce" => [
        "title" => "Commerce Stream",
        "overview" => "Commerce deals with business, trade, finance, and economics. Students learn accounting, management, and entrepreneurship.",
        "advantages" => [
            "Opens opportunities in business, finance, and management.",
            "Great for entrepreneurship and startups.",
            "Growing demand in banking and corporate sectors."
        ],
        "disadvantages" => [
            "Mathematics and accounts can be tough for some.",
            "Competitive environment in corporate jobs.",
            "Needs strong analytical and numerical skills."
        ],
        "courses" => ["B.Com", "BBA", "CA / CS / CMA", "MBA", "Economics / Finance"],
        "careers" => ["Accountant", "Manager", "Entrepreneur", "Banker", "Financial Analyst"]
    ],
    "arts" => [
        "title" => "Arts Stream",
        "overview" => "Arts focuses on creativity, literature, history, psychology, and social sciences. Students can pursue careers in teaching, writing, design, and media.",
        "advantages" => [
            "Encourages creativity and critical thinking.",
            "Wide range of subjects to choose from.",
            "Opportunities in media, writing, teaching, and government exams."
        ],
        "disadvantages" => [
            "Job opportunities may be competitive.",
            "Sometimes less pay compared to science/commerce.",
            "Needs strong communication skills."
        ],
        "courses" => ["BA (English, History, Psychology, Sociology)", "Fine Arts / Design", "Mass Communication", "Political Science / Law"],
        "careers" => ["Teacher", "Writer", "Journalist", "Designer", "Civil Services"]
    ]
];
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($subject); ?> Stream - Career Counselling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4 p-4 bg-white shadow rounded">

    <?php if(isset($details[$subject])): ?>
        <h2 class="text-primary"><?php echo $details[$subject]['title']; ?></h2>
        <h4 class="mt-3">Overview</h4>
        <p><?php echo $details[$subject]['overview']; ?></p>

        <h4>Advantages</h4>
        <ul>
            <?php foreach($details[$subject]['advantages'] as $adv): ?>
                <li><?php echo $adv; ?></li>
            <?php endforeach; ?>
        </ul>

        <h4>Disadvantages</h4>
        <ul>
            <?php foreach($details[$subject]['disadvantages'] as $dis): ?>
                <li><?php echo $dis; ?></li>
            <?php endforeach; ?>
        </ul>

        <h4>Available Courses</h4>
        <ul>
            <?php foreach($details[$subject]['courses'] as $course): ?>
                <li><?php echo $course; ?></li>
            <?php endforeach; ?>
        </ul>

        <h4>Career Opportunities</h4>
        <ul>
            <?php foreach($details[$subject]['careers'] as $career): ?>
                <li><?php echo $career; ?></li>
            <?php endforeach; ?>
        </ul>

        <a href="dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>
        <a href="quiz.php?subject=<?php echo $subject; ?>" class="btn btn-success">🎯 Take Quiz & Get Suggestion</a>
    <?php else: ?>
        <h3 class="text-danger">Invalid subject selected.</h3>
    <?php endif; ?>
</div>
</body>
</html>
