
<div class="row"> 

  <div class="col-md-12">

    <div class="card">

      <div class="card-body">

        <table class="table table-bordered tablaContable">

          <thead>

            <tr>

              <th style="width:100px;"></th>
                        
              <?php foreach ($meses as $key => $mes) { ?>
                
                <th><?=$mes?></th>

              <?php } ?> 

            </tr>

          </thead>

          <tbody id="tbodyContable">

            <tr>
            
              <td>Ingresos</td>

              <?php

                if(!$data['estrategia']['seteado']){

                  foreach ($meses as $key => $mes) { ?>

                    <td id="<?=$key?>">0</td>
  
                  <?php } 
                  
                } else {
                  
                 

                }

              ?>
              
            </tr>

            <tr>
            
              <td>Kg Prom Ing</td>

              <?php

                if(!$data['estrategia']['seteado']){

                  foreach ($meses as $key => $mes) { ?>

                    <td id="kgIngresoPlan<?=$key?>" >0</td>
  
                  <?php } 
                  
                } else {
                  
                 
                }

              ?>
              
            </tr>

            <tr>

              <td>Egresos</td>

              <?php

                if(!$data['estrategia']['seteado']){

                  foreach ($meses as $key => $mes) { ?>

                    <td id="ventaPlan<?=$key?>" >0</td>

                  <?php } 
                  
                } else {

      

                }

              ?>

            </tr>

            <tr>

              <td>Kg Prom Egr</td>

              <?php

                if(!$data['estrategia']['seteado']){

                  foreach ($meses as $key => $mes) { ?>

                    <td id="kgVentaPlan<?=$key?>" >0</td>

                  <?php } 
                  
                } else {


                }

              ?>

            </tr>

            <!--  DIETA ---->

          </tbody>

        </table>

      </div>

    </div>

  </div>

</div>

<script>



</script>

