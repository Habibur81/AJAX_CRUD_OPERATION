<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>AJAX CRUD OPERATION</title>
        <!--ajax cdn link-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!--bootstrap 4 cdn link-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">

                    <h1 class="text-uppercase text-center text-primary">ajax crud operation</h1>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Open modal
                        </button>
                    </div>
                    <div>
                        <h2 class="text-info">All Records</h2>
                        <div id="records_contant"></div>
                    </div>

                    <!-- user insert  The Modal  and form start-->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title text-">ajax crud operation</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" name="" id="firstname" class="form-control" placeholder="First Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="" id="lastname" class="form-control" placeholder="Last Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="" id="email" class="form-control" placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="tel" name="" id="tel" class="form-control" placeholder="Mobile Number">
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- user insert  The Modal  and form end-->

                    <!-- user update  The Modal  and form start-->
                    <div class="modal" id="user_update_model">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title text-center">ajax crud Update</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" name="" id="update_firstname" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="" id="update_lastname" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="" id="update_email" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="tel" name="" id="update_tel" class="form-control" >
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateuserdetail()">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <input type="hidden" name="" id="hidden_user_id">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- user update  The Modal  and form end-->

                </div>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


        <script>
            //// data refreshing show code
            $(document).ready(function (){

                readRecords();

            });

            //// data show ajax code
            function readRecords()
            {
                let readrecord = "readrecord";
                $.ajax({
                    url : "backend1.php",
                    type : "post",
                    data : {
                                readrecord : readrecord
                            },
                    success : function (data, status){

                                $("#records_contant").html(data)

                                },

                });

            }

            //// data insert ajax code
            function addRecord()
            {
                    let firstname = $("#firstname").val();
                    let lastname = $("#lastname").val();
                    let email = $("#email").val();
                    let mobile = $("#tel").val();

                    $.ajax({
                        url : "backend1.php",
                        type : "post",
                        data : {
                            firstname : firstname,
                            lastname : lastname,
                            email : email,
                            mobile : mobile
                        },
                        success : function (data, status)
                        {
                            readRecords();
                        }

                    });
            }

            //// delete user record ajax code
            function deleteUser(deleteid)
            {
                let conf = confirm("Are you sure!");
                if (conf == true)
                {
                    $.ajax({
                        url : "backend1.php",
                        type : "post",
                        data : {deleteid : deleteid},
                        success : function (data, status){
                            readRecords();
                        }
                    });
                }

            }

            //// update user record ajax code

            function getUserDetails(id)
            {
                $("#hidden_user_id").val(id);

                $.get(
                    "backend1.php",

                    {id : id},

                    function (data, status){
                        // console.log("data");
                        // console.log(data);
                        let user = JSON.parse(data);

                        $("#update_firstname").val(user.firstname);
                        $("#update_lastname").val(user.lastname);
                        $("#update_email").val(user.email);
                        $("#update_tel").val(user.mobile);
                    }

                );

                $("#user_update_model").modal("show");
            }

            function updateuserdetail()
            {
                let update_hidden_user_id = $('#hidden_user_id').val();

                console.log("");

                let update_firstname = $('#update_firstname').val();
                let update_lastname = $('#update_lastname').val();
                let update_email = $('#update_email').val();
                let update_mobile = $('#update_tel').val();

                $.post(
                    "backend1.php",
                    {
                        update_hidden_user_id : update_hidden_user_id,
                        update_firstname : update_firstname,
                        update_lastname : update_lastname,
                        update_email : update_email,
                        update_mobile : update_mobile
                    },
                    function (data, status)
                    {
                        $('#user_update_model').modal("hide");

                        readRecords();
                    }
                );
            }


        </script>
    </body>
</html>

