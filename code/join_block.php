<html>
<head>
<style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
<title>Join-Block</title>
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
        $bid = $_GET["bid"];

        $query = "select bname, longitudesw, latitudesw, longitudene, latitudene from block where bid=$bid";
        $result = mysqli_fetch_array(mysqli_query($databaseConnection, $query));
        $bname = $result[0];
        $longitude = ($result[1]+$result[3])/2;
        $latitude = ($result[2]+$result[4])/2;
        $query = "select name from user where uid=$uid";
        $name = mysqli_fetch_array(mysqli_query($databaseConnection, $query))[0];
        echo "Join block ".$bname."?";

        echo"<form method='post' action=''>
            <input name='apply' type='submit' id='apply' value='join'>";
        echo "</form>";

        if (isset($_POST["apply"])){
            $query = "alter table user
            modify bid int(11) not null";
            mysqli_query($databaseConnection, $query);
            $query = "update user set bid=$bid where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:home.php");
        }
        posMap($latitude, $longitude);
    ?>
</body>
</html>