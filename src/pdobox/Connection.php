<?php

namespace kfilin\pdobox;

class Connection
{
    /**
     *
     * @var string
     */
    protected $host;

    /**
     *
     * @var string
     */
    protected $db;

    /**
     *
     * @var string
     */
    protected $user;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var \PDO
     */
    protected $pdo;

    public function __construct(
            string $host,
            string $db,
            string $name,
            string $password) {
        $this->host = $host;
        $this->db = $db;
        $this->user = $name;
        $this->password = $password;

        $dsn = sprintf(
            "mysql:dbname=%s;host=%s;charset=UTF8",
            $this->db,
            $this->host
        );

        $this->pdo = new \PDO($dsn, $this->user, $this->password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getHost(): string {
        return $this->host;
    }

    public function getDb(): string {
        return $this->db;
    }

    public function getName(): string {
        return $this->user;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getPdo(): \PDO {
        return $this->pdo;
    }

    public function exec(string $sql): int {
        return $this->pdo->exec($sql);
    }

    public function queryCell(string $sql): string {
        $item = $this->query($sql, \PDO::FETCH_NUM)->fetch();

        return isset($item[0]) ? $item[0] : null;
    }

    public function queryRow(string $sql): array {
        return $this->query($sql, \PDO::FETCH_ASSOC)->fetch();
    }

    public function queryColumn(string $sql, $columnNum = 0): array {
        return $this->query($sql, \PDO::FETCH_ASSOC)->fetchAll(\PDO::FETCH_COLUMN, $columnNum);
    }

    public function queryAll(string $sql, int $fetchStyle = \PDO::FETCH_ASSOC): array {
        return $this->query($sql, $fetchStyle)->fetchAll();
    }

    public function query(string $sql, int $fetchStyle = \PDO::FETCH_ASSOC): \PDOStatement {
        return $this->pdo->query($sql, $fetchStyle);
    }

    public function executePrepared(\PDOStatement $statement, array $params = []): array {
        $statement->execute($params);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function prepareAndExecute(string $sql, array $params = [], array $driverOptions = []): array {
        $statement = $this->prepare($sql, $driverOptions);
        return $this->executePrepared($statement, $params);
    }

    public function prepare(string $sql, array $driverOptions = []): \PDOStatement {
        return $this->pdo->prepare($sql, $driverOptions);
    }
}
