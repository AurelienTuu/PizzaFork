<?= $this->extend('page.php') ?>
<?= $this->section('body') ?>
<div class="card">
    <div class="card-header">
        <h1><?= $title ?></h1>
    </div>
    <div class="card-body">
        <?= ((session()->has('errors')) ? \Config\Services::validation()->listErrors() : '') ?>
           <form class="form-horizontal" action="<?= (isset($pizza) ? '/pizza/save/' . $pizza->id : '/pizza/save') ?>" method="post" enctype="multipart/form-data">
            <div class=form-group>
                <form-label for="text ">Pizza : </form-label>
                <input type="text" name="text" id="text" value="<?= old('text', $pizza->text ?? '', false) ?>" placeholder="Nom de la pizza">
            </div>
            <div class="form-group">
                <label for="fileName">Image</label>
                <input type="text" name="fileName" id="fileName" class="form-control"
                       value="<?= old('picture', $pizza->picture ?? '', false) ?>"
                       disabled>
            </div>

            <div class="form-group">
                <input type="button" id="button" value="Choisir un fichier" class="btn btn-secondary" 
                       onclick="document.getElementById('picture').click()"/>
                
                <input type="file" name="picture" id="picture" style="display:none"
                       onchange="document.getElementById('fileName').value = document.getElementById('picture').files[0].name"/>
            </div>

            <div class="form-group">
                <img src="<?= old('picture', base_url('/img/' . ($ingredient->picture ?? '')), false) ?>"
                     class="img-fluid thumbnail preview-thumb">
            </div>

            <button class="btn btn-primary" type="submit">
                <i class="fa fa-plus"> Valider</i>
            </button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

