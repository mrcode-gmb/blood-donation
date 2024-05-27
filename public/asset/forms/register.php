<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Develop Skill</title>
    <link rel="stylesheet" href="../asset/mystyle/form.css">
    <link rel="stylesheet" href="../asset/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../asset/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../asset/boxicons/css/boxicons.min.css">
</head>
<body>
    <div id="container">
        <div class="container">
            <div class="col-lg-halp">
                <div class="form-left">
                    <div class="form-logo">
                        <img src="../asset/photos/images-removebg-preview (copy).png" alt="">
                        <h4>Welcome To Online Learning</h4>
                        <p>We provide a more defrent books to help you</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-halp">
                <div class="form-right">
                    <form action="../php/Controllers/RegisterController.php" method="POST">                        
                        <div class="form">
                            <div class="form-header">
                                <h4>Create new account</h4>
                                <p>Is easy open new accout by carry few step.</p>
                            </div>
                            <?php if(isset($_GET['message'])): ?>
                                <div class="message">
                                    <?= $_GET['message'] ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="">Fullname</label>
                                    <div class="form-control">
                                        <i class="bx bx-user"></i>
                                        <input type="name" name="fullname" placeholder="Fullname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Email address</label>
                                    <div class="form-control">
                                        <i class="bx bxl-gmail"></i>
                                        <input type="email" name="email" placeholder="Email address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">New password</label>
                                    <div class="form-control">
                                        <i class="bx bx-lock"></i>
                                        <input type="password" name="password" placeholder="New assword">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Comfirm password</label>
                                    <div class="form-control">
                                        <i class="bx bx-lock"></i>
                                        <input type="password" name="cpassword" placeholder="Comfirm password">
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 10px;">
                                    <button name="submit" type="submit">Register</button>
                                </div>
                                <div class="form-group">
                                    <p>Already have and account? <a href="index.php">login your account</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>