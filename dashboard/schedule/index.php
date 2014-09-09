<?php include_once '../../functions.php';?>
<!---- Individual inline style sheets ---->
<style>
<?php include '../stylesheets/schedule.min.css';?>
</style>
<table>
	<thead>
		<tr>
			<td id="age">Age of Child</td>
			<td id="vac">Vaccination</td>
			<td id="abbr">Abbreviation</td>
			<td id="product">Name of Vaccine</td>
			<td id="date_vac">Date of Vaccination</td>
			<td id="sign">Signature</td>
			<td id="batch">Batch Number</td>
			<td id="exp_vac">Expiry Date</td>
			<td id="submit">Submit</td>
		</tr>
	</thead> 
	<tbody>
		<?php 

		/*------------------------------------------------------
		-    Getting the information from the schedule table   -
		-------------------------------------------------------*/

		function capture($rid, $gid) {
			$id=['vacDate', 'sign', 'batch', 'expire'];
			//the first 2 blocks should not be editable
			for ($i=0; $i<2 ; $i++) { 
	 			echo "<td class='row$rid group$gid'><input name='$id[$i]$rid' id='$id[$i]$rid' type='text' required readonly></td>";
			}
			//these ones are editable as it's the batch and expiry dates which must be done manually
			for ($i=2; $i<4 ; $i++) { 
	 			echo "<td class='row$rid group$gid'><input name='$id[$i]$rid' id='$id[$i]$rid' type='text' required></td>";
			}
			echo '<td class="row'.$rid.' group'.$gid.'"><input type="submit" /></td>';
		}


		if($result = $con->query('SELECT * FROM schedule')) {

				// set the rowspan for each group manually (null for nothing)
				$span = array(2,4,4,4,null);

				while($row = $result->fetch_array()){

					global $vaccine_before;
					$vaccine_after = $row['abbr'];
					global $group_before;
	 				$group_after = $row['gid'];
	 				global $option;
	 				
	 				//Start of a new group in it's entirety
	 				if ($group_after !== $group_before) {
	 					
	 					// if a new group but not the first we then need to close the select option and start a new form:
	 					if ($group_after != 0) {
	 						echo "</select></td>";
	 						//if we have a new group but the options before were more than 1 then we need to take the option in account
	 						//so that we can target with javascript
	 						if ($option > 0 ) {
	 							capture(($row[0]-1-$option), ($row[1]-1));
	 						//otherwise there was only one option and we don't need to worry
	 						} else {
	 							capture(($row[0]-1), ($row[1]-1));
	 						}
	 						echo '</select></form></tr><tr><form action="/dashboard/welcome/schedule/process.php" method="post">';
	 					//the very first option doesn't need to be closed with the select
	 					} else {
	 						echo '<tr><form action="process.php" method="post">';
	 					}

						for ($i=2; $i < mysqli_num_fields($result)  ; $i++) { 
							$rowspan = ($i===2) ? 'rowspan="'.$span[$group_after].' "' : null ;
							if ($i===5){
								echo '<td '.$rowspan.'class="row'.$row[0].' group'.$row[1].'">'."<select required name='product$row[0]' id='product$row[0]'><option selected>Please select</option><option value=$row[$i]>$row[$i]</option>";
							} else {
							echo '<td '.$rowspan.'class="row'.$row[0].' group'.$row[1].'"><input required readonly type="text" name="" value="'.$row[$i].'" /></td>';
							}
						}
						//reset option value
						$option = 0;

					//when its the same group but a new row
					} elseif($vaccine_after!= $vaccine_before) {
						if ($option > 0 ) {
							capture($row[0]-1-$option, $row[1]);

						} else {
							capture($row[0]-1, $row[1]);
						}

						echo '</select></form></tr><tr><form action="/dashboard/welcome/schedule/process.php" method="post">';
							for ($i=3; $i < mysqli_num_fields($result) ; $i++) {
								if ($i===5) {
									echo '<td '.$rowspan.' class="row'.$row[0].' group'.$row[1].'">'."<select required name='product$row[0]' id='product$row[0]'><option selected>Please select</option><option value=$row[$i]>$row[$i]</option>";
								} else {
									echo '<td class="row'.$row[0].' group'.$row[1].'"><input required readonly type="text" name="" value="'.$row[$i].'" /></td>';
								}
							}
						//reset option value
						$option = 0;

					//what to do when the vacine option is in the same row
					} elseif($vaccine_after == $vaccine_before) {
						echo '<option value='.$row['product_name'].'>'.$row['product_name'].'</option>';

						//increment option to so that we can target via javascript
						$option++;
					}

					$vaccine_before = $vaccine_after;
					$group_before = $group_after;
					
				};


				// have to manually put last group and row no.
				capture(25,4);
				echo "</select></form></tr><tr><form>";

				// free query 
				$result->free();

			} else {
				echo $con->error;
			}; ?>
	</tbody>
</table>
<script><?php include "../compileJS/schedule.min.js";include "../compileJS/submit.min.js"?></script>
