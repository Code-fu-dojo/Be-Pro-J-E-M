<div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" enctype="multipart/form-data" action="<?= WEBROOT ?>admin/<?= $urlForm ?>" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />

                <?php if (isset($product['id']) && !empty($product['id'])): ?>
                  <div class="form-group">
                  <label for="exampleFormControlSelect1">ID</label>
                       <div class="input-group input-group-merge input-group-alternative mb-3">
                   <input class="form-control" name="id" type="number" value="<?= $product['id'] ?>" autocomplete="off" readonly>
                    </div>
                </div>
                <?php endif ?>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Nom*</label>
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <input class="form-control" placeholder="Nom" name="nom" type="text" value="<?php echo (isset($product['nom']) && !empty($product['nom']))?$product['nom']: '' ; ?>" autocomplete="off required">
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Catégorie</label>
                  <select class="form-control" id="exampleFormControlSelect1" name="category">
                    <?php foreach ($data as $cat): ?>
                      <option <?php echo (isset($product['categorie']) && !empty($product['categorie']) && $product['categorie'] == $cat['id'] )?'selected': '' ; ?> value="<?php echo $cat['id'] ?>"><?php echo $cat['nom']; ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Description</label>
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <textarea class="form-control" name="description" placeholder="Description"><?php echo (isset($product['description']) && !empty($product['description']))?$product['description']: '' ; ?></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Prix*</label>
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <input class="form-control" placeholder="Prix" name="prix" required type="number" value="<?php echo (isset($product['prix']) && !empty($product['prix']))?$product['prix']: '' ; ?>" autocomplete="off" min="0">
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Prix Promo</label>
                  <div class="input-group input-group-merge input-group-alternative">
                    <input class="form-control" placeholder="Prix promo" name="prix_promo" value="<?php echo (isset($product['prix_promo']) && !empty($product['prix_promo']))?$product['prix_promo']: '' ; ?>" type="number" autocomplete="off" min="0">
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Quantité*</label>
                  <div class="input-group input-group-merge input-group-alternative">
                    <input class="form-control" placeholder="Quantité" min="0" required name="quantity" value="<?php echo (isset($product['quantity']) && !empty($product['quantity']))?$product['quantity']: '' ; ?>" type="number" autocomplete="off">
                  </div>
                </div>
                <!-- PHOTOS -->

                <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Photo <?= $i ?></label>
                    <?php if (isset($product['photo'.$i]) && !empty($product['photo'.$i])): ?>
                    <div>
                    <div class="custom-file custom-file-bis">
                      <img src="<?= $product['photo'.$i] ?>">
                    </div>
                  <?php endif ?>
                  <input type="hidden" value="<?php echo (isset($product['photo'.$i]) && !empty($product['photo'.$i]))?$product['photo'.$i]: '' ; ?>" name="picturesLoad[]";>
                  <div class="custom-file <?php echo (isset($product['photo'.$i]) && !empty($product['photo'.$i]))?'custom-file-bis': '' ; ?>">
                      <input type="file" name="pictures[]" class="custom-file-input" id="customFile<?= $i ?>" lang="fr">
                      <label class="custom-file-label" for="customFile<?= $i ?>"><?php echo (isset($product['photo'.$i]) && !empty($product['photo'.$i]))?$product['photo'.$i]: 'Photo'.$i ; ?></label>
                  </div>
                   <?php if (isset($product['photo'.$i]) && !empty($product['photo'.$i])): ?>
                   </div>
                  <?php endif ?>
                </div>
              <?php endfor; ?>
 

                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">Create</button>
                </div>
              </form>
            </div>
          </div>
   