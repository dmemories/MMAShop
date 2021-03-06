<?php

    for ($i = 0; $i < 10; $i++) {
		echo "[$i] : ";
		for ($j = 0; $j < 5; $j++) {
			echo $j;
			if ($i == 4 && $j == 2) { break; break; }
		}
		echo "<br/>";
	}
	
?>