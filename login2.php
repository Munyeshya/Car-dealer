<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>CarDealer</title>
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <style>
        body {
            background: url('images/peakpx.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="container d-flex flex-column align-items-center" style="height: 100vh;">
        <!-- Logo Section -->
        <div class="mb-4">
            <img src="images/logo1.svg" alt="CarDealer Logo" style="max-width: 200px;">
        </div>

        <!-- Form Section -->
        <form class="border rounded p-4" style="background-color: rgba(255, 255, 255, 0.8);" id="login-formb">
            <h1 class="text-center">Login</h1>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark btn-block">Login</button>
            </div>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
