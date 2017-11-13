  /*autor: eacevedo
   * 
   * Agregar elementos de busqueda
   * 
   * Permite agregar los consultores a buscar

   * @param elemento de busqueda
   * @Date created: 9/11/17

   */
   var indice;
   var campo;
   function add_element(){
      var bandera=false;
  
      var consultor = $("#select_consultores").val();//valor del select
      var cant_selected=$("#cant_selected").val();
      
        if(consultor==0){
           alert("Debe seleccionar un consultor");
        }else{

             var resultado=consultor.split('/');
            //Se verifica que no se este agregando el mismo consultor
              
              for (var i = 1; i <= cant_selected; i++) {
                 campo="#id_consultor"+i;
                 id_consultor=$(campo).val();
   
                 if(resultado[0]===id_consultor){
                  alert("El consultor ya fue seleccionado");
                  bandera=true;
                 }


              }

                if(bandera==false){
                    indice=$("#indice").val();
                    indice=parseInt(indice) + 1;
      
                    var resultado=consultor.split('/');

                    cant_selected=$("#cant_selected").val();
                    cant_selected=parseInt(cant_selected) + 1;
      
                     
                    $("#div_selected").append(
                    "<div class='row style-fondo-selected'>"
                       +"<input type='hidden' name='consultor' id='id_consultor"+indice+"' value=''>"
                        +"<div class='col-xs-12 col-sm-10'>"
                            +"<label id=label"+indice+">"+resultado[1]+"</label>"+" "
                        +"</div>"
                        +"<div class='col-xs-12 col-sm-2'>"
                            +"<button  id=icono"+indice+" type='button' onclick=remove_element('"+indice+"')><span class='glyphicon glyphicon-minus style_button_iconos'></span></button>"
                        +"</div>"
                    +"</div>");
                       
                    $("#cant_selected").val(cant_selected);
                    $("#indice").val(indice);

                    campo="#id_consultor"+indice;
                    $(campo).val(resultado[0]);
              

                }

                


          }
    }
  
    /*autor: eacevedo
     * 
     * Eliminar elementos
     * 
     * Permite eliminar el consultor en el filtro de busqueda,
     * el icono el campo hidden que contiene el valor del id del consultor

     * @param elemento de busqueda
     * @Date created: 9/11/17

     */
    function remove_element(elemento){
     
      var label="#label"+elemento;
      $(label).parent().remove(); 
      var icono="#icono"+elemento;
      $(icono).parent().remove(); 
      var campo="#id_consultor"+elemento;
      $(campo).val("");
      cant_selected=$("#cant_selected").val();
      cant_selected=parseInt(cant_selected) - 1;
      $("#cant_selected").val(cant_selected); 
      if(cant_selected===0) {
       
        $("#indice").val(0);
      }
    }
     
    
    /*autor: eacevedo
     * 
     * Almacenar  elementos
     * 
     * Permite obtener los datos del filtro y mostrar la data respectiva
     * @Date created: 9/11/17

     */
   function enviar_datos(){


      var cant=$("#cant_selected").val();
      var mes_desde=$("#mes_desde").val();
      var year_desde=$("#year_desde").val();
      var mes_hasta=$("#mes_hasta").val();
      var year_hasta=$("#year_hasta").val();
      var campo;
      var arreglo_selected = [];
      var bandera=false;

      for (var i = 1; i <= cant; i++) {
            campo="#id_consultor"+i;
            
            //guardo en un arreglo
             arreglo_selected[i]=$(campo).val();
             bandera=true;
      
      }
      //cuando se envia la data, se procede a borrar los elementos del filtro eva de las tablas de ganacias, 
      //para cargar la nueva busqueda

      document.getElementById("div_selected").innerHTML = '';
      document.getElementById("div_ganancias").innerHTML = '';
      $("#cant_selected").val(0);
      $("#indice").val(0);
      if(bandera){
        msj_periodo_desde=meses(mes_desde,year_desde);
        msj_periodo_hasta=meses(mes_hasta,year_hasta);

            $.ajax({
                       method: "POST",
                       url:  base_url+ 'index.php/cconsultores/mostrar_datos_consultores',
                       dataType: "json",
                       data: "mes_desde="+mes_desde+"&year_desde="+year_desde+"&mes_hasta="+mes_hasta+"&year_hasta="+year_hasta+"&arreglo_selected="+arreglo_selected,
                       success: function(data) {

                        if(data=="false"){
                          alert("No hay registros para mostrar");
                        }else{
                   
                       for (var i = 0 ;i < data.length; i++) {//por cada consultor 


                         total_neto=parseInt(data[i][0][0]['valor_neto'])+parseInt((data[i][1][0]['valor_neto']));
                         total_costo_fijo=parseInt(data[i][0][0]['costo_fijo'])+parseInt((data[i][1][0]['costo_fijo']));
                         total_comision=parseInt(data[i][0][0]['comision'])+parseInt((data[i][1][0]['comision']));
                         total_lucro=parseInt(data[i][0][0]['comision'])+parseInt((data[i][1][0]['lucro']));

                                     $('#div_ganancias').append("<div class='container table-responsive'>"
                                          +"<label class='style-title'>"+data[i][0][0]['no_usuario']+"</label>"                                
                                          +"<table class='table table-striped table-bordered table-hover '>"
                                              +"<thead>"
                                                 +"<tr>"
                                                  +"<th>Periodo</th>"
                                                  +"<th>Receita Líquida</th>"
                                                  +"<th>Custo Fixo </th>"
                                                  +"<th>Comissão</th>"
                                                  +"<th>Lucro</th>"
                                                  +"</tr>"
                                              +"</thead>"
                                            +"<tbody>"
                                               +"<tr>"
                                                  +"<td>"+msj_periodo_desde+"</td>"
                                                  +"<td>"+data[i][0][0]['valor_neto']+"</td>"
                                                  +"<td>"+data[i][0][0]['costo_fijo']+"</td>"
                                                  +"<td>"+data[i][0][0]['comision']+"</td>"
                                                  +"<td>"+data[i][0][0]['Lucro']+"</td>"
                                                 +"</tr>"
                                                  +"<tr>"
                                                  +"<td>"+msj_periodo_desde+"</td>"
                                                  +"<td>"+data[i][1][0]['valor_neto']+"</td>"
                                                  +"<td>"+data[i][1][0]['costo_fijo']+"</td>"
                                                  +"<td>"+data[i][1][0]['comision']+"</td>"
                                                  +"<td>"+data[i][1][0]['Lucro']+"</td>"
                                                 +"</tr>"
                                                 +"<tr class='style-tr'>"
                                                 +"<td>Saldo</td>"
                                                  +"<td>"+total_neto+"</td>"
                                                  +"<td>"+total_costo_fijo+"</td>"
                                                  +"<td>"+total_comision+"</td>"
                                                  +"<td>"+total_lucro+"</td>"
                                                  
                                                 +"</tr>"
                                            +"</tbody>"
                                          +"</table>"
                                        +"</div>");
                             }

                        }

                            
                        }               
                    });
      }else{

        alert("Debe asignar valores en el filtro");
      }
    
      return false; // Evitar ejecutar el submit del formulario.
    
}

 /*autor: eacevedo
     * 
     * Obtener en mensaje el mes y el año
     * 
     * Se obtienen Obtener en mensaje del mes y el año

     * @Date created: 9/11/17
     * @return string
     */
  function meses(mes,year){
     var mensaje;
     switch(mes) {
        case "1" : mensaje= "Enero del "+year;
              break;
        case "2" : mensaje= "Febrero del "+year;
              break;
        case "3" : mensaje= "Marzo del "+year;
              break;
        case "4" : mensaje= "Abril del "+year;
              break;
        case "5" : mensaje= "Mayo del "+year;
              break;
        case "6" : mensaje= "Junio del del "+year;
              break;
        case "7" : mensaje= "Julio del del "+year;
              break;
        case "8" : mensaje= "Agosto del del "+year;
              break;
        case "9" : mensaje= "Septiembre del "+year;
              break;
        case "10" : mensaje= "Octubre del "+year;
              break;
        case "11" : mensaje= "Noviembre del "+year;
              break;
        case "12" : mensaje= "Diciembre del "+year;
        }

        return mensaje;
  }

  