<?php
namespace core\lib;
class conf
{
	static public $conf=array();
	static public function get($name,$file){
			/*
			判断文件是否存在
			 */
			$file=PZ.'\core\config\\'.$file.'.php';
		if(is_file($file)){
			$conf=include $file;
			if(isset($conf[$name])){
				self::$conf[$file]=$conf;
				return $conf[$name];
			}else{
				throw new \Exception("没有这个配置项",$name );
				
			}
		}else{
			throw new \Exception("找不到配置文件", $file);
			
		}
	}
}