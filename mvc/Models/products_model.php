<?php
class products_model extends Model {
	
	function test() {
		$query = 'INSERT INTO `users`(`name`, `firstname`, `mail`) VALUES (:name, :first, :mail)';
		
		return $this->get_from_DB($query, ["name" => 'titi', "first" => "toto", "mail" => "toto@"],false);
	}

	function get_products(){
		$query = 'SELECT produits.id, produits.nom, categorie.nom as categorie FROM produits INNER JOIN categorie ON categorie.id = produits.categorie ORDER BY produits.id';
		return $this->get_from_DB($query, [],true, true);
	}

	function get_product($id){
		$query = 'SELECT * FROM produits where produits.id = :id';
		return $this->get_from_DB($query, ['id' => $id],true);
	}

	function update_product($data){
		$query = 'UPDATE produits SET `nom` = :nom, `categorie` = :categorie, `description` = :description, `prix` = :prix, `prix_promo` = :prix_promo, `quantity` = :quantity, `photo1` = :photo1, `photo2` = :photo2, `photo3` = :photo3, `photo4` = :photo4, `photo5` = :photo5 WHERE id = :id';
		return $this->get_from_DB($query, ["nom" => $data["nom"], "categorie" => $data["category"], "description" => $data["description"], "prix" => $data["prix"], "prix_promo" => $data["prix_promo"], "quantity" => $data["quantity"], "photo1" => $data["pictures"][1]['name'], "photo2" => $data["pictures"][2]['name'], "photo3" => $data["pictures"][3]['name'], "photo4" => $data["pictures"][4]['name'], "photo5" => $data["pictures"][5]['name'], "id" => $data['id']],false);
	}

	function delete_product($id){
		$query = 'DELETE FROM produits WHERE id = :id';
		return $this->get_from_DB($query, ["id" => $id],false);
	}

	function add_product($data){
		$query = 'INSERT INTO produits (`nom`, `categorie`, `description`, `prix`, `prix_promo`, `quantity`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`) VALUES (:nom, :categorie, :description, :prix, :prix_promo, :quantity, :photo1, :photo2, :photo3, :photo4, :photo5)';
		return $this->get_from_DB($query, ["nom" => $data["nom"], "categorie" => $data["category"], "description" => $data["description"], "prix" => $data["prix"], "prix_promo" => $data["prix_promo"], "quantity" => $data["quantity"], "photo1" => $data["pictures"][1]['name'], "photo2" => $data["pictures"][2]['name'], "photo3" => $data["pictures"][3]['name'], "photo4" => $data["pictures"][4]['name'], "photo5" => $data["pictures"][5]['name']],false);
	}


	function load_cat(){
		$query = 'SELECT * FROM categorie';
		return $this->get_from_DB($query, [],true, true);
	}
	
}