
<div class="modal-dialog">
    
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Alterar Cargo</h4>
    </div>
    <div class="modal-body">
      <form action="<?php echo base_url() ?>ControlCargo/alterarCargoBanco" method="post" >
                                  	
         <div class="form-group">                 	
             <label for="nome">Nome Cargo:</label>
             <div class="input-group">
                 <div class="input-group-addon">
                    <i class="fa fa-users"></i>
                  </div>
                 <input type="text" name="nome" class="form-control" id="nome" placeholder="digite o nome" value="<?php echo $cargo[0]->nome ?>">
             </div>
         </div>	     
         <input type="hidden" name="idCargo" value="<?php echo $cargo[0]->idCargo ?>" id="idCargo"/>
         <div class="box-footer">
            <button type="submit" class="btn btn-primary">Alterar Cargo</button>
          </div>            
    
    	</form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
  
</div>


   