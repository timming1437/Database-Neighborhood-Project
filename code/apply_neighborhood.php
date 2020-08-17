<html>
<head>
<title>Neighborhood-Apply</title>
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
        $hid = $_GET["hid"];

        $query = "select hname from hood where hid=$hid";
        $hname = mysqli_fetch_array(mysqli_query($databaseConnection, $query))[0];
        $query = "select name from user where uid=$uid";
        $name = mysqli_fetch_array(mysqli_query($databaseConnection, $query))[0];
        echo "Apply to join neighborhood ".$hname."?";

        echo"<form method='post' action=''>
            <input name='apply' type='submit' id='apply' value='apply'>";
        echo "</form>";

        if (isset($_POST["apply"])){
            $query = "select uid from user where hid=$hid";
            $result = mysqli_query($databaseConnection, $query);
            while ($line=mysqli_fetch_array($result)){
                $query = "insert into msgbox(uid,etext,eid,settime) 
                    values($line[0],'$name wanted to join $hname',$uid,current_timestamp)";
                mysqli_query($databaseConnection, $query);
            }
            $query = "insert into hoodapp(uid, hid, confirm) values($uid, $hid, 0)";
            mysqli_query($databaseConnection, $query);
            Header("Location:home.php");
        }
    ?>
</body>
</html>