<html>
<head>
<title>Post-New-Topic</title>
</head>
<body>
    <?php
        session_start();
        include_once("phpfunction/fileSystem.php");
        include_once("phpfunction/database.php");
        getConnect();
        $uid = $_SESSION['uid'];
        $query = "select hid, bid from user where uid=$uid";
        $result = mysqli_fetch_array(mysqli_query($databaseConnection, $query));
        $hid = $result[0];
        $bid = $result[1];
        $query = "select max(tid) from thread";
        $result = mysqli_fetch_array(mysqli_query($databaseConnection, $query));
        $tid = $result[0]+1;

        echo "<a href='home.php'><input type='button' value='home'></a>";
        echo "<br />";
        
        echo "<form method='post' action=''>";

        echo "Title:";
        echo "<input type='text' name='title' size='20' maxlength='15'>";
        echo "</br>";

        echo "Message:";
        echo "<input type='text' name='message' size='60' maxlength='45'>";
        echo "</br>";

        echo "Visible to:";
        echo "<input type='radio' name='vtype' value='friend' checked>friend
        <input type='radio' name='vtype' value='neighbor'>neighbor
        <input type='radio' name='vtype' value='block'>block
        <input type='radio' name='vtype' value='neighborhood'>neighborhood";
        echo "</br>";

        echo "</br>";
        echo "<input name='location[]' type='checkbox' value='location'>include location";

        echo "</br>";
        echo "<input name='post' type='submit' id='post' value='post'>";

        echo "</form>";
        clickMap();

        if (isset($_POST["post"])){
            $title = $_POST["title"];
            $message = $_POST["message"];
            $vtype = $_POST["vtype"];
            switch($vtype){
                case "friend":
                    $vtype=1;
                    $query="select uid, fuid from friend where uid=$uid or fuid=$uid";
                    $result=mysqli_query($databaseConnection, $query);
                    while ($line=mysqli_fetch_array($result)){
                        if ($uid==$line[0]) $nuid=$line[1];
                        else $nuid=line[0];
                        $query="insert into msgbox(uid,eid,tid,no,mtype,settime) values ($nuid,$uid,$tid,0,5,current_timestamp)";
                        mysqli_query($databaseConnection,$query);
                    }
                break;
                case "neighbor":
                    $vtype=2;
                    $query="select nuid from neighbor where uid=$uid";
                    $result=mysqli_query($databaseConnection, $query);
                    while ($line=mysqli_fetch_array($result)){
                        $nuid=$line[0];
                        $query="insert into msgbox(uid,eid,tid,no,mtype,settime) values ($nuid,$uid,$tid,0,5,current_timestamp)";
                        mysqli_query($databaseConnection,$query);
                    }
                break;
                case "block":
                    $vtype=3;
                    $query="select uid from user where bid=$bid";
                    $result=mysqli_query($databaseConnection, $query);
                    while ($line=mysqli_fetch_array($result)){
                        $nuid=$line[0];
                        $query="insert into msgbox(uid,eid,tid,no,mtype,settime) values ($nuid,$uid,$tid,0,5,current_timestamp)";
                        mysqli_query($databaseConnection,$query);
                    }
                break;
                case "neighborhood":
                    $vtype=4;
                    $query="select uid from user where hid=$hid";
                    $result=mysqli_query($databaseConnection, $query);
                    while ($line=mysqli_fetch_array($result)){
                        $nuid=$line[0];
                        $query="insert into msgbox(uid,eid,tid,no,mtype,settime) values ($nuid,$uid,$tid,0,5,current_timestamp)";
                        mysqli_query($databaseConnection,$query);
                    }
                break;
            }
            if (empty($_POST["location"])){
                $longitude=0;
                $latitude=0;
            }
            else{
                $lng="<script>document.writeln(longitude);</script>";
                $lat="<script>document.writeln(latitude);</script>";
                $longitude=-78.987194;
                $latitude=40.693169;
            }
            $query = "insert into thread(tid,uid,hid,bid,title,visibtype,longitude,latitude,posttime) 
                values($tid,$uid,$hid,$bid,'$title',$vtype,$longitude,$latitude,current_timestamp)";
            $query = mysqli_real_escape_string($databaseConnection, $query);
            mysqli_query($databaseConnection, $query);
            $query = "insert into message(tid,uid,hid,bid,no,text,posttime) 
                values($tid,$uid,$hid,$bid,0,'$message',current_timestamp)";
            $query = mysqli_real_escape_string($databaseConnection, $query);
            mysqli_query($databaseConnection, $query);
        }
    ?>
</body>
</html>