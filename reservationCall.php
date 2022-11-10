<?php
          
          $stmt = $conn -> prepare("SELECT rd.reservation_id,g.garage_name,g.garagae_location,
          rd.arrival_date,rd.arrival_time,rd.total_charge 
          From reservations rd inner join garage g 
          On rd.garage_id = g.garage_id 
          where reservation_status='?' ")
          $stmt -> bind_param("s",$currentS);

          $stmt -> execute;
          
          $stmt ->bind_result($currentStates)
          echo "$currentStates";
          $stmt ->close();
          $conn ->close();

           
          
        ?>