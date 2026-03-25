<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<style>
    .btn-check {
        position: absolute;
        clip: rect(0, 0, 0, 0);
        pointer-events: none;
    }

    .size-option img {
        transition: transform 0.2s;
        cursor: pointer;
    }

    .size-option img:hover {
        transform: scale(1.1);
    }

    .btn-check:checked+label .btn-outline-primary {
        background-color: #007bff;
        color: white;
    }
</style>

<div class="card shadow w-100"
    style="margin-top: 2%; border-radius: 15px; overflow: hidden; background: rgba(255,255,255,0.95);">
    <div class="card-header bg-primary text-white text-center py-3">
        <h2 class="h3 mb-0"><?= $pizza->text ?></h2>
    </div>

    <div class="card-body"
        style="display: flex; flex-direction: row; gap: 40px; padding: 40px; align-items: flex-start;">

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

        <div
            style="flex: 0 0 30%; display: flex; flex-direction: column; gap: 30px; background: #f8f9fa; padding: 20px; border-radius: 10px; height: 550px;">

            <div class="pizzaSize">
                <label class="h5 border-bottom pb-2 mb-3 d-block font-weight-bold">Taille de la pizza</label>
                <div class="d-flex justify-content-between text-center align-items-end">
                    <?php
                    $sizes = [
                        ['id' => 'Small', 'label' => 'Petite', 'cm' => '24', 'img' => 'smallSizePizza.png', 'size' => '60px', 'checked' => ''],
                        ['id' => 'Medium', 'label' => 'Moyenne', 'cm' => '30', 'img' => 'mediumSizePizza.png', 'size' => '80px', 'checked' => 'checked'],
                        ['id' => 'Large', 'label' => 'Large', 'cm' => '40', 'img' => 'largeSizePizza.png', 'size' => '100px', 'checked' => '']
                    ];
                    foreach ($sizes as $s):
                        ?>
                        <div class="size-option" style="flex: 1;">
                            <input type="radio" name="size" id="size<?= $s['id'] ?>" class="btn-check" <?= $s['checked'] ?>>
                            <label for="size<?= $s['id'] ?>" class="m-0 cursor-pointer">
                                <div style="height: 110px; display: flex; align-items: center; justify-content: center;">
                                    <img src="/img/<?= $s['img'] ?>"
                                        style="width: <?= $s['size'] ?>; transition: transform 0.3s; mix-blend-mode: multiply;"
                                        class="mb-2 d-block mx-auto img-fluid">
                                </div>
                                <small class="d-block text-muted font-weight-bold"><?= $s['cm'] ?>cm</small>
                                <div class="btn btn-outline-primary btn-sm mt-1 px-3"><?= $s['label'] ?></div>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="quantity">
                <label class="h5 border-bottom pb-2 mb-3 d-block font-weight-bold text-center">Quantité</label>

                <div class="d-flex justify-content-center align-items-center gap-2" style="gap: 10px;">

                    <button class="btn btn-danger d-flex align-items-center justify-content-center p-0" type="button"
                        onclick="this.nextElementSibling.stepDown()"
                        style="width: 40px; height: 40px; border-radius: 5px;">-</button>

                    <input type="number" class="form-control text-center font-weight-bold p-0" value="1" min="1"
                        max="10" readonly
                        style="width: 40px; height: 40px; flex: none; border-radius: 5px; background-color: #eee;">

                    <button class="btn btn-success d-flex align-items-center justify-content-center p-0" type="button"
                        onclick="this.previousElementSibling.stepUp()"
                        style="width: 40px; height: 40px; border-radius: 5px;">+</button>

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
        Suppléments
    </div>
</div>

<?= $this->endSection() ?>