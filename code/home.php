<html>
<head>
<title>Neighborhood-Home</title>
<h2>Home</h2>
</head>
<body>
    <?php
        session_start();
        $uid = $_SESSION["uid"];
        include_once("phpfunction/fileSystem.php");
        include_once("phpfunction/database.php");

        
        getConnect();
        echo "<a href='profile.php?puid=$uid'><input type='button' value='profile'></a>";
        echo "<a href='setting.php'><input type='button' value='setting'></a>";
        echo "<a href='search_user.php'><input type='button' value='search user'></a>";
        echo "<a href='search_block.php'><input type='button' value='search block'></a>";
        echo "<a href='search_neighborhood.php'><input type='button' value='search neighborhood'></a>";
        echo "<br />";
        echo "<br />";
        echo "<a href='post_topic.php'><input type='button' value='post new topic'></a>";
        echo "<a href='search_message.php'><input type='button' value='search message'></a>";
        echo "<br />";


        $msgSQL = "select mtype,tid,no,etext,eid from msgbox where uid=$uid";
        $msgResult = mysqli_query($databaseConnection, $msgSQL);
        if ($msgResult !== false) {
            echo "<br />";
            echo "New Notifications:";
            echo "<br />";
            while ($line = mysqli_fetch_array($msgResult)) {
                switch ($line[0]){
                    case 1: #hood app
                        $eid=$line[4];
                        echo "$line[3]<br />";
                        echo "
                            <form method='post' action=''>
                            <input name='accepthood' type='submit' id='accepthood' value='accept'>";
                        if (isset($_POST["accepthood"])){
                            $query = "select confirm from hoodapp where uid=$eid";
                            $result = mysqli_query($databaseConnection, $query);
                            $num = mysqli_fetch_array($result);
                            if ($num[0]==2){
                                $query = "
                                    update user set hid=(select hid from hoodapp where eid=$eid) 
                                        where uid=$eid;
                                    delete from hoodapp where eid=$eid;";
                                mysqli_query($databaseConnection, $query);
                                $query="insert into msgbox(uid, mtype, settime) values ($eid, 2, current_timestamp);";
                                mysqli_query($databaseConnection, $query);
                            }
                            else{
                                $n = $num[0]+1;
                                $query = "update hoodapp set confirm=$n where eid=$eid";
                                mysqli_query($databaseConnection, $query);
                            }
                            $query = "delete from msgbox where uid=$uid and eid=$eid and $mtype=1";                                mysqli_query($databaseConnection, $query);
                            Header("Location:home.php");
                        }

                        echo"<input name='rejecthood' type='submit' id='rejecthood' value='reject'>";
                        if (isset($_POST["rejecthood"])){
                            $query = "delete from msgbox where uid=$uid and eid=$eid and mtype=1";
                            mysqli_query($databaseConnection, $query);
                            Header("Location:home.php");
                        }
                        echo "</form>";
                    break;

                    case 2: #hood confirm
                        echo "You have joined a new neighborhood!<br />";
                    break;

                    case 3: #friend app
                        $eid=$line[4];
                        echo "$line[3]<br />";
                        echo"<form method='post' action=''>
                            <input name='acceptfriend' type='submit' id='acceptfriend' value='accept'>";
                        if (isset($_POST["acceptfriend"])){
                            $query = "delete from msgbox where uid=$uid and eid=$eid and mtype=3;";
                                
                            mysqli_query($databaseConnection, $query);
                            $query = "insert into friend(uid, fuid, settime) values ($uid,$eid,current_timestamp);";
                            mysqli_query($databaseConnection, $query);
                            Header("Location:home.php");
                        }

                        echo"<input name='rejectfriend' type='submit' id='rejectfriend' value='reject'>";
                        if (isset($_POST["rejectfriend"])){
                            $query = "delete from msgbox where uid=$uid and eid=$eid and mtype=3";
                            mysqli_query($databaseConnection, $query);
                            Header("Location:home.php");
                        }
                        echo "</form>";
                    break;

                    case 4: #friend confirm
                        $tempuid=$line[4];
                        $query = "select `name` from user where uid=$tempuid";
                        $result=mysqli_query($databaseConnection, $query);
                        $fname=mysqli_fetch_array($result)[0];
                        echo "$fname has become your friend!";
                    break;

                    case 5:
                    break;
                }
            }

            echo "<br />";
            echo "New Messages";
            echo "<br />";

            echo "<table><tr>";
            echo "<table border = \"1\">\n";
            echo "\t\t<td>Topic</td><td>Message</td>\n";
            $msgSQL = "select mtype,tid,no,etext,eid from msgbox where uid=$uid";
            $msgResult = mysqli_query($databaseConnection, $msgSQL);
            while ($line = mysqli_fetch_array($msgResult)) {
                if ($line[0]==5){ #regular post visible
                    $tid=$line[1];
                    $no=$line[2];
                    $topicSQL = "select title from thread where tid=$tid";
                    $topic = mysqli_fetch_array(mysqli_query($databaseConnection, $topicSQL))[0];
                    $messageSQL = "select text from message where tid=$tid and `no`=$no";
                    $message = mysqli_fetch_array(mysqli_query($databaseConnection, $messageSQL))[0];
                    echo "\t<tr>\n";
                    echo "\t\t<td><a href='topic.php?tid=$tid'>".$topic."</td>\n";
                    echo "\t\t<td>$message</td>\n";
                    echo "\t<tr>\n";
                }
            }
        }




        closeConnect();
    ?>
</body>
</html>