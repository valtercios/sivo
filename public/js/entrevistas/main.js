$(document).ready(function(){
    let escolaridadeCorpoSerieElement = document.querySelector('#escolaridade_corpo_serie');

    $('#escolaridade_corpo').on('change', function(){
        let escolaridade = $(this).val();
        if(escolaridade == "Fundamental I (1ª a 4ª Série)"){
            $(escolaridadeCorpoSerieElement).html(`
                <option value="1ª Série">1ª Série</option>
                <option value="2ª Série">2ª Série</option>
                <option value="3ª Série">3ª Série</option>
                <option value="4ª Série">4ª Série</option>
                <option value="Ignorado">Ignorado</option>
            `);
            $(escolaridadeCorpoSerieElement).attr('disabled', false);
            return;
        }
        if(escolaridade == "Fundamental II (5ª a 8ª Série)"){
            $(escolaridadeCorpoSerieElement).html(`
                <option value="5ª Série">5ª Série</option>
                <option value="6ª Série">6ª Série</option>
                <option value="7ª Série">7ª Série</option>
                <option value="8ª Série">8ª Série</option>
                <option value="Ignorado">Ignorado</option>
            `);
            $(escolaridadeCorpoSerieElement).attr('disabled', false);
            return;
        }
        $(escolaridadeCorpoSerieElement).html('<option value="Ignorado">Ignorado</option>');
        $(escolaridadeCorpoSerieElement).attr('disabled', true);

    });
});