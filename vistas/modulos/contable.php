<?php    


$meses = array(1=>'Jun',2=>'Jul',3=>'Ago',4=>'Sep',5=>'Oct',6=>'Nov',7=>'Dic',8=>'Ene',9=>'Feb',10=>'Mar',11=>'Abr',12=>'May');

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
