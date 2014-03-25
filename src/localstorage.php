<?php
/**
*	Javascript LocalStorage implemented in PHP / Uses a local file to store data
*	More info: http://dev.w3.org/html5/webstorage/#the-localstorage-attribute
*	Usage: 
*			require 'localstorage/localstorage.php';
*			$store = new localStorage(); // or new localStorage("filename.ext");
*			$item = $store->getItem("item");
*/

class localStorage {
	private $storename;
	private $filedata;
	private $prettyprint;
	
	//Constructor
	public function localStorage($storename = FALSE, $prettyprint = FALSE) {
		$this->storename = is_string($storename) ? $storename : "localStorage.txt";
		$this->prettyprint = $prettyprint ? JSON_PRETTY_PRINT : FALSE;
		$this->loadFileData();
	}
	//get an item
	public function getItem($key) {
		if(isset($this->filedata[$key])) return $this->filedata[$key];
		else return NULL;
	}
	//set an item
	public function setItem($key, $value) {
		$this->filedata[$key] = $value;
		return $this->saveFileData();
	}
	//remove an item
	public function removeItem($key) {
		if(isset($this->filedata[$key])) {
			unset($this->filedata[$key]);
			return $this->saveFileData();
		}
		return TRUE;
	}
	//clear the local storage
	public function clear() {
		$this->filedata = array();
		return $this->saveFileData();
	}
	//Additional methods (<pop/push> - for the end of array <shift/unshift> - begining of array)
	public function pop() {
		$data = array_pop($this->filedata);
		$this->saveFileData();
		return $data;
	}
	public function push($itm) {
		$data = array_push($this->filedata, $itm);
		return $this->saveFileData();
	}
	public function shift() {
		$data = array_shift($this->filedata);
		$this->saveFileData();
		return $data;
	}
	public function unshift($itm) {
		$data = array_unshift($this->filedata, $itm);
		return $this->saveFileData();
	}
	
	//Private methods
	public function getFileData() {
		return $this->filedata;
	}
	private function loadFileData() {
		$this->filedata = array();
		$filedata = @file_get_contents($this->storename);
		if(!$filedata) return FALSE;
		else $filedata = (array)json_decode($filedata);
		if(!empty($filedata)) $this->filedata = $filedata;
		return TRUE;
	}
	private function saveFileData() {
		return @file_put_contents($this->storename, json_encode($this->filedata, $this->prettyprint));
	}
}
?>
