<!DOCTYPE HTML>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<form action="index.php" method="get">
		  Show TGs and Frequencies: <input type="checkbox" name="checkbox" checked><br>
		  <input type="submit" value="Submit">
		</form>
		<?php
			#set filename
			$dirname = 'flist/';
			$flistfilename = $dirname . 'f_list.cfg';
			#open f_list
			$f = fopen($flistfilename, "r");
				if ($f) {
					#set each line of file to an array
					$flist = explode("\n", fread($f, filesize($flistfilename)));
				}

			fclose($f);
			


		foreach ($flist as &$eachrow) {
		    list($datatype, $name, $ffile, $unknown1, $unknown2, $systemqk) = explode("	", $eachrow);
		    #If line has .hpd in it, echo this
		    If (strpos($ffile, 'hpd') === false) {
			} else {
			    echo '</table><h1><font color="red">QuickKey: '. $systemqk . ' </font>' . $name . '</h1>';


				$r = fopen($dirname . $ffile, "r");
				if ($r) {
					#set each line of f_000#.hpd file to an array
					$fline = explode("\n", fread($r, filesize($dirname . $ffile)));
				}

				fclose($r);
				#echo $fline[2];
				foreach ($fline as &$eachrow) {
		    	list($c1, $c2, $c3, $c4, $c5, $c6, $c7, $c8, $c9, $c10, $c10, $c11, $c12, $c13, $c14, $c15, $c16, $c17, $c18) = explode("	", $eachrow);
		    	#system
		    	if ($c1 == 'Trunk'){
		      		#end table
		    		echo '</table>';		    		
		    		#Echo trunked system name
		    		echo '<h2><font color="red">QuickKey: ' . $c12 . ' </font>' . $c4 . '</h2>';
		    	}
		    	#dept
		    	if ($c1 == 'T-Group'){
		      		#end table
		    		echo '</table>';
		    		#echo talkgroup name and info
		    		echo '<h3><font color="red">QuickKey: ' . $c10 . ' </font>' . $c4 . '</h3>';
		    		if(isset($_GET["checkbox"])){
			    		echo '<table border=1>';
			    		echo '<tr><td>Talkgroup</td><td>TGID</td><td>Avoid</td>';
			    	}
		    	}
		    	#channel
		    	if(isset($_GET["checkbox"])){
			    	if ($c1 == 'TGID'){
			      		#start row
			    		echo '<tr>';
			    		#echo first cell
			    		echo '<td>' . $c4 . '</td>';
			    		#echo second cell
			    		echo '<td>' . $c6 . '</td>';
			    		#echo third cell
			    		echo '<td>' . $c5 . '</td>';
			    		#end row
			    		echo '</tr>';
			    	}    
			    }	
		    	#system
		    	if ($c1 == 'Conventional'){
		      		#end table
		    		echo '</table>';
		    		#echo talkgroup name and info
		    		echo '<h2><font color="red">QuickKey: ' . $c8 . ' </font>' . $c4 . '</h2>';

		    	}
		      	#dept
		    	if ($c1 == 'C-Group'){
		      		#end table
		    		echo '</table>';
		    		#echo talkgroup name and info
		    		echo '<h3><font color="red">QuickKey: ' . $c10 . ' </font>' . $c4 . '</h3>';
		    		if(isset($_GET["checkbox"])){
			    		echo '<table border=1>';
			    		echo '<tr><td>Channel</td><td>Frequency</td><td>Avoid</td>';
			    	}
		    	}  	
		    	#channel
		    	if(isset($_GET["checkbox"])){
			    	if ($c1 == 'C-Freq'){
			      		#start row
			    		echo '<tr>';
			    		#echo first cell
			    		echo '<td>' . $c4 . '</td>';
			    		#echo second cell
			    		echo '<td>' . $c6 . '</td>';
			    		#echo third cell
			    		echo '<td>' . $c5 . '</td>';
			    		#end row
			    		echo '</tr>';
			    	}    	
		    	}
		    }
			}
		}
		?>
	</body>
</html>