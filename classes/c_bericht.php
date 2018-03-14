<?php
class Bericht 
{
	public static $id_of_bericht = 0;
	protected $id;
	protected $delind;
	protected $visind;
	protected $datumtijd;
	protected $id_user;
	protected $gebruikersnaam;
	protected $onderwerp;
	protected $tekst;
	
	public function __construct () {
		/* eerste de default waarden zetten */
		$this->visible = TRUE;
		$this->deleted = FALSE;
		$this->id_user = "0";
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }

	private function __construct1 ($berichtrow) {
		$this->id			= $berichtrow['id'];
		$this->delind		= $berichtrow['delind'];
		$this->visind		= $berichtrow['visind'];
		$this->datumtijd	= $berichtrow['datumtijd'];
		$this->id_user		= $berichtrow['id_user'];
		$this->gebruikersnaam	= html_entity_decode($berichtrow['gebruikersnaam']);
		$this->onderwerp	= html_entity_decode($berichtrow['onderwerp']);
		$this->tekst		= html_entity_decode($berichtrow['tekst']);
	}
	
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readBerichtWithId($value));
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
		switch ($attr)
		{
			case 'visible':
				if ($value)
					$this->visind = TRUE;
				else
					$this->visind = FALSE;
				break;
			case 'deleted':
				if ($value)
					$this->delind = TRUE;
				else
					$this->delind = FALSE;
				break;
			default:
				$this->$attr = $value;
		}
	}
	
	public function __toString()
	{
		/* hier printen we het object mee uit, voor testdoeleinden */
		return 	'$id      		: ' . $this->id . '<br/>' .
				'$delind		: ' . $this->delind . '<br/><br/>' . 
				'$visind		: ' . $this->visind . '<br/>' . 
				'$datumtijd		: ' . $this->datumtijd . '<br/>' .
				'$id_user		: ' . $this->id_user . '<br/>' .
				'$gebruikersnaam		: ' . $this->gebruikersnaam . '<br/>' .
				'$onderwerp		: ' . $this->onderwerp . '<br/>' .
				'$tekst			: ' . $this->tekst . '<br/>';
	}
	
	public function insertToDB () {
		global $connection;
		try
		{
			openDB();
			$sql = "INSERT INTO bericht VALUES (
										  :id,
										  :delind,
										  :visind,
										  :id_user,
										  :datumtijd,
										  :gebruikersnaam,
										  :onderwerp,
										  :tekst);";
			$stmt = $connection->prepare( $sql );
			//give value to named parameter :username
			$stmt->bindValue( ":id", NULL, PDO::PARAM_STR );
			$stmt->bindValue( ":delind", $this->delind, PDO::PARAM_STR );
			$stmt->bindValue( ":visind", $this->visind, PDO::PARAM_STR );
			$stmt->bindValue( ":datumtijd", $this->datumtijd, PDO::PARAM_STR );
			$stmt->bindValue( ":id_user", $this->id_user, PDO::PARAM_STR );
			$stmt->bindValue( ":gebruikersnaam", htmlentities($this->gebruikersnaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
			$stmt->bindValue( ":onderwerp", htmlentities($this->onderwerp, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
			$stmt->bindValue( ":tekst", htmlentities($this->tekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
//				echo $sql . '<br/>';
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (bericht 2) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}

	public function updateDB () {
		global $connection;
		try
		{
			openDB();
			$sql = "UPDATE bericht SET
									delind = :delind,
									visind = :visind,
									datumtijd = :datumtijd,
									id_user = :id_user,
									gebruikersnaam = :gebruikersnaam,
									onderwerp = :onderwerp,
									tekst = :tekst 
									WHERE id = :id;";
			$stmt = $connection->prepare( $sql );
			//give value to named parameter :username
			$stmt->bindValue( ":id", $this->id, PDO::PARAM_STR );
			$stmt->bindValue( ":delind", $this->delind, PDO::PARAM_STR );
			$stmt->bindValue( ":visind", $this->visind, PDO::PARAM_STR );
			$stmt->bindValue( ":datumtijd", $this->datumtijd, PDO::PARAM_STR );
			$stmt->bindValue( ":id_user", $this->id_user, PDO::PARAM_STR );
			$stmt->bindValue( ":gebruikersnaam", htmlentities($this->gebruikersnaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
			$stmt->bindValue( ":onderwerp", htmlentities($this->onderwerp, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
			$stmt->bindValue( ":tekst", htmlentities($this->tekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
	//			echo $sql . '<br/>';
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (bericht 3) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}
	
		protected function readBerichtWithId ($attr)
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
			$sql = "SELECT * FROM bericht WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$berichtrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (bericht 4) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $berichtrow;	
	}


}
