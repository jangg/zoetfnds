<?php
include_once ('c_blog.php');

class Blog_coll {
	
	/* $nbrBlogs bevat het aantal blogs in het collection object */
	protected $nbrBlogs;
	protected $blogColl = array();
	protected $query;
	
	
	public function __construct () {
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }

    private function __construct1 ($orderArr) {
	    /*
	    	De constructor heeft 1 array als argument:
	    	1. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde si op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    */
	    
	    $this->buildQuery(NULL, $orderArr, NULL);
	    $this->execQuery();
	    
    }
    
    private function __construct2 ($selectArr, $orderArr) {
	    /*
	    	De constructor heeft 2 arrays als argument:
	    	1. Een array met selectiecriteria;
	    		elke row heeft een attribuut uit de DB en de waarde ervan waarop geslecteerd wordt.
	    		Als de array leeg is worden alle blogen geselecteerd.
	    	2. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde is op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    */
	    
	    $this->buildQuery($selectArr, $orderArr, NULL);
	    $this->execQuery();
	    
    }
    
    private function __construct3 ($selectArr, $orderArr, $limit) {
	    /*
	    	De constructor heeft 3 attrs als argument:
	    	1. Een array met selectiecriteria;
	    		elke row heeft een attribuut uit de DB en de waarde ervan waarop geslecteerd wordt.
	    		Als de array leeg is worden alle blogen geselecteerd.
	    	2. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde si op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    	3. het aantal te lezen blogen
	    		
	    */
	    
	    $this->buildQuery($selectArr, $orderArr, $limit);
	    $this->execQuery();
	    
    }
    public function getBlogColl () {
    
	    return $this->blogColl;
    }
    
    private function buildQuery ($selectArr, $orderArr, $limit) {
	    
	    $this->query = 'SELECT blog.* FROM blog WHERE blog.delind = "n"';
// 		$this->query .= ' WHERE blog.user_id = comm_user.id AND comm_blog.deleted = FALSE AND comm_blog.visible = TRUE AND comm_user.approved = TRUE ';
	    if (!empty($selectArr)) {
		    foreach ($selectArr as $selection) {
	    		$this->query .= ' AND ';
			    $this->query .= $selection[0] . ' = "' . $selection[1] . '" ';
		    }
	    }
	    if (!empty($orderArr)) {
	    	$this->query .= ' ORDER BY ';
		    foreach ($orderArr as $sort) {
			    $this->query .= $sort[0] . ' ' . $sort[1];
		    }
	    }
	    
	    if ($limit != NULL)
	    {
		    $this->query .= ' LIMIT ';
		    $this->query .= $limit;
	    }
	    $this->query .= ';';
// 	    echo $this->query;
    }
    
	public function __get($attr)
	{
		switch ($attr) {
			
			case "query":
				if (!empty($this->query))
					return $this->$attr;
				else
					return 'Er is geen query aangemaakt. ';
				break;
			default:
				return $this->$attr;
		}
	}
	
	private function execQuery () {
		global $connection;
		try
		{
			openDB();
			$stmt = $connection->prepare( $this->query );
			$stmt->execute();
			$rows = $stmt->fetchAll();
			$this->nbrBlogs = 0;
			foreach ($rows as $row)
			{
				$this->nbrBlogs++;
				$blog = new Blog ($row);
//				echo $blog;
				$this->blogColl[] = $blog;
			}
		} catch (PDOException $e) 
		{
			  echo 'Connectie (blog 1 in c_blog_coll.php) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}

	}
	
	static public function getNbrBlogs()
	{
		global $connection;
		try
		{
			openDB();
			$query = 'SELECT COUNT(*) FROM blog WHERE blog.delind = "n";';
			$stmt = $connection->prepare( $query );
			$number = $stmt->execute();
			return $stmt->fetchColumn();
		} catch (PDOException $e) 
		{
			  echo 'Connectie (blog 2 in c_blog_coll.php) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	}
}
