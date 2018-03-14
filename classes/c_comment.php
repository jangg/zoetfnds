<?php
class Comment 
{
	public static $id_of_comment = 0;
	protected $id;
	protected $delind;
	protected $visind;
	protected $created;
	protected $id_aanvraag;
	protected $id_user;
	protected $subject;
	protected $text;
	
	public function __construct () {
		/* eerste de default waarden zetten */
		$this->visind = 'n';
		$this->delind = 'n';
		$this->id_user = "0";
		$this->id_aanvraag = "0";
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }

	private function __construct1 ($commentrow) {
		$this->id			= $commentrow['id'];
		$this->delind		= $commentrow['delind'];
		$this->visind		= $commentrow['visind'];
		$this->created		= $commentrow['created'];
		$this->id_aanvraag	= $commentrow['id_aanvraag'];
		$this->id_user		= $commentrow['id_user'];
		$this->subject		= html_entity_decode($commentrow['subject']);
		$this->text			= html_entity_decode($commentrow['text']);
	}
	
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readCommentWithId($value));
				break;
				
			default:
				return FALSE;
		}
		
	}
	
	public function __destruct ()
	{
//		echo 'Comment ' . Comment::$id_of_comment . ' is vernietigd<br/>';
	}
	
	public function __get($attr)
	{
		return $this->$attr;
	}

	public function __set($attr, $value)
	{
/*
		switch ($attr)
		{
			case 'visind':
				if ($value)
					$this->visind = 'j';
				else
					$this->visind = 'n';
				break;
			case 'delind':
				if ($value)
					$this->delind = 'j';
				else
					$this->delind = 'n';
				break;
			default:
				$this->$attr = $value;
		}
*/
		$this->$attr = $value;
	}
	
	public function __toString()
	{
		/* hier printen we het object mee uit, voor testdoeleinden */
		return 	
		'$id  				: ' . $this->id			. '<br/>' .
		'$delind 			: ' . $this->delind		. '<br/>' .
		'$visind  			: ' . $this->visind		. '<br/>' .
		'$created  			: ' . $this->created		. '<br/>' .
		'$id_aanvraag  		: ' . $this->id_aanvraag	. '<br/>' .
		'$id_user  			: ' . $this->id_user		. '<br/>' .
		'$subject  			: ' . $this->subject		. '<br/>' .
		'$text  			: ' . $this->text			. '<br/>';
	}
	
	public function insertToDB () {
		global $connection;
		try
		{
			openDB();
			$sql = "INSERT INTO comment VALUES (
								:id  		 ,
								:delind 	 ,
								:visind  	 ,
								:created  	 ,
								:id_aanvraag ,
								:id_user  	 ,
								:subject  	 ,
								:text);";
			$stmt = $connection->prepare( $sql );
			//give value to named parameter :username
			$stmt->bindValue( ":id"  		 , $this->id, PDO::PARAM_STR );
			$stmt->bindValue( ":delind" 	 , $this->delind, PDO::PARAM_STR );
			$stmt->bindValue( ":visind"  	 , $this->visind, PDO::PARAM_STR );
			$stmt->bindValue( ":created"  	 , $this->created, PDO::PARAM_STR );
			$stmt->bindValue( ":id_user"  	 , $this->id_user, PDO::PARAM_STR );
			$stmt->bindValue( ":id_aanvraag" , $this->id_aanvraag, PDO::PARAM_STR );
			$stmt->bindValue( ":subject"  	 , htmlentities($this->subject, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
			$stmt->bindValue( ":text" 		 , htmlentities($this->text, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
// 				echo $sql . '<br/>';
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (comment 2) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}

	public function updateToDB () {
		global $connection;
		try
		{
			openDB();
			$sql = "UPDATE comment SET
								delind = :delind 	 ,
								visind = :visind  	 ,
								created = :created  	 ,
								id_user = :id_user  	 ,
								id_aanvraag = :id_aanvraag ,
								subject = :subject  	 ,
								text = :text
							WHERE id = :id;";
			$stmt = $connection->prepare( $sql );
			//give value to named parameter :username
			$stmt->bindValue( ":id"  		 , $this->id, PDO::PARAM_STR );
			$stmt->bindValue( ":delind" 	 , $this->delind, PDO::PARAM_STR );
			$stmt->bindValue( ":visind"  	 , $this->visind, PDO::PARAM_STR );
			$stmt->bindValue( ":created"  	 , $this->created, PDO::PARAM_STR );
			$stmt->bindValue( ":id_user"  	 , $this->id_user, PDO::PARAM_STR );
			$stmt->bindValue( ":id_aanvraag" , $this->id_aanvraag, PDO::PARAM_STR );
			$stmt->bindValue( ":subject"  	 , htmlentities($this->subject, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
			$stmt->bindValue( ":text" 		 , htmlentities($this->text, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR );
	//			echo $sql . '<br/>';
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (comment 3) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}
	
		protected function readCommentWithId ($attr)
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
			$sql = "SELECT * FROM comment WHERE id = :id AND comment.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$commentrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (comment 4) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $commentrow;	
	}


}
