<?php require __DIR__ . '/head.php' ?>

<?php require __DIR__ . '/navbar.php' ?>

<?php use Ernio\Bankas\Controllers\BankController; ?>

<h2 class="h2-caption-accountlist"><?= "Sąskaitų sąrašas" ?></h2>
  <div class="sastable-accountlist">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col" class="text-center">Vardas</th>
          <th scope="col" class="text-center">Pavarde</th>
          <th scope="col" class="text-center">Saskaitos nr</th>
          <th scope="col" class="text-center">Lėšos</th>
          <th scope="col" class="text-center"></th>
        </tr>
      </thead>
      <tbody>
      <?php (new BankController)->showingallSas() ?>
      </tbody>
    </table>
  </div>
</body>

<?php require __DIR__ . '/footer.php' ?>