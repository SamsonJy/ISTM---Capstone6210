<?php
          include "db_connect.php";
          //not running when userid and status is null
          if($userid!=null&&$currentS!=null){   
            $sql = "SELECT * From reservations where reservation_status='".$currentS."' and user_id =". $userid;
            
            $result2 = mysqli_query($conn,$sql);
            $records = mysqli_fetch_all($result2, MYSQLI_ASSOC);

            mysqli_free_result($result2);
            mysqli_close($conn);
            
            foreach($records as $record){
              
              //echo "<div class'post-thumb'>".'<img src="' .$record['QR_image']."'/>";
              
              echo "<h4>Reservation number: " . $record['reservation_id'] ."</h4><br>";
              echo "<p>arrival date: " . $record['arrival_date']."</p><br>";
              echo "<p>arrival time: " . $record['arrival_time']."</p><br>";
              echo "<p>exit date: " . $record['exit_date']."</p><br>";
              echo "<p>exit time: " . $record['exit_time']."</p><br>";
              echo "<p>total charge: " . $record['total_charge']."</p><br>";
              // echo "</div></div></div></div>"
              // echo "<div class='row'>";
              // echo "<div class='col'>";
              // echo "<div class='post-container'>";
              // //echo "<div class'post-thumb'>".'<img src="' .$record['QR_image']."'/>";
              // echo "<div class='post-content'>";
              // echo "<h4>Reservation number: " . $record['reservation_id'] ."</h4><br>";
              // echo "<p>arrival date: " . $record['arrival_date']."</p><br>";
              // echo "<p>arrival time: " . $record['arrival_time']."</p><br>";
              // echo "<p>aexit date: " . $record['exit_date']."</p><br>";
              // echo "<p>aexit time: " . $record['exit_time']."</p><br>";
              // echo "<p>atotal charge: " . $record['total_charge']."</p><br>";
              // echo "</div></div></div></div>"
            }
            $conn -> close();
          }
        ?>