<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<div class="row" style="margin-top: 5%; display: flex; justify-content: flex-end;">
    <p>
        <a class="btn btn-primary" href="/bag/checkout">
            <i class="fas fa-shopping-cart"></i>
            Panier
        </a>
    </p>
</div>

<h1><?= $title ?></h1>

<div class="row row-cols-md-3">
    <?php foreach ($pizzas as $pizza): ?>
        <div class="col mb-4">
            <div class="card">
                <img src="<?= '/img/' . $pizza->picture ?>" class="card-img-top fixed-thumb" alt="...">

                <div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
                    <h5 class="card-title" style="text-align: center;"><?= $pizza->text ?></h5>

                    <a href="<?= '/pizza/' . $pizza->id ?>" class="btn btn-secondary" role="button">
                        Détails Pizza <i class="fas fa-info-circle"></i>
                    </a>

                    <a href="<?= '/bag/add/' . $pizza->id ?>" class="btn btn-primary" role="button" >
                        Ajoutez au panier <i class="fas fa-cart-plus"></i>
                    </a>
                    
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<div class="row">
    <?= $pager->links('default', 'bootstrap') ?>
</div>
<?= $this->endSection() ?>