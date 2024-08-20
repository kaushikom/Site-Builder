<nav class="navbar navbar-expand-lg border-bottom border-body 
    <?php echo $navbar["darkmode"] ? 'bg-dark' : 'bg-body-secondary'; ?>" <?php if ($navbar["darkmode"])
               echo 'data-bs-theme="dark"'; ?>>
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><?= $navbar["header"] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  <?php echo $navbar["header-alignment"] == 'center' ? 'justify-content-center' : ""; ?>"
            id="navbarNavAltMarkup">
            <div class="navbar-nav <?php echo $navbar["header-alignment"] == "right" ? "ms-auto" : "" ?>">
                <?php
                foreach ($otherLinks as $otherLink) {
                    echo "<a class=\"nav-link\" href=\"#\">$otherLink</a>";
                } ?>
            </div>
            <?php
            if ($navbar['searchbar']) { ?>
                <form class="d-flex ms-auto align-self-center" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            <?php }
            ?>
        </div>
    </div>
</nav>