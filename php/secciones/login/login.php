
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Inicio de sesion</h4>
                                    <form id="login" action="<?php send("login") ?>" method="POST">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>NoDocumento</strong></label>
                                            <input name="username" type="number" class="form-control" value="12345">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Contraseña</strong></label>
                                            <input type="password" name="password" class="form-control" value="admin">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox ml-1">
                                                    <input type="checkbox"  class="custom-control-input" id="basic_checkbox_1">
                                                    <!-- <label class="custom-control-label" for="basic_checkbox_1">Remember my preference</label> -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="forgot-password.php">Olvidé mi Contraseña</a>
                                            </div>
                                        </div>
                                        <div class="textError text-center d-none">
                                            <p>USUARIO o CONTRASEÑA incorrecta</p>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <!-- <p>Don't have an account? <a class="text-primary" href="./page-register.html">Sign up</a></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>