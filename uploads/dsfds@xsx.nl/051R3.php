<!DOCTYPE html>

<HTML>
<head>
<meta charset="UTF-8">
<title>Inzendopdracht 051R3</title>
</head>
<BODY>
<?php


function tekenKaart ($kaart)
// Deze functie tekent de kaart in de browser. Parameter is een een twee-dimensionale tabel van 6 x 6.
{
	echo '<TABLE BORDER=1>';
	for ($rij = 0 ; $rij < 6 ; $rij++)
	{
		echo '<TR HEIGHT="80">';
		for ($col = 0 ; $col < 6 ; $col++)
		{
			echo '<TD WIDTH="80" ALIGN="center"';
			if ($kaart[$rij][$col][1] == 'x')
				echo ' BGCOLOR="#999999"';
			if ($kaart[$rij][$col][1] == 'b')
				echo ' BGCOLOR="#99FFCC"';
			echo '>';
			echo '<FONT FACE="arial" SIZE="6">' . 
			$kaart[$rij][$col][0] .
			'</FONT></TD>';
		}
		echo '</TR>';
	}
	echo '</TABLE>';
}

	
function genereerKaart()
// Deze functie genereert een kaart. Returnwaarde is een twee-dimensionale tabel, gevuld met getallen.
{
	global $kaart;
	for ($rij = 0; $rij < 6; $rij++)
	{
		$kaartrij = range(0, 9);
		shuffle ($kaartrij);
		for ($col = 0; $col < 6; $col++)
		{
			$kaart[$rij][$col][0] = ($rij * 10) + $kaartrij[$col] + 10;
			$kaart[$rij][$col][1] = '';
		}
	}
}

function goedeBingo()
{
	global $kaart;
	global $rijen;
	global $kolommen;
	$result = FALSE;
	for ($i = 0; $i < 6; $i++)
	{
		
		if ($rijen[$i] == 6)
		{	$result = TRUE;
			for ($j = 0; $j < 6; $j++) {$kaart[$i][$j][1] = 'b';}
			break;
		}
		if ($kolommen[$i] == 6)
		{	$result = TRUE;
			for ($j = 0; $j < 6; $j++) {$kaart[$j][$i][1] = 'b';}
			break;
		}
//		echo $rijen[$i]. ' ' . $kolommen[$i] . '<>';	
	}
	
	return $result;
}

function speelBingo()
{
	global $kaart;
	global $rijen;
	global $kolommen;
	global $trekkingsreeks;
	shuffle ($trekkingsreeks);
	
	$i = 0;
	do
	{
		$rij = floor($trekkingsreeks[$i] / 10) - 1;
		for ($col = 0; $col < 6; $col++)
		{
			if ($trekkingsreeks[$i] == $kaart[$rij][$col][0])
			{
				$kaart[$rij][$col][1] = 'x';
				$rijen[$rij] += 1;
				$kolommen[$col] += 1;
				break;
			}
		}
		$i++;
	}
	while (!goedeBingo());
	return $i;
}

$kaart[][][] = '';
$rijen = array(0, 0, 0, 0, 0, 0);	
$kolommen = array(0, 0, 0, 0, 0, 0);	
$trekkingsreeks = range(10, 69);

genereerKaart();

$aantalGetallen = speelBingo();

echo '<FONT FACE="arial" SIZE="6">Bingokaart waarop BINGO is gevallen</FONT><br><br>';
tekenKaart($kaart);
echo '<FONT FACE="arial" SIZE="4">';
echo '<br>Aantal getallen dat is getrokken: ' . $aantalGetallen . '<br>';
for ($i = 0; $i < $aantalGetallen; $i++)
{
	echo $trekkingsreeks[$i] . ' ';
}
echo '</FONT>';

?>

</BODY>
</HTML>