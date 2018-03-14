<?php
class Person_gala 
{
	protected $id;
	protected $id_person;
	protected $aanvraag;
	protected $invitation;
	protected $invitationSent;
	protected $reaction;
	protected $emailadres;

	public function __construct () {
			$this->id_person       = '';
			$this->aanvraag		  = 'n';
			$this->invitation	  = 'n';
			$this->invitationSent= 'n';
			$this->reaction= 'n';
			$this->emailadres= '';
//		echo $this;

        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }
     	
	public function __construct1 ($pinvitationrow) 
	{
		if ($pinvitationrow)
		{
// 			error_log("De person bestaat, invullen maar");
			$this->id             = $pinvitationrow['id'];
			$this->id_person       = $pinvitationrow['id_person'];
			$this->aanvraag		  = $pinvitationrow['aanvraag'];
			$this->invitation	  = $pinvitationrow['invitation'];
			$this->invitationSent= $pinvitationrow['invitationSent'];
			$this->reaction= $pinvitationrow['reaction'];
			$this->emailadres= $pinvitationrow['emailadres'];
		}
		else
		{
// 			error_log("Geen person gevonden, dan lege geven");
			$this->id 			  = NULL;
			$this->id_person       = '';
			$this->aanvraag		  = 'n';
			$this->invitation	  = 'n';
			$this->invitationSent= 'n';
			$this->reaction= 'n';
			$this->emailadres= '';
		}
	}

	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readPerson_galaWithId($value));
				break;
				
			case 'emailadres':
				$this->__construct1($this->readPerson_galaWithEmailadres($value));
				break;
				
			default:
				return FALSE;
		}
		
	}

	public function __destruct ()
	{
//		echo 'Pinvitation ' . $this->id . ' is vernietigd<br/>';
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
			'$id				: ' . $this->id .				'<br/>' .
			'$id_person			: ' . $this->id_person .			'<br/>' .
			'$aanvraag			: ' . $this->aanvraag .			'<br/>' .
			'$invitation		: ' . $this->invitation	  . '<br/>' .
			'$invitationSent	: ' . $this->invitationSent  . '<br/>' .
			'$reaction	: ' . $this->reaction  . '<br/>';
			'$emailadres	: ' . $this->emailadres  . '<br/>';
	}
	
	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT person_gala 
										(	id,
											id_person 		,
											aanvraag ,
											invitation,
											invitationSent,
											reaction,
											emailadres
											)
									VALUES (
											:id,
											:id_person 		,
											:aanvraag ,
											:invitation,
											:invitationSent,
											:reaction,
											:emailadres
											)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"		, $this->id_person, PDO::PARAM_STR);
			$stmt->bindValue( ":aanvraag"		, $this->aanvraag, PDO::PARAM_STR);
			$stmt->bindValue( ":invitation"	, $this->invitation, PDO::PARAM_STR);
			$stmt->bindValue( ":invitationSent", $this->invitationSent, PDO::PARAM_STR);
			$stmt->bindValue( ":reaction", $this->reaction, PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres", $this->emailadres, PDO::PARAM_STR);
			$stmt->execute();
// 			error_log('Een nieuwe c_person is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (person_gala 1) met de database mislukt: ' . $e->getMessage();
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
			$sql = "UPDATE person_gala SET
							id_person         = :id_person,
							aanvraag		 = :aanvraag,
							invitation      = :invitation,
							invitationSent  = :invitationSent,
							reaction  = :reaction,
							emailadres  = :emailadres
							WHERE id         = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"		, $this->id_person, PDO::PARAM_STR);
			$stmt->bindValue( ":aanvraag"		, $this->aanvraag, PDO::PARAM_STR);
			$stmt->bindValue( ":invitation"	, $this->invitation, PDO::PARAM_STR);
			$stmt->bindValue( ":invitationSent", $this->invitationSent, PDO::PARAM_STR);
			$stmt->bindValue( ":reaction", $this->reaction, PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres", $this->emailadres, PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (person_gala 5) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}
	protected function readPerson_galaWithId ($attr)
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
			$sql = "SELECT * FROM person_gala WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$pinvitationrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (person_gala 2) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $pinvitationrow;	
	}
	
	protected function readPerson_galaWithEmailadres ($attr)
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
			$sql = "SELECT * FROM person_gala WHERE emailadres = :emailadres LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":emailadres", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$pinvitationrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (person_gala 6) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $pinvitationrow;	
	}

}
