<html>
    <body>
        <h3>Olá {{ $user->name }}! Aqui vai a previsão e informações do tempo hoje:</h3>
        <p></p>
        <p>Cidade: {{ $data['cidade'] }} </p>
        <p>Estado: {{ $data['estado'] }} </p>
        <p>Pais: {{ $data['pais'] }} </p>
        <p>Temperatura: {{ $data['temperatura'] }} </p>
        <p>Status: {{ $data['status'] }} </p>
        <p>Velocidade do Vento: {{ $data['velocidadeVento'] }} </p>
        <p>Umidade do AR: {{ $data['umidadeAr'] }} </p>
        <p>Atualizado Em: {{ $data['ultimaAtualizacao'] }}
        <p></p>
    </body>
</html>