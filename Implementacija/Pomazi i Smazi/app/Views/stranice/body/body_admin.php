<td>
<table>
    <form method="post" >
     
        <?php   
         
        $k=new \App\Controllers\Admin();
           
        for ($i=0;$i<1;$i++){   
            foreach ($recepti as $recept) {

            $imageProperties = [
            'src' => "http://localhost/ps/{$recept['recept']->slika}",
            'alt' => "{$recept['recept']->slika}",
            'width' => '90%',
            ];
          
             echo "<tr>";
            echo "<td width='40%' align='center'>";
           // echo img("http://localhost/ps/$recept->slika");
            echo img($imageProperties);
            echo "</td>";
            
            echo "<td width='60%'>";
            echo "<table style=>";
            echo "<tr>";
            echo "<td><br/>";
           echo "<h5> {$recept['recept']->ime} </h5> <hr/>";

           echo "{$recept['recept']->sastojci}  <hr/>";

           echo "{$recept['recept']->priprema}  <hr/>";
           echo "Broj prijava: ".$recept['broj'];
           echo "&nbsp &nbsp ";
           echo anchor("Admin/izbaci?id={$recept['recept']->id}", "<input type='button' class='btn btn-danger'  value='izbaci' />");
           echo "&nbsp &nbsp ";
           echo anchor("Admin/ostavi?id={$recept['recept']->id}", "<input type='button' class='btn btn-success'  value='ostavi' />");
           echo "&nbsp &nbsp ";
           echo " <br/><hr/><br/><br/>";
         
            echo "</td>";
            echo "</tr>";
            echo "</table>";
             echo '<hr style="border: 1px solid gray;">';
            echo "</td>";
            echo "</tr>";
            
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