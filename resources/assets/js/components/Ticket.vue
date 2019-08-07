<template>
            <div class="content">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
          <i class="fa fa-align-justify"></i> TICKETS 
                      <div style="float:right;">
            <button type="button" @click="abrirModal('ticket', 'registrar')" class="btn btn-primary btn-round">
              <i class="icon-plus"></i>&nbsp;Nuevo ticket
                        </button>                                       
                        <button type="button" class="btn btn-info btn-round">
                            <i class="icon-doc"></i>&nbsp;Reporte
                        </button>                        
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">   
                                    <select style="border-top:0px; border-right:0px; border-left:0px;" class="form-control col-md-3" v-model="criterio">
                                      <option value="descripcion">Descripcion</option>
                                      
                                    </select>
                                  <input  type="text" v-model="buscar" @keyup.enter="listarTicket(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarTicket(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    <th>NOMBRE DE LA PERSONA</th>
                                    <th>ASUNTO</th>
                                    <th>DESCRIPCION</th>
                                    <th>FECHA Y HORA</th>
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                              <tr v-for="ticket in arrayTicket" :key="ticket.idTicket">
                                   
                                    <td v-text="ticket.nombre"></td>
                                    <td v-text="ticket.asunto"></td>
                                    <td v-text="ticket.descripcion"></td>
                                    <td v-text="ticket.fecha_y_hora"></td>
                                    <td>
                                              <div v-if="ticket.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                     <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                                      <i @click="abrirModal('ticket', 'actualizar', ticket)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="ticket.condicion">
                                            <button type="button" @click="desactivarTicket(ticket.idTicket)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" @click="activarTicket(ticket.idTicket)" style="border-radius:30px;" class="btn btn-info btn-sm">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                        <nav>
                         <br>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1" >
                                    <a class="page-link" style="border-radius:30px;" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)" >Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" style="border-radius:30px;" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" style="border-radius:30px;" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
              
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                          <div class="row">
                     <div class="col-md-4">
                       
                       <div class="card card-user">
                           <div class="image">                               
                             <img src="admin/assets/img/fondo1.jpg" alt="">
                           </div>
                           <div class="card-body">
                             <div class="author">
                               <a href="#">
                                 <img class="avatar border-gray" src="admin/assets/img/default-avatar.png" alt="...">
                                 <h5  v-for="personaa in arrayInfoPersona" v-text="personaa.nombre" class="title"></h5>
                               </a>
                               <p v-for="personaa in arrayInfoPersona" v-text="personaa.email" class="description"></p>
                             </div>
                             <p v-for="personaa in arrayInfoPersona" v-text="personaa.direccion" class="description text-center"></p>
                             <p v-for="personaa in arrayInfoPersona" v-text="personaa.telefono" class="description text-center"></p>
                           </div>
                           <div class="card-footer">
                             <hr>
                             <div class="button-container">
                               <h5 align="center" class="title">Persona</h5>
                             </div>
                           </div>
                       </div>
                    </div>
                            
                 <div class="col-md-8">
                      <div class="card card-user">
                          <div class="card-header">
                              <h5  v-text="tituloModal" class="card-title"></h5>
                          </div>
                        <div class="card-body">
                          
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-5 pr-1">
                                      <div class="form-group">
                                        <label for="text-input">Persona</label>
                                          <select class="form-control sin" v-model="idPersona" name="" id="" @change="selectInfoPersona($event)">
                                              <option value="0" disabled>Seleccione</option>
                                              <option v-for="persona in arrayPersona" :key="persona.idPersona" :value="persona.idPersona" v-text="persona.nombre"></option>
                                          </select>
                                      </div>
                                    </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                          <label for="text-input"></label>
                                          <input type="text" v-model="asunto" class="form-control sin" placeholder="Asunto">
                                        </div>
                                      </div>
                                 </div>
                              <div class="row">
                                      &nbsp&nbsp <div class="col-md-11 pl-1">
                                        <div class="form-group">
                                         &nbsp&nbsp  <label for="text-input"></label>
                                          <input type="text" v-model="descripcion" class="form-control sin" placeholder="Descripcion">
                                        </div>
                                      </div>
                              </div>
                              <div class="row">
                                      &nbsp&nbsp<div class="col-md-4 pl-1">
                                        <div class="form-group">
                                          &nbsp&nbsp<label for="text-input">Fecha y hora</label>
                                          <input type="date" v-model="fecha_y_hora" class="form-control sin" value="<?php echo date();?>">
                                        </div>
                                      </div>
                                </div>
                              
                 <div class="row">
                       <div class="update ml-auto mr-auto">
                               <button type="button"  v-if="tipoAccion==1" class="btn btn-primary btn-round" @click="registrarTicket()">Registrar</button>
                               <button type="button"  v-if="tipoAccion==2" class="btn btn-primary btn-round" @click="actualizarTicket()">Actualizar</button>
                             </div> 
                 </div>
                               <div v-show="errorTicket" class="form-group row div-error">
                                    <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMensajesTicket" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        
                        </div>
                    <!-- /.modal-content -->
                        </div>
                <!-- /.modal-dialog -->
                        </div>
            <!--Fin del modal-->
                        </div>
        <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
        </div>
                      
     </div> 
 </div>
