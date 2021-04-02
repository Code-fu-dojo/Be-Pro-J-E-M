<?php 
class admin extends Controller {

	function index() {
		$this->loadModel('products_model');
		$data = $this->products_model->get_products();
		$this->set(["data" => $data]);
		$this->set(["dests" => ["update","delete"]]);
		$this->setContent([ "Content" => ["table"]]); // views/controller_name
		$this->render('admin');
	}

	function create() {
		$this->loadModel('products_model');
		$data = $this->products_model->load_cat();
		$this->set(["data" => $data]);
		$this->set(["urlForm" => "add-product"]);
		$this->setContent([ "Content" => ["form"]]); // views/controller_name
		$this->render('admin');
	}

	function addProduct(){
		if( !isset($_POST) || empty($_POST)) {
			 header('HTTP/1.0 404 Not Found');
	 include(ROOT404);
    exit;
		}
		$stateLoad = $this->load_files();
		if ($stateLoad['error'] == false){
			$data = $_POST;
			$data["pictures"] = $stateLoad['pictures'];
			$this->loadModel('products_model');
			$response = $this->products_model->add_product($data);
			if(!isset($response["lastInsertId"])) {
				$stateLoad = ['error' => true, 'message' => $this->set_error_code(0)];
			}
			else {
				$stateLoad = ['error' => false, 'message' => $this->set_succes_code(1)];
			}
			
		}
		

		$this->setContent([ "Content" => ["message"]]); // views/controller_name
		$this->set($stateLoad);
		$this->render('admin');
	}

	function listeUpdate() {
		$this->loadModel('products_model');
		$data = $this->products_model->get_products();
		$this->set(["data" => $data]);
		$this->set(["dests" => ["update"]]);
		$this->setContent([ "Content" => ["table"]]); // views/controller_name
		$this->render('admin');
	}

	function listeDelete() {
		$this->loadModel('products_model');
		$data = $this->products_model->get_products();
		$this->set(["data" => $data]);
		$this->set(["dests" => ["delete"]]);
		$this->setContent([ "Content" => ["table"]]); // views/controller_name
		$this->render('admin');
	}

	function delete($id) {
		$this->set(["id" => $id]);
		$this->setContent([ "Content" => ["form-delete"]]); // views/controller_name
		$this->set(["urlForm" => "delete-product"]);
		$this->render('admin');
	}

	function update($id) {
		$this->loadModel('products_model');
		$data = $this->products_model->load_cat();
		$this->set(["data" => $data]);
		$product= $this->products_model->get_product($id);
		$this->set(["product" => $product]);
		$this->set(["urlForm" => "update-product"]);
		$this->setContent([ "Content" => ["form"]]); // views/controller_name
		$this->render('admin');
	}

	function deleteProduct($id) {
		$this->loadModel('products_model');
		$response = $this->products_model->delete_product($id);
		if(!isset($response["rowCount"]) || $response["rowCount"] != 1) {
			$stateLoad = ['error' => true, 'message' => $this->set_error_code(0)];
		}
		else {
			$stateLoad = ['error' => false, 'message' => $this->set_succes_code(3)];
			$this->remove_photos($id);
		}
		$this->setContent([ "Content" => ["message"]]); // views/controller_name
		$this->set($stateLoad);
		$this->render('admin');
	}

	function remove_photos($id) {
		 $name = ROOT.'assets/images/products/product_'.$id.'_picture_*';
	 		foreach (glob($name) as $file) {
	        	unlink($file);
	        }
	}

	function updateProduct() {
		if( !isset($_POST) || empty($_POST)) {
			 header('HTTP/1.0 404 Not Found');
	 include(ROOT404);
    exit;
		}
		$stateLoad = $this->load_files($_POST['id']);
		if ($stateLoad['error'] == false){
			$data = $_POST;
			$data["pictures"] = $stateLoad['pictures'];
			$this->loadModel('products_model');
			$response = $this->products_model->update_product($data);
			if(!isset($response["lastInsertId"])) {
				$stateLoad = ['error' => true, 'message' => $this->set_error_code(0)];
			}
			else {
				$stateLoad = ['error' => false, 'message' => $this->set_succes_code(2)];
			}
			
		}
		
		$this->setContent([ "Content" => ["message"]]); // views/controller_name
		$this->set($stateLoad);
		$this->render('admin');
	}

	private function load_files($id = "") {
		
		$extList = ['jpg',"png","gif","svg"];
		$noFiles = true;
		if(empty($id)) {
			$this->loadModel('admin_model');
			$id = $this->admin_model->get_next_id("produits");
		}
		foreach ($_FILES["pictures"]["error"] as $key => $error) {
		    if ($error == UPLOAD_ERR_OK) {
		        $tmp_name = $_FILES["pictures"]["tmp_name"][$key]; 
		        $ext = strtolower($this->get_extension($_FILES["pictures"]["name"][$key]));
		        if (!in_array($ext, $extList)) {
		        	return ['error' => true, 'message' => $this->set_error_code(9)];
		        }
		        $name = 'assets/images/products/product_'.$id.'_picture_'.$key;
		        $pictures[] = ["name" => ROOT.$name, "ext" => $ext, "tmp_name" => $tmp_name];
		        $picturesSaved[$key+1]['name'] = WEBROOT.$name.'.'.$ext;
		        $noFiles = false;
		    }
		    elseif ($error == UPLOAD_ERR_NO_FILE) {
		    	if(isset($_POST['picturesLoad'][$key]) && !empty($_POST['picturesLoad'][$key])){
		    		$picturesSaved[$key+1]['name'] = $_POST['picturesLoad'][$key];
		    	}
		    	else {
		    		$picturesSaved[$key+1]['name'] = null;
		    	}
		    }
		    else {
		    	return ['error' => true, 'message' => $this->set_error_code($error)];
		    }
		}
		if($noFiles) {
		 	return ['error' => false, 'message' => '' , "pictures" => $picturesSaved];
		}
		foreach ($pictures as $picture) {
			foreach (glob($picture['name'].'.*') as $file) {
	        	unlink($file);
	        }
	        if (move_uploaded_file($picture['tmp_name'], $picture['name'].'.'.$picture['ext'])) {
			   
			} else {
			    return ['error' => true, 'message' => $this->set_error_code(10)];
			}
		}

		return ['error' => false, 'message' => '' , "pictures" => $picturesSaved];

	}

	private function get_extension($filename){
		return pathinfo($filename, PATHINFO_EXTENSION);
	}

	private function set_error_code($code) {
		switch ($code) {
			case 9:
				$retour = "Un fichier de la liste n'est pas dans un format autoriser (jpg,png,gif,svg) ";
				break;
			case 10:
				$retour = "Une erreur est survenue durant le transfert des images";
				break;
			case 2:
				$retour = "La taille du fichier téléchargé excède la valeur";
				break;
			default:
				$retour = "Une erreur est survenue";
				break;
		}
		return $retour;
	}


	private function set_succes_code($code) {
		switch ($code) {
			case 1:
				$retour = "Le produit a bien été ajouté à la base ";
				break;
			case 2:
				$retour = "Le produit a bien été mis à jour dans la base ";
				break;
			case 2:
				$retour = "Le produit a bien été supprimer dans la base ";
				break;
			default:
				$retour = "Une erreur est survenue";
				break;
		}
		return $retour;
	}
}