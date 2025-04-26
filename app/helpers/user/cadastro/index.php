<?php include('app/helpers/user/cadastro/class.cadastro.php');?>
<?php
    $object = new gravar_agendamento;

    $object->gravar();
?>

<?php if($_GET['erro'] <> ''){ ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $_GET['erro']; ?>
    </div>
<?php } ?>