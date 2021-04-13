<?php
require '../admin/frmHeader.php';
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Capacitaciones de: <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                          
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                      <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Colaborador</th>
                            <th>Capacitacion</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                           <th>Opciones</th>
                            <th>Colaborador</th>
                            <th>Capacitacion</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                     <div class="panel-body" style="height:400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <input type="hidden" name="id_col" id="id_col">
                            <label>Colaborador:</label>
                            <select  id="idcolaborador"  name="idcolaborador" class="form-control selectpicker" data-live-search="true" maxlength="256"></select>   
                          </div> 
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Capacitacion:</label>
                            <select id="idcapacitacion" name="idcapacitacion" class="form-control selectpicker" data-live-search="true" maxlength="256"></select>
                          </div>  
                       <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                            
                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                              </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  
<?php

require '../admin/frmFooter.php';
  
?>
  <script src="../scripts/capacitacioncolaborador.js" type="text/javascript"></script>
