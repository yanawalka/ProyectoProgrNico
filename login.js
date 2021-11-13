$('#formLogin').submit(function(e){             
          
    e.preventDefault(); 
    var usuario = $.trim($("#usuario").val());
    var clave = $.trim($("#clave").val());
    
    if(usuario.length == "" || clave == ""){
        Swal.fire({
          type: 'warning',
          title: 'Ingrese Usuario y/o clave',                            
        }); 
        return false;
    }else{    

        $.ajax({
          url:"bd/logica_login.php",
          type:"POST",    
          datatype:"json",    
          data:  {usuario:usuario, clave:clave},    
          success: function(data) {


              if(data == "null"){
 
                  Swal.fire({
                      type: 'error',
                      title: 'Usuario y/o clave incorrectas',                          
                    });                    

              }else{           

                  Swal.fire({
                      type: 'success',                          
                      title: '¡Conexión exitosa!',                                                
                      confirmButtonColor: '#3085d6',                          
                      confirmButtonText: 'Ingresar'
                    }).then((result) => {
                      if (result.value) {
                          window.location.href = "vistas/paginas/pag_inicio.php";                          
                      }
                    })                                                               
              }
           }
        });			            
    }
});
