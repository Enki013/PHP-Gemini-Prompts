<?php
// Kategori ve kart verilerini tanımla (JavaScript'ten gelen verilere benzer şekilde)
$kategoriVerileri = array(
    array("category" => "Tag 1"),
    array("category" => "Tag 2"),
    array("category" => "Tag 3"),
    array("category" => "Tag 4"),
    array("category" => "Tag 5")
);

$kartVerileri = array(
    array("category" => "Tag 1", "baslik" => "Başlık 1", "icerik" => "İçerik 1"),
    array("category" => "Tag 2", "baslik" => "Başlık 2", "icerik" => "İçerik 2"),
    array("category" => "Tag 3", "baslik" => "Başlık 3", "icerik" => "İçerik 3"),
    array("category" => "Tag 4", "baslik" => "Başlık 4", "icerik" => "İçerik 4"),
    array("category" => "Tag 5", "baslik" => "Başlık 5", "icerik" => "İçerik 5"),
    array("category" => "Tag 6", "baslik" => "Başlık 6", "icerik" => "İçerik 6")
);
$kategorilerJSON = json_encode($kategoriVerileri);
$kartlarJSON = json_encode($kartVerileri);
// AJAX isteğinden gelen kategori parametresini al
if(isset($_GET['category'])) {
    $selected_category = $_GET['category'];
    // Filtrelenmiş kartları HTML olarak geri döndürme
    foreach ($kartVerileri as $kart) {
        if ($kart['category'] == $selected_category) {
            echo '<div class="bg-white shadow-lg rounded-lg card m-2 p-6 transform transition duration-500 ease-in-out hover:scale-105">';
            echo '<span class="px-2 py-0.5 text-xs bg-gray-300 text-gray-500 rounded-full badge float-right">' . $kart['category'] . '</span>';
            echo '<p class="font-semibold text-blue-600 text-xl mb-3 block">' . $kart['baslik'] . '</p>';
            echo '<p class="text-gray-600 mb-6">' . $kart['icerik'] . '</p>';
            echo '<button fontfamily="Arial" type="submit" class="inline-flex focus:outline-none focus:ring-2 focus:ring-blue-600
                    focus:ring-offset-2 w-full justify-center rounded-lg py-2 px-4 bg-blue-600 text-sm
                    font-semibold text-white shadow-lg">Click me!</button>';
            echo '</div>';
        }
    }
}
// Kategori verilerini JSON formatına çevir
$kategoriJSON = json_encode($kategoriVerileri);
// Kart verilerini JSON formatına çevir
$kartJSON = json_encode($kartVerileri);


?>
