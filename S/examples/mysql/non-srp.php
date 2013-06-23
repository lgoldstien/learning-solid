<?php
/**
 * Tasks - Non-SRP
 * A task database class that does not abide by SRP
 * @package solid
 * @author lgoldstien@onmylemon.co.uk
 */

class tasks {

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

	/**
	 * list
	 * List all the tasks in the database
	 */
	public function list() {
		// The sql statement
		$sql = "select `name`, `duedate`, `priority`, `complete` from tasks";
		// Run the query
		$result = $this->connection->query( $sql );
		// Return the result
		return $result->fetch_all
	}
}

$tasks = new tasks( 'localhost', 'username', 'password', 'tasks' );
$tasks_list = $tasks->list();
print_r( $tasks_list );
