<?php
class Database
{
    public function __construct()
    {
        $dbuser = getenv('DBUSER');
        $dbpass = getenv('DBPASS');
        $dbport = getenv('DBPORT');
        $dbname = getenv('DBNAME');
        $dbhost = getenv('DBHOST');
        $dsn = 'pgsql:dbname=' . $dbname . ' host=' . $dbhost . ' port=' . $dbport;
        $user = $dbuser;
        $password = $dbpass;
        $this->dbh = new PDO($dsn, $user, $password);
    }

    public function db_query($sql)
    {
        return $this->dbh->query($sql);
    }

    public function db_fetch($pdo_statement)
    {
        return $pdo_statement->fetch();
    }
}
$db = new Database();
if (!$db->dbh) {
    die('Could not connect...');
}