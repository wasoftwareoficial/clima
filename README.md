# API de clima usando o Apixu
Biblioteca simples para pegar informações de clima usando a API do Apixu, armazenando as informações por **x** horas para não drenar suas requisições mensais.

⚠️ **Atenção:** não recomendamos usar essa biblioteca em produção, considerando que foi desenvolvida para fins específicos. Ao menos, clone esse repisitório e adapte-o às suas necessidades (ou deixe-as como um issue) antes de usar.

## Como usar?

Solicite suas requisições usando os parâmetros `dia`, para informar o **dia da semana** e `info` para solicitar uma **informação** específica sobre essa data.
| Parâmetro | Definição           | Exemplo de requisição | Exemplo de retorno |
|-----------|---------------------|-----------------------|--------------------|
| `dia`     | Dia da semana       | 3                     | Domingo            |
| `info`    | Informação desejada | chuva                 | 0.2%               |

**Exemplo de solicitação:**
> localhost/?dia=3&info=chuva

#### Configurações

Abra o arquivo `index.php` e edite as seguintes variáveis. Elas ficam localizadas abaixo do título **CONFIGURAÇÕES**, logo no topo do documento:

| Variável   | Definição                                   | Exemplo                         |
|------------|---------------------------------------------|---------------------------------|
| api_key    | Chave de API do Apixu                       | 4ba40c4f49bf4c881136b06ea6771c8 |
| cache_time | Tempo (em horas) até requisitar novos dados | 2                               |

#### Parâmetro `dia`
Use esse parâmetro para definir qual dia da semana, à partir de hoje (1), você quer solicitar as informações.

| Valor   | Retorno         |
|---------|-----------------|
| 1       | Hoje            |
| 2       | Amanhã          |
| *3-7*   | *Dia da semana* |

#### Parâmetro `info`
Use esse parâmetro para determinar qual informação você quer receber sobre o dia definido anteriormente.

| Valor | Definição                  | Exemplo de retorno                        |
|-------|----------------------------|-------------------------------------------|
| text  | Dia da semana              | Terça-feira                               |
| min   | Temperatura mínima (em ºC) | 18                                        |
| max   | Temperatura máxima (em ºC) | 27.6                                      |
| chuva | Chance de chuva (em %)     | 77.4                                      |
| icone | URL do ícone relacionado   | //cdn.apixu.com/weather/64x64/day/116.png |

#### Imprimindo o retorno em PHP

Considerando que todos os retornos da biblioteca são textos planos, você pode simplesmente pegar o conteúdo da URL e escrevê-lo na sua página:

```php
<?php
  function wasApixu(dia, info) {
    return file_get_contents("index.php?dia=".$dia."&info=".$info);
  }
  
  echo wasApixu(3, "min");
?>
```

#### Imprimindo o retorno em JavaScript

O mesmo podemos fazer usando JavaScript e AJAX com uma função como essa:

```javascript
function wasApixu(dia, info) {
  fetch('api/clima/?dia=' + dia + '&info=' + info).then((resp) => resp.text()).then(function(data) {
    return data;
  });
}

document.write(wasApixu(3, "min"));
```

## TO-DO (Quem sabe algum dia?)
- Configurações separadas em seu próprio arquivo (quando houver mais opções)
- Função para solicitar as informações
- Cidade personalizável
- Solicitar outras informações do clima

## Veja em ação!
Você pode ver nossa biblioteca funcionando [nesse site](http://reportercidade.hospedagemdesites.ws/novo/#was-extras)!