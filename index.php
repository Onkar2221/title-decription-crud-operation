<?php
//INSERT INTO `newone` (`sr.no`, `title`, `description`, `tstamp`) VALUES (NULL, 'Cricket', 'I Love Cricket So much.', current_timestamp());
$insert = false;
$update = false;
$delete = false;
//Connnect to the database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newone";

// Creata connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Die if connection was not successful
if (!$conn) {
  die("connection failed :" . mysqli_connect_error());
}

//Delete purpose
if (isset($_GET['delete'])) {
  $sr_no = $_GET['delete'];
  $delete = true;

  $sql = "DELETE FROM `newone` WHERE `sr_no` = $sr_no";
  $result = mysqli_query($conn, $sql);

}



// echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['sr_noEdit'])) {
    // Update the record
    $sr_no = $_POST["sr_noEdit"]; //When we are ding "UPDATE"
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

    // Sql query to be executed for Update
    $sql = "UPDATE `newone` SET `title` = '$title' ,`description` = '$description' WHERE `newone`.`sr_no` = $sr_no";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    }
  } else {
    $title = $_POST["title"];
    $description = $_POST["description"];

    // Sql query to be executed
    $sql = "INSERT INTO `newone` (`title`, `description`) VALUES ('$title' , '$description')";
    $result = mysqli_query($conn, $sql);


    if ($result) {
      // echo "The record has been inserted successfully <br>";
      $insert = true;
    } else {
      echo "Error, The record was not inserted successfully" . mysqli_error($conn);
    }
  }
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
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
  <title>Hello, world!</title>
  <!-- <script>
  edits=document.getElementByClassName('edit');
  Array.form(edits).forEach((element)=>{
    element.addEventListener("click",(e)=>{
       console.log("edit" ,e); 
  })
</script>
 -->


</head>

<body>
  <!--  Edit Model   -->
  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
EditModal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal">Edit this Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="index.php" method="post">
            <input type="hidden" name="sr_noEdit" id="sr_noEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" area-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="description">Note Description</label>
              <textarea name="descriptionEdit" id="descriptionEdit" rows="3" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary my-3" type="submit">Update Notes</button>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


.
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">CRUD</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Contact US</a>
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
    echo "<div class='alert alert-success alert-dismissible fade show'  role='alert'>
  <strong>Success!</strong> Your notes has been inserted successfully
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  ?>
  <?php
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show'  role='alert'>
  <strong>Success!</strong> Your notes has been updated successfully
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  ?>
  <?php
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show'  role='alert'>
  <strong>Success!</strong> Your notes has been deleted successfully
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  ?>

  <div class="container my-5">
    <h2>Add a Note</h2>
    <form action="index.php" method="post">
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" area-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="description">Note Description</label>
        <textarea name="description" id="description" rows="3" class="form-control"></textarea>
      </div>
      <button class="btn btn-primary my-3" type="submit">Add Notes</button>
    </form>
  </div>

  <div class="container my-4"></div>

  <div class="container">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">sr_no</th>
          <th scope="col">Title</th>
          <th scope="col">Desc</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `newone`";
        $result = mysqli_query($conn, $sql);
        $sr_no = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sr_no = $sr_no + 1;
          echo "<tr>
       <th scope='row'>" . $sr_no . "</th>
      <td>" . $row['title'] . "</td>
      <td>" . $row['description'] . "</td>
      <td><button class='edit  btn btn-sm btn-primary' id=" . $row['sr_no'] . ">Edit </button>
      <button class='delete  btn btn-sm btn-primary' id=d" . $row['sr_no'] . ">Delete</button>
      </td>
    </tr>";
        }
        ?>

      </tbody>
    </table>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        tr = e.target.parentNode.parentNode
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);

        titleEdit.value = title;
        descriptionEdit.value = description;
        sr_noEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');

      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit",);
        $sr_no = e.target.id.substr(1,);  //substr(means Everything else except that )
        console.log($sr_no);
        if (confirm("Are you sure you want to delete this note!")) {
          console.log("Yes");
          //  window.location=`/CRUD/index.php?delete=${sr_no}`;
          window.location = `./index.php?delete=${$sr_no}`;
          // window.location=`http://localhost/new%20CRUD/index.php?delete=${sr_no}`;
        }
        else {
          console.log("No");
        }
      })
    })

  </script>
</body>

</html>