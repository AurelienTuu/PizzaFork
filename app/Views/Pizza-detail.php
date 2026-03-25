<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<style>
    .btn-check { position: absolute; clip: rect(0,0,0,0); pointer-events: none; }
    
    .size-option img { transition: transform 0.2s; cursor: pointer; }
    .size-option img:hover { transform: scale(1.1); }
    
    .btn-check:checked + label .btn-outline-primary {
        background-color: #007bff;
        color: white;
    }
</style>

<div class="card shadow w-100" style="margin-top: 2%; border-radius: 15px; overflow: hidden; background: rgba(255,255,255,0.95);">
    <div class="card-header bg-primary text-white text-center py-3">
        <h2 class="h3 mb-0"><?= $pizza->text ?></h2>
    </div>

    <div class="card-body" style="display: flex; flex-direction: row; gap: 40px; padding: 40px; align-items: flex-start;">
        
        <div style="flex: 0 0 30%;">
            <img src="<?= '/img/' . $pizza->picture ?>" class="img-fluid rounded shadow-sm" 
                 style="width: 100%; height:550px; object-fit: cover;" alt="<?= $pizza->text ?>">
        </div>

        <div style="flex: 1; 35%;">
            <h3 class="h4 border-bottom pb-2 mb-3">Ingrédients</h3>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>Ingrédient</th>
                        <th class="text-center">Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pizza->ingredients as $ingredient): ?>
                        <tr>
                            <td class="align-middle"><?= $ingredient->ingredient->text ?></td>
                            <td class="text-center align-middle"><?= $ingredient->quantity ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div style="flex: 0 0 30%; display: flex; flex-direction: column; gap: 30px; background: #f8f9fa; padding: 20px; border-radius: 10px; height: 550px;">
            
            <div class="pizzaSize">
                <label class="h5 border-bottom pb-2 mb-3 d-block font-weight-bold">Taille de la pizza</label>
                <div class="d-flex justify-content-between text-center">
                    <?php 
                        $sizes = [
                            ['id' => 'Small', 'label' => 'Petite', 'cm' => '24', 'img' => 'smallSizePizza.png', 'checked' => ''],
                            ['id' => 'Medium', 'label' => 'Moyenne', 'cm' => '30', 'img' => 'mediumSizePizza.png', 'checked' => 'checked'],
                            ['id' => 'Large', 'label' => 'Large', 'cm' => '40', 'img' => 'largeSizePizza.png', 'checked' => '']
                        ];
                        foreach($sizes as $s): 
                    ?>
                    <div class="size-option">
                        <input type="radio" name="size" id="size<?= $s['id'] ?>" class="btn-check" <?= $s['checked'] ?>>
                        <label for="size<?= $s['id'] ?>" class="m-0">
                            <img src="/img/<?= $s['img'] ?>" style="width: 50px;" class="mb-1 d-block mx-auto">
                            <small class="d-block text-muted"><?= $s['cm'] ?>cm</small>
                            <div class="btn btn-outline-primary btn-sm mt-1"><?= $s['label'] ?></div>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="quantity">
                <label class="h5 border-bottom pb-2 mb-3 d-block font-weight-bold">Quantité</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" onclick="this.parentNode.nextElementSibling.stepDown()">-</button>
                    </div>
                    <input type="number" class="form-control text-center font-weight-bold" value="1" min="1" max="10" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="this.parentNode.previousElementSibling.stepUp()">+</button>
                    </div>
                </div>
            </div>

            <div class="price-display text-center mt-2">
                <span class="h3 font-weight-bold text-primary">12,50 €</span>
            </div>

            <div class="d-grid mt-2">
                <a href="<?= '/bag/add/' . $pizza->id ?>" class="btn btn-success btn-lg btn-block py-3 shadow-sm">
                    <i class="fas fa-cart-plus mr-2"></i> Ajouter au panier
                </a>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted text-center py-3">
        Supplément
    </div>
</div>

<?= $this->endSection() ?>