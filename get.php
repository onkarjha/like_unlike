<!--this is the code written by onkar jha of tech with onkar youtube channal looking for people response towards this system-->
<?php
if (isset($_POST['how']))
{
    session_start();
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['data'];
    $conn = new mysqli("localhost", "root", "", "captcha");
    $sql1 = "SELECT `liker`, `liked` FROM `likes` WHERE liker='$user_id' and liked='$post_id'";
    $res = $conn->query($sql1);
    if ($res->num_rows == 0)
    {
        $sql2 = "UPDATE `uploads` SET `count`=count+1 WHERE id='$post_id'";
        if ($conn->query($sql2))
        {
            $sql3 = "INSERT INTO `likes`(`liker`, `liked`) VALUES ('$user_id','$post_id')";
            if ($conn->query($sql3))
            {
                echo 1;
            }
        }
    }
    else if ($res->num_rows == 1)
    {
        $sql2 = "UPDATE `uploads` SET `count`=count-1 WHERE id='$post_id'";
        if ($conn->query($sql2))
        {
            $sql3 = "DELETE FROM `likes` WHERE liker='$user_id' and liked='$post_id'";
            if ($conn->query($sql3))
            {
                echo 0;
            }
        }
    }

}

?>
