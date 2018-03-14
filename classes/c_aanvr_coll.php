<?php
include_once ('c_aanvraag.php');
include_once ('c_person.php');

class Aanvraag_coll {
	
	protected $aanvraagColl = array();
	protected $query;
	
	
	public function __construct () {
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }

    private function __construct1 ($orderArr) {
	    /*
	    	De constructor heeft 1 array als argument:
	    	1. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde si op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    */
	    
	    $this->buildQuery(NULL, $orderArr, NULL);
	    $this->execQuery();
	    
    }
    
    private function __construct2 ($selectArr, $orderArr) {
		    
		/*
	    	De constructor heeft 2 array als argument:
	    	1. Een array met selectiecriteria;
	    		elke row heeft een attribuut uit de DB en de waarde ervan waarop geslecteerd wordt.
	    		Als de array leeg is worden alle aanvraagen geselecteerd.
	    	2. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde si op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    */
	    
	    /*
		    Als het tweede element van de selectie array NULL is, dan bevat het eerste element
		    een bijzondere waarde en wordt de Query op een specifieke manier opgemaakt.
		*/
		if ($selectArr[0] != 'lopend')
		{
	    	$this->buildQuery($selectArr, $orderArr, NULL);
	    }
	    else
	    {
		    $this->buildSpecQuery($selectArr[0]);
	    }
		$this->execQuery();
	    
    }
    
    private function __construct3 ($selectArr, $orderArr, $limit) {
	    /*
	    	De constructor heeft 3 attrs als argument:
	    	1. Een array met selectiecriteria;
	    		elke row heeft een attribuut uit de DB en de waarde ervan waarop geslecteerd wordt.
	    		Als de array leeg is worden alle aanvraagen geselecteerd.
	    	2. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde si op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    	3. het aantal te lezen aanvraagen
	    		
	    */
	    
	    $this->buildQuery($selectArr, $orderArr, $limit);
	    $this->execQuery();
	    
    }
    public function getaanvraagColl () {
    
	    return $this->aanvraagColl;
    }
    
    private function buildQuery ($selectArr, $orderArr, $limit) {
	    
	    $this->query = 'SELECT aanvraag.* FROM aanvraag';
		$this->query .= ' WHERE aanvraag.deleted = "n" AND aanvraag.approved = "j" ';
	    if (!empty($selectArr)) {
	    	
		    foreach ($selectArr as $selection) {
			    $this->query .= ' AND ';
			    $this->query .= $selection[0] . ' = "' . $selection[1] . '" ';
		    }
	    }
	    if (!empty($orderArr)) {
	    	$this->query .= ' ORDER BY ';
		    foreach ($orderArr as $sort) {
			    $this->query .= $sort[0] . ' ' . $sort[1];
		    }
	    }
	    
	    if ($limit != NULL)
	    {
		    $this->query .= ' LIMIT ';
		    $this->query .= $limit;
	    }
	    $this->query .= ';';
//  	    echo $this->query;
    }
    
    private function buildSpecQuery ($selArg) {
	    
	    $this->query = 'SELECT aanvraag.* FROM aanvraag WHERE aanvraag.deleted = "n" AND aanvraag.approved = "j" AND aanvraag.procstatus < 80 ORDER BY DESC;';
		error_log ($this->query);
//   	    echo $this->query;
    }
	public function __get($attr)
	{
		switch ($attr) {
			
			case "query":
				if (!empty($this->query))
					return $this->$attr;
				else
					return 'Er is geen query aangemaakt. ';
				break;
			default:
				return $this->$attr;
		}
	}
	
	private function execQuery () {
		global $connection;
		try
		{
			openDB();
			$stmt = $connection->prepare( $this->query );
			$stmt->execute();
			$rows = $stmt->fetchAll();
			foreach ($rows as $row)
			{
				$aanvraag = new aanvraag ($row);
//				echo $aanvraag;
				$this->aanvraagColl[] = $aanvraag;
			}
		} catch (PDOException $e) 
		{
			  echo 'Connectie (aanvraag 1 in c_aanvraag_coll.php) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}

	}
}
