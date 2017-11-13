  <script>
  /*autor: eacevedo
   * 
   * Agregar elementos de busqueda
   * 
   * Permite agregar los consultores a buscar

   * @param elemento de busqueda
   * @Date created: 9/11/17

   */
  var contador=0;
   function add_element(elemento){
        contador++;
        if(elemento==0){
           alert("Debe seleccionar un consultor");
        }else{
                if(contador>5){ 
                  alert("Máximo 5 consultores");
                }else{
                  var consultor = $("#select_consultores").val();
                  var resultado=consultor.split('/');
                
                  $(seleccionados).append(
"<?php $estilos = array('class' => 'my_class_css', 'id' => 'nombre_formulario');?>"

echo form_open('controlador/metodo', $estilos)


                  "<div class='row'><input type='hidden' id=consultores["+contador+"] value="+resultado[0]+"><label id="+contador+">"+resultado[1]+"</label>"+" "+"<button type='button' onclick=remove_element('"+contador+"')>"+
                  "<span class='glyphicon glyphicon-minus'></span></button></div><?php echo form_close());?>;");
                }
            }
    }
  

    /*autor: eacevedo
     * 
     * Eliminar elementos
     * 
     * Permite eliminar el consultor en el filtro de busqueda

     * @param elemento de busqueda
     * @Date created: 9/11/17

     */
    function remove_element(elemento){
        
           var element="#"+elemento;
           //se elimina el elemento
           $(element).parent().remove();
           
    }
     
    
    /*autor: eacevedo
     * 
     * Almacenar  elementos
     * 
     * Permite obtener los datos del filtro y mostrar la data respectiva
     * @Date created: 9/11/17

     */
   
   
    $(function(){
     $("#btn_enviar").click(function(){
        url: base_url+ 'cconsultores/mostrar_datos_consultores',
        $.ajax({
               type: "POST",
               url: url,
               data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
               success: function(data)
               {
                   // $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
               }
             });

           return false; // Evitar ejecutar el submit del formulario.
      });
});



    //   alert(consultores);
    //   alert(consultores.length);
    //   for (i=1;i<=consultores.length;i++){ 
    //     alert(consultores[i]);
    //     }
    
    // }

   function obtener_grafico(){
        
    }
    function obtener_pizza(){
        
    }
     </script>