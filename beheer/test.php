<?php
	$dateToday = new DateTime();
	$dateFuture = new DateTime();
	$dateFuture->add(new DateInterval('P35D'));
	$Date1 = $dateToday->format('Y-m-d');
	$Date2 = $dateFuture->format('Y-m-d');
	echo $Date1;
	echo '<br/>';
	echo $Date2;
	echo '<br/>';
	if ($dateToday > $dateFuture)
		echo 'Today > Future';
		else
		if ($dateToday < $dateFuture)
			echo 'Today < Future';
			else
			echo 'Today = Future';

?>
