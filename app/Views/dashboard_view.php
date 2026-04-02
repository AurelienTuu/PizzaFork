<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<style>
    .admin-panel {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 30px;
        margin-top: 15%;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }


    .admin-title {
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        color: #333;
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        margin-bottom: 30px;
    }
</style>

<div class="container">
    <div class="admin-panel">

        <div class="row align-items-center mb-4">
            <div class="col">
                <h1 class="admin-title">Tableau de bord Admin</h1>
            </div>
        </div>
        <div class="col-auto" style="text-align: right;">
            <a href="/logout" class="btn btn-outline-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i> Se déconnecter
            </a>
        </div>

        <hr>

        <div class="text-center mt-5 mb-5">
            <h4 class="text-muted mb-4">Gestion de la Carte</h4>
            <a href="/pizzas" class="btn btn-primary btn-lg mx-2 px-4 shadow-sm">
                Gérer les pizzas
            </a>
            <a href="/ingredients" class="btn btn-secondary btn-lg mx-2 px-4 shadow-sm">
                Gérer les ingrédients
            </a>
        </div>

    </div>
</div>

<?= $this->endSection() ?>