<?php
function clean($value) {
    return htmlspecialchars(trim($value ?? ""), ENT_QUOTES, "UTF-8");
}

$submitted = ($_SERVER["REQUEST_METHOD"] === "POST");
$errors = [];
$data = [];

if ($submitted) {
    $data = [
        "Full Name" => clean($_POST["fullname"] ?? ""),
        "Email" => clean($_POST["email"] ?? ""),
        "Phone Number" => clean($_POST["phone"] ?? ""),
        "Date of Birth" => clean($_POST["dob"] ?? ""),
        "Gender" => clean($_POST["gender"] ?? ""),
        "Course" => clean($_POST["course"] ?? ""),
        "Address" => clean($_POST["address"] ?? "")
    ];

    foreach ($data as $label => $value) {
        if ($value === "") {
            $errors[] = $label . " is required.";
        }
    }

    if (!filter_var($_POST["email"] ?? "", FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (!preg_match("/^[0-9]{10}$/", $_POST["phone"] ?? "")) {
        $errors[] = "Phone number must contain exactly 10 digits.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js" defer></script>
</head>
<body>
    <main class="container">
        <?php if ($submitted && empty($errors)): ?>
            <section class="result-card">
                <div class="success-icon">&#10003;</div>
                <h1>Registration Successful!</h1>
                <p class="subtitle">Your application details have been submitted.</p>

                <h2>Submitted Information</h2>
                <div class="details">
                    <?php foreach ($data as $label => $value): ?>
                        <div class="detail-row">
                            <strong><?= $label ?></strong>
                            <span><?= $value ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="button" href="index.php">Back to Registration</a>
            </section>

        <?php else: ?>
            <section class="form-card">
                <h1>Online Registration</h1>
                <p class="subtitle">Please fill in the details below to register.</p>

                <?php if (!empty($errors)): ?>
                    <div class="error-box">
                        <?php foreach ($errors as $error): ?>
                            <p><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form id="registrationForm" method="POST" action="index.php">
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="10-digit phone number"
                               pattern="[0-9]{10}" maxlength="10" required>
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="course">Course Applying For</label>
                        <select id="course" name="course" required>
                            <option value="">Select a course</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Information Science">Information Science</option>
                            <option value="Electronics and Communication">Electronics and Communication</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>
                    </div>

                    <button type="submit">Submit Application</button>
                </form>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
