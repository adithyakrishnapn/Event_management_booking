<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <div class="container">
            <div class="row">
                <div class="right col-6">

                </div>
                <div class="left col-6">
                    <ul>
                        <li><a href="admin.php">ADMIN</a></li>
                        <li><a href="index.php" class="active">USER</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="main">
        <h1 class="pt-4" style="text-align: center;color: white;">Change Password</h1>
        <div class="box mt-4">
        <form action="password.php" method="post">
        <label>Enter the Username</label>
        <input type="text" name="name" placeholder="Username">
        <input type="number" name="number" placeholder="Number">
        <input type="submit">
    </form>
        </div>
    </div>
</body>
</html>