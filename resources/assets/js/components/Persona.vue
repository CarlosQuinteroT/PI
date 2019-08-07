<template>
            <div class="content">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> PERSONAS 
                      <div style="float:right;">
                        
                        <button type="button" @click="abrirModal('persona', 'registrar')" class="btn btn-primary btn-round">
                            <i class="icon-plus"></i>&nbsp;Nueva persona
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
                                      <option value="nombre">Nombre</option>
                                      <option value="telefono">Apellido Paterno</option>
                                      <option value="estado">Apellido Materno</option>
                                    </select>
                                    <input  type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control ml-4 " style="height:40px; border-top:0px; border-right:0px;" placeholder="Texto a buscar">
                                    <button type="submit" style="border-radius:50px;" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary mt-1 ml-2"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <tr>
                                    
                                    <th>NOMBRE</th>
                                    <th>APELLIDO PATERNO</th>
                                    <th>APELLIDO MATERNO</th>
                                    <th>DIRECCION</th>
                                    <th>TEELEFONO</th>
                                    <th>EMAIL</th>
                                    <th>CONDICION</th>
                                    <th>OPCIONES</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arrayPersona" :key="persona.idPersona">
                                   
                                    <td v-text="persona.nombre"></td>
                                    <td v-text="persona.apellidoPaterno"></td>
                                    <td v-text="persona.apellidoMaterno"></td>
                                    <td v-text="persona.direccion"></td>
                                    <td v-text="persona.telefono"></td>
                                    <td v-text="persona.email"></td>
                                                         
                                    <td>
                                        <div v-if="persona.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                     <td>
                                        <button type="button" style="border-radius:30px;" class="btn btn-warning btn-sm">
                                          <i @click="abrirModal('persona', 'actualizar', persona)" class="icon-pencil"></i>
                                        </button> &nbsp;
                                       
                                        <template v-if="persona.condicion">
                                            <button type="button" @click="desactivarPersona(persona.idPersona)" style="border-radius:30px;" class="btn btn-danger btn-sm">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                         <template v-else>
                                            <button type="button" @click="activarPersona(persona.idPersona)" style="border-radius:30px;" class="btn btn-info btn-sm">
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
                                    <h5 v-text="nombre" class="title"></h5>
                                  </a>
                                  <p v-text="email" class="description"></p>
                                </div>
                                <p v-text="direccion" class="description text-center"></p>
                                <p v-text="telefono" class="description text-center"></p>
                              </div>
                              <div class="card-footer">
                                <hr>
                                <div class="button-container">
                                  
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
                                          <label></label>
                                          <input type="text" v-model="nombre" class="form-control sin"  placeholder="Nombre">
                                        </div>
                                      </div>
                                      <div class="col-md-3 px-1">
                                        <div class="form-group">
                                          <label></label>
                                          <input type="text" v-model="telefono" class="form-control sin" placeholder="Telefono" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                      </div>
                                      <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                          <label for="exampleInputEmail1"></label>
                                          <input type="email" v-model="email" class="form-control sin" placeholder="Email" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                          <label></label>
                                          <input type="text" v-model="apellidoPaterno" class="form-control sin" placeholder="Apellido paterno">
                                        </div>
                                      </div>
                                      <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                          <label></label>
                                          <input type="text" v-model="apellidoMaterno" class="form-control sin" placeholder="Apellido materno" >
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label></label>
                                          <input type="text" v-model="direccion" class="form-control sin" placeholder="Direccion">
                                        </div>
                                      </div>
                                      
<!--                                       <div class="col-md-12">
                                        <div class="form-group">
                                          <label>Selecciona foto de perfil</label>
                                          <input type="file" :name="imagen" class="form-control">
                                        </div>
                                      </div> -->
                                     
                                    </div>
                                    
                                      
                         <div class="row">
                              <div class="update ml-auto mr-auto">
                                <button type="button"  v-if="tipoAccion==1" class="btn btn-primary btn-round" @click="registrarPersona()">Registrar</button>
                                <button type="button"  v-if="tipoAccion==2" class="btn btn-primary btn-round" @click="actualizarPersona()">Actualizar</button>
                              </div>                       
                         </div>
                          <div v-show="errorPersona" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMensajesPersona" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>                         
                   </form>
              </div>
            </div>
          </div>
         </div>
       </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary"       @click="cerrarModal()">Cerrar</button>
              </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </div>
</template>

