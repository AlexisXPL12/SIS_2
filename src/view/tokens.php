<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="page-title-box d-flex align-items-center justify-content-between p-0">
                    <h4 class="mb-0 font-size-18">Mis Tokens API</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista de Tokens</h4>
                <div id="tablas"></div>
            </div>
        </div>
    </div>
</div>
<div id="modals_editar"></div>
<!-- Incluir el archivo JS externo -->
<script src="<?php echo BASE_URL; ?>src/view/js/functions_tokens.js"></script>
<script>
    // Llamar a la función para listar tokens al cargar la página
    listarTokens();
</script>
<!-- end page title -->
