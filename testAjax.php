<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD Ajax</title>
        <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap core JS-JQUERY -->
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="./assets/jumbotron.css" rel="stylesheet">

</head>
<body>
    <!-- DIV HIDEN MODAL BOOTRAPP -->
    <div class="modal fade" id="completeModal" tabeindex="-1" role="dialog" aria-labelledby="exampleModaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="completename">Name</label><br>
                        <input type="text" id="completename" name="nom" class="form-control" placeholder="enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="completemail">Email</label><br>
                        <input type="email" id="completemail" name="email" class="form-control" placeholder="enter your email" required>
                    </div> 
                    <div class="form-group">
                        <label for="completemobile">mobile</label><br>
                        <input type="text" id="completemobile" name="mobile" class="form-control" placeholder="enter your mobile number" required>
                    </div>
                    <div class="form-group">
                        <label for="completeplace">Place</label><br>
                        <input type="text" id="completeplace" name="place" class="form-control" placeholder="enter your location" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="adduser()" >Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabeindex="-1" role="dialog" aria-labelledby="exampleModaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="updatename">Name</label><br>
                        <input type="text" id="updatename" name="nom" class="form-control" placeholder="enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="updatemail">Email</label><br>
                        <input type="email" id="updatemail" name="email" class="form-control" placeholder="enter your email" required>
                    </div> 
                    <div class="form-group">
                        <label for="updatemobile">mobile</label><br>
                        <input type="text" id="updatemobile" name="mobile" class="form-control" placeholder="enter your mobile number" required>
                    </div>
                    <div class="form-group">
                        <label for="updateplace">Place</label><br>
                        <input type="text" id="updateplace" name="place" class="form-control" placeholder="enter your location" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="updateDetails()" >Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddendata">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- DIV CONTENAIRE -->
    <div class="container my-4">
        <h1 class="text-center "> Using PHP Modal with AJAX</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#completeModal"> Add new user </button>
        </br> <br>
        <div id="displayDataTable"></div>
    </div>

    <script>
        //appel automatique
        $(document).ready(function(){
            displayData();//appel automatique
        });
        //display function
        function displayData(){
            var displayData="true";
            $.ajax({
                url:"testDisplay.php",
                type:"post",
                data:{
                    displaySend:displayData
                },
                success:function(data,status){
                     $("#displayDataTable").html(data);
                }
            });
        }
        function adduser(){
            var nameAdd=$("#completename").val();
            var emailAdd=$("#completemail").val();
            var mobileAdd=$("#completemobile").val();
            var placeAdd=$("#completeplace").val();
            $.ajax({//4 parameters
                url:"TestInserer.php",
                type:"post",
                data:{
                    nameSend:nameAdd,
                    emailSend:emailAdd,
                    mobileSend:mobileAdd,
                    placeSend:placeAdd
                },
                success:function(data,status){
                    //function to dispalay data;
                    console.log(status);
                    $("#completeModal").modal('hide');
                    displayData();
                }
            });
        }
        //Delete record
        function deleteUser(deleteid){
            if( confirm("Are you sure to delete this user ?")){
                $.ajax({
                url:"testDelete.php",
                type:"post",
                data:{
                    deleteSend:deleteid
                },
                success:function(data, status){
                    displayData();
                    console.log(status);
                }
            });
            }
        }
        //Update Details showing
        function GetDetails(updateid){
            $("#hiddendata").val(updateid);
            //post takes 3 parametres (url,data,success) pas de type
            $.post("testUpdate.php",{updateid:updateid},function(data,status){
                var userid=JSON.parse(data);
                $('#updatename').val(userid.name);
                $('#updatemail').val(userid.email);
                $('#updatemobile').val(userid.mobile);
                $('#updateplace').val(userid.place);
            });
            $("#updateModal").modal('show');//For showing the modal which has id=updateModal
        }
        //Update function details
        function updateDetails(){
            var updatename=$('#updatename').val();
            var updatemail=$('#updatemail').val();
            var updatemobile=$('#updatemobile').val();
            var updateplace=$('#updateplace').val();
            var hiddendata=$('#hiddendata').val();
            $.post("testUpdate.php",{
                updatename:updatename,
                updatemail:updatemail,
                updatemobile:updatemobile,
                updateplace:updateplace,
                hiddendata:hiddendata

            },function(data,status){
                $("#updateModal").modal('hide');//to hide Modal
                displayData(); 
            });
        }
    </script>
    
</body>
</html>