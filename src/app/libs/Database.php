<?php 
/**
 * PDO Database Class
 * 
 * Connect to database 
 * Create prepared statements
 * Bind values
 * Return rows and results
 */
class Database 
{
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $dbname = DB_NAME;
    private $user = DB_ROOT_USER;
    private $pwd = DB_ROOT_PWD;
    
    private $dbh;
    private $stmt; 
    private $err; 

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true, // Persistent connection - increase performance
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pwd, $options);
        } catch(PDOException $e) {
            $this->err = $e->getMessage();
            echo $this->err;
        }
    }

    /**
     * Prepare statement with query
     */
    public function query($sql) 
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Bind values 
     */
    public function bind($param, $value, $type = null) 
    {
        if (is_null($type)) {
            switch(true) {
                case is_int($value): 
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value): 
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default: 
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute Prepared Statement
     */
    public function execute() 
    {
        return $this->stmt->execute();
    }

    /**
     * Get the result set of the executed statement
     *
     * @return array[Object]
     */
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ); // return as object, not array
    }

    /**
     * Get a single record from the executed statement
     *
     * @return Object
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get the row count
     * 
     * @return Integer rowCount
     */
    public function rowCount() 
    {
        return $this->stmt->rowCount();
    }
}