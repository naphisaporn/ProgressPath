<?php include('header.php'); ?>



<div class="container">
    <div class="contain my-5">
    <h1>Hello world</h1>
    <?php
    require_once('dashboard.php');
    require_once('showProject.php');
    ?>

    </div>

</div>
<?php


echo $_SESSION['IDNo'] . $_SESSION['Position'] . $_SESSION['LevelID'];

?>

<?php include('footer.php'); ?>