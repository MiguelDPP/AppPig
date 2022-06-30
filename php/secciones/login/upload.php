

<div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">S<span class="text-color">Q</span>L</h4>
                                    <form id="login-sql" action="<?php send("upload") ?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Usuario</strong></label>
                                                <input id="username" class="form-control" name="username" type="text" placeholder="root">
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-1"><strong>Contraseña</strong></label>
                                                <input id="password" class="form-control" name="password" type="password" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="sql" id="sql" accept=".sql">
                                            </div>
                                            <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Cargar SQL</button>
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

