<?php
namespace core;
class imooc
{
	public static $classMap = array();
	static $assign;
	static public function run()
	{
		$route = new \core\lib\route();
		$ctrlClass = $route->ctrl;
		$action = $route->action;
		$ctrlfile = APP.'ctrl/'.$ctrlClass.'Ctrl.php';
		$ctrlClass = '\\'.MODULE.'\ctrl\\'.$ctrlClass.'Ctrl';
		if(is_file($ctrlfile)){
			include $ctrlfile;
			$ctrl = new $ctrlClass();
			$ctrl->$action();
		}else{
			throw new \Exception('找不到控制器'.$ctrlClass);
		}
	}
	static public function load($class)
	{
		//自动加载类库
		if(isset($classMap[$class])){
			return true;
		}else{			
			$class = str_replace('\\','/',$class);
			$file = IMOOC.$class.'.php';
			if(is_file($file)){
				include $file;
				self::$classMap[$class] = $class;
			}else{				
				return false;
			}
		}
	}

	public function assign($name,$value)
	{
		$this->assign[$name] = $value;
	}
	public function display($file)
	{
		$file = APP.'/views/'.$file;
		if(is_file($file)){
			extract($this->assign);
			include $file;
		}
	}
}