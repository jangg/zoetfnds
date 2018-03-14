<?php
class Status 
{
	protected $id;
	protected $code;
	protected $color;
	protected $omschrijving;
	
	public function __construct () {
		/* eerste de default waarden zetten */
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }

	private function __construct1 ($berichtrow) {
		$this->id			= $berichtrow['id'];
		$this->code			= $berichtrow['code'];
		$this->color		= $berichtrow['color'];
		$this->omschrijving	= $berichtrow['omschrijving'];
	}
	
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'code':
				$this->__construct1($this->readStatusWithCode($value));
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
				'$code			: ' . $this->code . '<br/><br/>' . 
				'$color			: ' . $this->color . '<br/><br/>' . 
				'$omschrijving	: ' . $this->omschrijving . '<br/>';
	}
	
	public function getColorCode() 
	{
		return $this->color;
	}
	
	protected function readStatusWithCode ($attr)
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
			$sql = "SELECT * FROM status WHERE code = :code LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":code", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$berichtrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (status 1) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $berichtrow;	
	}

}
