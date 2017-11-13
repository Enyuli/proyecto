     <div class="tabla_principal panel panel-default">
        <ul class="nav nav-tabs">
        
          <li class="active"><a href="#">Por consultor</a></li>
          <li><a href="#">Por Cliente</a></li>
         
        </ul>
        <div class="style-panel ">  <label class="style-title"><?php  ?></label></div>
            <div class="panel-body">  
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                               <div class="col-xs-12 col-sm-4"> 
                                    <label class="style-title"><?php echo "Periodo Desde"; ?></label>
                                </div>
                                <div class="col-xs-12 col-sm-5">
                                    <?php 
                                          $meses = array( 1 => 'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'junio',7=>'julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre');

                                            echo "<select name='mes_desde' id='mes_desde'>";

                                            for ($i=1; $i<=sizeof($meses); $i++){
                                                    echo "<option value='".$i."'>". $meses[$i]."</option>";
                                            }
                                            echo  '</select>';
                                        ?>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <?php      
                                            echo "<select name='year_desde' id='year_desde' >";
                                            for($i=date("Y");$i>=1970;$i--)
                                            {
                                                echo "<option value='".$i."'>".$i."</option>";
                                            }
                                            echo "</select>";
                                        ?>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <label class="style-title"><?php echo "Periodo Hasta"; ?></label>
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <?php
                                        echo "<select name='mes_hasta' id='mes_hasta'>";

                                        for ($i=1; $i<=sizeof($meses); $i++){
                                                echo "<option value='".$i."'>". $meses[$i]."</option>";
                                        }
                                        echo  '</select>';
                                    ?>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                                <?php
                                        echo "<select name='year_hasta' id='year_hasta' >";
                                        for($i=date("Y");$i>=1970;$i--)
                                        {
                                            echo "<option value='".$i."'>".$i."</option>";
                                        }
                                        echo "</select>";
                                    ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                    <label class="style-title"><?php echo "Consultores"; ?></label>                                  
                             </div>
                            <div class="col-xs-12 col-sm-8">
                                    
                                    <select name="select_consultores" id="select_consultores" >
                                         <option value="0" selected="true">-- <?php echo "Seleccione"?> --</option>
                                        <?php 
                                        foreach ($result as $row) { ?>
                                         <option value="<?php echo $row->co_usuario.'/'.$row->no_usuario?>"><?php echo $row->no_usuario?></option>
                                        <?php } ?>
                                    </select>
                                    <button type="button" onclick="add_element();"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                        </div>
                    </div>
                <!-- style-panel-selected -->
         <?php $attributes = array('name' => 'form', 'id' => 'id_form', 'onsubmit' => 'return false');
         echo $formulario= form_open('cconsultores/index', $attributes);?>
                    <div class="col-xs-12 col-sm-4  ">
                        
                            <div id="div_selected">
                                
                             </div>
                            
                            <input type="hidden" name="cant_selected" id="cant_selected" value='0'>
                            <input type="hidden" name="indice" id="indice" value='0'>
                    </div>
                    <div class="col-xs-12 col-sm-2 ">
                        <div class="row style-row">
                             <button type="button" id="relatorio" onclick="enviar_datos()" class="style_button_action"><IMG SRC="<?php echo base_url() ?>images/icone_relatorio.png" />Relatório</button>
                        </div>
                        <div class="row style-row">
                             <button type="button" id="grafico"  onclick="" class="style_button_action">
                                <IMG SRC="<?php echo base_url() ?>images/icone_grafico.png" />Grafico</button>
                        </div>
                        <div class="row style-row">
                             <button type="button" id="pizza" onclick=""  class="style_button_action">
                                <IMG SRC="<?php echo base_url() ?>images/icone_pizza.png" />Pizza</button>
                        </div>
                    </div>
        <?php echo form_close();?>
                </div>
            </div>
         
    </div>

 <div class="tabla_secundaria">
    <div id="div_ganancias">
                                
    </div>

</div>
