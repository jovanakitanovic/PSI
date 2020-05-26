<td>
<table>
    <form method="post" >
            <?php
            
         for ($i=0;$i<1;$i++){   
          foreach ($recepti as $recept) {
            
            echo "<tr>";
            echo "<td width='40%' align='center'>";
            echo "<img width='100%' src={$recept->slika}></img>";
            echo "</td>";
            
            echo "<td width='60%'>";
            echo "<table style=>";
            echo "<tr>";
            echo "<td>";
           echo "<h5> {$recept->ime} </h5> <hr/>";

           echo "{$recept->sastojci}  <hr/>";

           echo "{$recept->priprema}  <hr/>";
           
         
           echo "<input type='submit' class='btn btn-light' name="."o$recept->id"."  value='1' />&nbsp	";    
           echo "<input type='submit' class='btn btn-light' name="."o$recept->id"."  value='2' /> &nbsp	";
           echo "<input type='submit' class='btn btn-light' name="."o$recept->id"."  value='3' /> &nbsp	";
           echo "<input type='submit' class='btn btn-light' name="."o$recept->id"."  value='4' /> &nbsp";
           echo "<input type='submit' class='btn btn-light' name="."o$recept->id"." value='5' /> &nbsp &nbsp ";
           echo "<input type='submit' name="."sacuvaj$recept->id"."  class='btn btn-primary' value='sačuvaj'> &nbsp &nbsp";
           echo "<input type='submit' name="."prijavi$recept->id"."  class='btn btn-danger' value='prijavi'><hr/><hr/><br>";
        
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            echo "</td>";
            echo "</tr>";
            
            }
         }
         
         foreach ($recepti as $recept){
             
             if(isset($_POST["sacuvaj$recept->id"])){
                 echo "$recept->id";
             }
             
             if(isset($_POST["prijavi$recept->id"])){
                 echo "$recept->id";
             }
             if(isset($_POST["o$recept->id"])){
                 $lala=$_POST["o$recept->id"];
                 echo "$recept->id -- $lala";
             }
             
         }
         
         
         
            ?>
   
    </form>
</table>
</td>
</tr>
</div>
</table>
</body>
</html>