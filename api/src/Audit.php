<?php
declare(strict_types=1); namespace Wms;
final class Audit {public function __construct(private Database $db){} public function log(array $u,string $action,string $entity,string $id,mixed $old=[],mixed $new=[]):void{$this->db->exec('INSERT INTO audit_log(id,created_at,user_id,user_name,action,entity,entity_id,old_value,new_value) VALUES(?,?,?,?,?,?,?,?,?)',[Util::uuid(),Util::now(),$u['id'],$u['displayName'],$action,$entity,$id,json_encode($old,JSON_UNESCAPED_UNICODE),json_encode($new,JSON_UNESCAPED_UNICODE)]);}}
