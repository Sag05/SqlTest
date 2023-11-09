<?php
	$link = mysqli_connect("localhost", "root", "");
	
	if($link){
		echo "Connection to database sucessful!<br />";
	}else{
		die("Connection failed!" . mysqli_connect_error());
	}
	
	$sql = "CREATE DATABASE SQL_test_TE";
	if (mysqli_query($link, $sql)) {
		echo "Database created successfully<br />";
	} else {
		die("Error creating database: " . mysqli_error($link));
	}

	mysqli_close($link);
	
	//Skapar kontakt med den nya databasen
	$link = mysqli_connect("localhost", "root", "", "SQL_test_TE");
	mysqli_query($link, "SET character_set_results = 'utf8', character_set_client = 'utf8', 
						character_set_connection = 'utf8', character_set_database = 'utf8', 
						character_set_server = 'utf8'");

	if($link){
		echo "Connection to database SQL_test_TE sucessful!<br />";
	}else{
		die("Connection failed!" . mysqli_connect_error());
	}
	
	//Skapar tabell för studenter
	$sql = "CREATE TABLE students(
			id INT AUTO_INCREMENT PRIMARY KEY,
			firstname TEXT,
			lastname TEXT,
			birthdate VARCHAR(6))";
			
	if(mysqli_query($link, $sql)){
		echo "Table students created succesfully!<br />";
	}else{
		die("Error creating table students").mysqli_error($link);
	}
	
	//Array med studenter
	$students = [["Anton", "Andersson", "030329"], ["Britt", "Bengtsson", "030320"], ["Ceasar", "Classon", "030513"], ["Daniella", "Dinkel", "030823"], ["Ebbot", "Eriksson", "031110"], ["Felicia", "Forsberg", "031205"], ["Gustav", "Gyllenhammar", "030710"], ["Hilda", "Hansdotter", "030228"], ["Isak", "Isaksson", "030225"], ["Johanna", "Jonsson", "030401"], ["Klas", "Karlsson", "030214"], ["Lena", "Larsson", "031003"], ["Martin", "Moberg", "031003"], ["Nadja", "Norgren", "031031"], ["Omar", "Oskarsson", "030822"], ["Pernilla", "Persson", "031207"], ["Rostom", "Rikardsson", "030131"], ["Stina", "Svensson", "031023"], ["Tim", "Tallberg", "030310"], ["Ulla", "Utterström", "030820"], ["Vincent", "Viktorsson", "030814"], ["Åsa", "Åberg", "030221"]];
	
	
	for($i = 0; $i < count($students); $i++){
		$fn = $students[$i][0];
		$ln = $students[$i][1];
		$bd = $students[$i][2];
		$sql = "INSERT INTO students (firstname, lastname, birthdate) VALUES ('$fn', '$ln', '$bd')";
		if(!mysqli_query($link, $sql)){
			die("Error adding students to table").mysqli_error($link);
		}
	}
	echo "Students added to database!<br />";
	
	//Skapar tabell för anställda
	$sql = "CREATE TABLE teachers(
			id INT AUTO_INCREMENT PRIMARY KEY,
			firstname TEXT,
			lastname TEXT,
			workload INT)";
			
	if(mysqli_query($link, $sql)){
		echo "Table Teachers created succesfully!<br />";
	}else{
		die("Error creating table employees").mysqli_error($link);
	}
	
	$teachers = [["Petter", "Forslund", 100],["Rickard", "Kjellgren", 100],["Johan", "Kron", 100], ["Sofia", "Aspling Sjöberg", 80], ["Maria", "Edin", 90], ["Lena", "Andersson", 100], ["Britta", "Hermansson", 50], ["Jesper", "Brusell", 90], ["Jan-Åke", "Sundberg", 100], ["Janne", "Karlsson", 100], ["Elin", "Andersson", 50], ["Mikael", "Wahlberg", 40], ["Karin", "Sundqvist", 100], ["Anette", "Stenvall", 30]];
	
	for($i = 0; $i < count($teachers); $i++){
		$fn = $teachers[$i][0];
		$ln = $teachers[$i][1];
		$wl = $teachers[$i][2];
		$sql = "INSERT INTO teachers (firstname, lastname, workload) VALUES ('$fn', '$ln', $wl)";
		if(!mysqli_query($link, $sql)){
			die("Error adding teachers to table").mysqli_error($link);
		}
	}
	echo "Teachers added to database!<br />";
	
	//Hämta teacher_id för Petter, Rickard, Maria och Anette
	$sql = "SELECT * from teachers";
	$res = mysqli_query($link, $sql);
	while($row = mysqli_fetch_assoc($res)){
		if($row['firstname'] == "Petter" && $row['lastname'] == "Forslund"){
			$petter_id = $row['id'];
		}
		if($row['firstname'] == "Rickard" && $row['lastname'] == "Kjellgren"){
			$rickard_id = $row['id'];
		}
		if($row['firstname'] == "Anette" && $row['lastname'] == "Stenvall"){
			$anette_id = $row['id'];
		}if($row['firstname'] == "Maria" && $row['lastname'] == "Edin"){
			$maria_id = $row['id'];
		}
	}
	
	//Skapar tabell för kurser
	$sql = "CREATE TABLE courses(
			id INT AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(60),
			subject TEXT,
			points INT, 
			teacher_id INT,
			UNIQUE (name))";
			
	if(mysqli_query($link, $sql)){
		echo "Table Courses created succesfully!<br />";
	}else{
		die("Error creating table Courses").mysqli_error($link);
	}
	
	$courses = [["MATMAT02c", "Matematik", 100, $petter_id],["MATMAT03", "Matematik", 100, $petter_id],["MATMAT01b", "Matematik", 100, $anette_id],["MATMAT01a", "Matematik", 100, $anette_id],["TEKTEK01", "Teknik", 150, $maria_id], ["PSKPSY01", "Psykologi", 50, $rickard_id],["PSKPSY02a", "Psykologi", 50, $rickard_id],["HISHIS01a1", "Historia", 50, 0],["HISHIS01b", "Historia", 100, 0],["PRRPRR02", "Programmering", 100, 0],["PRRPRR01", "Programmering", 100, 0]];
	
	for($i = 0; $i < count($courses); $i++){
		$na = $courses[$i][0];
		$su = $courses[$i][1];
		$po = $courses[$i][2];
		$ti = $courses[$i][3];
		$sql = "INSERT INTO courses (name, subject, points, teacher_id) VALUES ('$na', '$su', $po, $ti)";
		if(!mysqli_query($link, $sql)){
			die("Error adding course to table").mysqli_error($link);
		}
	}
	echo "Courses added to database!<br />";
	
	//Hämta course_id för Matte 3, Psykologi 2 och Programmering 2
	$sql = "SELECT * from courses";
	$res = mysqli_query($link, $sql);
	while($row = mysqli_fetch_assoc($res)){
		if($row['name'] == "MATMAT03"){
			$ma3_id = $row['id'];
		}
		if($row['name'] == "PSKPSY02a"){
			$ps2_id = $row['id'];
		}
		if($row['name'] == "PRRPRR02"){
			$pr2_id = $row['id'];
		}
	}
	
	//Skapar kopplingstabell för elever och kurser
	$sql = "CREATE TABLE courseStudents(
			course_id INT,
			student_id INT
			)";
	
	if(mysqli_query($link, $sql)){
		echo "Table courseStudents created succesfully <br />";
	}else{
		die("Error creating table courseStudents").mysqli_error($link);
	}
	
	$ma3 = [1,2,4,5,8,12,16,17];
	$pr2 = [0,1,2,3,4,5,6,7,8,9,10,15,16,17,18,19,20,21];
	$ps2 = [0,3,6,7,9,10,11,12,13,14,15,18,19,20,21];
	
	//Fyller på med studenter till kurser
	for($i = 0; $i < count($ma3); $i++){
		$sql = "INSERT INTO courseStudents VALUES ($ma3_id, $ma3[$i])";
		mysqli_query($link, $sql);
	}
		
	for($i = 0; $i < count($pr2); $i++){
		$sql = "INSERT INTO courseStudents VALUES ($pr2_id, $pr2[$i])";
		mysqli_query($link, $sql);
	}
	
	for($i = 0; $i < count($ps2); $i++){
		$sql = "INSERT INTO courseStudents VALUES ($ps2_id, $ps2[$i])";
		mysqli_query($link, $sql);
	}
	echo "Students added to courses!";
	echo "<h1>Skapa en ny fil som heter SQL_test.php<br />Där skriver ni de SQL-kommandon som behövs och skriver ut informationen ni tar ut i en tabell på skärmen.</h1>";
?>