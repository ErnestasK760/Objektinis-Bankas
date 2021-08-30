<?php use Ernio\Bankas\App; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>">Bankas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if(App::isLogged()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>create">Nauja sąskaita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>accountlist">Sąskaitų sąrašas</a>
                </li>
                <li class="nav-item">
                    <form class="logout-form" action="<?= URL ?>logout" method="post">
                    <button type="submit" class="nav-link logout-btn">Atsijungti</button>
                    </form>
                </li>
                <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URL ?>login">Prisijungimas</a>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>

<?php showMessages();