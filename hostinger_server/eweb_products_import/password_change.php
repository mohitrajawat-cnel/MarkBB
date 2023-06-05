<?php
//database connection file include
include 'config.php';
require 'head.php';

$error='';
if(isset($_POST['change_password']))
{
    $password = $_POST['password'];
    
    $select = "SELECT * from `user_login`";
    $row= $conn->query($select);
    if(mysqli_num_rows($row) > 0)
    {

        $result = mysqli_fetch_assoc($row);
        $username = $result['username'];
        $update = "UPDATE `user_login` SET `password`='".$password."' where `username`='".$username."'";

        if(mysqli_query($conn,$update))
        {
            $error = '<div style="text-align:center;color:green;">Hello, '.$username.'. Your Password Updated Successfully.</div>';
        }
        else
        {
            $error = '<div style="text-align:center;color:red;">Password not updated.</div>';
        }
    } 
    else
    {
        $error = '<div style="text-align:center;color:red;">No account of user</div>';
    }

}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<div class="container" style="width:40%;">
    <div class="row" style="text-align:center;">
        <div class="col-md-12 col-12">
            <?php echo $error; ?>
        </div>
    </div>
    <div class="row">
        </div class="col-md-6">
            <form method="post">
        
            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="text" name="password" id="form1Example2" class="form-control" />
                <label class="form-label" for="form1Example2">Change Password</label>
            </div>


            <!-- Submit button -->
            <button type="submit" name="change_password" class="btn btn-primary btn-block">Update Password</button>
            </form>
        </div>
    </div>
</div>

<?php
require 'footer.php';