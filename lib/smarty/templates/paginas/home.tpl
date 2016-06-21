
<h2 class="text-center"><strong>Ciclo de Operações Infoway</strong></h2>
<div class="row">
    <div class="col-md-pull-9">                   

        <div class="col-md-pull-9">
            <div class="alert alert-success" role="alert">
                <center>
                    <p>
                        Deploy's realizado em <strong>{$smarty.now|date_format:"%d/%m/%Y"} <span class="label label-default">{$cont}</span></strong><br><small>Contagem por usuário</small>
                    </p>
                </center>
            </div>
        </div>

        {if isset($usrDep)}

            {foreach $usrDep as $d}
                <div class="col-md-6">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <span style='font-size: 13px;'> Deploy realizado por <strong>{$d->nome_usuario} </strong></span> <span class="label label-default">{$d->total}</span> 
                    </div>
                </div>
            {/foreach}

        {else}
            <div class="col-md-6 col-md-offset-3">
                <div class="alert alert-warning" role="alert">
                    <center>Nenhum deploy realizado no dia de hoje</center>
                </div>
            </div>
        {/if}


        <small>
            <div class="text-info" style=" float: right;">

            </div>
        </small>
        {*<h4><small>{if $nivel =="admin" || $nivel == "gerente"}P.S. Foi adicionada funções de exclusão automatica de informação. A mensagem será excluida automaticamente ao corrigir a alteração informada. {else}P.S. Agora ao gerar declaração, os dados, devidamente cadastrados do usuário, será automaticamente preenchido pelo sistema. Caso não vigore, saia e entre no  sistema novamente.{/if} Att. Sgt Álvaro</small></h4>*}
        <div class="clear"></div>

    </div>
</div>


