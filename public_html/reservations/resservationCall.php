<?php
          echo "<table style='border:solid 1px black;'>";
          echo "<tr><th>Reservation ID</th><th>Garage name</th><th>Garage Location</th><th>arrival date</th><th>arrival time</th><th>total_charge</th>"
          $servername = "localhost";
          $username="cxlgo";
          $password= "zero5397"
          try{
            $conn = new PDO("mysql:host=$servername;dbname=GWVP",$username,$password);

            $conn -> setAttribute(PDO::ATTR_ERRMODE,PDD::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            $stmt= $conn ->prepare("SELECT rd.reservation_id,g.garage_name,g.garagae_location,
            rd.arrival_date,rd.arrival_time,rd.total_charge From reservations rd inner join garage g On rd.garage_id = g.garage_id where reservation_status='upcoming' ")
            $stmt ->execute();

            $result = $stmt ->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
              echo $v;
            }
            echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
          $conn=null;
          echo "</table>";
        ?>