<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<div class="card">
    <div class="card-header"><div class="col"><h4><?= $title ?></h4></div></div>
    <div class="card-body">
        <thead></thead>
        <table class="table table-hover table-striped">
            <?php foreach ($bag->contents() as $item) : ?>
                <tr style="text-align: center;">
                    <td>
                    <img src="<?= '/img/' . $item['picture'] ?>" 
                        class="img-fluid rounded bag-thumb" alt="...">
                    </td>
                    <td><h5><?= $item['name'] ?></h5></td>
                    <td style="width: 5%;">
                        <a href="<?= '/bag/qty/Dec' ?>" class="btn btn-danger" role="button">
                            <i class="fas fa-minus"></i>
                        </a>
                    </td>
                    <td style="width: 10%;">
                        <h5><?= $bag->formatNumber($item['qty']) ?></h5>
                    </td>
                    <td style="width: 5%;">
                        <a href="<?= '/bag/qty/Inc' ?>" class="btn btn-success" role="button">
                            <i class="fas fa-plus"></i>
                        </a>
                    </td>
                    <td>
                        <h5 class="text-grey"><?= '&euro;' . 
                            $bag->formatNumber($item['price']) ?></h5>
                    </td>
                    <td>
                        <a href="<?= '/bag/item/delete' ?>" class="btn btn-danger"
                           role="button">
                            <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="card-footer">
        <a href="<?= '/payement' ?>" class="btn btn-warning btn-block pay-button"
           role="button">
            <i class="fa fa-credit-card"></i> Procéder au paiement
        </a>
    </div>
</div>
<?= $this->endSection() ?>