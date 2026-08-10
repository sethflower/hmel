<?php
declare(strict_types=1); namespace Wms;
final class Util {
 public static function uuid():string{$d=random_bytes(16);$d[6]=chr((ord($d[6])&15)|64);$d[8]=chr((ord($d[8])&63)|128);return vsprintf('%s%s-%s-%s-%s-%s%s%s',str_split(bin2hex($d),4));}
 public static function now():string{return date('Y-m-d H:i:s');}
 public static function text(mixed $v):string{return trim((string)($v??''));}
 public static function qty(mixed $v,string $label='Количество'):int{if(filter_var($v,FILTER_VALIDATE_INT)===false||(int)$v<=0)throw new ApiException('VALIDATION',"$label должно быть целым числом больше нуля");return(int)$v;}
 public static function bool(mixed $v):bool{return filter_var($v,FILTER_VALIDATE_BOOL);}
 public static function page(array $p,int $default=25):array{$page=max(1,(int)($p['page']??1));$size=min(100,max(1,(int)($p['pageSize']??$default)));return[$page,$size,($page-1)*$size];}
}
