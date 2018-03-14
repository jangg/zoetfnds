<?php
class Newsitem 
{
	protected $id;
	protected $id_author;
	protected $title;
	protected $subtitle;
	protected $text;
	protected $tw_text;
	protected $tw_url;
	protected $fb_elementid;
	protected $fb_title;
	protected $fb_pict;
	protected $fb_caption;
	protected $fb_description;
	protected $date_created;
	protected $date_modified;
	protected $delind;
	protected $visind;

	public function __construct () {
		$this->id_author	 	= '0';
		$this->title		 	= '';
		$this->subtitle		 	= '';
		$this->text			 	= '';
		$this->tw_text		 	= '';
		$this->tw_url		 	= '';
		$this->fb_elementid	 	= '';
		$this->fb_title		 	= 'standaard construct';
		$this->fb_pict		 	= '';
		$this->fb_caption	 	= '';
		$this->fb_description	= '';
		$this->date_created	 	= '';
		$this->date_modified 	= '';
		$this->delind		 	= 'n';
		$this->visind		 	= 'n';
//		echo $this;

        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }
    
    public function __construct1 ($newsitemrow)
    {
		if ($newsitemrow)
		{
// 			error_log("De newsitem bestaat, invullen maar");
			$this->id             = $newsitemrow['id'];
			$this->id_author	  = $newsitemrow['id_author'];
			$this->title		  = $newsitemrow['title'];
			$this->subtitle		  = $newsitemrow['subtitle'];
			$this->text			  = $newsitemrow['text'];
			$this->tw_text		  = $newsitemrow['tw_text'];
			$this->tw_url		  = $newsitemrow['tw_url'];
			$this->fb_elementid	  = $newsitemrow['fb_elementid'];
			$this->fb_title		  = $newsitemrow['fb_title'];
			$this->fb_pict		  = $newsitemrow['fb_pict'];
			$this->fb_caption	  = $newsitemrow['fb_caption'];
			$this->fb_description = $newsitemrow['fb_description'];
			$this->date_created	  = $newsitemrow['date_created'];
			$this->date_modified  = $newsitemrow['date_modified'];
			$this->delind		  = $newsitemrow['delind'];
			$this->visind		  = $newsitemrow['visind'];

		}
		else
		{
// 			error_log("Geen newsitem gevonden, dan lege geven");
			$this->id 			    = NULL;
			$this->id_author	 	= '0';
			$this->title		 	= '';
			$this->subtitle		 	= '';
			$this->text			 	= '';
			$this->tw_text		 	= '';
			$this->tw_url		 	= '';
			$this->fb_elementid	 	= '';
			$this->fb_title		 	= '';
			$this->fb_pict		 	= '';
			$this->fb_caption	 	= '';
			$this->fb_description	= '';
			$this->date_created	 	= '';
			$this->date_modified 	= '';
			$this->delind		 	= 'n';
			$this->visind		 	= 'n';
		}	    
    } 	
    
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readNewsitemWithId($value));
				break;
			default:
				return FALSE;
		}
		
	}


	public function __destruct ()
	{
//		echo 'newsitem ' . $this->id . ' is vernietigd<br/>';
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
		'$id            	: ' . $this->id			     . '<br/>' .
		'$id_author         : ' . $this->id_author	     . '<br/>' .
		'$title             : ' . $this->title		     . '<br/>' .
		'$subtitle          : ' . $this->subtitle	     . '<br/>' .
		'$text              : ' . $this->text		     . '<br/>' .
		'$tw_text           : ' . $this->tw_text	     . '<br/>' .
		'$tw_url            : ' . $this->tw_url		     . '<br/>' .
		'$fb_elementid      : ' . $this->fb_elementid    . '<br/>' .
		'$fb_title          : ' . $this->fb_title	     . '<br/>' .
		'$fb_pict           : ' . $this->fb_pict	     . '<br/>' .
		'$fb_caption        : ' . $this->fb_caption	     . '<br/>' .
		'$fb_description    : ' . $this->fb_description  . '<br/>' .
		'$date_created      : ' . $this->date_created    . '<br/>' .
		'$date_modified     : ' . $this->date_modified   . '<br/>' .
		'$delind	        : ' . $this->delind		     . '<br/>' .
		'$visind            : ' . $this->visind		     . '<br/>' ;
	}
	
	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT newsitem 
										(	id,
											id_author,
											title,
											subtitle,
											text,
											tw_text,
											tw_url,
											fb_elementid,
											fb_title,
											fb_pict,
											fb_caption,
											fb_description,
											date_created,
											date_modified,
											delind,
											visind
											)
									VALUES (
											:id,
											:id_author,
											:title,
											:subtitle,
											:text,
											:tw_text,
											:tw_url,
											:fb_elementid,
											:fb_title,
											:fb_pict,
											:fb_caption,
											:fb_description,
											NOW(),
											:date_modified,
											:delind,
											:visind
											)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":id_author"		, $this->id_author, PDO::PARAM_STR);
			$stmt->bindValue( ":title"			, $this->title, PDO::PARAM_STR);
			$stmt->bindValue( ":subtitle"		, $this->subtitle, PDO::PARAM_STR);
			$stmt->bindValue( ":text"			, $this->text, PDO::PARAM_STR);
			$stmt->bindValue( ":tw_text"		, $this->tw_text, PDO::PARAM_STR);
			$stmt->bindValue( ":tw_url"			, $this->tw_url, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_elementid"	, $this->fb_elementid, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_title"		, $this->fb_title, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_pict"		, $this->fb_pict, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_caption"		, $this->fb_caption, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_description"	, $this->fb_description, PDO::PARAM_STR);
// 			$stmt->bindValue( ":date_created"	, $this->date_created, PDO::PARAM_STR);
			$stmt->bindValue( ":date_modified"	, $this->date_modified, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"			, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":visind"			, $this->visind, PDO::PARAM_STR);
			$stmt->execute();
// 			error_log('Een nieuwe c_newsitem is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (newsitem 1) met de database mislukt: ' . $e->getMessage();
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
			$sql = "UPDATE newsitem SET
							id_author	  	= :id_author,
							title		  	= :title,
							subtitle	  	= :subtitle,
							text		  	= :text,
							tw_text		  	= :tw_text,
							tw_url		  	= :tw_url,
							fb_elementid  	= :fb_elementid,
							fb_title	  	= :fb_title,
							fb_pict		  	= :fb_pict,
							fb_caption	  	= :fb_caption,
							fb_description	= :fb_description,
							date_created  	= :date_created,
							date_modified 	= NOW(),
							delind		  	= :delind,
							visind		  	= :visind
							WHERE id         = :id;";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":id_author"		, $this->id_author, PDO::PARAM_STR);
			$stmt->bindValue( ":title"			, $this->title, PDO::PARAM_STR);
			$stmt->bindValue( ":subtitle"		, $this->subtitle, PDO::PARAM_STR);
			$stmt->bindValue( ":text"			, $this->text, PDO::PARAM_STR);
			$stmt->bindValue( ":tw_text"		, $this->tw_text, PDO::PARAM_STR);
			$stmt->bindValue( ":tw_url"			, $this->tw_url, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_elementid"	, $this->fb_elementid, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_title"		, $this->fb_title, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_pict"		, $this->fb_pict, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_caption"		, $this->fb_caption, PDO::PARAM_STR);
			$stmt->bindValue( ":fb_description"	, $this->fb_description, PDO::PARAM_STR);
			$stmt->bindValue( ":date_created"	, $this->date_created, PDO::PARAM_STR);
// 			$stmt->bindValue( ":date_modified"	, $this->date_modified, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"			, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":visind"			, $this->visind, PDO::PARAM_STR);
// 			echo $sql;
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (newsitem 5) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}
	protected function readNewsitemWithId ($attr)
	{
		/* Haal de gegevens uit de database
			$newsitemid kan 2 soorten waarde hebben:
			NULL of 0 => het object bestaat niet in de database => zo laten
			integer => het object kan uit de DB gelezen worden => ophalen en attrs vullen
		*/
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM newsitem WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$newsitemrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (newsitem 2) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $newsitemrow;	
	}
	
}
