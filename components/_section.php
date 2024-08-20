<div class="container-fluid" style="padding:5em 2em;  background-color:#eef3f9;">
    <h2 class="<?= $class ?>"><?= $section["heading"] ?></h2>
    <p class="<?= $class ?>"><?= $section["description"] ?></p>
    <div class="row mt-4">
        <?php
        foreach ($section["pointers"] as $obj) { ?>
            <div class="col">
                <div class="card border-0" style="width:250px; padding: 0.5em 1em;">
                    <div class="card-img-top"
                        style="width:60px; height:60px; border-radius:50%; opacity:0.3; background-color:hotpink;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $obj['heading'] ?></h5>
                        <div class="card-text text-secondary fw-medium"><?= $obj['description'] ?></div>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>