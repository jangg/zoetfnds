<?php
class Organisatie 
{
	protected $id;
	protected $naam;
	protected $adres;
	protected $postcode;
	protected $plaats;
	protected $telnr;
	protected $rechtsvorm;
	protected $kvknummer;
	protected $emailadres;
	protected $urlwebsite;
	protected $reknr;
	protected $deleted;
	protected $approved;
	protected $datumnw;

	public function __construct () {
			$this->naam           = '';
			$this->adres		  = '';
			$this->postcode		  = '';
			$this->plaats		  = '';
			$this->telnr		  = '';
			$this->rechtsvorm	  = '';
			$this->kvknummer	  = '';
			$this->emailadres	  = '';
			$this->urlwebsite	  = '';
			$this->reknr		  = '';
			$this->deleted		  = 'n';
			$this->approved		  = 'j';
			$this->datumnw		  = '';
						
//		echo $this;

        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }
     	
	public function __construct1 ($row) 
	{
		if ($row)
		{
// 			error_log("De organisatie bestaat, invullen maar");
			$this->id				= $row['id'];
			$this->naam				= html_entity_decode($row['naam']);
			$this->adres			= html_entity_decode($row['adres']);
			$this->postcode			= html_entity_decode($row['postcode']);
			$this->plaats			= html_entity_decode($row['plaats']);
			$this->telnr			= html_entity_decode($row['telnr']);
			$this->rechtsvorm		= html_entity_decode($row['rechtsvorm']);
			$this->kvknummer		= html_entity_decode($row['kvknummer']);
			$this->emailadres		= html_entity_decode($row['emailadres']);
			$this->urlwebsite		= html_entity_decode($row['urlwebsite']);
			$this->reknr			= html_entity_decode($row['reknr']);
			$this->deleted			= $row['deleted'];
			$this->approved			= $row['approved'];
			$this->datumnw			= $row['datumnw'];

		}
		else
		{
// 			error_log("Geen person gevonden, dan lege geven");
			$this->id 			  = NULL;
			$this->naam           = '';
			$this->adres		  = '';
			$this->postcode		  = '';
			$this->plaats		  = '';
			$this->telnr		  = '';
			$this->rechtsvorm	  = '';
			$this->kvknummer	  = '';
			$this->emailadres	  = '';
			$this->urlwebsite	  = '';
			$this->reknr		  = '';
			$this->deleted		  = 'n';
			$this->approved		  = 'j';
			$this->datumnw		  = '';
		}
	}

	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readOrganisatieWithId($value));
				break;
				
/*
			case 'gebruikersnaam':
				$this->__construct1($this->readPersonWithGebruikersnaam($value));
				break;
				
*/
			case 'emailadres':
				$this->__construct1($this->readOrganisatieWithEmailadres($value));
				break;
				
			default:
				return FALSE;
		}
		
	}

	public function __destruct ()
	{
//		echo 'Person ' . $this->id . ' is vernietigd<br/>';
	}
	
	public function __get($attr)
	{
		return $this->$attr;
	}

	public function __set($attr, $value)
	{
		/* hier moet nog wel per attr de value worden gechecked */
		$this->$attr = $value;
	}
	
	public function __toString()
	{
		/* hier printen we het object mee uit, voor testdoeleinden */
		return 
			'id				: ' . $this->id 			. '<br/>' .
			'naam			: ' . $this->naam			. '<br/>' .
			'adres			: ' . $this->adres			. '<br/>' .
			'postcode		: ' . $this->postcode		. '<br/>' .
			'plaats			: ' . $this->plaats			. '<br/>' .
			'telnr			: ' . $this->telnr			. '<br/>' .
			'rechtsvorm		: ' . $this->rechtsvorm		. '<br/>' .
			'kvknummer		: ' . $this->kvknummer		. '<br/>' .
			'emailadres		: ' . $this->emailadres		. '<br/>' .
			'urlwebsite		: ' . $this->urlwebsite		. '<br/>' .
			'reknr			: ' . $this->reknr			. '<br/>' .
			'deleted		: ' . $this->deleted		. '<br/>' .
			'approved		: ' . $this->approved		. '<br/>' .
			'datumnw		: ' . $this->datumnw		. '<br/>';
	}
	
	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT organisatie 
										(	id,
											naam		,	
											adres		,
											postcode	,
											plaats		,
											telnr		,
											rechtsvorm	,
											kvknummer	,
											emailadres	,
											urlwebsite	,
											reknr		,
											deleted		,
											approved	,
											datumnw		
											)
									VALUES (
											:id,
											:naam		,	
											:adres		,
											:postcode	,
											:plaats		,
											:telnr		,
											:rechtsvorm	,
											:kvknummer	,
											:emailadres	,
											:urlwebsite	,
											:reknr		,
											:deleted	,
											:approved	,
											NOW()											
											)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":naam"			, htmlentities($this->naam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":adres"			, htmlentities($this->adres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"		, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":plaats"			, htmlentities($this->plaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telnr"			, htmlentities($this->telnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":rechtsvorm"		, htmlentities($this->rechtsvorm, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":kvknummer"		, htmlentities($this->kvknummer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"		, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":urlwebsite"		, htmlentities($this->urlwebsite, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":reknr"			, htmlentities($this->reknr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":deleted"		, $this->deleted, PDO::PARAM_STR);
			$stmt->bindValue( ":approved"		, $this->approved, PDO::PARAM_STR);
			$stmt->execute();
// 			error_log('Een nieuwe c_organisatie is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (organisatie 1) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}

	public function updateToDB () 
	{
		global $connection;
		try
		{
			openDB();
			$sql = "UPDATE organisatie SET
							naam			= :naam		,	
							adres			= :adres		,
							postcode		= :postcode	,
							plaats			= :plaats		,
							telnr			= :telnr		,
							rechtsvorm		= :rechtsvorm	,
							kvknummer		= :kvknummer	,
							emailadres		= :emailadres	,
							urlwebsite		= :urlwebsite	,
							reknr			= :reknr		,
							deleted			= :deleted	,
							approved		= :approved	,
							datumnw         = :datumnw
							WHERE id        = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":naam"			, htmlentities($this->naam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":adres"			, htmlentities($this->adres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"		, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":plaats"			, htmlentities($this->plaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telnr"			, htmlentities($this->telnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":rechtsvorm"		, htmlentities($this->rechtsvorm, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":kvknummer"		, htmlentities($this->kvknummer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"		, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":urlwebsite"		, htmlentities($this->urlwebsite, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":reknr"			, htmlentities($this->reknr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":deleted"		, $this->deleted, PDO::PARAM_STR);
			$stmt->bindValue( ":approved"		, $this->approved, PDO::PARAM_STR);
			$stmt->bindValue( ":datumnw"		, $this->datumnw, PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (organisatie 5) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}
	protected function readOrganisatieWithId ($attr)
	{
		/* Haal de gegevens uit de database
			$personid kan 2 soorten waarde hebben:
			NULL of 0 => het object bestaat niet in de database => zo laten
			integer => het object kan uit de DB gelezen worden => ophalen en attrs vullen
		*/
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM organisatie WHERE id = :id  AND deleted = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (organisatie 2) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $row;	
	}
	
	protected function readOrganisatieWithEmailadres ($attr)
	{
		global $connection;
		try
		{
// 			error_log("We gaan de person ophalen met het emailadres");
			openDB();
			$sql = "SELECT * FROM organisatie WHERE emailadres = :emailadres AND deleted = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":emailadres", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (organisatie 4) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $row;	
	}
}
