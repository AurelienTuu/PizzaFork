<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<div class="container-fluid mt-5 px-md-5"> <h1 class="text-center mb-4"><?= $title ?></h1>

    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="h3 mb-0"><?= $pizza->text ?></h2>
        </div>

        <div class="card-body p-4">
            <div class="row align-items-center">

                <div class="col-md-5 text-center">
                    <img src="<?= '/img/' . $pizza->picture ?>" class="img-fluid rounded shadow-sm"
                        style="width: 100%; max-height: 500px; object-fit: cover;" alt="<?= $pizza->text ?>">
                </div>

                <div class="col-md-7">
                    <div class="ps-md-4">
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
                                        <td><?= $ingredient->ingredient->text ?></td>
                                        <td class="text-center"><?= $ingredient->quantity ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="row g-3 mt-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Taille de la pizza</label>
                                <select class="form-select shadow-sm">
                                    <option value="S">Petite (26cm)</option>
                                    <option value="M" selected>Moyenne (33cm)</option>
                                    <option value="L">Large (40cm)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nombre</label>
                                <select class="form-select shadow-sm">
                                    <?php for($i=1; $i<=10; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <a href="<?= '/bag/add/' . $pizza->id ?>" class="btn btn-primary btn-lg" role="button">
                                <i class="fas fa-cart-plus me-2"></i> Ajouter au panier
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>