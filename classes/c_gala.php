<?php
class Gala 
{
	public static $id_of_blog = 0;
	protected $id;
	protected $naam;
	protected $email;
	protected $organisatie;
	protected $id_person;
	protected $datumnw;
	
	public function __construct () {
		/* eerste de default waarden zetten */
		$this->id_person = "0";
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }

	private function __construct1 ($galarow) {
		if ($galarow) {
			$this->id			= $galarow['id'];
			$this->naam			= html_entity_decode($galarow['naam']);
			$this->email		= html_entity_decode($galarow['email']);
			$this->organisatie	= html_entity_decode($galarow['organisatie']);
			$this->datumnw		= $galarow['datumnw'];
			$this->id_person	= $galarow['id_person'];		
		}
		else {
			$this->id			= NULL;
			$this->naam			= '';
			$this->email		= '';
			$this->organisatie	= '';
			$this->datumnw		= '';
			$this->id_person	= NULL;
		}
	}
	
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readGalaWithId($value));
				break;
				
			case 'email':
				$this->__construct1($this->readGalaWithEmail($value));
				break;
			default:
				return FALSE;
		}
		
	}
	
	public function __destruct ()
	{
//		echo 'Gala ' . Gala::$id_of_gala . ' is vernietigd<br/>';
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
		return 	
		'$id  				: ' . $this->id			. '<br/>' .
		'$naam	 			: ' . $this->naam		. '<br/>' .
		'$email  			: ' . $this->email	. '<br/>' .
		'$organisatie 		: ' . $this->organisatie		. '<br/>' .
		'$id_person  		: ' . $this->id_person		. '<br/>' .
		'$datumnw  			: ' . $this->datumnw		. '<br/>';
	}
	
	public function saveToDB () {
		global $connection;
		try
		{
			openDB();
			$sql = "INSERT INTO gala VALUES (
								:id  		 ,
								:naam 	 ,
								:email  	 ,
								:organisatie  	 ,
								:id_person  	 ,
								NOW());";
			$stmt = $connection->prepare( $sql );
			//give value to named parameter :username
			$stmt->bindValue( ":id"  		 , NULL, PDO::PARAM_STR );
			$stmt->bindValue( ":naam" 		 , 	$this->naam, PDO::PARAM_STR );
			$stmt->bindValue( ":email"  	 , $this->email, PDO::PARAM_STR );
			$stmt->bindValue( ":organisatie"  	 , $this->organisatie, PDO::PARAM_STR );
			$stmt->bindValue( ":id_person"  	 , $this->id_person, PDO::PARAM_STR );
// 				echo $sql . '<br/>';
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (gala 2) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}

	public function updateToDB () {
		global $connection;
		try
		{
			openDB();
			$sql = "UPDATE gala SET
								naam = :naam,
								email = :email,
								organisatie = :organisatie,
								id_person = :id_person,
								datumnw = NOW()
							WHERE id = :id;";
			$stmt = $connection->prepare( $sql );
			//give value to named parameter :username
			$stmt->bindValue( ":id"  		 , $this->id, PDO::PARAM_STR );
			$stmt->bindValue( ":naam" 		 , 	$this->naam, PDO::PARAM_STR );
			$stmt->bindValue( ":email"  	 , $this->email, PDO::PARAM_STR );
			$stmt->bindValue( ":organisatie"  	 , $this->organisatie, PDO::PARAM_STR );
			$stmt->bindValue( ":id_person"  	 , $this->id_person, PDO::PARAM_STR );
// 			$stmt->bindValue( ":datumnw"  	 , htmlentities($this->datumnw, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
	//			echo $sql . '<br/>';
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (gala 3) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}
	
	protected function readGalaWithId ($attr)
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
			$sql = "SELECT * FROM gala WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$galarow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (gala 4) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $galarow;	
	}

	protected function readGalaWithEmail ($attr)
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
			$sql = "SELECT * FROM gala WHERE email = :email LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":email", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$galarow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (gala 5) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $galarow;	
	}


}
