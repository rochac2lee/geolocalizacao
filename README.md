# geolocalizacao

- Uma rota não autenticada onde, através da geolocalização do ip do usuário deverá consultar uma api de previsão de tempo para a cidade do mesmo. O retorno da requisição deverá estar no padrão jsonapi; ☑️

- Adicionar à model User um atributo referente ao último ip e criar um command que rode todo dia às 07hs de America/Sao_Paulo e mande por e-mail a previsão do tempo. (não precisa se preocupar com o layout do email, pode ver depois); ☑️

- Para cada ação de envio de previsão, seja por consulta http ou command, o sistema deverá registrar os resultados em uma tabela de logs utilizando escuta de eventos; ☑️

- Uma rota para consulta das últimas previsões para o determinado usuário. ☑️