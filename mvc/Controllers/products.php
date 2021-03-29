<?php 
class products extends Controller {

	function example() {
		$this->loadModel('products_model');
		$data = $this->products_model->test();
		$this->set(["data" => $data]);
		$this->render('product_page_example');
	}

	function index() {
		$this->render('index');
	}

	function get_products(){

	}

	function update_product(){

	}

	function delete_product(){

	}

	function add_product(){

	}

	function product($product_id){

	}

}
