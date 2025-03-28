<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP No.1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 400px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            width: 100%;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #ff9800;
            border-color: #ff9800;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">User Information</h2>
        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $contact = $_POST['contact'];
            $errors = [];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
            if (!preg_match("/^[0-9]{10}$/", $contact)) {
                $errors[] = "Contact number must be 10 digits";
            }
            if (empty($address)) {
                $errors[] = "Address cannot be empty.";
            }
            if (empty($gender)) {
                $errors[] = "Gender is required.";
            }
            if ($errors) {
                $_SESSION['errors'] = $errors;
            } else {
                $_SESSION['success_message'] = "Form submitted successfully!";
                header("Location: thank_you.php");
                exit;
            }
        }
        if (isset($_SESSION['errors'])) {
            echo "<div class='alert alert-danger'>";
            foreach ($_SESSION['errors'] as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
            unset($_SESSION['errors']);
        }
        ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select class="form-control" name="gender" required>
                    <option value="">what is your genda?</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="mechanic">mechanic</option>
                    <option value="mechanic">mechanic</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="tel" class="form-control" id="contact" name="contact" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
