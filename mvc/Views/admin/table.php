<div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Produits</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <?php foreach ($data[0] as $key => $value): ?>
                      <th scope="col"><?= $key ?></th>
                    <?php endforeach ?>
                    <?php if (isset($dests)): ?>
                      <?php foreach ($dests as $dest): ?>
                        <th scope="col"> 
                            Action
                          </th>
                      <?php endforeach ?>
                        <?php endif ?>
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $value): ?>
                      <tr>
                        <?php foreach ($value as $attr => $fieldvalue): ?>
                          <td> <?= $fieldvalue ?> </td>
                        <?php endforeach ?>
                        <?php if (isset($dest)): ?>
                          <?php foreach ($dests as $dest): ?>
                          <td> 
                            <button type="button" onclick="location.href='<?= WEBROOT ?>admin/<?= $dest ?>/<?= $value['id'] ?>';" class="btn btn-primary mt-4"><?= $dest ?></button>
                          </td>
                          <?php endforeach ?>
                        <?php endif ?>
                      </tr>
                    <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>