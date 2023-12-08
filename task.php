<?php


    $link = mysqli_connect("localhost", "root", "", "prov");
    //header("Location: index.php");

    $res = mysqli_query($link, "SELECT * FROM `task`");
    PrintResult($res);
    
    function A()
    {
        
    }



    
    
    
    
    
    
    
    
    
    function PrintResult($res)
    {
        echo "<table border='1'>";
        echo "<tr><td>id</td><td>name</td><td>description</td><td>date</td><td>status</td></tr>";
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['description'] . "</td><td>" . $row['date'] . "</td><td>" . $row['status'] . "</td></tr>";
        }
        echo "</table>";
    }
?>