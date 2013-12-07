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
	var $storename;
	var $filedata;
	
	//Constructor
	function localStorage($storename = "localStorage.txt") {
		$this->storename = $storename;
		$this->getFileData();
	}
	//get an item
	function getItem($key) {
		if(isset($this->filedata[$key])) return $this->filedata[$key];
		else return NULL;
	}
	//set an item
	function setItem($key, $value) {
		$this->filedata[$key] = $value;
		return $this->setFileData();
	}
	//remove an item
	function removeItem($key) {
		if(isset($this->filedata[$key])) {
			unset($this->filedata[$key]);
			return $this->setFileData();
		}
		return TRUE;
	}
	//clear the local storage
	function clear() {
		$this->filedata = array();
		return $this->setFileData();
	}
	//Additional methods (<pop/push> - for the end of array <shift/unshift> - begining of array)
	function pop() {
		$data = array_pop($this->filedata);
		$this->setFileData();
		return $data;
	}
	function push($itm) {
		$data = array_push($this->filedata, $itm);
		return $this->setFileData();
	}
	function shift() {
		$data = array_shift($this->filedata);
		$this->setFileData();
		return $data;
	}
	function unshift($itm) {
		$data = array_unshift($this->filedata, $itm);
		return $this->setFileData();
	}
	
	//Private methods
	function getData() {
		return $this->filedata;
	}
	function getFileData() {
		$this->filedata = array();
		$filedata = @file_get_contents($this->storename);
		if(!$filedata) return FALSE;
		else $filedata = json_decode($filedata);
		if(!empty($filedata)) $this->filedata = $filedata;
		return TRUE;
	}
	function setFileData() {
		return @file_put_contents($this->storename, json_encode($this->filedata));
	}
}
?>
