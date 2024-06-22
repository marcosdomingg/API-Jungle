<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rick and Morty API</title>
    <link rel="stylesheet" href="/css/output.css">
    <link rel="shortcut icon" href="/public/assets/favicon.ico" type="image/x-icon" />
</head>
<body class="grid grid-cols-2 bg font-manrope">

<?php
$characterData = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $characterId = htmlspecialchars($_POST["character-id"]);
    $apiUrl = "https://rickandmortyapi.com/api/character/" . $characterId;

    $response = @file_get_contents($apiUrl);

    if(!$characterId){
        $error = "No se pudo encontrar el personaje especificado.";
    }
    if ($response === FALSE) {
        $error = "No se pudo encontrar el personaje especificado.";
    } else {
        $characterData = json_decode($response, true);
        if (isset($characterData["error"])) {
            $error = "No se pudo encontrar el personaje especificado.";
        }
    }
}
?>

<div class="bg-main-mainblack w-full h-screen border-r border-main-maingreen flex flex-col items-center p-4">

    <header class="flex w-full justify-between items-center">
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

    <form action="" method="POST" class="w-full h-1/3 flex flex-col items-center justify-evenly">
        <div class="items-center justify-center w-2/4">
            <label class="block text-gray-700 text-md mb-2 text-main-maingreen" for="character-id">
                ID del personaje de Ricky And Morty
            </label>
            <input name="character-id" class="w-full py-4 rounded-md px-2" id="character-id" type="number" placeholder="Ingrese el ID del personaje">
        </div>
        <div class="flex flex-col justify-center items-center w-full">
            <button class="text-main-maingreen hover:bg-main-maingreen hover:text-main-mainwhite transition ease-in duration-300  py-3 w-2/4 border border-main-maingreen rounded-md" type="submit">
                Buscar
            </button>
        </div>
    </form>

    <div
      class="w-full h-1/2 flex justify-center items-center text-main-maingreen"
    >
      <div class="flex items-center w-1/2 justify-evenly">
        <img
          src="/public/assets/img/profile-picture.png"
          alt=""
          class="w-14"
        />
        <p>
          Marcos Dominguez - 20221093 <br />
          <span class="text-main-maingray"
            >Desarrollo de Software - ITLA</span
          >
        </p>
      </div>

      <div class="flex">
        <object
          data="/public/assets/SVG/tailwind.svg"
          type="image/svg+xml"
          class="w-6"
        ></object>
        <h1 class="text-main-mainwhite ml-2">Tailwind CSS</h1>
      </div>
    </div>
</div>

    <div id="result" class="w-full h-screen">
        <?php if ($error): ?>
            <div class="bg-error-main text-red-700 px-4 py-3  relative h-screen flex justify-center items-center" role="alert">
                <strong class="font-bold text-main-mainwhite mr-2">¡Error!</strong>
                <span class="text-main-mainwhite"><?php echo $error; ?></span>
            </div>
        <?php elseif ($characterData): ?>
            <div class="bg-white w-full h-full items-center justify-center flex flex-col ">
                <img class="w-52 " src="<?php echo $characterData["image"]; ?>" alt="<?php echo $characterData["name"]; ?>">
                <h1 class="text-xl font-bold mt-3"><?php echo $characterData["name"]; ?></h1>
                <p class="text-gray-700">Especie: <?php echo $characterData["species"]; ?></p>
                <p class="text-gray-700">Estado: <?php echo $characterData["status"]; ?></p>
            </div>
        <?php endif; ?>
</div>

</body>
</html>
