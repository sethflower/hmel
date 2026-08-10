<?php
declare(strict_types=1); namespace Wms;
use PDO;
final class Database {
 private PDO $pdo;
 public function __construct(array $c) { $dsn=sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',$c['host'],(int)($c['port']??3306),$c['name'],$c['charset']??'utf8mb4'); $this->pdo=new PDO($dsn,$c['user'],$c['password'],[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false]); }
 public function pdo(): PDO{return $this->pdo;}
 public function all(string $sql,array $params=[]):array{$s=$this->pdo->prepare($sql);$s->execute($params);return $s->fetchAll();}
 public function one(string $sql,array $params=[]):?array{$s=$this->pdo->prepare($sql);$s->execute($params);$r=$s->fetch();return $r===false?null:$r;}
 public function exec(string $sql,array $params=[]):int{$s=$this->pdo->prepare($sql);$s->execute($params);return $s->rowCount();}
 public function transaction(callable $fn):mixed{$this->pdo->beginTransaction();try{$r=$fn();$this->pdo->commit();return $r;}catch(\Throwable $e){if($this->pdo->inTransaction())$this->pdo->rollBack();throw $e;}}
}
