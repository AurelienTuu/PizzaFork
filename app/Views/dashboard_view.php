<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<div class="card shadow" style="margin-top: 2%; border-radius: 15px; overflow: hidden;">
    <div class="titre" style="text-align: center; padding-top: 20px;">
        <h1 style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif; color: black; text-align: center;">
            Tableau de bord Admin
        </h1>
    </div>


    <div>
        <a href="/logout" class="btn btn-danger">Se déconnecter</a>
    </div>

    <div>
        <a href="/pizzas" class="btn btn-primary">Gérer les pizzas</a>
        <a href="/ingredients" class="btn btn-secondary">Gérer les ingrédients</a>
    </div>
</div>

<?= $this->endSection() ?>