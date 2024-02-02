<!doctype html>
<html lang="en" data-bs-theme="auto">


<head>

    <script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>MRFN - Car Rental</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/heroes/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }


        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="heroes.css" rel="stylesheet">

</head>





<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap" />
                </svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                <li><a href="#" class="nav-link px-2 text-white">About</a></li>
            </ul>

            <!-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..."
                        aria-label="Search">
                </form> -->

            <!-- <div class="text-end"> 
            <button type="button" class="btn btn-outline-light me-2" >Admin Login</button>
            <button type="button" class="btn btn-warning" >Sign-up</button>
          </div> -->

            <div class="text-end">

                <a href="signupPage.php" class="btn btn-warning">Sign-up</a>
                <a href="adminLogin.html" class="btn btn-warning">Admin Login</a>
            </div>

        </div>
    </div>
</header>



<div class="container col-xl-10 col-xxl-8 px-4 py-5">


    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">MRFN Car Rental</h1>
            <p class="col-lg-10 fs-4">
                Welcome to MRFN Car Rental System, where every journey begins with a seamless rental experience.
                Our diverse fleet of quality vehicles is matched with competitive pricing and dedicated customer service,
                ensuring a hassle-free rental for both leisure and business needs.
                Choose MRFN for a reliable and enjoyable driving experience, where your satisfaction is our journey.
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action="handleLogin.php" method="post">


                <?php
                //var_dump($_POST);

                if (!empty($_GET["msg"])  && $_GET["msg"] == "empty_field") {
                    #Since we put that error message in the GET in "handleSignUp"
                ?>
                    <!-- Since we are writing HTML now -->
                    <div class="alert alert-primary" role="alert">
                        <strong>Empty Field</strong>
                    </div>

                <?php
                }    #since this bracket belongs to code ie php not the html part

                ?>

                <?php
                //var_dump($_POST);

                if (!empty($_GET["msg"])  && $_GET["msg"] == "Invalid Email or Password") {
                    #Since we put that error message in the GET in "handleSignUp"
                ?>


                    <!-- Since we are writing HTML now -->
                    <div class="alert alert-primary" role="alert">
                        <strong>Invalid Email or Password</strong>
                    </div>

                <?php
                }    #since this bracket belongs to code ie php not the html part

                ?>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="password">Password</label>
                </div>


                <!-- WILL BE CHANGED LATERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR FOR EVERY SINGLE USER -->
                <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
                <!-- <a href="handleLogin.php" class="btn btn-bd-primary"> Login</a> -->
                <hr class="my-4">
                <!-- <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small> -->
            </form>
        </div>
    </div>
</div>

<div class="b-example-divider"></div>

</main>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="css/bootstrap.bundle.min.js"></script>

</body>

</html>