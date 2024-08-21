<div class="container py-4">
    <div class="row" style="padding: 5em 0em;">
        <?php
        if ($hero["alignment"] == 'left') { ?>
            <div class="col-md-4 d-flex flex-column gap-2 align-items-start">
                <h1 style="color:#34526e"><?= $hero["heading"] ?></h1>
                <p class="text-secondary fw-medium my-4"><?= $hero["description"] ?></p>
                <button class="btn fw-medium btn-<?= $hero["btn-color"] ?> px-4"><?= $hero["btn-text"] ?></button>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 d-flex justify-content-center align-items-center rounded"
                style="height:300px; width:300px; background-color:#cecece;">
                <?php getImage($conn) ?>
            </div>
        <?php } else { ?>
            <div class="col-md-4 ml-4 d-flex justify-content-center align-items-center rounded"
                style="height:300px; width:300px; background-color:#cecece;">
                <?php getImage($conn) ?>
            </div>

            <div class="col-md-4"></div>

            <div class="col-md-4 d-flex flex-column gap-2 align-items-start">
                <h1><?= $hero["heading"] ?></h1>
                <p class="text-secondary fw-medium my-4" style="text-align:justify;"><?= $hero["description"] ?></p>
                <button class="btn fw-medium btn-<?= $hero["btn-color"] ?> px-4"><?= $hero["btn-text"] ?></button>
            </div>
        <?php } ?>
    </div>
</div>