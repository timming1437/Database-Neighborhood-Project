<html>
<head>
<title>Search-Message</title>
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
        
        echo "search message by keywords";
        echo"<form method='post' action=''>
            <input name='keyword' type='text' id='keyword'>
            <input name='search' type='submit' id='search' value='search'>";
        echo "</form>";
        if (isset($_POST["search"])){
            $keyword=$_POST["keyword"];
            $query="select tid,no,text from message where text like '%$keyword%'";
            $result=mysqli_query($databaseConnection, $query);
            echo "<table><tr>";
            echo "<table border = \"1\">\n";
            while ($line=mysqli_fetch_array($result)){
                echo "\t<tr>\n";
                echo "\t\t<td><a href='topic.php?tid=$line[0]'>".$line[2]."</td>\n";
                echo "\t<tr>\n";
            }
            echo "</table>";
        }
    ?>
</body>
</html>