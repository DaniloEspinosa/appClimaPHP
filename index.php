<?php

error_reporting(0);


$ciudad = "Tucumán";

$URL = "https://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=93b7d700335e20d50fbed4f29e09c2ea&units=metric&lang=es";

// funcion predeterminada de json, a partir de un URL nos va a devolver el contenido en formato json
$string_meteo = file_get_contents($URL);  // Esto devuelve un string
// echo $string_meteo;

$json_meteo = json_decode($string_meteo, true);
// var_dump($json_meteo);

// echo $json_meteo['name'];


// var_dump($json_meteo['weather']['0']['icon']);
$icon = $json_meteo['weather']['0']['icon'];
$temperatura = $json_meteo['main']['temp'];
$sensacion = $json_meteo['main']['feels_like'];
$maxima = $json_meteo['main']['temp_max'];
$minima = $json_meteo['main']['temp_min'];
$humedad = $json_meteo['main']['humidity'];
$descripcion = $json_meteo['weather']['0']['description'];
$viento = $json_meteo['wind']['speed'];


// Esta es la ruta completa que mostrara el icono del clima
$url_icon = "https://www.imelcf.gob.pa/wp-content/plugins/location-weather/assets/images/icons/weather-icons/$icon.svg";


if ($_POST) {
    // var_dump($_POST);    

    $ciudad = $_POST['ciudad'];

    $URL = "https://api.openweathermap.org/data/2.5/weather?q=$ciudad&appid=93b7d700335e20d50fbed4f29e09c2ea&units=metric&lang=es";

    // funcion predeterminada de json, a partir de un URL nos va a devolver el contenido en formato json
    $string_meteo = file_get_contents($URL);  // Esto devuelve un string
    // echo $string_meteo;

    $json_meteo = json_decode($string_meteo, true);
    // var_dump($json_meteo);

    // echo $json_meteo['name'];


    // var_dump($json_meteo['weather']['0']['icon']);
    $icon = $json_meteo['weather']['0']['icon'];
    $temperatura = $json_meteo['main']['temp'];
    $sensacion = $json_meteo['main']['feels_like'];
    $maxima = $json_meteo['main']['temp_max'];
    $minima = $json_meteo['main']['temp_min'];
    $humedad = $json_meteo['main']['humidity'];
    $descripcion = $json_meteo['weather']['0']['description'];
    $viento = $json_meteo['wind']['speed'];


    // Esta es la ruta completa que mostrara el icono del clima
    $url_icon = "https://www.imelcf.gob.pa/wp-content/plugins/location-weather/assets/images/icons/weather-icons/$icon.svg";

    // header('location:index.php');
}

?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Meteo</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Belanosima:wght@400;600;700&family=Mako&family=Salsa&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: black;
            font-family: "Mako", sans-serif;
        }

        :root {
            --color-back: #9CF6F6;
            --color-emphasis: #F3C98B;
        }

        .content {
            background-color: #C46D5E;
            width: 750px;
            margin: 10px auto;
            padding: 20px;
            border-radius: 20px;
        }

        h1 {
            text-align: center;
            background-color: var(--color-back);
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            margin-top: 10px;
            font-family: "Belanosima", sans-serif;
            font-size: 3rem;
            font-weight: 300;
        }

        p {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .width-content {
            max-width: 700px;
            margin: 0 auto;
        }

        /* Formato de las cajas */
        .cajas {
            display: flex;
            padding: 10px;
            background-color: var(--color-back);
            border-radius: 10px;
            margin-bottom: 10px;
        }

        /* Caja donde se muestra la informacion principal */

        .informacion-principal {
            justify-content: space-around;
        }

        .temperatura {
            font-size: 6rem;
        }

        .sensacion {
            font-size: 4rem;
        }

        .informacion-principal div {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            width: 45%;
            background-color: var(--color-emphasis);
            border-radius: 10px;
            text-align: center;
        }

        img {
            height: 100%;
        }

        /* Caja donde se muestra la informacion secundaria */
        .informacion-secundaria {
            flex-direction: column;
            align-items: center;
        }

        /* Caja del input */
        .elige-ciudad form {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            font-size: 1.5rem;
        }

        input {
            height: 2rem;
            width: 200px;
        }

        button {
            padding: 5px 10px;
            color: #C46D5E;
            background-color: #F3C98B;
            border-radius: 5px;
            border: none;
            font-size: 1.2rem;
        }

        button:hover {
            background-color: #f56960;
            scale: 1.1;
            color: white;
        }

        /* Solo saldra en caso de que la ciudad elegida no sea encontrada */
        .warning {
            color: red;
            font-weight: bold;
            font-size: 2rem;
            text-align: center;
            background-color: white;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="content">




        <div class="width-content">

            <header>
                <h1> Clima en <?= $json_meteo['name'] ?></h1>
                <?php if (!$string_meteo) : ?>
                    <p class="warning"><?= $ciudad ?> : nombre de ciudad incorrecto.</p>

                <?php endif; ?>
            </header>

            <main>
                <section class="informacion-principal cajas">
                    <div>
                        <div>
                            <p>Temperatura :</p>
                            <p class="temperatura"><?= $temperatura ?>º</p>
                        </div>
                        <div>
                            <p>Sensación :</p>
                            <p class="sensacion"><?= $sensacion ?>º</p>
                        </div>

                    </div>
                    <div>
                        <img src=<?= $url_icon ?> alt="">
                    </div>
                </section>

                <section class="informacion-secundaria cajas">
                    <p>Temperatura máxima : <?= $maxima ?>º</p>
                    <p>Temperatura mínima : <?= $minima ?>º</p>
                    <p>Humedad : <?= $humedad ?>%</p>
                    <p>Hoy tenemos : <?= $descripcion ?></p>
                    <p>Velocidad del viento : <?= $viento ?>km/h</p>
                </section>

                <section class="elige-ciudad cajas">
                    <form method="POST">
                        <div>
                            <label for="ciudad">Elige una ciudad :</label>
                            <input type="text" name="ciudad" class="form-control" id="ciudad" aria-describedby="ciudad">
                        </div>
                        <button type="submit">Submit</button>

                    </form>
                </section>

            </main>
        </div>
    </div>

</body>

</html>