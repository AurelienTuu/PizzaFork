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

<div class="tittle" style="margin-top: 2%;">
    <h1
        style="font-family: 'Playfair Display'; font-weight: 700; font-style: italic; color: white; text-align: center;  ">
        PIZZA FORK</h1>
</div>

<div class="row"
    style="display: flex; flex-direction: column; justify-content: flex-end; align-items: flex-end; gap: 15px;">
    <p>
        <?php if (auth()->loggedIn()): ?>
            <a href="/logout" class="btn btn-danger">Se déconnecter</a>
        <?php else: ?>
            <a class="btn btn-light" href="/login">Se connecter</a>
            <a href="/register" class="btn btn-primary">S'inscrire</a>
        <?php endif; ?>
    </p>
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
            <div class="card" style="background-color: rgba(255, 255, 255, 0.9); border: 2px solid #000000ff;">
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
                    <a href="<?= '/bag/add/' . $pizza->id ?>" class="btn btn-primary add-to-cart-home"
                        data-pizza-id="<?= $pizza->id ?>" role="button">
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

<script>
    document.querySelectorAll('.add-to-cart-home').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const pizzaId = this.getAttribute('data-pizza-id');
            const url = this.getAttribute('href');

            // 1. Trouver l'input radio coché pour cette pizza spécifique
            const selectedInput = document.querySelector(`input[name="size_${pizzaId}"]:checked`);
            let sizeValue = "Moyenne"; // Valeur par défaut

            if (selectedInput) {
                // On récupère le texte du label correspondant (Petite, Moyenne ou Large)
                const label = document.querySelector(`label[for="${selectedInput.id}"]`);
                sizeValue = label.textContent.trim();
            }

            // 2. Création d'un formulaire invisible pour envoyer en POST
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;

            // 3. Ajout du jeton CSRF (Indispensable pour CodeIgniter)
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '<?= csrf_token() ?>';
            csrfInput.value = '<?= csrf_hash() ?>';
            form.appendChild(csrfInput);

            // 4. Ajout de la taille
            const sizeInput = document.createElement('input');
            sizeInput.type = 'hidden';
            sizeInput.name = 'size';
            sizeInput.value = sizeValue;
            form.appendChild(sizeInput);

            // 5. Ajout de la quantité (forcée à 1 sur la home)
            const qtyInput = document.createElement('input');
            qtyInput.type = 'hidden';
            qtyInput.name = 'qty';
            qtyInput.value = '1';
            form.appendChild(qtyInput);

            // 6. Envoi automatique
            document.body.appendChild(form);
            form.submit();
        });
    });
</script>

<?= $this->endSection() ?>