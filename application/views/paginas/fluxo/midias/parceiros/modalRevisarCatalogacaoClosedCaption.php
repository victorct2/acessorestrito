<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <form action="<?php echo base_url('RevisaoClosedCaptionController/cadastrarRevisaoCatalogacao') ?>" method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>        
        <?php $programa =  $this->parceirosDao->selectProgramaParceiroById($ingest[0]->idPrograma)?>
        <img src="<?php echo IMAGEM_PROGRAMA_PARCEIRO.$programa[0]->imagem?>" class="img-thumbnail imgProgramaParceiro" width="160" height="100" />
        <hr />
        <h4 class="modal-title">Revisar Catalogacao Closed Caption <i class="fa fa-cc" aria-hidden="true"></i> -  <?php echo $ingest[0]->tituloPrograma?></h4>
        
      </div>
      <div class="modal-body">
          
          <?php if($ingest[0]->observacao != ''){ ?>
              <div class="panel panel-warning">
                <div class="panel-heading">Observações</div>
                <div class="panel-body">
                  <h4 class="media-heading"><?php echo $ingest[0]->observacao ?> </h4>										    
                </div>
              </div>
          <?php } ?>  
              
          <div class="panel panel-default">
            <div class="panel-heading">Revisão de Catalogação deClosed Caption:</div>
            <div class="panel-body">
              <div class="form-group">
                  <label for="closedCaption"  class="control-label">Aprovação do Closed Caption <i class="fa fa-cc" aria-hidden="true"></i>:</label><br>
                  <div class="col-sm-6">
                    <select name="closedCaption" class="form-control closedCaption">
                        <option>Selecione --></option>
                        <option value="APROVADO">Aprovado</option>
                        <option value="REPROVADO">Reprovado</option>
                    </select>
                  </div>
              </div>
              <br><br>
              <div class="form-group observacaoClosedCaption">
                  <label for="prazo"  class="control-label">Observação do Closed Caption <i class="fa fa-cc" aria-hidden="true"></i>:</label><br>
                  <div class="col-sm-6">
                    <textarea name="obs_closedCaption" class="form-control" rows="3"></textarea>
                  </div>
              </div>
            </div>
          </div>						
             
            
          <input type="hidden" name="idIngestParceiro" value="<?php echo $ingest[0]->idIngestParceiro ?>"/>
			  	<input type="hidden" name="idParceiros" value="<?php echo $ingest[0]->parceiro_id ?>"/>
			  	<input type="hidden" name="idIngest" value="<?php echo $ingest[0]->idIngest ?>" />
			  	<input type="hidden" name="tipoFluxo" value="M"/> 
			  	<input type="hidden" name="tipoIngest" value="P"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Cadastrar Revisão Closed Caption</button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
