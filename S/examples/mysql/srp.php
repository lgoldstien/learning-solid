<?php
/**
 * Tasks - SRP
 * A task database class that does abide by SRP
 * @package solid
 * @author lgoldstien@onmylemon.co.uk
 */

class db {

	/**
	 * @var connection
	 */
	private $connection;

	/**
	 * __construct
	 */
	function __construct( $db_host, $db_user, $db_pass, $db_name ) {
		/**
		 * Make the connection
		 */
		$this->connection = new mysqli( $db_host, $db_user, $db_pass, $db_name );
	}

	public function query($sql) {
		// Run the query
		$result = $this->connection->query( $sql );
		// Return the result
		return $result->fetch_all
	}
}

class tasks {

	/**
	 * @var db
	 */
	private $db;

	/** 
	 * __construct
	 */
	function __construct( $db_host, $db_user, $db_pass, $db_name ) {
		// Instantiate the db class
		$this->db = new db( $db_host, $db_user, $db_pass, $db_name );

	}

	/**
	 * list
	 * List all the tasks in the database
	 */
	public function list() {
		// The SQL query
		$sql = "select `name`, `duedate`, `priority`, `complete` from tasks";
		// Return the array from the query
		return $this->db->query( $sql );
	}
}

$tasks = new tasks( 'localhost', 'username', 'password', 'tasks' );
$tasks_list = $tasks->list();
print_r( $tasks_list );
