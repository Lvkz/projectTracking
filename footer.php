            <footer>
                <p>2014 © Aguacat Development.</p>
            </footer>

            <a id="btn-scrollup" class="btn btn-circle btn-large" href="#"><i class="icon-chevron-up"></i></a>
        </div>
        <!-- END Content -->
    </div>
    <!-- END Container -->


    <!--basic scripts-->
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>-->
    <script>window.jQuery || document.write('<script src="assets/jquery/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <script src="assets/nicescroll/jquery.nicescroll.min.js"></script>

    <!--page specific plugin scripts-->
    <script type="text/javascript" src="assets/chosen-bootstrap/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
    <script type="text/javascript" src="assets/jquery-tags-input/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="assets/clockface/js/clockface.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>
    <script type="text/javascript" src="assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
    <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
    <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script> 

    <!--flaty scripts-->
    <script src="js/flaty.js"></script>
    <script src="js/custom.js"></script>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <form class="form-horizontal" method="post" action="cambiarContrasenia.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Cambio de Contraseña</h4>
                    </div>
                    <div class="modal-body">
                        <div class="control-group">
                            <label for="contrasenia_actual" class="control-label">Contrasenia Actual: </label>
                            <div class="controls">
                                <input type="password" class="input-large" id="contrasenia_actual" name="contrasenia_actual"/>
                            </div>
                        </div>

                         <div class="control-group">
                            <label for="nueva_contrasenia" class="control-label">Nueva Contrasenia: </label>
                            <div class="controls">
                                <input type="password" class="input-large" id="nueva_contrasenia" name="nueva_contrasenia"/>
                            </div>
                        </div>

                         <div class="control-group">
                            <label for="confirmacion_contrasenia" class="control-label">Repetir Contrasenia: </label>
                            <div class="controls">
                                <input type="password" class="input-large" id="confirmacion_contrasenia" name="confirmacion_contrasenia"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-default" data-dismiss="modal">Close</a>
                        <button class="btn btn-primary" type="submit">Procesar Cambio</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
