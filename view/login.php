<?php require __DIR__ . '/head.php' ?>

<?php require __DIR__ . '/navbar.php' ?>

<form action ="<?= URL ?>login" class="row g-3 mx-auto mt-3 border border-3 rounded-5 p-3 login-login"  method="POST">

    <div class="col-md-3">
        <label class="form-label">Vardas</label>
        <input type="text" name="name" class="form-control" value="">
    </div>
    <div class="col-md-3">
        <label class="form-label">Email</label>
        <input type="text" name="email" class="form-control" value="">
    </div>
    <div class="col-md-3">
        <label class="form-label">Slaptazodis</label>
        <input type="password" name="pass" class="form-control">
    </div>
    <div class="col-12 login-btndiv">
        <button class="btn btn-primary" type="submit">Prisijungti</button>
    </div>
</form>
<?php require __DIR__ . '/footer.php' ?>