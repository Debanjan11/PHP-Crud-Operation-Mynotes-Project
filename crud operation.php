<?php

$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "crud notes";

$conn = new mysqli($servername, $username, $password, $database);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['snoEdit'])) {
        $sno = $_POST['snoEdit'];
        $name = $_POST['nameEdit'];
        $title = $_POST['titleEdit'];
        $description = $_POST['descriptionEdit'];

        $sql = "UPDATE `notes` SET `name` = '$name' , `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = '$sno'";
        $result = mysqli_query($conn, $sql);

        if($result){
            $update = true;
        }

    } else {
        $name = $_POST['name'];
        $Title = $_POST['title'];
        $desc = $_POST['description'];


        // DATA INSERT INTO DATABASE

        $sql = "INSERT INTO `notes` (`name`, `title`, `description`) VALUES ('$name', '$Title', '$desc')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $insert = true;
        }
    }
}

// DELETE OPTION CREATE

if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- LINK JQUERY DATA TABLE CSS  -->

    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">

    <title>CRUD OPERATION</title>

</head>

<body class="" style="background-color: #95B9C7">



    <!-- BOOTSTRAP MODAL START FOR EDIT BUTTON -->

    <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
        Edit Modal
    </button>-->


    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="/PHP PRATICE/CRUD OPERATION.PHP" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <h2>Edit Your Notes</h2>
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="test" class="form-control" id="nameEdit" name="nameEdit"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Note Description</label>
                            <textarea class="form-control" id="descriptionEdit" name="descriptionEdit"
                                rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Note</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



    <!-- BOOTSTARP NAV BAR -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/PHP PRATICE/CRUD OPERATION/crud operation.php">My Notes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/PHP PRATICE/CRUD OPERATION/crud operation.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Note Has Been Submitted Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
    }
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Note Has Been Updated Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
    }
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your Note Has Been Deleted Successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
    }
    ?>



    <!-- BOOTSTRAP FORM START -->

    <div style="width:1140px; height:500px; margin:auto; margin-top:20px; padding:20px">
        <form action="/PHP PRATICE/CRUD OPERATION/crud operation.php" method="POST">
            <h2>Enter Your Notes Please</h2>
            <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input type="test" class="form-control" id="name" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <hr>
    </div>



    <!-- BOOTSTRAP TABLE START -->

    <div style="width:1140px; height:500px; margin:auto; padding:20px">
        <h2>Your All Notes Show Here</h2>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">SL No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <!-- DATA SHOW IN TABLE FROM DATA BASE -->

                <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);

                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <th scope='row'>" . $no . "</th>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td> <button class='edit btn btn-sm btn-primary' id =" . $row['sno'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id =d" . $row['sno'] . ">Delete</button> </td>
                </tr>";
                    // echo $row['sno'] . $row['name'] . $row['title'] . $row['description'] . $no;
                    // echo "<br>";
                    $no++;
                }
                ?>


            </tbody>
        </table>
        <hr>
    </div>










    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->







    <!-- JAVASCRIPT START FOR EDIT BUTTON -->

    <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit");
                tr = e.target.parentNode.parentNode;
                name = tr.getElementsByTagName("td")[0].innerText;
                title = tr.getElementsByTagName("td")[1].innerText;
                description = tr.getElementsByTagName("td")[2].innerText;
                console.log(name, title, description);
                nameEdit.value = name;
                titleEdit.value = title;
                descriptionEdit.value = description;
                //editmodal.toggle();
                $('#editmodal').modal('toggle');
                snoEdit.value = e.target.id;
                console.log(e.target.id);
            })
        })</script>



<script>
        // JAVASCRIPT START FOR DELETE BUTTON 
        deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit");
                sno = e.target.id.substr(1,)
                console.log (sno);               
                if(confirm("Are You Sure You Want To Delete This Note ?")){
                    console.log("yes");
                    window.location = `/PHP PRATICE/CRUD OPERATION.PHP?delete=${sno}`;
                }
                else {
                    console.log("no");
                }
                
            })
        })
    </script>



    <!-- JQUERY DATA TABLE START -->

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
    
</body>

</html>
