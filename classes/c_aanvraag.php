<?php
include_once('c_user.php');

class Aanvraag 
{
	protected $id;
	protected $id_aanvrager;
	protected $id_organisatie;
	protected $wat;
	protected $voorwie;
	protected $waarom;
	protected $metwie;
	protected $wanneer;
	protected $hoe;
	protected $kosten;
	protected $bijdrage;
	protected $bedragbijdrage;
	protected $bedraggereserv;
	protected $bedragtoegekend;
	protected $bedraguitgekeerd;
	protected $file1;
	protected $file2;
	protected $file3;	
	protected $datumnw;
	protected $deleted;
	protected $approved;
	protected $omskort;
	protected $omschrijving;
	protected $codeaanvraag;
	protected $procstatus;
	protected $datumstatus;
	protected $boekingsnr;
	protected $codecat1;
	protected $codecat2;
	protected $datum_comm;
	protected $status_old;
	protected $afgerond_ind;
	protected $file1_dblink;
	protected $file2_dblink;
	protected $file3_dblink;

	public function __construct () {
			$this->id_aanvrager         = '';
			$this->id_organisatie         = '';
			$this->wat			   = '';
			$this->voorwie		   = '';
			$this->waarom		   = '';
			$this->metwie		   = '';
			$this->wanneer		   = '';
			$this->hoe			   = '';
			$this->kosten		   = '';
			$this->bijdrage	   	   = '';
			$this->bedragbijdrage  = 0;
			$this->bedraggereserv  = 0;
			$this->bedragtoegekend  = 0;
			$this->bedraguitgekeerd  = 0;
			$this->file1 		   = '';
			$this->file2 		   = '';
			$this->file3 		   = '';
			$this->datumnw		   = '';
			$this->deleted		   = 'n';
			$this->approved		   = 'n';
			$this->omskort		   = '';
			$this->omschrijving	   = '';
			$this->codeaanvraag	   = '';
			$this->procstatus	   	   = '00';
			$this->datumstatus		   = '';
			$this->boekingsnr	   = '';
			$this->codecat1 = '';
			$this->codecat2 = '';
			$this->datum_comm = '';
			$this->status_old = '';
			$this->afgerond_ind = 'n';
			$this->file1_dblink = '';
			$this->file2_dblink = '';
			$this->file3_dblink = '';
			
//		echo $this;

        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }
     	
