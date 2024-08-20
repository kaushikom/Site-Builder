<div class="container-fluid text-white" style="background-color:#2d314e; padding: 4em 0em;">
    <div class="row justify-content-center d-flex">
        <div class="col-3">
            <h2><?= $footer['heading'] ?></h2>
            <div class="d-flex gap-2 mt-4">
                <a href=""><img width="50" height="50"
                        src="https://img.icons8.com/ios-filled/50/ffffff/facebook--v1.png" alt="facebook--v1" /></a>
                <a href=""><img width="50" height="50"
                        src="https://img.icons8.com/ios-filled/50/ffffff/youtube-play.png" alt="youtube-play" /></a>
                <a href=""><img width="50" height="50" src="https://img.icons8.com/ios-filled/50/ffffff/twitter.png"
                        alt="twitter" /></a>
                <a href=""><img width="50" height="50"
                        src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new--v1.png"
                        alt="instagram-new--v1" /></a>
            </div>
        </div>
        <div class="col-3 d-flex flex-column gap-1">
            <a href="<?= $footer['about'] ?>">About Us</a><a href="<?= $footer['contact'] ?>">Contact</a><a
                href="<?= $footer['blog'] ?>">Blog</a>
        </div>
        <div class="col-3 d-flex flex-column gap-1">
            <a href="<?= $footer['career'] ?>">Careers</a><a href="<?= $footer['support'] ?>">Support</a><a
                href="<?= $footer['privacy_policy'] ?>">Privacy Policy</a>
        </div>
    </div>
</div>


<style>
    a>img {
        width: auto;
        height: 30px;
        transition: transform 0.3s ease;
    }

    a>img:hover {
        transform: scale(1.2);
    }

    a {
        text-decoration: none;
        color: #f4f5f7;
    }

    a:hover {
        color: grey;
    }
</style>