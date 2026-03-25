<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<style>
    .selection {
        display: flex;
        gap: .5rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .selection input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
        pointer-events: none;
    }

    .selection label.btn {
        margin: 0;
        padding: .375rem .75rem;
        border-radius: .375rem;
        cursor: pointer;
        transition: background-color .15s, color .15s;
    }

    .selection input[type="radio"]:checked+label.btn {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    .selection label.btn.active {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }
</style>

<div class="container" style="display: flex; flex-direction: column; align-items: center; margin-top: 5%; justify-content: center;">
    <h1><?= $title ?></h1>
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="h3 mb-0">
                <?= $pizza->text ?>
            </h2>
        </div>
        <div class="body" style="display: flex; flex-direction: row; justify-content: space-around; gap: 20px; margin-top: 20px;">
            <div class="left" style="width: 25%;">
                <img src="<?= '/img/' . $pizza->picture ?>" class="img-fluid rounded shadow-sm"
                    style="width: 100%; height: 100%; object-fit: cover;" alt="<?= $pizza->text ?>">
            </div>

            <div class="middle" style="">
                <h3 class="h4 border-bottom pb-2 mb-3">Ingrédients</h3>

                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Ingrédient</th>
                            <th class="text-center">Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pizza->ingredients as $ingredient): ?>
                            <tr>
                                <td>
                                    <?= $ingredient->ingredient->text ?>
                                </td>
                                <td class="text-center">
                                    <?= $ingredient->quantity ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="right" style="">

                <label class="h4 border-bottom pb-2 mb-3">Taille de la pizza</label>
                <div class="selection" style="display: flex; ">
                    <div class="small d-flex flex-column align-items-center">
                        <img src="<?= '/img/smallSizePizza.png' ?>" class="img-fluid"
                            style="width: 100px; height: 100px; object-fit: contain;" alt="Petite pizza">
                        <h5 style="font-size: 15px;">24cm</h5>
                        <input type="radio" class="btn-check" name="size" id="sizeSmall" autocomplete="off">
                        <label class="btn btn-outline-primary" for="sizeSmall">Petite</label>
                    </div>
                    <div class="medium d-flex flex-column align-items-center">
                        <img src="<?= '/img/mediumSizePizza.png' ?>" class="img-fluid"
                            style="width: 100px; height: 100px; object-fit: contain;" alt="Moyenne pizza">
                        <h5 style="font-size: 15px;">30cm</h5>
                        <input type="radio" class="btn-check" name="size" id="sizeMedium" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="sizeMedium">Moyenne</label>
                    </div>
                    <div class="large d-flex flex-column align-items-center">
                        <img src="<?= '/img/largeSizePizza.png' ?>" class="img-fluid"
                            style="width: 100px; height: 100px; object-fit: contain;" alt="Large pizza">
                        <h5 style="font-size: 15px;">40cm</h5>
                        <input type="radio" class="btn-check" name="size" id="sizeLarge" autocomplete="off">
                        <label class="btn btn-outline-primary" for="sizeLarge">Large</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Quantité</label>
                    <select class="form-select shadow-sm">
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i ?>">
                                <?= $i ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

            </div>

        </div>
        <div class="d-grid mt-4">
            <a href="<?= '/bag/add/' . $pizza->id ?>" class="btn btn-primary btn-lg" role="button">
                <i class="fas fa-cart-plus me-2"></i> Ajouter au panier
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>