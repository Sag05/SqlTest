<?php    
    function One($link){
        echo "<h2> 1: Skriv ut all info om lärare som jobbar 100%</h2>";
        //Select all info from teachers where workload is 100
        $res = mysqli_query($link, "SELECT * FROM teachers WHERE workload = 100");
        PrintResult($res);
    }

    function Two($link){
        echo "<h2> 2: Skriv ut namn på de kurser som är inlagda</h2>";
        //Select names from courses
        $res = mysqli_query($link, "SELECT name FROM courses");
        PrintResult($res);
    }
    
    function Three($link){
        echo "<h2> 3: Skriv ut fullständigt namn och födelsedata på de tio första eleverna i tabellen</h2>";
        //Select the first 10 firstnames, lastnames and birthdates from students
        $res = mysqli_query($link, "SELECT firstname, lastname, birthdate FROM students LIMIT 10");
        PrintResult($res);
    }

    function Four($link){
        echo "<h2> 4: Skriv ut all info om alla elever som har ett namn som innehåller ett e (antingen förnamn eller efternamn)</h2>";
        //Select all info from students where any name contains an E
        $res = mysqli_query($link, "SELECT * FROM students WHERE firstname LIKE '%e%' OR lastname LIKE '%e%'");
        PrintResult($res);
    }

    function Five($link){
        echo "<h2> 5: Skriv ut ämne och namn på de kurser som har några elever kopplade</h2>";
        //Select subject and name from courses where the id is in the coursestudents table, which means that there are students in the course
        $res = mysqli_query($link, "SELECT subject, name FROM courses WHERE id IN (SELECT course_id FROM coursestudents)");
        printResult($res);
    }

    function Six($link){
        echo "<h2> 6: Skriv ut namn på lärare som inte är kopplade till någon kurs</h2>";
        //
        $res = mysqli_query($link, "SELECT firstname, lastname FROM teachers WHERE id NOT IN (SELECT teacher_id FROM courses)");
        PrintResult($res);
    }

    function Seven($link){
        echo "<h2> 7: Skriv ut namn på de studenter som är kopplade till någon kurs i matematik. Skriv bara samma namn en gång ifall de finns i flera kurser</h2>";
        $res = mysqli_query($link, "SELECT DISTINCT firstname, lastname FROM students WHERE id IN (SELECT student_id FROM coursestudents WHERE course_id IN (SELECT id FROM courses WHERE subject = 'matematik'))");
        PrintResult($res); 
    }

    function Eight($link){
        echo "<h2> 8: Skriv ut namn på lärare och kurs till ämnena matematik och programmering. Om lärare saknas ska ni skriva vakant istället för lärarens namn</h2>";
        $res = mysqli_query($link, "SELECT subject, name, IFNULL(firstname, 'vakant') as firstname, IFNULL(lastname, 'vakant') as lastname from courses LEFT JOIN teachers 
        ON courses.teacher_id = teachers.id WHERE subject IN('matematik', 'programmering')");
        PrintResult($res);
    }

    function Nine($link){
        echo "<h2> 9: Skriv ut id och namn på de elever som läser någon kurs enligt coursestudents. Namnen ska bara skrivas ut en gång om de läser flera kurser. Sortera på id</h2>";
        $res = mysqli_query($link, "SELECT DISTINCT students.id, students.firstname, students.lastname FROM students JOIN coursestudents ON students.id = coursestudents.student_id ORDER BY students.id");
        PrintResult($res);
    }

    function Ten($link){
        echo "<h2> 10: Skriv ut namn på de studenter som endast läser en kurs</h2>";
        $res = mysqli_query($link, "SELECT firstname, lastname FROM students WHERE id IN (SELECT student_id FROM coursestudents GROUP BY student_id HAVING COUNT(*) = 1)");
        PrintResult($res);
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