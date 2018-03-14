<?php
class Optie
{
	protected $id;
	protected $id_stelling;
	protected $volgnr;
	protected $antw_tekst;
	protected $toelicht_tekst;
	protected $score;

	public function __construct() 
	{
		$this->id_stelling = NULL;
		$this->volgnr = 0;
		$this->antw_tekst = '';
		$this->toelicht_tekst = '';
		$this->score = '';
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        }
	}

	public function __construct1 ($row) 
	{
		if ($row)
		{
			$this->id 				= $row['id'];
			$this->id_stelling		= $row['id_stelling'];
			$this->volgnr 			= $row['volgnr'];
			$this->antw_tekst		= $row['antw_tekst'];
			$this->toelicht_tekst	= $row['toelicht_tekst'];
			$this->score			= $row['score'];
		}
		else
		{
			$this->id 				= NULL;
			$this->id_stelling		= NULL;
			$this->volgnr 			= 0;
			$this->antw_tekst 		= '';
			$this->toelicht_tekst 	= '';
			$this->score			= '';
		}
	}
	public function __destruct ()
	{
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
			'$id				: ' . $this->id .				'<br/>' .
			'$id_stelling		: ' . $this->id_stelling .		'<br/>' .
			'$volgnr			: ' . $this->volgnr .			'<br/>' .
			'$antw_tekst		: ' . $this->antw_tekst .		'<br/>' .
			'$toelicht_tekst	: ' . $this->toelicht_tekst .	'<br/>' .
			'$score				: ' . $this->score .			'<br/>';
	}
}
?>
