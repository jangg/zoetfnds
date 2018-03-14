<?php
class Stelling
{
	protected $id;
	protected $tekst;
	protected $gewicht;
	protected $opties = array();

	public function __construct() 
	{
		$this->id = NULL;
		$this->tekst = '';
		$this->gewicht = '';
		$this->opties = array();			
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
			$this->tekst			= $row['tekst'];
			$this->gewicht			= $row['gewicht'];
			$this->opties			= $row['opties'];
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
			'$tekst				: ' . $this->tekst .			'<br/>' .
			'$gewicht			: ' . $this->gewicht .			'<br/>' .
			'$opties (aantal)	: ' . count($this->opties) .	'<br/>';
	}
}
?>
