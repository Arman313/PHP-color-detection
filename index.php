<?php

$display_image = false;
if (isset($_COOKIE['image_colors']) && isset($_COOKIE['image_name'])) {
  $last_image = $_COOKIE['image_name'];

  $display_image = true;

    $finale_colors = json_decode($_COOKIE['image_colors'], true);
  $sum = array_sum($finale_colors);

  $precents = [];
  foreach ($finale_colors as $key => $amount) {

    $precents["#" . $key] = round(($amount / $sum) * 100, 2);
  }

  $new_arr = array_splice($precents, 0, 5, true);
} else {
  $new_arr = [];
  $display_image = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <div class="container-fluid ">
    <div class="row">
      <!-- -----------image ---------------- -->
      <div class="col-lg-9 text-center mt-3 content">
        <?php if (!$display_image) : ?>
          <div class="center">
            <p class="text-white">Please upload Image to start detection</p>
          </div>
        <?php else : ?>
          <img src="images/<?= $last_image ?>" class="img-fluid" alt="image_to_detect">
        <?php endif ?>
      </div>
      <!-- ---------------- image end ------------------- -->

      <!-- -------------------- RGB col ----------------------------- -->
      <div class="col-lg-3">
        <?php if ($new_arr) : ?>
          <?php foreach ($new_arr as $key => $val) : ?>
            <div style="background-color:<?= $key ?>" ; class="card m-2 p-5">
              <div class="card-body">

                <h5 class="card-title text-center"><?= $val ?>%</h5>
              </div>
            </div>
          <?php endforeach ?>
        <?php endif ?>
      </div>
      <!-- --------------------- RGB cols end --------------------- -->
    </div>


    <!-- ----------------- main form row ----------------- -->
    <div class="row">
      <div class="col-lg-12">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
          <div class="row mt-3">
            <div class="col-lg-9">
              <input class="form-control" type="file" name="image" id="fileToUpload">
            </div>
            <div class="col-lg-3 pr-5 ">
              <div class="">
                <button class="btn btn-primary bt-lg w-100" type="submit" name="submit">Uplaod</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- ------------- main form row end ---------------- -->

  </div>
</body>

</html>