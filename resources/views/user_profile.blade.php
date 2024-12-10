@extends('master', ['cartcount' => $cartcount, 'wishcount' => $wishcount, 'subcategory' => $subcategory, 'subcategory2' => $subcategory2])

@section('content')
    <div id="user_profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <h2 class="section-head">My Profile</h2>

                    <div class="tablediv">
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <td><b>User Name :</b></td>
                                <td id="username"></td>
                            </tr>
                            <tr>
                                <td><b>User Email :</b></td>
                                <td id="useremail"></td>
                            </tr>

                        </table>
                    </div>
                    <a class="modify-btn btn" href="">Modify Details</a>
                    <a class="modify-btn btn" href="change_password.php">Change Password</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var username = $("#username").val();
            var useremail = $("#useremail").val();
            $.ajax({
                url: 'singleUser',
                data: "GET",
                success: function(data) {
                    var output = `
                    <table class="table table-bordered table-responsive">
                            <tr>
                                <td><b>User Name :</b></td>
                                <td id="username">${data.name}</td>
                            </tr>
                            <tr>
                                <td><b>User Email :</b></td>
                                <td id="useremail">${data.email}</td>
                            </tr>

                        </table>
                    `
                    $(".tablediv").empty()
                    $(".tablediv").append(output)


                }
            })
        })
    </script>
@endsection
