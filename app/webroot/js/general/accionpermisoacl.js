$(document).ready(function(){
var link = new Array() ;

//Buscamos todos las acciones excepto los de paginador
$('#contenido').find("a:not([href *= 'page'])").each(function(i){    
    url = $(this).attr("href");
    if(url == 'javascript:;'){
         url = $(this).attr("onclick").toString();
         inicio = url.search('/');
         fin =   url.length;
         url = url.substr(inicio,fin);       
         fin = url.search('"');
         url = url.substr(0,fin);         
    }
    base = $('base').attr('href');
    url = url.replace(base , "");    
        
    controlador = url.substr(0,url.search('/'));
    accion = url.replace(controlador+'/', "");    
    valor = accion.search('/');    
    if( valor > 0){
        fin = accion.search('/');        
        accion = accion.substr(0,fin);

        fin = controlador.length + accion.length + 1;
        url = url.substr(0,fin );
    }
    link[i] = url;    
});
    //Realizamos un distinct para disminuir la carga en el momento de preguntar por los permisos y no repetir
        var newArray=new Array();
        label:for(var i=0; i<link.length;i++ )
        {  
          for(var j=0; j<newArray.length;j++ )
          {
            if(newArray[j]==link[i]) 
            continue label;
          }
          newArray[newArray.length] = link[i];
        }
   
    //Damos formato json para enviar al servidor
    var myJSONObject = {};
    for(var i=0; i<newArray.length; i++) {
        var value = newArray[i];
        controlador = value.substr(0,value.search('/'));
        accion = value.replace(controlador+'/', "");
        rol = $('base').attr('permisorol');
        myJSONObject["data[acl]["+i+"][controlador]"]= controlador; 
        myJSONObject["data[acl]["+i+"][accion]"]= accion; 
        myJSONObject["data[acl]["+i+"][rol]"]= rol;              
    } 
    
    //Enviamos al servidor
    var url = $.url('/secaccesses/permiso/'); 
    $.post(url , myJSONObject,
    function(data){   
        //console.info(data);
        data= JSON.parse(data);
        //console.info(data);
        $.each(data.acl, function(entryIndex, value){
            
            var controller = value.controlador;
            var action = value.accion;
            var permiso = value.permiso;
            
            //De acuerdo a la respueta ocultamos a los que el usuario no tenga permiso
            $('#contenido').find("a:not([href *= 'page'])").each(function(i){    
                 url = $(this).attr("href");
                if(url == 'javascript:;'){
                     url = $(this).attr("onclick").toString();
                     inicio = url.search('/');
                     fin =   url.length;
                     url = url.substr(inicio,fin);       
                     fin = url.search('"');
                     url = url.substr(0,fin);         
                }
                base = $('base').attr('href');
                url = url.replace(base , "");    
        
                controlador = url.substr(0,url.search('/'));
                accion = url.replace(controlador+'/', "");    
                valor = accion.search('/');    
                if( valor > 0){
                   fin = accion.search('/');        
                    accion = accion.substr(0,fin);
                    fin = controlador.length + accion.length + 1;
                    url = url.substr(0,fin );
                }

                if(controlador == controller && accion == action && permiso == 0)            
                   $(this).remove();
            })
            
            
        })
   });

})