<html>
<head>
<title>Neighborhood-Profile</title>
</head>
<body>
    <?php
        $puid = $_GET['puid'];
        session_start();
        include_once("phpfunction/fileSystem.php");
        include_once("phpfunction/database.php");
        getConnect();
        $uid = $_SESSION['uid'];

        $query = "select `name` from `user` where uid=$uid";
        $result=mysqli_query($databaseConnection, $query) or die (mysqli_error($databaseConnection));
        $uname = mysqli_fetch_array($result)[0];
        $query = "select `name`,`email`,address,profile,hid,bid from user where uid=$puid";
        $result = mysqli_query($databaseConnection, $query);
        $line = mysqli_fetch_array($result);

        echo "<a href='home.php'><input type='button' value='home'></a>";
        echo "<br />";
        echo "<br />";

        echo "Name: $line[0]</br>";
        echo "Email: $line[1]</br>";
        echo "Address: $line[2]</br>";

        echo "Description: ";

        if ($puid==$uid){
            echo "<form method='post' action=''>";
            echo "<input type='text' name='profile' size='20' maxlength='15' placeholder='$line[3]'>";
            echo "<input name='edit' type='submit' id='edit' value='edit'>";
            
            if (isset($_POST["edit"])){
                $profile=$_POST["profile"];
                $notnullSQL="alter table user modify profile varchar(45) not null ;";
                mysqli_query($databaseConnection, $notnullSQL);
                $updateSQL = "update user set profile='$profile' where uid=$uid";
                mysqli_query($databaseConnection, $updateSQL);
                Header("Location:profile.php?puid=$puid");
            }
            echo "</form>";
        }
        else{
            echo "$line[3]</br>";
        }

        echo "Neighborhood: ";
        if ($line[4]==""){
            echo "not in any neighborhood";
            if ($uid==$puid){
                echo "<a href='search_neighborhood.php'><input type='button' value='neighborhood apply'></a>";
            }
        }
        else {
            $query = "select hname from hood where hid=$line[4]";
            $result = mysqli_fetch_array(mysqli_query($databaseConnection, $query))[0];
            echo "$result";
        }
        echo "</br>";

        echo "Block: ";
        if ($line[5]==""){
            echo "not in any block";
            if ($uid==$puid){
                echo "<a href='search_block.php'><input type='button' value='join block'></a>";
            }
        }
        else {
            $query = "select bname,longitudesw,latitudesw,longitudene,latitudene from block where bid=$line[5]";
            $result = mysqli_fetch_array(mysqli_query($databaseConnection, $query));
            echo "$result[0]";
            $longitude = ($result[1]+$result[3])/2;
            $latitude = ($result[2]+$result[4])/2;
            echo "</br>";
        }

        if ($puid==$uid){
            $query = "select uid,fuid from friend where uid=$uid or fuid=$uid";
            $result = mysqli_query($databaseConnection, $query);
            echo "Your friends:";
            echo "<table><tr>";
            echo "<table border = \"1\">\n";
            while ($line = mysqli_fetch_array($result)){
                if ($uid==$line[0]) $fuid=$line[1];
                else $fuid=$line[0];
                $query = "select name,email from user where uid=$fuid";
                $fname = mysqli_fetch_array(mysqli_query($databaseConnection, $query))[0];
                $femail = mysqli_fetch_array(mysqli_query($databaseConnection, $query))[1];
                echo "\t<tr>\n";
                echo "\t\t<td><a href='profile.php?puid=$fuid'>".$fname."</td>\n";
                echo "\t\t<td>$femail</td>\n";
                echo "\t<tr>\n";
            }
            echo "</table>";
        }
        else{
            $query = "select uid,fuid from friend where (uid=$uid and fuid=$puid) or (fuid=$uid and uid=$puid)";
            $result = mysqli_query($databaseConnection, $query);
            if (mysqli_fetch_array($result)[0]==""){
                echo "<form method='post' action=''>";
                echo "<input name='applyfriend' type='submit' id='applyfriend' value='friend apply'>";
                if (isset($_POST["applyfriend"])){
                    $query = "insert into msgbox(uid, mtype, etext, eid, settime) values ($puid, 3, '"."$uname"." wanted to be your friend', $uid, current_timestamp)";
                    mysqli_query($databaseConnection, $query);
                }
                echo "</form>";
            }
            else echo "Your friend </br>";
        }

        if ($puid==$uid){
            $query = "select nuid from neighbor where uid=$uid";
            $result = mysqli_query($databaseConnection, $query);
            echo "Your neighbors:";
            echo "<table><tr>";
            echo "<table border = \"1\">\n";
            while ($line = mysqli_fetch_array($result)){
                $nuid = $line[0];
                $query = "select name,email from user where uid=$nuid";
                $nname = mysqli_fetch_array(mysqli_query($databaseConnection, $query))[0];
                $nemail = mysqli_fetch_array(mysqli_query($databaseConnection, $query))[1];
                echo "\t<tr>\n";
                echo "\t\t<td><a href='profile.php?puid=$nuid'>".$nname."</td>\n";
                echo "\t\t<td>$nemail</td>\n";
                echo "\t<tr>\n";
            }
            echo "</table>";
        }
        else{
            $query = "select nuid from neighbor where uid=$uid and nuid=$puid";
            $result = mysqli_query($databaseConnection, $query);
            if (mysqli_fetch_array($result)[0]==""){
                echo "<form method='post' action=''>";
                echo "<input name='addneighbor' type='submit' id='addneighbor' value='add neighbor'>";
                if (isset($_POST["addneighbor"])){
                    $query = "insert into neighbor(uid, nuid, settime) values ($uid, $puid, current_timestamp)";
                    mysqli_query($databaseConnection, $query);
                    Header("Location:profile.php?puid=$puid");
                }
                echo "</form>";
            }
            else echo "Your neighbor </br>";
        }

        posMap($latitude, $longitude);
    ?>
</body>
</html>