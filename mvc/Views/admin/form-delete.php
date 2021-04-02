<div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" enctype="multipart/form-data" action="<?= WEBROOT ?>admin/<?= $urlForm ?>/<?= $id ?>" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />

                <?php if (isset($id) && !empty($id)): ?>
                  <div class="form-group" style="display:none;">
                  <label for="exampleFormControlSelect1">ID</label>
                       <div class="input-group input-group-merge input-group-alternative mb-3">
                   <input class="form-control" name="id" type="number" value="<?= $product['id'] ?>" autocomplete="off" readonly>
                    </div>
                </div>
                <?php endif ?>

                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <label>Etes vous sur de vouloir supprimer le produit <?= $id ?></label>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary mt-4">Supprimer</button>
                </div>
              </form>
            </div>
          </div>