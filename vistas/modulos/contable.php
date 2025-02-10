<?php    


$meses = array(1=>'May',2=>'Jun',3=>'Jul',4=>'Ago',5=>'Sep',6=>'Oct',7=>'Nov',8=>'Dic',9=>'Ene',10=>'Feb',11=>'Mar',12=>'Abr');

?>

  
    <div class="box">
    
        <section class="content" style="padding-top:5px;">

        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#contable" aria-controls="contable" role="tab" data-toggle="tab">Contable</a></li>
          <!-- <li role="presentation"><a href="#graficosContable1" aria-controls="graficosContable1" role="tab" data-toggle="tab">Analisis</a></li> -->
        </ul>

        <div class="tab-content">

          <div role="tabpanel" class="tab-pane active" id="contable">
            <?php include('tablaContable.php'); ?>
          </div>

          <!-- <div role="tabpanel" class="tab-pane" id="graficosContable1">
          <?php// include('graficosContable1.php'); ?>

          </div> -->


        </div>

        

        </section>

    </div>


<?php


?>
