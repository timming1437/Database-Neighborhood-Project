<html>
<head>
<title>Topic</title>
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
        $tid = $_GET['tid'];

        $query = "select title, name, posttime, visibtype, longitude, latitude from thread join user where tid=$tid";
        $result = mysqli_fetch_array(mysqli_query($databaseConnection, $query));
        $longitude=$result[4];
        $latitude=$result[5];
        
        echo "<h2>$result[0]</h2>";
        echo "created by $result[1] at $result[2]</br>";
        $visibtype = $result[3];
        switch ($visibtype){
            case 1:
                echo "visible to friend</br>";
            break;
            case 2:
                echo "visible to neighbor</br>";
            break;
            case 3:
                echo "visible to block</br>";
            break;
            case 4:
                echo "visible to neighborhood</br>";
            break;
        }

        $query = "select no, text, posttime, uid from message where tid=$tid order by no";
        $result = mysqli_query($databaseConnection, $query);
        echo "<table><tr>";
        echo "<table border = \"1\">\n";
        while ($line=mysqli_fetch_array($result)){
            echo "\t<tr>\n";
            $query = "select name from user where uid=$line[3]";
            $uname = mysqli_fetch_array(mysqli_query($databaseConnection,$query))[0];
            echo "\t\t<td>$line[0]</td><td><a href='profile.php?puid=$line[3]'>".$uname."</td><td>$line[2]</td><td>$line[1]</td>\n";
            echo "\t<tr>\n";
        }
        echo "</table>";
        echo "<a href='reply.php?tid=$tid'><input type='button' value='reply'></a>";
        posMap($latitude, $longitude);
    ?>
</body>
</html>