</div>

</div>
</template>

<script>
    export default {
        data (){
          //                 variables que se usan para almacenar la informacion 
            return {
                ticket_id : 0,
                idPersona : 0,
                asunto : '',
                descripcion : '',
                fecha_y_hora : '',
                arrayTicket : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorTicket : 0,
                errorMostrarMensajesTicket : [],
                pagination : 
                {
                    'total'        : 0,
                    'current_page' : 0,
                    'per_page'     : 0,
                    'last_page'    : 0,
                    'from'         : 0,
                    'to'           : 0,
                },
                offset : 3,
                criterio : 'descripcion',
                buscar : '',
                arrayPersona : [],
                arrayInfoPersona : []
            }
        },
     //PROPIEDADES COMPUTADAS 
        computed:{
            isActived: function(){
              return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                  return [];
                }
                //variable offset
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                
                //VARIABLE TO
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
               //VARIABLE PAGESARRAY
                var pagesArray = [];
                while(from <= to){
                  pagesArray.push(from);
                  from++;
                }
                return pagesArray;
            }
        },
      
        //METODOS
        methods : {
          //             METODO QUE SIRVE PARA LISTAR TODOS LOS REGISTROS QUE HAY EN LA TABLA
          listarTicket (page, buscar, criterio){
                 let me=this;
                 var url = '/ticket?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayTicket = respuesta.tickets.data;
                     me.pagination=respuesta.pagination;
                 })
                .catch(function (error){
                       console.log(error.response);         
               });
          },
          //           METODO QUE SIRVE PARA MOSTRAR LAS PERSONAS DENTRO DE UN SELECT
          selectPersona(){
                let me=this;
                 var url = '/persona/selectPersonas';
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayPersona = respuesta.personas;
//                      me.pagination=respuesta.pagination;
                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
          //           METODO UTILIZADO PARA MOSTRAR LA INFORMACION EN EL MODAL, ESTA INFORMACION ES LA DE LAS PERSONAS Y SE ,MUESTRA EN BASE A LA PERSONA QUE HA SIDO SELECCIONADA 
          selectInfoPersonaUp(id){
                console.log(id);
                let me = this;
                axios.put('/persona/selectInfoPersona', {
                  'idPersona' : id
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayInfoPersona = respuesta.personas;
                   console.log(me.arrayInfoPersona);
                }).catch(function (error){
                       console.log(error);         
               });
          },
          //           SIRVE PARA MOSTRAR LA INFORMACION AL MOMENTO DE SELECCIONAR UNA OPCION DENTREO DE UN SELECT 
           selectInfoPersona(event){
                console.log(event.target.value);
                let me = this;
                axios.put('/persona/selectInfoPersona', {
                  'idPersona' : event.target.value
                }).then(function (response){
                   var respuesta=response.data;
                   me.arrayInfoPersona = respuesta.personas;
                   
                   
                }).catch(function (error){
                       console.log(error);         
               });
          },
          //           CAMBIA LA PAGINA DENTRO DE LA TABLA PARA MOSTRAR LOS DEMAS REGISTROS
          cambiarPagina(page, buscar, criterio){
              let me = this;
              //Actualiza la pagina actual
              me.pagination.current_page = page;
              //Envia la peticion para visualizar la data de esa pagina 
              me.listarTicket(page, buscar, criterio);
          },
          //           METODO QUE SIRVE PARA REGISTRAR
          registrarTicket(){
            
            if(this.validarTicket()){
              return;
            }
            
            let me = this;
            axios.post('/ticket/registrar', {
              'idPersona' : this.idPersona,
              'asunto' : this.asunto,
              'descripcion' : this.descripcion,
              'fecha_y_hora' : this.fecha_y_hora
            }).then(function (response){
                me.cerrarModal();
                me.listarTicket(1, '', 'descripcion');
              
            }).catch(function (error){
                   console.log(error);         
           });
            
          },
          //           SIRVE PARA ACTUALIZAR EN LA BD AL ID QUE SE MANDA
          actualizarTicket(){
                if(this.validarTicket()){
                  return;
                }

                let me = this;
                axios.put('/ticket/actualizar', {
                  'idPersona' : this.idPersona,
                  'asunto' : this.asunto,
                  'descripcion' : this.descripcion,
                  'fecha_y_hora' : this.fecha_y_hora,
                  'idTicket' : this.ticket_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarTicket(1,'', 'descripcion');

                }).catch(function (error){
                       console.log(error);         
               });

          },
          //           SIRVE PARA DESACTIVAR UN REGISTRO
          desactivarTicket(idTicket){
                swal({
                title: 'Esta seguro de desactivar este registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/ticket/desactivar',{
                        'idTicket': idTicket
                    }).then(function (response) {
                        me.listarTicket(1,'','descripcion');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
          },
          //           SIRVE PARA ACTIVAR UN REGISTRO
           activarTicket(idTicket){
                 swal({
                title: 'Esta seguro de activar este registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/ticket/activar',{
                        'idTicket': idTicket
                    }).then(function (response) {
                        me.listarTicket(1,'','descripcion');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
          },
          //           SIRVE PARA VALIDAR LOS DATOS INGRESADOS EN EL MODAL
          validarTicket(){
            this.errorTicket = 0;
            this.errorMostrarMensajesTicket = [];
            
            if(!this.idPersona){
              this.errorMostrarMensajesTicket.push("El ID de la persona no puede estar vacio");
            }
            if(!this.asunto){
              this.errorMostrarMensajesTicket.push("El asunto no puede estar vacio");
            }
            if(!this.descripcion){
              this.errorMostrarMensajesTicket.push("La descripcion no puede estar vacia");
            }
            
            
            if(this.errorMostrarMensajesTicket.length){
              this.errorTicket = 1;
            }
            
            return this.errorTicket;
          },
          //           SIRVE PARA CERRAR EL MODAL
          cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.idPersona = '';
            this.estado = '';
          },
          //           SIRVE PARA ABRIR EL MODAL
          abrirModal(modelo, accion, data = []){
              switch(modelo){
                case "ticket":
                  {
                    switch(accion)
                    {
                      case "registrar":
                      {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Ticket'
                        this.idPersona = '';
                        this.asunto = '';
                        this.descripcion = '';
                        this.fecha_y_hora = '';
                        this.tipoAccion = 1;
                        break;
                      }              
                      case "actualizar":
                      {
                          this.modal = 1;
                          this.tituloModal = 'Actualizar Contacto';
                          this.tipoAccion = 2;
                          this.idPersona = data['idPersona'];
                          this.asunto = data['asunto'];
                          this.descripcion = data['descripcion'];
                          this.fecha_y_hora = data['fecha_y_hora'];
                          this.ticket_id = data['idTicket'];
                          break;
                      }
                    }
                  }
              }
            this.selectPersona();
            this.selectInfoPersonaUp(this.idPersona);
          }
        },
        
        mounted() {
            this.listarTicket(1, this.buscar, this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
   .sin{
        border-top:0px;
        border-right:0px;
        border-left:0px;
  }
</style>
