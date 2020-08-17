<html>
<head>
<title>User-Setting</title>
</head>
<body>
    <?php
        session_start();
        include_once("phpfunction/fileSystem.php");
        include_once("phpfunction/database.php");
        getConnect();
        $uid = $_SESSION['uid'];

        $query = "select fntf, nntf, bntf, hntf, emailntf from setting where uid=$uid";
        $result = mysqli_query($databaseConnection, $query);
        $line = mysqli_fetch_array($result);

        echo "<a href='home.php'><input type='button' value='home'></a>";
        echo "<br />";
        echo "<br />";

        echo "Friend message notification: ";
        if ($line[0]==true) echo "Y";
        else echo "N";
        echo "<form method='post' action=''>
        <input name='yfntf' type='submit' id='yfntf' value='yes'>";
        if (isset($_POST["yfntf"])){
            $query = "update setting set fntf=true where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "<input name='nfntf' type='submit' id='nfntf' value='no'>";
        if (isset($_POST["nfntf"])){
            $query = "update setting set fntf=false where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "</form>";

        echo "Neighbor message notification: ";
        if ($line[1]==true) echo "Y";
        else echo "N";
        echo "<form method='post' action=''>
        <input name='ynntf' type='submit' id='ynntf' value='yes'>";
        if (isset($_POST["ynntf"])){
            $query = "update setting set nntf=true where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "<input name='nnntf' type='submit' id='nnntf' value='no'>";
        if (isset($_POST["nnntf"])){
            $query = "update setting set nntf=false where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "</form>";

        echo "Block message notification: ";
        if ($line[2]==true) echo "Y";
        else echo "N";
        echo "<form method='post' action=''>
        <input name='ybntf' type='submit' id='ybntf' value='yes'>";
        if (isset($_POST["ybntf"])){
            $query = "update setting set bntf=true where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "<input name='nbntf' type='submit' id='nbntf' value='no'>";
        if (isset($_POST["nbntf"])){
            $query = "update setting set bntf=false where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "</form>";

        echo "Neighborhood message notification: ";
        if ($line[3]==true) echo "Y";
        else echo "N";
        echo "<form method='post' action=''>
        <input name='yhntf' type='submit' id='yhntf' value='yes'>";
        if (isset($_POST["yhntf"])){
            $query = "update setting set hntf=true where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "<input name='nhntf' type='submit' id='nhntf' value='no'>";
        if (isset($_POST["nhntf"])){
            $query = "update setting set hntf=false where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "</form>";

        echo "Email notification: ";
        if ($line[4]==true) echo "Y";
        else echo "N";
        echo "<form method='post' action=''>
        <input name='yentf' type='submit' id='yentf' value='yes'>";
        if (isset($_POST["yentf"])){
            $query = "update setting set emailntf=true where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "<input name='nentf' type='submit' id='nentf' value='no'>";
        if (isset($_POST["nentf"])){
            $query = "update setting set emailntf=false where uid=$uid";
            mysqli_query($databaseConnection, $query);
            Header("Location:setting.php");
        }
        echo "</form>";
    ?>
</body>
</html>