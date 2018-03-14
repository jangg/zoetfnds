<?php
class Categorie 
{
	protected $id;
	protected $omschrijving;
	protected $code;
	
	public function __construct () {
		/* eerste de default waarden zetten */
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }

	private function __construct1 ($rrow) {
		$this->id			= $rrow['id'];
		$this->omschrijving	= $rrow['omschrijving'];
		$this->code			= $rrow['code'];
	}
	
	public function __construct2 ($attr, $value)
	{
		switch ($attr)
		{
			case 'code':
				$this->__construct1($this->readCategorieWithCode($value));
				break;
				
			default:
				return FALSE;
		}		
	}
	
	public function __destruct ()
	{
//		echo 'Bericht ' . Bericht::$id_of_bericht . ' is vernietigd<br/>';
	}
	
	public function __get($attr)
	{
		return $this->$attr;
	}

	public function __set($attr, $value)
	{
		$this->$attr = $value;
	}
	
	public function __toString()
	{
		/* hier printen we het object mee uit, voor testdoeleinden */
		return 	'$id      		: ' . $this->id . '<br/>' .
				'$omschrijving	: ' . $this->omschrijving . '<br/>' . 
				'$code			: ' . $this->code . '<br/><br/>';
	}
		
	protected function readCategorieWithCode ($attr)
	{
		/* Haal de gegevens uit de database
			$userid kan 2 soorten waarde hebben:
			NULL of 0 => het object bestaat niet in de database => zo laten
			integer => het object kan uit de DB gelezen worden => ophalen en attrs vullen
		*/
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM categorie WHERE code = :code LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":code", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$rrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (categorie 1) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $rrow;	
	}

}
