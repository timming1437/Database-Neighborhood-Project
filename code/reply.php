<html>
<head>
<title>Reply</title>
</head>
<body>
    <?php
        session_start();
        include_once("phpfunction/fileSystem.php");
        include_once("phpfunction/database.php");
        getConnect();
        $uid = $_SESSION['uid'];
        echo "<a href='home.php'><input type='button' value='home'></a>";
        echo "<br />";
        $tid = $_GET["tid"];
        $query = "select max(no) from message where tid=$tid";
        $result = mysqli_fetch_array(mysqli_query($databaseConnection, $query));
        $no = $result[0];
        $no = $no + 1;
        $query = "select hid,bid from thread where tid=$tid";
        $result = mysqli_fetch_array(mysqli_query($databaseConnection, $query));
        $hid = $result[0];
        $bid = $result[1];
        echo "<form method='post' action=''>";

        echo "<input type='text' name='message' size='60' maxlength='45'>";
        echo "</br>";
        echo "<input name='post' type='submit' id='post' value='post'>";

        echo "</form>";
        if (isset($_POST["post"]) && $_POST["message"]!==""){
            $message = $_POST["message"];
            $query = "insert into message(tid,no,uid,text,posttime,hid,bid) values ($tid,$no,$uid,'$message',current_timestamp,$hid,$bid)";
                mysqli_query($databaseConnection,$query);
            $query = "select uid, visibtype from thread where tid=$tid";
            $result = mysqli_fetch_array(mysqli_query($databaseConnection,$query));
            $vtype = $result[1];
            $uid = $result[0];
            switch($vtype){
                case 1:
                    $query="select uid, fuid from friend where uid=$uid or fuid=$uid";
                    $result=mysqli_query($databaseConnection, $query);
                    while ($line=mysqli_fetch_array($result)){
                        if ($uid==$line[0]) $nuid=$line[1];
                        else $nuid=line[0];
                        $query="insert into msgbox(uid,eid,tid,no,mtype,settime) values ($nuid,$uid,$tid,0,5,current_timestamp)";
                        mysqli_query($databaseConnection,$query);
                    }
                break;
                case 2:
                    $query="select nuid from neighbor where uid=$uid";
                    $result=mysqli_query($databaseConnection, $query);
                    while ($line=mysqli_fetch_array($result)){
                        $nuid=$line[0];
                        $query="insert into msgbox(uid,eid,tid,no,mtype,settime) values ($nuid,$uid,$tid,0,5,current_timestamp)";
                        mysqli_query($databaseConnection,$query);
                    }
                break;
                case 3:
                    $query="select uid from user where bid=$bid";
                    $result=mysqli_query($databaseConnection, $query);
                    while ($line=mysqli_fetch_array($result)){
                        $nuid=$line[0];
                        $query="insert into msgbox(uid,eid,tid,no,mtype,settime) values ($nuid,$uid,$tid,0,5,current_timestamp)";
                        mysqli_query($databaseConnection,$query);
                    }
                break;
                case 4:
                    $query="select uid from user where hid=$hid";
                    $result=mysqli_query($databaseConnection, $query);
                    while ($line=mysqli_fetch_array($result)){
                        $nuid=$line[0];
                        $query="insert into msgbox(uid,eid,tid,no,mtype,settime) values ($nuid,$uid,$tid,0,5,current_timestamp)";
                        mysqli_query($databaseConnection,$query);
                    }
                break;
            }
        }
    ?>
</body>
</html>