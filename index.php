<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>


    <div class="container my-5">
        <h2>List of People</h2>
        <a href="/CRUD-Operation/create.php" class="btn btn-dark mb-3" role="button">Add New</a>
        <br>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "crud_operation"; 

                    //create connection
                    $connection = new mysqli($servername, $username, $password, $database);

                    //check connection
                    if($connection->connect_error){
                        die("Connection failed: " .$connection->connect_error);
                    }

                    //Read all row from database table
                    $sql = "SELECT * FROM client";
                    $result = $connection->query($sql);

                    if(!$result){
                        die("Invalid Query: " .$connection->error);
                    }

                    //read data of each row
                    while($row = $result->fetch_assoc()){
                        echo "
                            <tr>
                                <td>$row[id]</td>
                                <td>$row[Name]</td>
                                <td>$row[Email]</td>
                                <td>$row[Phone]</td>
                                <td>$row[Address]</td>
                                <td>$row[created_at]</td>
                                <td>
                                    <a class='btn btn-dark btn-sm' href='/CRUD-Operation/update.php?id=$row[id]'>Update</a>
                                    <a class='btn btn-danger btn-sm' href='/CRUD-Operation/delete.php?id=$row[id]' >Delete</a>
                                    
                                </td>
                            </tr>

                        ";
                    }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>