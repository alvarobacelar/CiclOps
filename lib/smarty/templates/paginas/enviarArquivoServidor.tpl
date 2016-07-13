<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Enviar arquivo para Deploy</h2>
    </div>

    <div class="panel-body">

        <nav class="text-center">
            <ul class="pagination">
                <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">1º Escolher Servidor</span></a></li>
                <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
                <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">2º Escolher Sistema </span></a></li>
                <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
                <li class="active"><a >3º Enviar arquivo <span class="sr-only">(current)</span></a></li>
                <li class="disabled"><span aria-hidden="true"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></span></li>
                <li class="disabled"><a  aria-label="Previous"><span aria-hidden="true">4º Iniciar Deploy</span></a></li>
            </ul>
        </nav>

        <div class="alert alert-info text-center" role="alert">
            <p>
                Enviar arquivo <i><strong>*.war</strong></i> para o servidor local do ciclops <small><i> ({$resSistema->nome_sistema})</i></small>
            </p>
        </div>

        {$erroCadastro}
        <form enctype="multipart/form-data" {*action="includes/controllers/enviarArquivoServdiorControl.php"*} method="post" id="formEnviaWar" name="formEnviaWar"  class="form-horizontal" role="form">
            <fieldset>
                <legend>Envio de arquivo para o servidor local</legend>
                <input type="hidden" id="servidor" name="servidor" value="{$servidor}">
                <input type="hidden" id="sistema" name="sistema" value="{$sistema}">
                <input type="hidden" id="userSistema" name="userSistema" value="{$resSistema->id_usuarios_servidor}">
                <div class="row form-group">
                    <label class="col-sm-3 control-label" for="versaoArquivo">Versão do arquivo</label>
                    <div class="col-sm-3">
                        <input class="form-control" type="text" id="versaoArquivo" name="versaoArquivo" required="" placeholder="EX: 3.22.1.1">

                    </div>                
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="fileWar">Escolher arquivo</label>
                    <div class="col-sm-6">
                        <input type="file" title="Arquivo war" class="btn btn-default" id="fileWar" name="fileWar" required="">
                    </div> 
                </div>

                {*<div class="row form-group">
                <label class="col-sm-3 control-label" for="textObsFile"> Observações</label>
                <div class="col-sm-4">
                <textarea class="form-control" id="textObsFile" name="textObsFile" placeholder="Observações do arquivo (opcional)" rows="3"></textarea>
                </div>                
                </div> *}
                <h4 class="text-info"><small>Progresso de envio do arquivo para o servidor local</small></h4>
                <progress class="progress" value="0" max="100"></progress><span id="porcentagem"></span>
                <h4 class="text-info"><small>(Apos enviar para o servidor local do CiclOps o sistema enviará automaticamente para o servidor do {$resSistema->nome_sistema})</small></h4>
                <br>

                <div id="resposta"></div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <input type="button" id="btnEnviar" class="btn btn-success" value="Enviar arquivo">
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
    <br />
</div>
<center><a class="btn btn-default" href="javascript:history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> Voltar</a></center> 