	public function __construct1 ($aanvraagrow) 
	{
		if ($aanvraagrow)
		{
			$this->id              = $aanvraagrow['id'];
			$this->id_aanvrager       = $aanvraagrow['id_aanvrager'];
			$this->id_organisatie       = $aanvraagrow['id_organisatie'];
			$this->wat			   = html_entity_decode($aanvraagrow['wat']);
			$this->voorwie		   = html_entity_decode($aanvraagrow['voorwie']);
			$this->waarom		   = html_entity_decode($aanvraagrow['waarom']);
			$this->metwie		   = html_entity_decode($aanvraagrow['metwie']);
			$this->wanneer		   = html_entity_decode($aanvraagrow['wanneer']);
			$this->hoe			   = html_entity_decode($aanvraagrow['hoe']);
			$this->kosten		   = html_entity_decode($aanvraagrow['kosten']);
			$this->bijdrage	   	   = html_entity_decode($aanvraagrow['bijdrage']);
			$this->bedragbijdrage  = $aanvraagrow['bedragbijdrage'];
			$this->bedraggereserv  = $aanvraagrow['bedraggereserv'];
			$this->bedragtoegekend = $aanvraagrow['bedragtoegekend'];
			$this->bedraguitgekeerd = $aanvraagrow['bedraguitgekeerd'];
			$this->file1		   = html_entity_decode($aanvraagrow['file1']);
			$this->file2		   = html_entity_decode($aanvraagrow['file2']);
			$this->file3		   = html_entity_decode($aanvraagrow['file3']);
			$this->datumnw		   = $aanvraagrow['datumnw'];
			$this->deleted		   = $aanvraagrow['deleted'];
			$this->approved		   = $aanvraagrow['approved'];
			$this->omskort		   = html_entity_decode($aanvraagrow['omskort']);
			$this->omschrijving	   = html_entity_decode($aanvraagrow['omschrijving']);
			$this->codeaanvraag	   = $aanvraagrow['codeaanvraag'];
			$this->procstatus	   = $aanvraagrow['procstatus'];
			$this->datumstatus		= $aanvraagrow['datumstatus'];
			$this->boekingsnr	   = $aanvraagrow['boekingsnr'];
			
			$this->codecat1		= $aanvraagrow['codecat1'];
			$this->codecat2		= $aanvraagrow['codecat2'];
			$this->datum_comm		= $aanvraagrow['datum_comm'];
			$this->status_old		= $aanvraagrow['procstatus'];
			$this->afgerond_ind		= $aanvraagrow['afgerond_ind'];
			$this->file1_dblink		= $aanvraagrow['file1_dblink'];
			$this->file2_dblink		= $aanvraagrow['file2_dblink'];
			$this->file3_dblink		= $aanvraagrow['file3_dblink'];
		}
		else
		{
			$this->id 			  = NULL;
			$this->id_aanvrager         = '';
			$this->id_organisatie         = '';
			$this->wat			   = '';
			$this->voorwie		   = '';
			$this->waarom		   = '';
			$this->metwie		   = '';
			$this->wanneer		   = '';
			$this->hoe			   = '';
			$this->kosten		   = '';
			$this->bijdrage	   	   = '';
			$this->bedragbijdrage  = 0;
			$this->bedraggereserv  = 0;
			$this->bedragtoegekend  = 0;
			$this->bedraguitgekeerd  = 0;
			$this->file1 		   = '';
			$this->file2 		   = '';
			$this->file3 		   = '';
			$this->datumnw		   = '';
			$this->deleted		   = 'n';
			$this->approved		   = 'n';
			$this->omskort		   = '';
			$this->omschrijving	   = '';
			$this->codeaanvraag	   = '';
			$this->procstatus	   	   = '00';
			$this->datumstatus		   = '';
			$this->boekingsnr	   = '';
			$this->codecat1		= '';
			$this->codecat2		= '';
			$this->datum_comm = '';
			$this->status_old = '';
			$this->afgerond_ind = 'n';
			$this->file1_dblink = '';
			$this->file2_dblink = '';
			$this->file3_dblink = '';
		}
	}
	public function __construct2 ($attr, $value)
	{
		/* id of id_aanvrager is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readAanvraagWithId($value));
				break;
				
			case 'id_aanvrager':
				$this->__construct1($this->readAanvraagWithUserid($value));
				break;
				
			default:
				return FALSE;
		}
		
	}
	public function __destruct ()
	{
//		echo 'Aanvraag ' . $this->id . ' is vernietigd<br/>';
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
			'$id_aanvrager			: ' . $this->id_aanvrager .			'<br/>' .
			'$id_organisatie			: ' . $this->id_organisatie .			'<br/>' .
			'$wat			    : ' . $this->wat .				'<br/>' .
			'$voorwie		    : ' . $this->voorwie .			'<br/>' .
			'$waarom		    : ' . $this->waarom .			'<br/>' .
			'$metwie		    : ' . $this->metwie .			'<br/>' .
			'$wanneer		    : ' . $this->wanneer .			'<br/>' .
			'$hoe			    : ' . $this->hoe .				'<br/>' .
			'$kosten		    : ' . $this->kosten .			'<br/>' .
			'$bijdrage	   	    : ' . $this->bijdrage .			'<br/>' .
			'$bedragbijdrage  = : ' . $this->bedragbijdrage .	'<br/>' .
			'bedraggereserv  = : ' . $this->bedraggereserv .	'<br/>' .
			'bedragtoegekend  = : ' . $this->bedragtoegekend .	'<br/>' .
			'bedraguitgekeerd  = : ' . $this->bedraguitgekeerd .	'<br/>' .
			'$file1				: ' . $this->file1 .			'<br/>' .
			'$file2				: ' . $this->file2 .			'<br/>' .
			'$file3				: ' . $this->file3 .			'<br/>' .
			'$datumnw		   	: ' . $this->datumnw		  . '<br/>' .
			'$deleted		   	: ' . $this->deleted		  . '<br/>' .
			'$approved		   	: ' . $this->approved		  . '<br/>' .
			'$omskort		   	: ' . $this->omskort		  . '<br/>' .
			'$omschrijving	   	: ' . $this->omschrijving	  . '<br/>' .
			'$codeaanvraag		: ' . $this->codeaanvraag	  . '<br/>' .
			'$procstatus		   	: ' . $this->procstatus		  . '<br/>' .
			'$datumstatus		   	: ' . $this->datumstatus		  . '<br/>' .
			'$boekingsnr		   	: ' . $this->boekingsnr		  . '<br/>';
			'$codecat1		   	: ' . $this->codecat1		  . '<br/>';
			'$codecat2		   	: ' . $this->codecat2		  . '<br/>';
			'$datum_comm		: ' . $this->datum_comm		. '<br/>';
			'$afgerond_ind		: ' . $this->afgerond_ind		. '<br/>';
			'$file1_dblink		: ' . $this->file1_dblink		. '<br/>';
			'$file2_dblink		: ' . $this->file2_dblink		. '<br/>';
			'$file3_dblink		: ' . $this->file3_dblink		. '<br/>';
	}
	
	protected function addStatusLine ()
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT statushist 
										(	id, 
											id_aanvraag,
											statuscode,
											id_user,
											ts_status
											)
									VALUES ( :id,
											:id_aanvraag,
											:statuscode,
											:id_user,
											:ts_status
											)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":id_aanvraag"	, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":statuscode"		, $this->procstatus, PDO::PARAM_STR);
// 			$stmt->bindvalue( ":id_user"		, $this->wat, PDO::PARAM_STR);
			$stmt->bindvalue( ":id_user"		, '0', PDO::PARAM_STR);
			$stmt->bindValue( ":ts_status"	, $this->datumstatus, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (statusline 1) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
		
	}
	
	public function saveToDB () 
	{
		$date = new DateTime();
        $this->datumnw = $date->format('Y-m-d H:i:s');
        $this->datumstatus = $date->format('Y-m-d H:i:s');
        global $connection;
		try
		{			
			openDB();
			$sql = "INSERT aanvraag 
										(	id,
											id_aanvrager,
											id_organisatie,
											wat,	
											voorwie,	
											waarom,	
											metwie,	
											wanneer,	
											hoe,	
											kosten,	
											bijdrage,
											bedragbijdrage,
											bedraggereserv,
											bedragtoegekend,
											bedraguitgekeerd,
											file1,
											file2,
											file3,
											datumnw,											
											deleted,											
											approved,
											omskort,
											omschrijving,
											codeaanvraag,
											procstatus,
											datumstatus,											
											boekingsnr,
											codecat1,
											codecat2,
											datum_comm,
											afgerond_ind,
											file1_dblink,
											file2_dblink,
											file3_dblink
											)
									VALUES (
											:id,
											:id_aanvrager,
											:id_organisatie,
											:wat,	
											:voorwie,	
											:waarom,	
											:metwie,	
											:wanneer,	
											:hoe,	
											:kosten,	
											:bijdrage,
											:bedragbijdrage,
											:bedraggereserv,
											:bedragtoegekend,
											:bedraguitgekeerd,
											:file1,
											:file2,
											:file3,
											:datumnw,
											:deleted,
											:approved,											
											:omskort,
											:omschrijving,
											:codeaanvraag,
											:procstatus,
											:datumstatus,											
											:boekingsnr,
											:codecat1,
											:codecat2,
											:datum_comm,
											:afgerond_ind,										
											:file1_dblink,
											:file2_dblink,
											:file3_dblink
											)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":id_aanvrager"		, $this->id_aanvrager, PDO::PARAM_STR);
			$stmt->bindValue( ":id_organisatie"		, $this->id_organisatie, PDO::PARAM_STR);
			$stmt->bindvalue( ":wat"			, htmlentities($this->wat, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":voorwie"		, htmlentities($this->voorwie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":waarom"			, htmlentities($this->waarom, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":metwie"			, htmlentities($this->metwie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":wanneer"		, htmlentities($this->wanneer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":hoe"			, htmlentities($this->hoe, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":kosten"			, htmlentities($this->kosten, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":bijdrage"		, htmlentities($this->bijdrage, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":bedragbijdrage"	, $this->bedragbijdrage, PDO::PARAM_STR);
			$stmt->bindvalue( ":bedraggereserv"	, $this->bedraggereserv, PDO::PARAM_STR);
			$stmt->bindvalue( ":bedragtoegekend"	, $this->bedragtoegekend, PDO::PARAM_STR);
			$stmt->bindvalue( ":bedraguitgekeerd"	, $this->bedraguitgekeerd, PDO::PARAM_STR);
			$stmt->bindValue( ":file1"			, htmlentities($this->file1, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":file2"			, htmlentities($this->file2, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":file3"			, htmlentities($this->file3, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":datumnw"		, $this->datumnw, PDO::PARAM_STR);
			$stmt->bindValue( ":deleted"		, $this->deleted, PDO::PARAM_STR);
			$stmt->bindValue( ":approved"		, $this->approved, PDO::PARAM_STR);
			$stmt->bindvalue( ":omskort"		, htmlentities($this->omskort, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":omschrijving"	, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":codeaanvraag"	, $this->codeaanvraag, PDO::PARAM_STR);
			$stmt->bindValue( ":procstatus"		, $this->procstatus, PDO::PARAM_STR);
			$stmt->bindValue( ":datumstatus"	, $this->datumstatus, PDO::PARAM_STR);
			$stmt->bindValue( ":boekingsnr"		, $this->boekingsnr, PDO::PARAM_STR);
			$stmt->bindValue( ":codecat1"		, $this->codecat1, PDO::PARAM_STR);
			$stmt->bindValue( ":codecat2"		, $this->codecat2, PDO::PARAM_STR);
			$stmt->bindValue( ":datum_comm"		, $this->datum_comm, PDO::PARAM_STR);
			$stmt->bindValue( ":afgerond_ind"	, $this->afgerond_ind, PDO::PARAM_STR);
			$stmt->bindValue( ":file1_dblink"	, $this->file1_dblink, PDO::PARAM_STR);
			$stmt->bindValue( ":file2_dblink"	, $this->file2_dblink, PDO::PARAM_STR);
			$stmt->bindValue( ":file3_dblink"	, $this->file3_dblink, PDO::PARAM_STR);
			$stmt->execute();
// 			error_log('Een nieuwe c_person is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (aanvraag 1) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
// Bij de aanmaak van een nieuwe aanvarag wordt altijd een statusregel geschreven
		$this->addStatusLine ();
	    return TRUE;	
	}

	public function updateToDB () 
	{
		global $connection;
		try
		{
			openDB();
			$sql = "UPDATE aanvraag SET
							id_aanvrager	 = :id_aanvrager,
							id_organisatie	 = :id_organisatie,
							wat				 = :wat,	
							voorwie			 = :voorwie,	
							waarom			 = :waarom,	
							metwie			 = :metwie,	
							wanneer			 = :wanneer,	
							hoe				 = :hoe,	
							kosten			 = :kosten,	
							bijdrage		 = :bijdrage,
							bedragbijdrage	 = :bedragbijdrage,
							bedraggereserv	 = :bedraggereserv,
							bedragtoegekend	 = :bedragtoegekend,
							bedraguitgekeerd = :bedraguitgekeerd,
							file1			 = :file1,
							file2			 = :file2,
							file3			 = :file3,
							datumnw          = :datumnw,
							deleted			 = :deleted,
							approved		 = :approved,
							omskort			 = :omskort,
							omschrijving	 = :omschrijving,
							codeaanvraag	 = :codeaanvraag,
							procstatus		 = :procstatus,
							datumstatus      = :datumstatus,
							boekingsnr		 = :boekingsnr,
							codecat1		 = :codecat1,
							codecat2		 = :codecat2,
							datum_comm		 = :datum_comm,
							afgerond_ind	 = :afgerond_ind,
							file1_dblink	 = :file1_dblink,
							file2_dblink	 = :file2_dblink,
							file3_dblink	 = :file3_dblink
							WHERE id         = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":id_aanvrager"		, $this->id_aanvrager, PDO::PARAM_STR);
			$stmt->bindValue( ":id_organisatie"		, $this->id_organisatie, PDO::PARAM_STR);
			$stmt->bindvalue( ":wat"			, htmlentities($this->wat, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":voorwie"		, htmlentities($this->voorwie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":waarom"			, htmlentities($this->waarom, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":metwie"			, htmlentities($this->metwie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":wanneer"		, htmlentities($this->wanneer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":hoe"			, htmlentities($this->hoe, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":kosten"			, htmlentities($this->kosten, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":bijdrage"		, htmlentities($this->bijdrage, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":bedragbijdrage"	, $this->bedragbijdrage, PDO::PARAM_STR);
			$stmt->bindvalue( ":bedraggereserv"	, $this->bedraggereserv, PDO::PARAM_STR);
			$stmt->bindvalue( ":bedragtoegekend"	, $this->bedragtoegekend, PDO::PARAM_STR);
			$stmt->bindvalue( ":bedraguitgekeerd"	, $this->bedraguitgekeerd, PDO::PARAM_STR);
			$stmt->bindValue( ":file1"			, htmlentities($this->file1, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":file2"			, htmlentities($this->file2, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":file3"			, htmlentities($this->file3, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":datumnw"		, $this->datumnw, PDO::PARAM_STR);
			$stmt->bindValue( ":deleted"		, $this->deleted, PDO::PARAM_STR);
			$stmt->bindValue( ":approved"		, $this->approved, PDO::PARAM_STR);
			$stmt->bindvalue( ":omskort"		, htmlentities($this->omskort, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue( ":omschrijving"	, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":codeaanvraag"	, $this->codeaanvraag, PDO::PARAM_STR);
			$stmt->bindValue( ":procstatus"			, $this->procstatus, PDO::PARAM_STR);
			$stmt->bindValue( ":datumstatus"		, $this->datumstatus, PDO::PARAM_STR);
			$stmt->bindValue( ":boekingsnr"			, $this->boekingsnr, PDO::PARAM_STR);
			$stmt->bindValue( ":codecat1"		, $this->codecat1, PDO::PARAM_STR);
			$stmt->bindValue( ":codecat2"		, $this->codecat2, PDO::PARAM_STR);
			$stmt->bindValue( ":datum_comm"		, $this->datum_comm, PDO::PARAM_STR);
			$stmt->bindValue( ":afgerond_ind"	, $this->afgerond_ind, PDO::PARAM_STR);
			$stmt->bindValue( ":file1_dblink"	, $this->file1_dblink, PDO::PARAM_STR);
			$stmt->bindValue( ":file2_dblink"	, $this->file2_dblink, PDO::PARAM_STR);
			$stmt->bindValue( ":file3_dblink"	, $this->file3_dblink, PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (aanvraag 5) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
// Bij de wijziging van een aanvraag wordt alleen een statusregel geschreven als de status veranderd is
		if ($this->procstatus != $this->status_old)
			$this->addStatusLine ();
		
	    return TRUE;	
	}

	protected function readAanvraagWithId ($attr)
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
			$sql = "SELECT * FROM aanvraag WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$aanvraagrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (aanvraag 2) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $aanvraagrow;	
	}
	
	protected function readAanvraagWithUserid ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM aanvraag WHERE id_aanvrager = :id_aanvrager;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id_aanvrager", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$aanvraagrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (aanvraag 4) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $aanvraagrow;	
	}
	
	public function nbrOfComments ($attr)
	{
		$count = 0;
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT COUNT(*) FROM user,comment,aanvraag WHERE user.activity < comment.created AND user.id = :userid AND comment.id_aanvraag = :aanvraagid;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":userid", $attr, PDO::PARAM_STR);
			$stmt->bindValue( ":aanvraagid", $this->id, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$count = $stmt->execute();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (aanvraag 3) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $count;	
		
	}
	
	public function getStatusList ()
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM statushist WHERE id_aanvraag = :id ORDER BY ts_status DESC;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $this->id, PDO::PARAM_STR);
			$stmt->execute();
			$statusList = $stmt->FetchAll(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (aanvraag 4) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
		return $statusList;
	}
	
	public function newComms ($userid)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT datum FROM user_aanv WHERE id_user = :id_user AND id_aanvraag = :id_aanvraag;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id_user", $userid, PDO::PARAM_STR);
			$stmt->bindValue( ":id_aanvraag", $this->id, PDO::PARAM_STR);
			$stmt->execute();
			$user_aanv_row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($user_aanv_row == NULL)
			{
				return TRUE;
			} else
			{
// 				echo $user_aanv_row[datum] . ' -- ' . $this->datum_comm . '<br/>';
				if ($user_aanv_row['datum'] < $this->datum_comm)
				{
					return TRUE;
				} else
				{
					return FALSE;
				}
			}
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (user_aanv 1) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	}
	
	public function setDatumGezien($userid)
	{
		$datum = new DateTime();
		$datum_gezien = $datum->format('Y-m-d H:i:s');
		global $connection;
		try
		{
			openDB();
			$sql = "REPLACE INTO user_aanv (id_user, id_aanvraag, datum) VALUES (:id_user, :id_aanvraag, :datum)";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id_user", $userid, PDO::PARAM_STR);
			$stmt->bindValue( ":id_aanvraag", $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":datum", $datum_gezien, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (user_aanv 1) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
		
	}
}
