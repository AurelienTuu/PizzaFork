<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<div class="row">   
    <p>
        <a class="btn btn-primary" href="/bag/checkout">
            <i class="fas fa-check"></i> <i class="fas fa-shopping-cart"></i>
            checkout
        </a>
    </p>
</div>

<h1><?= $title ?></h1>

<div class="row row-cols-md-3">
    <?php foreach ($pizzas as $pizza) : ?>
        <div class="col mb-4">
            <div class="card">
                <img src="<?= '/img/'.$pizza->picture ?>" class="card-img-top fixed-thumb" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $pizza->text ?></h5>
                    <a href="<?= '/bag/add/'.$pizza->id ?>" class="btn btn-primary"
                        role="button">
                        Ajoutez à votre panier <i class="fas fa-cart-plus"></i>
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