<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breaking Bad Quotes</title>
    <link rel="stylesheet" href="/css/output.css">
    <link rel="shortcut icon" href="/public/assets/favicon.ico" type="image/x-icon" />
</head>
<body class="grid grid-cols-2 bg font-manrope">

<?php
$quote = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $apiUrl = "https://api.breakingbadquotes.xyz/v1/quotes";

    $response = @file_get_contents($apiUrl);
    if ($response === FALSE) {
        $error = "No se pudo obtener una cita de Breaking Bad.";
    } else {
        $quoteData = json_decode($response, true);
        if (!isset($quoteData[0]["quote"])) {
            $error = "No se pudo obtener una cita de Breaking Bad.";
        } else {
            $quote = $quoteData[0];
        }
    }
}
?>

<div class="bg-main-mainblack w-full h-screen border-r border-main-maingreen flex flex-col items-center p-4">
    <header class="flex w-full just">
        <nav>
            <ul>
                <li>
                    <a href="../index.html" class="text-main-mainwhite"> < Inicio</a>
                </li>
            </ul>
        </nav>
    </header> 
    <section class="w-full h-1/3 flex justify-center items-center">
        <object data="/public/assets/SVG/api-jungle.svg" type="image/svg+xml" class="w-52"></object>
    </section>

    <form action="" method="POST" class="w-full h-2/3 flex flex-col items-center justify-evenly">
        <div class="items-center justify-center w-2/4">
            <label class="block text-gray-700 text-md mb-2 text-center text-main-maingreen" for="quote">
                Frase aleatoria de Breaking Bad
            </label>
            <button class="text-main-maingreen hover:bg-main-maingreen hover:text-main-mainwhite transition ease-in duration-300 py-3 w-full border border-main-maingreen rounded-md" type="submit">
                Buscar
            </button>

        </div>
        <img src="../public/assets/img/breakingbad.jpg" alt="" class="w-80 my-10 ">
    </form>

    <div class="w-full h-1/2 flex justify-center items-center text-main-maingreen">
        <div class="flex items-center w-1/2 justify-evenly">
            <img src="/public/assets/img/profile-picture.png" alt="" class="w-14" />
            <p>
                Marcos Dominguez - 20221093 <br />
                <span class="text-main-maingray">Desarrollo de Software - ITLA</span>
            </p>
        </div>

        <div class="flex">
            <object data="/public/assets/SVG/tailwind.svg" type="image/svg+xml" class="w-6"></object>
            <h1 class="text-main-mainwhite ml-2">Tailwind CSS</h1>
        </div>
    </div>
</div>

<div id="result" class="w-full h-screen flex flex-col justify-center items-center">
    <?php if ($error): ?>
        <div class="bg-error-main text-red-700 px-4 py-3 relative h-screen flex justify-center items-center" role="alert">
            <strong class="font-bold text-main-mainwhite mr-2">¡Error!</strong>
            <span class="text-main-mainwhite"><?php echo $error; ?></span>
        </div>
    <?php elseif ($quote): ?>
        <div class="bg-white w-2/4 p-5 rounded-md  justify-center flex flex-col border border-main-maingreen">
            <h1 class="text-xl font-bold "><?php echo $quote["quote"]; ?></h1>
            <p class="text-gray-700 items-start mt-3"> <?php echo '- '. $quote["author"]; ?></p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
