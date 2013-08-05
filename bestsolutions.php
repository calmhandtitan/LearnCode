<?php
    error_reporting(E_ALL);
    ini_set('display_errors'.'1');
    session_start();
    if(!isset($_SESSION['username']))
        header("Location:index.php?id=4");
    include 'server_constraints.php';
    include 'function.php';
    $problem_name = $_GET['id'];
    $con = mysqli_connect($host, $server_username, $server_password, $db);
?>
<html>
 <head>
        <title>D-odge</title>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div id = "header">
            <div id = "logo">
                D-odge  ^
            </div>
            <div id = "header-bar">
                <div id = "menu" style ="float:left">
                    <ul>
                       <li><a href = "problemset.php">Problemset</a></li>
                   </ul>
                </div>
                <div id = user-id style = "float:right; font-size:19px;">
                    <ul>
                        <li ><a href = "userhome.php"><?php echo $_SESSION['username'];?></a></li>
                        <li><a href = "logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
<?php
    echo "<table class = \"table-style\">
            <th>id</th>
            <th>username</th>
            <th>time</th>
            ";
    $query = "select * from code_submissions where question = '".$problem_name."' and result ='accepted'";
    $result = mysqli_query($con, $query);
    echo mysqli_error($con);
    echo mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result))
    {
        echo '<tr>
                <td><a href = "codedisplay.php?id='   .$row['code_num'].'&lang='.convert_lang_to_url($row['language']).'" target="_blank">'   .$row['code_num'].    '</a></td>
                <td><a href = problem.php?id=' .$problem_name. '>'.$row['username'].'</a></td>
                <td>'.$row['sub_time'].'</td>
                </tr> ';
    }
    echo "</table>";
?>
    </body>
</html>