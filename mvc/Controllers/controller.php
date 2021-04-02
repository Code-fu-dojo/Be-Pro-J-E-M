<?php


class Controller {

	var $vars = array();
	var $layout = 'default';


	function render($layout) {
		
		extract($this->vars);
        require (ROOT.'mvc/Views/Layouts/'.$layout.'.php');
	}


	function set($array) {
		$this->vars = array_merge($this->vars,$array);
	}

	function setContent($array) {
		$this->vars = array_merge($this->vars,$array);
	}


	function loadModel($name){
		require_once(ROOT.'mvc/Models/'.$name.'.php');
		$this->$name = new $name();
	}

	function loadController($name){
		require_once(ROOT.'mvc/Controllers/'.$name.'.php');
		$this->$name = new $name();
	}


	public final function loadParts($name, $data = []) {
		extract($data);
        ob_start();
		require (ROOT.'mvc/Views/Parts/'.$name.'.php');
		$out = ob_get_contents();
        ob_end_clean();
        return $out;
	}


	public final function content($view) {
		extract($this->vars);
        ob_start();
        require (ROOT.'mvc/Views/'.get_class($this).'/'.$view.'.php');
        $out = ob_get_contents();
        ob_end_clean();

        return $out;
    }

    public function getTitle() {
		$params = array_filter(explode('/', $_GET['p']));
		foreach ($params as &$value) {
			$explode = explode('@',str_replace(["-","_"], "@", $value));
			$value = ucfirst($explode[0]);
			unset($explode[0]);
			foreach ($explode as $explodeChar) {
				$value .=" ".ucfirst($explodeChar);
			}
		}
		return implode(" - ", $params);
    }

    public function getTitleExplode() {
		$params = array_filter(explode('/', $_GET['p']));
		$path = "";
		foreach ($params as $key => &$value) {
			if($key !== key($params)){
				$path .= "/";
			}
			$path .= $value;
			$explode = explode('@',str_replace(["-","_"], "@", $value));
			$valuebis = ucfirst($explode[0]);
			unset($explode[0]);
			foreach ($explode as $explodeChar) {
				$valuebis .=" ".ucfirst($explodeChar);
			}
			$value = ["name" => $valuebis, "path" => $path];
		}
		return $params;
    }

}