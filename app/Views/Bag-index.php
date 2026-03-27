<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>

<a href="<?= '/' ?>" class="btn btn-secondary back-button" role="button" style="margin-top: 5%;">
    <i class="fas fa-arrow-left"></i> Retour à la boutique
</a>

<div class="card shadow" style="margin-top: 2%; border-radius: 15px; overflow: hidden;">
    <div class="card-header bg-dark text-white">
        <h4 class="mb-0"><i class="fas fa-shopping-bag mr-2"></i> <?= $title ?></h4>
    </div>
    
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr class="text-center">
                    <th>Produit</th>
                    <th class="text-left">Détails</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Sous-total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bag->contents() as $item): ?>
                    <tr class="text-center align-middle">
                        <td style="width: 150px;">
                            <img src="<?= '/img/' . $item['picture'] ?>" class="img-fluid rounded shadow-sm" style="max-height: 80px;" alt="...">
                        </td>

                        <td class="text-left">
                            <h5 class="mb-1"><?= $item['name'] ?></h5>
                            <?php if (isset($item['options']['details'])): ?>
                                <div class="small text-muted">
                                    <i class="fas fa-info-circle mr-1"></i> <?= $item['options']['details'] ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($item['options']['extras_names'])): ?>
                                <div class="small text-success">
                                    <i class="fas fa-plus-circle mr-1"></i> Suppléments: <?= $item['options']['extras_names'] ?>
                                </div>
                            <?php endif; ?>
                        </td>

                        <td style="width: 180px;">
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="<?= '/bag/qty/Dec/' . $item['rowid'] ?>" class="btn btn-sm btn-outline-danger mr-2">
                                    <i class="fas fa-minus"></i>
                                </a>
                                <span class="h5 mb-0 mx-2 font-weight-bold"><?= $item['qty'] ?></span>
                                <a href="<?= '/bag/qty/Inc/' . $item['rowid'] ?>" class="btn btn-sm btn-outline-success ml-2">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </td>

                        <td>
                            <span class="text-muted"><?= number_format($item['price'], 2, ',', ' ') ?> €</span>
                        </td>

                        <td>
                            <strong class="text-primary h5"><?= number_format($item['subtotal'], 2, ',', ' ') ?> €</strong>
                        </td>

                        <td>
                            <a href="<?= '/bag/item/delete/' . $item['rowid'] ?>" class="btn btn-link text-danger" title="Supprimer">
                                <i class="fa fa-trash-alt fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer bg-light p-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="mb-0">Total: <span class="text-primary"><?= number_format($bag->total(), 2, ',', ' ') ?> €</span></h3>
            </div>
            <div class="col-md-6 text-right">
                <div id="paypal-button-container" style="max-width: 300px; margin-left: auto;"></div>
            </div>
        </div>
        <p id="result-message" class="mt-3 text-center font-weight-bold"></p>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=AZgdcCREt-e92TI2hQW1h0FZAjGRqQm8fD685aRsxvCguxwfI3gyQXcy8o9vw-I7rHl1HjMpdv9hb4lC&currency=EUR"></script>

<script>
    paypal.Buttons({
        style: { shape: "pill", layout: "vertical", color: "gold", label: "checkout" },
        async createOrder() {
            const response = await fetch("/api/orders", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ 
                    total: "<?= $bag->total() ?>", // On envoie le vrai total du panier
                    items: <?= json_encode($bag->contents()) ?> 
                })
            });
            const orderData = await response.json();
            return orderData.id;
        },
        async onApprove(data, actions) {
            const response = await fetch(`/api/orders/${data.orderID}/capture`, { method: "POST" });
            const orderData = await response.json();
            if (orderData.status === 'COMPLETED') {
                window.location.href = "/order/success"; // Rediriger après succès
            }
        }
    }).render("#paypal-button-container");
</script>

<?= $this->endSection() ?>