<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <!--<li role="presentation" class="active"><a href="#sistemas" aria-controls="sistemas" role="tab" data-toggle="tab">Sistemas</a></li>-->
            {foreach $servidoresGrupo as $s}
            <li role="presentation"><a href="#{$s->id_sistema}" aria-controls="{$s->id_sistema}" role="tab" data-toggle="tab">{$s->nome_sistema}</a></li>
            {/foreach}
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="sistemas">
            <br>
            <div class="alert alert-success" role="alert">
                Para verificar o monitoramento dos sistemas basta realizar o login (caso solicite)<br> <strong>Login:</strong> suporte<br> <strong>Senha:</strong> rootinfoway
            </div>
        </div>
        {foreach $servidoresGrupo as $s}
            <div role="tabpanel" class="tab-pane" id="{$s->id_sistema}"><iframe width='100%' height='1400' frameborder='0' src='{$s->link_monitoramento}'></iframe></div>
        {/foreach}
    </div>

</div>