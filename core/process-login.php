<?php include 'conn.php';?>
<?php
if(isset($_POST['login'])){

    if(empty($_POST['account']) || empty($_POST['password'])){

        echo "All fileds required";
    
    }else
    {
     
        $accountNumber = mysqli_real_escape_string($con,$_POST["account"]);

        $password = md5($_POST["password"]);

        $sql = "SELECT * FROM users WHERE account = '$accountNumber' AND password = '$password' ";

        $run_query = mysqli_query($con,$sql)or die(mysqli_error($con));

        $count = mysqli_num_rows($run_query);
        
        if($count == 1){
            $row = mysqli_fetch_assoc($run_query);
            session_start();
            if($row["type"] == 'B'){
               
                $_SESSION['user_id'] = $row['id'];

                header('Location: ../home.php');

            }else if($row["type"] == 'C'){
                $_SESSION['type'] =  'C';
                $_SESSION["user_id"] = $row['id'];
                header('Location: ../user.php');
            }
            
        }else
        {
            echo "User not found please check your details properly ";

        }
    }
}
?>