<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<style>
    .selection {
        display: flex;
        justify-content: space-around;
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
        padding: .380rem .80rem;
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

<div class="row" style="margin-top: 5%; display: flex; justify-content: flex-end;">
    <p>
        <a class="btn btn-primary" href="/bag/checkout">
            <i class="fas fa-shopping-cart"></i>
            Panier
        </a>
    </p>
</div>

<h1 style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; color: white;">LA CARTE</h1>

<div class="row row-cols-md-3">
    <?php foreach ($pizzas as $pizza): ?>
        <div class="col mb-4">
            <div class="card" style="background-color: #ffffff67; border: 2px solid #ff9900ff;">
                <img src="<?= '/img/' . $pizza->picture ?>" class="card-img-top fixed-thumb" alt="...">

                <div class="card-body"
                    style="display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
                    <h5 class="card-title" style="text-align: center;"><?= $pizza->text ?></h5>
                    <div class="selection" style="display: flex; ">
                        <div class="small d-flex flex-column align-items-center">
                            <h5 style="font-size: 15px;">24cm</h5>
                            <input type="radio" class="btn-check" name="size_<?= $pizza->id ?>"
                                id="sizeSmall_<?= $pizza->id ?>" autocomplete="off">
                            <label class="btn btn-outline-primary" for="sizeSmall_<?= $pizza->id ?>">Petite</label>
                        </div>
                        <div class="medium d-flex flex-column align-items-center">
                            <h5 style="font-size: 15px;">30cm</h5>
                            <input type="radio" class="btn-check" name="size_<?= $pizza->id ?>"
                                id="sizeMedium_<?= $pizza->id ?>" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="sizeMedium_<?= $pizza->id ?>">Moyenne</label>
                        </div>
                        <div class="large d-flex flex-column align-items-center">
                            <h5 style="font-size: 15px;">40cm</h5>
                            <input type="radio" class="btn-check" name="size_<?= $pizza->id ?>"
                                id="sizeLarge_<?= $pizza->id ?>" autocomplete="off">
                            <label class="btn btn-outline-primary" for="sizeLarge_<?= $pizza->id ?>">Large</label>
                        </div>
                    </div>
                    <a href="<?= '/pizza/' . $pizza->id ?>" class="btn btn-secondary" role="button">
                        Détails Pizza <i class="fas fa-info-circle"></i>
                    </a>
                    <a href="<?= '/bag/add/' . $pizza->id ?>" class="btn btn-primary" role="button">
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