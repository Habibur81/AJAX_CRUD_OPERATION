<?php

    $con = new mysqli('localhost', 'root', '', 'crudajax');
//     Check connection
//    if ($con->connect_error) {
//        die("Connection failed: " . $con->connect_error);
//    }
//    echo "Connected successfully";

    extract($_POST);

//show data from database
    if (isset($_POST['readrecord']))
    {
        $data = '<table class="table table-bordered table-striped">
                        <tr>
                            <th>No</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>';
                    
                    $display = "select * from crud";

                    $result = mysqli_query($con, $display);

                    if(mysqli_num_rows($result) > 0)
                    {
                        $number = 1;
                        while($row = mysqli_fetch_array($result))
                        {
                            $data .='<tr>
                                        <td>'.$number.'</td>>
                                        <td>'.$row['firstname'].'</td>
                                        <td>'.$row['lastname'].'</td>
                                        <td>'.$row['email'].'</td>
                                        <td>'.$row['mobile'].'</td>
                                        <td>
                                            <button onclick="getUserDetails('.$row['id'].')" class="btn btn-info">Edit</button>
                                        </td>
                                        <td>
                                            <button onclick="deleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
                                        </td>
                                     </tr>';

                            $number++;
                        }

                    }
               $data .= '</table';

                echo $data;

    }

//insert data into database
    if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile']))
    {
        $query = "INSERT INTO crud (firstname, lastname, email, mobile) VALUES ('$firstname', '$lastname', '$email', '$mobile')";

        mysqli_query($con, $query);

    }

//// delete user record from database

    if (isset($_POST['deleteid']))
    {
        $userid = $_POST['deleteid'];

        $deletequery = "delete from crud where id = '$userid' ";

        mysqli_query($con, $deletequery);
    }
////get user data form database
    if(isset($_GET['id']))
    {
        $user_id = $_GET['id'];

        $query = "SELECT * FROM crud WHERE id = '$user_id' ";

        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $response = $row;
            }


        }

        echo json_encode($response);

    }

    if(isset($_POST['update_hidden_user_id']))
    {
        $update_hidden_user_id = $_POST['update_hidden_user_id'];
        $update_firstname = $_POST['update_firstname'];
        $update_lastname = $_POST['update_lastname'];
        $update_email = $_POST['update_email'];
        $update_mobile = $_POST['update_mobile'];

        $query = "update crud set firstname = '$update_firstname', lastname = '$update_lastname', email = '$update_email', mobile = '$update_mobile' where id = '$update_hidden_user_id' ";
    //echo "data ".$update_hidden_user_id;
        mysqli_query($con, $query);

    }


?>