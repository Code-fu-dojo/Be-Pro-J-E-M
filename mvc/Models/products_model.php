<?php
class products_model extends Model {
	
	function test() {
		$query = 'INSERT INTO `users`(`name`, `firstname`, `mail`) VALUES (:name, :first, :mail)';
		
		return $this->get_from_DB($query, ["name" => 'titi', "first" => "toto", "mail" => "toto@"],false);
	}

	function get_products(){
		$query = 'SELECT * FROM `produits`';
		return $this->get_from_DB($query, [], true, true);
	}

	function get_product($id_produit){
		$query = 'SELECT id, nom, prix, prix_promo, photo1 FROM `produits` WHERE id = :id';
		return $this->get_from_DB($query, ["id" => $id_produit], true, true);
	}

	function update_product(){
		$query = 'UPDATE `produits` SET `id`=[value-1],`nom`=[value-2],`categorie`=[value-3],`description`=[value-4],`prix`=[value-5],`prix_promo`=[value-6],`quantity`=[value-7],
`photo1`=[value-8],`photo2`=[value-9],`photo3`=[value-10],`photo4`=[value-11],`photo5`=[value-12] WHERE 1';
	return $this->get_from_DB($query, [], true, true);
	}

	function delete_product(){
		$query = 'DELETE FROM `produits` WHERE id = 1';
		return $this->get_from_DB($query, [], true, true);
	}

	function add_product(){
		$query = 'INSERT INTO `produits`(`id`, `nom`, `categorie`, `description`, `prix`, `prix_promo`, `quantity`, `photo1`, `photo2`, `photo3`, `photo4`, `photo5`) 
VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])';
	return $this->get_from_DB($query, [], true, true);
	}
}
