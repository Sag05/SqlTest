<?php    
    function One($link){
        echo "<p> 1: Skriv ut all info om lärare som jobbar 100%</p>";
        $res = mysqli_query($link, "SELECT * FROM teachers WHERE workload = 100");
        PrintResult($res);
    }

    function Two($link){
        echo "<p> 2: Skriv ut namn på de kurser som är inlagda</p>";
        $res = mysqli_query($link, "SELECT name FROM courses");
        PrintResult($res);
    }
    
    function Three($link){
        echo "<p> 3: Skriv ut fullständigt namn och födelsedata på de tio första eleverna i tabellen</p>";
        $res = mysqli_query($link, "SELECT firstname, lastname, birthdate FROM students LIMIT 10");
        PrintResult($res);
    }

    function Four($link){
        echo "<p> 4: Skriv ut all info om alla elever som har ett namn som innehåller ett e (antingen förnamn eller efternamn)</p>";
    }

    function Five($link){
        echo "<p> 5: Skriv ut ämne och namn på de kurser som har några elever kopplade</p>";
    }

    function Six($link){
        echo "<p> 6: Skriv ut namn på lärare som inte är kopplade till någon kurs</p>";
    }

    function Seven($link){
        echo "<p> 7: Skriv ut namn på de studenter som är kopplade till någon kurs i matematik. Skriv bara samma namn en gång ifall de finns i flera kurser</p>";
    }

    function Eight($link){
        echo "<p> 8: Skriv ut namn på lärare och kurs till ämnena matematik och programmering. Om lärare saknas ska ni skriva vakant istället för lärarens namn</p>";
    }

    function Nine($link){
        echo "<p> 9: Skriv ut id och namn på de elever som läser någon kurs enligt coursestudents. Namnen ska bara skrivas ut en gång om de läser flera kurser. Sortera på id</p>";
    }

    function Ten($link){
        echo "<p> 10: Skriv ut namn på de studenter som endast läser en kurs</p>";
    }

    function PrintResult($res)
    {
        echo "<table border='1'>";
        
        $row = mysqli_fetch_assoc($res);

        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<th>$key</th>";
        }
        echo "</tr>";
        mysqli_data_seek($res, 0);

        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>$cell</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
?>