<div class="wrapper"> 

    <?php $this->load->view('include/header') ?>
    <?php $this->load->view('include/menuLateral') ?>

    <!-- Bootstrap Core CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="<?php echo base_url(); ?>asset/jquery-ui.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>asset/style.css" rel="stylesheet">

    <!-- Page Content -->
    <div class="content-wrapper">
        <div class="row">

            <div class="col-md-3">
                <br/><br/><br/>
                <form action="<?php echo base_url('UsuariosController/alterarUsuario') ?>" method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario[0]->id ?>">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id ?>">

                    <div class="list-group">
                        <h3>Tipo de arquivo</h3>
                        <?php foreach($descricao_data->result_array() as $row){ ?>
                            <div class="list-group-item checkbox">
                                <label>
                                    <input type="checkbox" class="common_selector descricao" value="<?php echo $row['descricao']; ?>">
                                    <?php echo $row['descricao']; ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>

            <div class="col-md-9">
                <h2 align="center">Selecione o Tipo de Arquivo</h2>
                <br/>
                <div align="center" id="pagination_link"></div>
                <br/><br/><br/>
                <div class="row filter_data"></div>
            </div>

        </div>
    </div>

    <style>
        #loading {
            text-align: center;
            background: url('<?php echo base_url(); ?>asset/loader.gif') no-repeat center;
            height: 150px;
        }
    </style>

    <script>
        $(document).ready(function() {
            filter_data(1);

            function filter_data(page) {
                $('.filter_data')
                .css('opacity', '0.3')
                .html('<div id="loading"></div>');
                var action = 'fetch_data';
                var descricao = get_filter('descricao');
                var id = $("#id_usuario").val();

                $.ajax({
                    url: "<?php echo base_url(); ?>EnvioController/fetch_data/" + page,
                    method: "POST",
                    dataType: "JSON",
                    data: { action: action, descricao: descricao, id: id },
                    success: function(data) {
                        $('.filter_data').css('opacity', '1').html(data.product_list);

                        $('#pagination_link').html(data.pagination_link);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }

           $(document).on('click', '.pagination li a', function(event) {
             event.preventDefault();
            var page = $(this).data('ci-pagination-page');

            if (!page || page === '') return;

            $("html, body").animate({ scrollTop: 0 }, 200); // sobe a tela

            filter_data(page);
            });


            $('.common_selector').click(function() {
                filter_data(1);
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.download-link', function(e) {
                e.preventDefault();

                var link = $(this);
                var idArquivo = link.data('id');
                var arquivoUrl = link.data('arquivo');

                // Verifica se já foi visto (prevenção extra)
                if (link.data('visto') === 'S') {
                    window.open(arquivoUrl, '_blank');
                    return;
                }

                // Marca como visto (preventivamente)
                link.data('visto', 'S');

                // Abre o arquivo
                window.open(arquivoUrl, '_blank');

                // Chamada Ajax para marcar no banco
                var idUser = $('#id_usuario').val();

                $.ajax({
                    url: '<?= base_url("EnvioController/registrar_download") ?>',
                    method: 'POST',
                    data: { id_arquivo: idArquivo, id_user: idUser },
                    success: function() {
                        link.next('span').html('✅ Visto').css('color', 'green');
                    }
                });
            });
        });
    </script>
<style>
    /* Container centralizado */
    #pagination_link .pagination {
    justify-content: center !important;
    margin: 20px auto;
}

    /* Padrão de paginação moderno */
    .pagination li {
        display: inline-block;
        margin: 0 3px;
    }

    .pagination li a, .pagination li span {
        border-radius: 6px !important;
        padding: 8px 14px;
        text-decoration: none !important;
        border: 1px solid #ddd;
        color: #0056b3;
        background: #fff;
        transition: 0.2s;
        font-size: 14px;
    }

    /* Hover */
    .pagination li a:hover {
        background: #e8f1ff;
        border-color: #b8d6ff;
    }

    /* Página ativa */
    .pagination li.active span {
        background: #0056b3;
        border-color: #003f80;
        color: white !important;
        font-weight: bold;
    }

    /* Desabilitados */
    .pagination li.disabled span {
        color: #999 !important;
        border-color: #ddd !important;
        background: #f8f8f8 !important;
    }
</style>


</div> <!-- /wrapper -->
