     var variableGlobal;
           
          function myFunction(elmnt,clr) { 
           variableGlobal = clr;
              var idd = clr;
              console.log(variableGlobal);
               $.ajax({
                      type: "GET",
                      url: "api/verbanco.php?tabla=1&idu="+idd
                  }).done(function(json) 
                      {
                          json = $.parseJSON(json)
                              for(var i=0;i<json.length;i++)
                              {
                                  $('.editinplace').html(
                                      "<div class='col-xs-8'><ul class='list-unstyled' style='line-height: 2'><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Codigo:</span> <span style='font-size: 9pt; text-align: left;'>"+json[i].id+"</span></li><li><span class='text-success'><i class='fa fa-desktop'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Banco o Monedero:</span> <span  data-campo='bank_name_accounts' style='font-size: 9pt; text-align: left;'>"+json[i].nombre+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Tipo de Cuenta:</span> <span style='font-size: 9pt; text-align: left;' data-campo='tipe_accounts' >"+json[i].tipo+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>propietario de cuenta:</span> <span style='font-size: 9pt; text-align: left;' data-campo='name_accounts' >"+json[i].propietario+"</span></li><li><span class='text-success'><i class='fa fa-database'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Numero de cuenta:&nbsp; </span><a><span class='label label-primary'data-campo='num_accounts' >"+json[i].num+"</span></a></li><div style='margin-top: 8px; margin-bottom: 8px; width: 100%; height: 1px; background-color: #d9d9d9;'></div><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Email:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='mail_accounts' >"+json[i].email+"</span></li><li><span class='text-success'><i class='fa fa-building-o'></i></span> <span style='color: #acacac; font-size: 9pt; text-align: left;'>Numero de Identificacion:&nbsp;</span><span style='font-size: 9pt; text-align: left;' data-campo='ci_accounts' >"+json[i].ci+"</span></li></ul></div><div class='col-xs-4'><div class='well'><div style='color: #acacac; font-size: 9pt; text-align: center; padding: 0px; margin-bottom: 6px;'></div><span style='font-size: 9pt; text-align: left;' data-campo='imagen' ><img width='100%' src='./producto/banco.png'></span></br></div></div>");
                              }

                      });
          }




           
          function myFunction2(elmnt,clr) { 
           variableGlobal = clr;
              var idd = clr;
              console.log(variableGlobal);
               $.ajax({
                      type: "GET",
                      url: "api/verbanco.php?tabla=1&idu="+idd
                  }).done(function(json) 
                      {
                          json = $.parseJSON(json)
                              for(var i=0;i<json.length;i++)
                              {
                                  $('.editinplace2').html(
                                      "<div class='col-xs-12'><table class='editinplace2 table table-striped table-hover'><tr><td width='30%'><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Codigo: &nbsp; </td><td class='id'width='70%' >"+json[i].id+" </span></td></tr><tr><td width='30%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Banco o Monedero:</span></td><td class='editable' data-campo='name_bank_accounts' width='70%' ><span><a class='link'>"+json[i].nombre+"</a></span></td></tr><tr><td width='30%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Tipo de Cuenta:</span></td><td class='editable' data-campo='tipe_accounts' width='40%' ><span><a class='link'>"+json[i].tipo+"</a></span></td></tr><tr><td width='20%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Tipo de Propietario de cuenta:</span></td><td class='editable' data-campo='name_accounts' width='70%' ><span><a class='link'>"+json[i].propietario+"</a></span></td></tr><tr><td width='30%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>numero de cuenta:</span></td><td class='editable' data-campo='num_accounts' width='70%' ><span><a class='link'>"+json[i].num+"</a></span></td></tr><tr><td width='30%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Correo </span></td><td class='editable' data-campo='mail_accounts' width='80%' ><span><a class='link'>"+json[i].email+"</a></span></td></tr><tr><td width='30%' ><span class='text-success'></span><span style='color: #acacac; font-size: 9pt; text-align: left;'>Numero de Identificacion: </span></td><td class='editable' data-campo='ci_accounts' width='70%' ><span><a class='link'>"+json[i].ci+"</a></span></td></tr></table></div></div>");
                              }   
                              
                      });


                  var td,campo,valor,id;
                  $(document).on("click","td.editable span",function(e)
                  {
                      e.preventDefault();
                      $("td:not(.id)").removeClass("editable");
                      td=$(this).closest("td");
                      campo=$(this).closest("td").data("campo");
                      valor=$(this).text();
                      id=$(this).closest("table").find(".id").text();
                      td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
                  });
                  
                  $(document).on("click",".cancelar",function(e)
                  {
                      e.preventDefault();
                      td.html("<span><a class='link'>"+valor+"</a></span>");
                      $("td:not(.id)").addClass("editable");
                  });
                  
                  $(document).on("click",".guardar",function(e)
                  {
                      $(".mensaje").html("<img src='img/loading.gif'>");
                      e.preventDefault();
                      nuevovalor=$(this).closest("td").find("input").val();
                      if(nuevovalor.trim()!="")
                      {
                          $.ajax({
                              type: "POST",
                              url: "api/verbanco.php",
                              data: { campo: campo, valor: nuevovalor, id:id }
                          })
                          .done(function( msg ) {
                              $(".mensaje").html(msg);
                              td.html("<span><a class='link'>"+nuevovalor+"</a></span>");
                              $("td:not(.id)").addClass("editable");
                              setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 3000);
                          });
                      }
                      else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
                  });
          }

 function confirmDel(url){
//var agree = confirm("¿Realmente desea eliminarlo?");
if (confirm("¿Realmente desea eliminar esta Plataforma de pago?"))
    window.location.href = url;
else
    return false ;
}