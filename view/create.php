<?php require __DIR__ . '/head.php' ?>

<?php require __DIR__ . '/navbar.php' ?>
<?php 

use Ernio\Bankas\User;

?>

<form class="row g-3 mx-auto mt-3 border border-3 rounded-5 p-3 register-newuser" action="<?= URL ?>create" method="POST">

    <div class="col-md-2">
      <label class="form-label">Vardas</label>
      <input type="text" name="name" class="form-control" value="">
    </div>

    <div class="col-md-2">
      <label class="form-label">Pavarde</label>
      <input type="text" name="surname" class="form-control" value="">
    </div>

    <div class="col-md-3">
      <label class="form-label">Asmens Kodas</label>
      <input type="text" name="personalId" class="form-control">
    </div>

    <div class="col-md-6">
      <label class="form-label">Sąskaitos numeris</label>
      <input class="form-control" name="acc" type="text" value=<?= User::getaccNum() ?> readonly>
    </div>

    <div class="col-12">
      <button class="btn btn-primary" type="submit">Registruoti</button>
    </div>
  </form>

  <?php require __DIR__ . '/footer.php' ?>