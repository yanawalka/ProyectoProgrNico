$('#formRegistro').submit(function(e){                        
    e.preventDefault(); 
    var nombre = $.trim($("#nombre").val());
    var usuario = $.trim($("#usuario").val());
    var email = $.trim($("#email").val());
    var clave = $.trim($("#clave").val());
    if(usuario.length == "" || nombre == "" || email == "" || clave == ""){
        Swal.fire({
          type: 'warning',
          title: 'Llene todos los campos',                          
        }); 
        return false;
    }else{    
        $.ajax({
          url:"../../bd/logica_registro.php",
          type:"POST",    
          datatype:"json",    
          data:  {usuario:usuario, nombre:nombre, email:email, clave:clave },    
          success: function(data) {          

                  Swal.fire({
                      type: 'success',                          
                      title: '¡Cuenta registrada!',                                                
                      confirmButtonColor: '#3085d6',                          
                      confirmButtonText: 'Correcto'
                    }).then((result) => {
                      if (result.value) {
                          window.location.href = "../../index.php";                          
                      }
                    })                                                               

           }
        });			            
    }
});
