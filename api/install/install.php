<?php
declare(strict_types=1);
if (PHP_SAPI !== 'cli') { http_response_code(403); exit("Запускайте установщик из командной строки hosting.\n"); }
require dirname(__DIR__).'/src/bootstrap.php';
use Wms\Database; use Wms\Util;
$db=new Database($config['db']);$sql=file_get_contents(__DIR__.'/schema.sql');foreach(array_filter(array_map('trim',explode(';',$sql))) as $statement)$db->pdo()->exec($statement);
$admin=$db->one('SELECT id FROM users WHERE login=?',['admin']);if(!$admin)$db->exec('INSERT INTO users(id,login,password_hash,display_name,role,active,created_at,version) VALUES(?,?,?,?,?,?,?,1)',[Util::uuid(),'admin',password_hash('301993',PASSWORD_DEFAULT),'Системный администратор','admin',1,Util::now()]);
echo "Установка завершена. Войдите как admin / 301993 и немедленно смените пароль.\n";
