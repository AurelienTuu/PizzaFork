<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<h1>Tableau de bord Admin</h1>
<p>Bienvenue dans votre espace administratif !</p>
<div>
    <a href="pizzas" class="btn btn-primary">Gérer les pizzas</a>
    <a href="ingredients" class="btn btn-secondary">Gérer les ingrédients</a>
</div>
<?= $this->endSection() ?>