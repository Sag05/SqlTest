<?php
    
    $link = mysqli_connect("localhost", "root", "", "SQL_test_TE");
    
    if($link){
        echo "Connection to database sucessful!<br />";
    }else{
        die("Connection failed!" . mysqli_connect_error());
    }
    



    //$return =  SELECT * FROM students WHERE birthdate > __05__; 

    //Select studens born after june
    function BornAfterSelection()
    {
        $sql = "SELECT * FROM students WHERE SUBSTRING(birthdate, 3, 2) > 05";
        $res = mysql_query($link, $sql); 
    }
    

    //write names of courses missing a teacher
    MissingTeacher(
        SELECT * FROM courses WHERE teacher_id = 0 OR teacher_id IS NULL; 
    )

    //count number of students for all courses
    CountStudents(
        //Separate by course id
        SELECT COUNT(*) FROM coursestudents GROUP BY course_id;  
        //Separate by course name
        SELECT courses.name, COUNT(*) as num FROM courses JOIN coursestudents WHERE coursestudents.course_id = courses.id GROUP BY courses.name; 
    )

    //Display all courses where 
    MathCourses(
        SELECT * FROM courses WHERE courses.subject = "matematik"; 
    )

    //Display all teachers whos workload is 100%
    FullWorkload(
        SELECT firstname, lastname FROM teachers WHERE teachers.workload < 100;
    )
    
    //List all teachers that have a course
    TeacherCourse(
        //Copilot answer: SELECT teachers.firstname, teachers.lastname, courses.name FROM teachers JOIN courses WHERE teachers.id = courses.teacher_id;
        //Lists all teachers, multiple times if they have multiple courses
        SELECT firstname, lastname FROM teachers JOIN courses WHERE courses.teacher_id = teachers.id;
        //Lists all teachers that have a course once
        SELECT DISTINCT firstname, lastname FROM teachers JOIN courses WHERE courses.teacher_id = teachers.id; 
        //https://stackoverflow.com/questions/7686049/sql-select-to-make-a-value-appear-only-once
    )

    //list name of teacher and studens in course PRRPRR02
    TeacherStudents(
        //Copilot answer; returns nothing
        SELECT teachers.firstname, teachers.lastname, students.firstname, students.lastname FROM teachers JOIN courses JOIN coursestudents JOIN students WHERE courses.name = "PRRPRR02" AND courses.id = coursestudents.course_id AND coursestudents.student_id = students.id AND courses.teacher_id = teachers.id;
       
        //WIP answer      
        SELECT teachers.firstname, teachers.lastname, students.firstname, students.lastname FROM teachers 
        JOIN courses ON teachers.id = courses.teacher_id
        JOIN courseStudents ON courses.id = courseStudents.course_id
        JOIN students ON courseStudents.student_id = students.id WHERE courses.name = 'PRRPRR02';
    )

?>