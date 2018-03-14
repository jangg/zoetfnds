<?php
	function getStatusDesc($code)
{
	switch ($code) {
	    case 10:
	        $status = 'ingediend, nog niet bekeken';
	        break;
	    case 21:
	        $status = 'wacht op aanvullende informatie';
	        break;
	    case 31:
	        $status = 'klaar voor beoordeling bestuur';
	        break;
	    case 50:
	        $status = 'bevestigd, aanhouden tot nader order';
	        break;
	    case 71:
	        $status = 'toegekend, wacht op bevestiging aanvrager';
	        break;
	    case 72:
	        $status = 'toegekend, contractbrief verstuurd';
	        break;
	    case 75:
	        $status = 'gedeeltelijk toegekend, wacht op bevestiging aanvrager';
	        break;
	    case 76:
	        $status = 'gedeeltelijk toegekend, contractbrief verstuurd';
	        break;
	    case 80:
	        $status = 'afgewezen, gereageerd per email';
	        break;
	    case 86:
	        $status = 'aanvraag ingetrokken door aanvrager';
	        break;
	    case 91:
	        $status = 'contractbrief getekend, donatie kan worden overgemaakt';
	        break;
	    case 92:
	        $status = 'contractbrief getekend, donatie is overgemaakt';
	        break;
	    case 93:
	        $status = 'verslag is binnen, restant donatie kan worden overgemaakt';
	        break;
	    case 94:
	        $status = 'verslag is binnen, restant donatie is overgemaakt';
	        break;
	    case 95:
	        $status = 'aanvraag volledig afgerond';
	        break;
	    default:
	    	$status = 'status onbekend';
	}
	return $status;	
}
?>