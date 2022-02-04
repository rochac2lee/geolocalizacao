# GeoApi
Uma api que retornas as condições climáticas pelo ip do usuário

## Instalação
### Clone o repositório
```bash
git clone https://github.com/rochac2lee/geolocalizacao.git
```

### Na pasta do projeto, configure as credenciais no arquivo .env

### Iniciando o servidor de desenvolvimento:
<p>Vai exportar a api na porta 8000</p>

```bash
php artisan serve
```


## Exemplo de requisições a api:
### GET /weather
Essa requisição informa a condição climática e um status de previsão nas próximas horas
```bash
$ curl http://localhost:8000/api/weather
```
```js
{
  "ip": "xxx.xxx.xxx.xxx",
  "cidade": "Conceição do Araguaia",
  "estado": "Para",
  "pais": "Brazil",
  "temperatura": "24.4º C",
  "eDia": "Sim",
  "status": "Possibilidade de chuva irregular",
  "velocidadeVento": "3.6Km\/h",
  "umidadeAr": "88 %",
  "ultimaAtualizacao": "2022-02-04 09:15"
}
```

### GET /weather/list
Essa requisição lista as úlitmas consultas feitas a um determinado ip, o parâmetro limitador(Obrigatório) define a quantidade de registros
```bash
$ curl http://localhost:8000/api/weather/list/{ip}/{limitador}
```
```js
[
  {
    "ip": "xxx.xxx.xxx.xxx",
    "cidade": "Conceição do Araguaia",
    "estado": "Para",
    "pais": "Brazil",
    "temperatura": "24.4º C",
    "eDia": "Sim",
    "status": "Possibilidade de chuva irregular",
    "velocidadeVento": "3.6Km\/h",
    "umidadeAr": "88 %",
    "ultimaAtualizacao": "2022-02-04 09:15"
  },
  {
    "ip": "xxx.xxx.xxx.xxx",
    "cidade": "Curitiba",
    "estado": "Paraná",
    "pais": "Brazil",
    "temperatura": "23.0º C",
    "eDia": "Sim",
    "status": "Possibilidade de chuva irregular",
    "velocidadeVento": "11Km\/h",
    "umidadeAr": "81 %",
    "ultimaAtualizacao": "2022-02-04 09:00"
  },
]
```

## Cron para envio de emails
Uma cron para enviar emails para os usuários registrados no banco a previsão do tempo, por definição roda todo dia as 07:00 América/Sao_Paulo
```bash
$ php artisan SendEmail:cron
```
<b>Necessita de email configurado do .env para funcionar, caso seja gmail, criar uma senha de aplicativos.</b>

## Tokens externos a api:
#### A api utiliza duas api externas:
### http://ip-api.com/json 
Uma api pra obter com precisão a geolocalização do usuário pelo IP, não necessita de TOKEN

### http://api.weatherapi.com/v1
A api responsável por obter informações climáticas, na api é usado a referência de latitude e longitude
Essa api necessita de TOKEN, que pode ser inserido no .env, para obter o TOKEN é necessário se registar na página da API, consumo mensal máximo de 1M de requisições por mês.
<b>Token: 6162d88515ad4819bf4235020220302</b>

<b> As urls das apis estão no final do .env, tal como a chave para inserir o TOKEN</b>



