<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Record Page</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Student Forum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" type="button" onclick="window.open('Record.php')">Insert Data<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" type="button" onclick="window.open('view.php')">View Data<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" type="button" onclick="window.open('delete.php')">Delete Data<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" type="button" onclick="window.open('update.php')">Update Data<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //$Seat_Number = $_POST['Seat_Number'];
        $First_Name = $_POST['First_Name'];
        $Last_Name = $_POST['Last_Name'];
        $Gender = $_POST['Gender'];
        $Email = $_POST['Email'];
        $Year = $_POST['Year'];
        $Address = $_POST['Address'];



        // Connecting to the Database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "student_information_system";

        // Create a connection
        $conn = mysqli_connect($servername, $username, $password, $database);
        // Die if connection was not successful
        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        } else {
            if (!empty($First_Name) && !empty($Last_Name) && !empty($Gender) && !empty($Email) && !empty($Year) && !empty($Address)) {
                $duplicate = mysqli_query($conn, "SELECT * from `student_information` WHERE Email = '$Email'");
                if (mysqli_num_rows($duplicate) > 0) {
                    echo '<div class="alert alert-fail alert-dismissible fade show" role="alert">
          <strong>Failed!</strong> Email is already in use.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>';
                } else {
                    // Submit these to a database
                    // Sql query to be executed
                    $sql = "INSERT INTO `student_information` (`First_Name`, `Last_Name`, `Gender`, `Email`, `Year`, `Address`) VALUES ('$First_Name', '$Last_Name', '$Gender', '$Email', '$Year', '$Address')";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>';
                    } else {
                        // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>';
                    }
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Failed!</strong> Please complete the form.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>';
            }
        }
    }


    ?>

    <div class="container mt-3">
        <h1>Insert Your Data</h1>
        <form action="Record.php" method="post">
            <div class="form-group">
                <label for="First_Name">First Name: </label>
                <input type="text" name="First_Name" class="form-control" id="First_Name" aria-describedby="emailHelp" required>
            </div>

            <div class="form-group">
                <label for="Last_Name">Last Name: </label>
                <input type="text" name="Last_Name" class="form-control" id="Last_Name" aria-describedby="emailHelp" required>
            </div>

            <div class="form-group">
                <label for="Gender">Gender: </label> <br>
                Male<input type="radio" name="Gender" value="Male" class="form-control" id="Gender" aria-describedby="emailHelp" required>
                Female<input type="radio" name="Gender" value="Female" class="form-control" id="Gender" aria-describedby="emailHelp" required>
            </div>

            <div class="form-group">
                <label for="Email">Email: </label>
                <input type="email" name="Email" class="form-control" id="Email" aria-describedby="emailHelp" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>

            <div class="form-group">
                <label for="Year">Year: </label>
                <input type="number" name="Year" class="form-control" id="Year" aria-describedby="emailHelp" required>
            </div>

            <div class="form-group">
                <label for="Address">Address: </label>
                <input type="text" name="Address" class="form-control" id="Address" aria-describedby="emailHelp" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
</body>

</html>