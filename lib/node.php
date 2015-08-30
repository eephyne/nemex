<?php

require_once(NX_PATH.'lib/project.php');


class Node {
	protected $path = null;
	protected $extension = 'txt';

	public $type = 'none';
	public $editable = true;

	protected function __construct($path) {
		$this->path = $path;
	}

	public function getName() {
		return basename($this->path);
	}

	public function getPath() {
		return $this->path;
	}

	public function getOriginalPath() {
		return $this->path;
	}

	public function getTimestamp() {
		return explode('-',$this->getName())[0];
	}
	public function getLastModifiedTimestamp() {
		if (date('Ymd',$this->getTimestamp()) != date('Ymd',filemtime($this->path))) {
			return filemtime($this->path);
		} else {
			return null;
		}
	}	
	protected static function getNewName($extension) {
		return time().'-'.substr(md5(uniqid(rand(), true)),0, 8).'.'.$extension;
	}

	public function delete() {
		unlink($this->path);
	}
}
