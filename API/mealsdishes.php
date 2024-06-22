<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MealDB API</title>
    <link rel="stylesheet" href="/css/output.css">
    <link rel="shortcut icon" href="/public/assets/favicon.ico" type="image/x-icon" />
</head>
<body class="grid grid-cols-2 bg font-manrope">

<?php
$mealData = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mealId = htmlspecialchars($_POST["meal-id"]);
    $apiUrl = "https://www.themealdb.com/api/json/v2/1/lookup.php?i=" . $mealId;

    $response = @file_get_contents($apiUrl);

    if ($response === FALSE) {
        $error = "Hubo un error al conectar con la API.";
    } else {
        $mealData = json_decode($response, true);

        if (!$mealData || $mealData["meals"] === null) {
            $error = "No se pudo encontrar el platillo especificado.";
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
            <label class="block text-gray-700 text-md mb-2 text-main-maingreen" for="meal-id">
                Ingresa el ID del platillo (52772, 52829, 53030)
            </label>
            <input name="meal-id" class="w-full py-4 rounded-md px-2" id="meal-id" type="text" placeholder="Ingrese el ID del platillo">
        </div>
        <div class="flex flex-col justify-center items-center w-full">
            <button class="text-main-maingreen hover:bg-main-maingreen hover:text-main-mainwhite transition ease-in duration-300  py-3 w-2/4 border border-main-maingreen rounded-md" type="submit">
                Buscar
            </button>
        </div>
    </form>

    <div class="w-full h-1/2 flex justify-center items-center text-main-maingreen">
        <div class="flex items-center w-1/2 justify-evenly">
            <img src="/public/assets/img/profile-picture.png" alt="" class="w-14">
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

<div id="result" class="w-full h-screen">
    <?php if ($error): ?>
        <div class="bg-error-main text-red-700 px-4 py-3 relative h-screen flex justify-center items-center" role="alert">
            <strong class="font-bold text-main-mainwhite mr-2">¡Error!</strong>
            <span class="text-main-mainwhite"><?php echo $error; ?></span>
        </div>
    <?php elseif ($mealData): ?>
        <div class="bg-white w-full h-full flex items-center justify-center">
            <?php foreach ($mealData["meals"] as $meal): ?>
                <div class="text-center">
                    <img class="w-52 mx-auto mb-4 rounded-lg shadow-md" src="<?php echo $meal["strMealThumb"]; ?>" alt="<?php echo $meal["strMeal"]; ?>">
                    <h1 class="text-xl font-bold text-gray-800"><?php echo $meal["strMeal"]; ?></h1>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
