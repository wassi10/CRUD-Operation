<?php
     // connect to database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "crud_operation"; 

        //create connection
        $connection = new mysqli($servername, $username, $password, $database);

        $id = "";
        $Name = "";
        $Email = "";
        $Phone = "";
        $Address = "";

        $errorMassage = "";
        $successMassage = "";

    if( $_SERVER['REQUEST_METHOD'] == 'GET'){
        //GET Method: Show the data of the client

        if(!isset($_GET["id"])){
            header("location: /CRUD-Operation/index.php");
            exit;
        }

        $id = $_GET["id"];

        $sql = "SELECT * FROM `client` WHERE id=$id";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("location: /CRUD-Operation/index.php");
            exit;
        }

        $Name = $row["Name"]; //database row name
        $Email = $row["Email"];
        $Phone = $row["Phone"];
        $Address = $row["Address"];

    }else{
        //POST Method: Update the data of the client

        $id = $_POST["id"];
        $Name = $_POST["name"];
        $Email = $_POST["email"];
        $Phone = $_POST["phone"];
        $Address = $_POST["address"];

        do{
            if( empty($id) || empty($Name) || empty($Email) || empty($Phone) || empty($Address)){
                $errorMassage = "All the fields are required";
                break;
            }

            //Insert new client to database

            $sql = "UPDATE `client`" . "SET `Name`='$Name',`Email`=' $Email',`Phone`='$Phone',`Address`='$Address'" . "WHERE id = $id";


            $result = $connection->query($sql);

            if(!$result){
                $errorMassage  = "Invalid Query: ". $connection->error;
                break;
            }
           
            $successMassage = "Client updated correctly";

            // TO ALLOW USER TO REDIRECT TO INDEX.PHP FILE
            header("location: /CRUD-Operation/index.php");
            exit;

        }while(false);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create: Crud Operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">

        
        <div class="text-center mb-4">
        <h2>Update Information</h2>
        <p class="text-muted">Complete the form below to add a new user</p>
        </div>
        
        <?php
            if(!empty($errorMassage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMassage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }

        ?>
        

        <form method="post">
            <input type="hidden" name = "id" value="<?php echo $id; ?>">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $Name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $Email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $Phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $Address; ?>">
                </div>
            </div>

                <?php

                    if(!empty($successMassage)){
                         echo "
                        <div class='row mb-3>
                            <div class='offset-sm-3 col-sm-6'>
                                <div class='alert alert-success alert-dismissible fade show'        role='alert'>
                                <strong>$successMassage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            </div>
                        </div>
                         ";
                     }
                ?>


            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-dark" href="/CRUD-Operation/index.php" role="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</body>
</html>