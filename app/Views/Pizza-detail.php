<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<style>
    .btn-check { position: absolute; clip: rect(0, 0, 0, 0); pointer-events: none; }
    .size-option img { transition: transform 0.2s; cursor: pointer; }
    .size-option img:hover { transform: scale(1.1); }
    .btn-check:checked+label .btn-outline-primary { background-color: #007bff; color: white; }

    .supplement-badge {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid #6c757d;
        user-select: none;
    }
    .supplement-badge.selected {
        background-color: #28a745 !important;
        border-color: #1e7e34 !important;
        transform: scale(1.05);
        color: white !important;
    }
    .price-tag {
        font-size: 0.7rem;
        background: rgba(255, 255, 255, 0.2);
        padding: 2px 5px;
        border-radius: 4px;
        margin-left: 5px;
        display: none;
    }
    .selected .price-tag { display: inline-block; }
</style>
<div style="margin-top: 2%;">
    <a href="/" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Retour à la carte
    </a>
</div>
<form action="<?= '/bag/add/' . $pizza->id ?>" method="POST" id="pizza-form">
    <?= csrf_field() ?>
    <div class="card shadow w-100" style="margin-top: 2%; border-radius: 15px; overflow: hidden; background: rgba(255,255,255,0.9);">
        
        <div class="card-header bg-primary text-white text-center py-3">
            <h2 class="h3 mb-0" style="font-family: 'Arial Black', sans-serif;"><?= $pizza->text ?></h2>
        </div>

        <div class="card-body" style="display: flex; flex-direction: row; gap: 40px; padding: 40px; align-items: flex-start;">

            <div style="flex: 0 0 30%;">
                <img src="<?= '/img/' . $pizza->picture ?>" class="img-fluid rounded shadow-sm"
                    style="width: 100%; height:550px; object-fit: cover;" alt="<?= $pizza->text ?>">
            </div>

            <div style="flex: 1;">
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

            <div style="flex: 0 0 30%; display: flex; flex-direction: column; gap: 30px; background: #f8f9fa; padding: 20px; border-radius: 10px; min-height: 550px;">

                <div class="pizzaSize">
                    <label class="h5 border-bottom pb-2 mb-3 d-block font-weight-bold text-center">Taille</label>
                    <div class="d-flex justify-content-between text-center align-items-end">
                        <?php
                        $sizes = [
                            ['id' => 'Small', 'label' => 'Petite', 'cm' => '24', 'img' => 'smallSizePizza.png', 'size' => '50px', 'price' => 10.00, 'checked' => ''],
                            ['id' => 'Medium', 'label' => 'Moyenne', 'cm' => '30', 'img' => 'mediumSizePizza.png', 'size' => '70px', 'price' => 12.50, 'checked' => 'checked'],
                            ['id' => 'Large', 'label' => 'Large', 'cm' => '40', 'img' => 'largeSizePizza.png', 'size' => '90px', 'price' => 15.00, 'checked' => '']
                        ];
                        foreach ($sizes as $s): ?>
                            <div class="size-option" style="flex: 1;">
                                <input type="radio" name="size" id="size<?= $s['id'] ?>" class="btn-check" 
                                       value="<?= $s['label'] ?>" data-price="<?= $s['price'] ?>" 
                                       <?= $s['checked'] ?> onchange="updateTotalPrice()">
                                <label for="size<?= $s['id'] ?>" class="m-0 cursor-pointer text-center">
                                    <div style="height: 100px; display: flex; align-items: center; justify-content: center;">
                                        <img src="/img/<?= $s['img'] ?>" style="width: <?= $s['size'] ?>; transition: 0.3s; mix-blend-mode: multiply;" class="mb-2 img-fluid">
                                    </div>
                                    <small class="d-block text-muted font-weight-bold"><?= $s['cm'] ?>cm</small>
                                    <div class="btn btn-outline-primary btn-sm mt-1"><?= $s['label'] ?></div>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="quantity">
                    <label class="h5 border-bottom pb-2 mb-3 d-block font-weight-bold text-center">Quantité</label>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <button class="btn btn-danger" type="button" onclick="changeQty(-1)" style="width: 40px; height: 40px;">-</button>
                        <input type="number" name="qty" id="pizza-qty" class="form-control text-center font-weight-bold" 
                               value="1" min="1" max="10" readonly style="width: 60px; height: 40px; background-color: #eee;">
                        <button class="btn btn-success" type="button" onclick="changeQty(1)" style="width: 40px; height: 40px;">+</button>
                    </div>
                </div>

                <div class="price-display text-center mt-2">
                    <span class="h2 font-weight-bold text-primary" id="final-price-display">12,50 €</span>
                </div>

                <div class="d-grid mt-2">
                    <button type="submit" class="btn btn-success btn-lg btn-block py-3 shadow-sm">
                        <i class="fas fa-cart-plus mr-2"></i> Ajouter au panier
                    </button>
                </div>
            </div>
        </div>

        <div class="card-footer text-muted py-3">
            <h2 class="text-center mb-4" style="font-size: 1.2rem; font-family: Impact, sans-serif">Ajouter des suppléments (+1€)</h2>
            <div class="row px-4">
                <?php foreach ($ingredients as $ingredient): ?>
                    <?php if (in_array($ingredient->id, [1, 2, 23])) continue; ?>
                    <div class="col-md-4 mb-2">
                        <div class="supplement-badge badge badge-secondary w-100 p-2 shadow-sm d-flex justify-content-between align-items-center" 
                             onclick="toggleSupplement(this)">
                            <span>+ <?= esc($ingredient->text) ?></span>
                            <span class="price-tag">+1,00 €</span>
                            <input type="checkbox" name="extras[]" value="<?= $ingredient->id ?>" style="display:none;">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</form>

<script>
    function toggleSupplement(element) {
        element.classList.toggle('selected');
        const checkbox = element.querySelector('input[type="checkbox"]');
        checkbox.checked = !checkbox.checked;
        updateTotalPrice();
    }

    function changeQty(delta) {
        const qtyInput = document.getElementById('pizza-qty');
        let val = parseInt(qtyInput.value) + delta;
        if (val >= 1 && val <= 10) {
            qtyInput.value = val;
            updateTotalPrice();
        }
    }

    function updateTotalPrice() {
        const selectedSize = document.querySelector('input[name="size"]:checked');
        let sizePrice = selectedSize ? parseFloat(selectedSize.getAttribute('data-price')) : 12.50;
        let extrasCount = document.querySelectorAll('.supplement-badge.selected').length;
        let quantity = parseInt(document.getElementById('pizza-qty').value);

        let total = (sizePrice + extrasCount) * quantity;
        document.getElementById('final-price-display').innerText = total.toFixed(2).replace('.', ',') + " €";
    }

    window.onload = updateTotalPrice;
</script>

<?= $this->endSection() ?>