<script>
    export default {
        data (){
          //                 variables que se usan para almacenar la informacion 
            return {
                persona_id : 0,
                email : 0,
                nombre : '',
                apellidoPaterno : '',
                apellidoMaterno : '',
                direccion : '',
                telefono : '',
                imagen : '',
                arrayPersona : [],
                imagenMiniatura : '',
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMensajesPersona : [],
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
                criterio : 'nombre',
                buscar : ''
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
          listarPersona (page, buscar, criterio){
                 let me=this;
                 var url = '/persona?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                 axios.get(url).then(function (response){
                     var respuesta=response.data;
                     me.arrayPersona = respuesta.personas.data;
                     me.pagination=respuesta.pagination;
                 })
                .catch(function (error){
                       console.log(error);         
               });
          },
          //           CAMBIA LA PAGINA DENTRO DE LA TABLA PARA MOSTRAR LOS DEMAS REGISTROS
          cambiarPagina(page, buscar, criterio){
              let me = this;
              //Actualiza la pagina actual
              me.pagination.current_page = page;
              //Envia la peticion para visualizar la data de esa pagina 
              me.listarPersona(page, buscar, criterio);
          },
          //           METODO QUE SIRVE PARA REGISTRAR
          registrarPersona(){
            console.log(this.imagen);
            if(this.validarPersona()){
              return;
            }
            
            let me = this;
            axios.post('/persona/registrar', {
              'nombre' : this.nombre,
              'apellidoPaterno' : this.apellidoPaterno,
              'apellidoMaterno' : this.apellidoMaterno,
              'direccion' : this.direccion,
              'telefono' : this.telefono,
              'email' : this.email,
              'imagen' : this.imagen
            }).then(function (response){
                me.cerrarModal();
                me.listarPersona(1, '', 'nombre');
              
            }).catch(function (error){
                   console.log(error.response);         
           });
            
          },
          //           SIRVE PARA ACTUALIZAR EN LA BD AL ID QUE SE MANDA
          actualizarPersona(){
                if(this.validarPersona()){
                  return;
                }

                let me = this;
                axios.put('/persona/actualizar', {
                  'nombre' : this.nombre,
                  'apellidoPaterno' : this.apellidoPaterno,
                  'apellidoMaterno' : this.apellidoMaterno,
                  'direccion' : this.direccion,
                  'telefono' : this.telefono,
                  'email' : this.email,
                  'imagen' : this.imagen,
                  'idPersona' : this.persona_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarPersona(1,'', 'nombre');

                }).catch(function (error){
                       console.log(error);         
               });

          },
          //           SIRVE PARA DESACTIVAR UN REGISTRO
          desactivarPersona(idPersona){
                swal({
                title: 'Esta seguro de desactivar esta persona?',
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

                    axios.put('/persona/desactivar',{
                        'idPersona': idPersona
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'La persona ha sido desactivado con éxito.',
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
           activarPersona(idPersona){
                 swal({
                title: 'Esta seguro de activar esta persona?',
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

                    axios.put('/persona/activar',{
                        'idPersona': idPersona
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
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
          
         /* validarSiNumero(numero){
            if (!/^([0-9])*$/.test(numero))
            alert("El valor " + numero + " no es un número");
          },*/
          //           SIRVE PARA VALIDAR LOS DATOS INGRESADOS EN EL MODAL
          validarPersona(){
            this.errorPersona = 0;
            this.errorMostrarMensajesPersona = [];
            
            if(!this.nombre){
              this.errorMostrarMensajesPersona.push("El nombre de la persona no puede estar vacio");
            }
            if(this.errorMostrarMensajesPersona.length){
              this.errorPersona = 1;
            }
            
            return this.errorPersona;
          },
          //           SIRVE PARA CERRAR EL MODAL
          cerrarModal(){
            this.modal = 0;
            this.tituloModal = '';
            this.nombre = '';
            this.apellidoMaterno = '';
            this.apellidoPaterno = '';
            this.direccion = '';
            this.telefono = '';
            this.email = '';
            this.imagen = '';
          },
          //           SIRVE PARA ABRIR EL MODAL
          abrirModal(modelo, accion, data = []){
              switch(modelo){
                case "persona":
                  {
                    switch(accion)
                    {
                      case "registrar":
                      {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Persona'
                        this.nombre = '';
                        this.apellidoPaterno = '';
                        this.apellidoMaterno = '';
                        this.telefono = '';
                        this.direccion = '';
                        this.email = '';
                        this.imagen = '';
                        this.tipoAccion = 1;
                        break;
                      }              
                      case "actualizar":
                      {
                          this.modal = 1;
                          this.tituloModal = 'Actualizar Persona';
                          this.tipoAccion = 2;
                          this.nombre = data['nombre'];
                          this.apellidoPaterno = data['apellidoPaterno'];
                          this.apellidoMaterno = data['apellidoMaterno'];                         
                          this.telefono = data['telefono'];
                          this.direccion = data['direccion'];
                          this.email = data['email'];
                          this.imagen = data['imagen'];
                          this.persona_id = data['idPersona'];
                          break;
                      }
                    }
                  }
              }
          },
  
        },
        
        mounted() {
            this.listarPersona(1, this.buscar, this.criterio);
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
