$(document).ready(function(){
    $('#btnEnviar').click(function(){
        $('#formEnviaWar').ajaxForm({
            uploadProgress: function(event, position, total, percentComplete) {
                $('progress').attr('value',percentComplete);
//                $('#porcentagem').html(percentComplete+'%');
            },        
            success: function(data) {
                $('progress').attr('value','100');
                urlRed = "./sendFile.php?idFile=" + data;
                $( location ).attr("href", urlRed);                             
            },
            error : function(){
                $('#resposta').html(data);
            },
            dataType: 'json',
            url: 'includes/controllers/enviarArquivoServdiorControl.php',            
            resetForm: true
        }).submit();
    })
})