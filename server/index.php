<?php
require_once("api/check_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans&amp;family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css"
        integrity="sha512-apX8rFN/KxJW8rniQbkvzrshQ3KvyEH+4szT3Sno5svdr6E/CP0QE862yEeLBMUnCqLko8QaugGkzvWS7uNfFQ=="
        crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com/3.4.1?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>src = "api/get_categories.php"</script>
    <style>

    </style>
    <meta charset="UTF-8">

</head>

<body>
    <div class="bg-white pt-4 pr-8 pb-4 pl-8">
        <nav class="w-full">
            <div class="flex w-full justify-between max-w-screen-2xl md:flex-row mt-auto mr-auto mb-auto ml-auto">
                <div class="flex flex-row bg-white justify-between items-center mt-2 mb-2 md:m-0 hidden md:flex">
                    <a href="#" fontfamily="Raleway"
                        class="text-gray-600 text-center mr-6 font-medium text-base">Ana Sayfa</a>
                    <a href="#" fontfamily="Raleway"
                        class="text-gray-600 text-center mr-6 font-medium text-base">Özellikler</a>
                </div>
                <div class="bg-white flex-row flex items-center justify-center order-first md:order-none">
                    <img src="https://res.cloudinary.com/speedwares/image/upload/v1659284687/windframe-logo-main_daes7r.png"
                        class="w-12 md:w-16">
                </div>

                <div class="flex justify-center items-center md:justify-start hidden md:flex">
                    <a href="login.html">
                        <button fontfamily="Arial" class="h-9 w-24 text-gray-600 bg-white border-2 border-white flex items-center
            justify-center text-center rounded-lg text-lg font-normal mr-6">Sign in</button></a>
                    <a href="register.html">
                        <button fontfamily="Arial" class="h-9 w-24 text-white bg-blue-700 hover:bg-blue-900 hover:border-blue-900
            border-2 flex items-center justify-center text-center border-blue-700 rounded-lg text-lg font-normal
            mr-auto">Sign up</button></a>
                    <a href="api/logout.php">
                        <button fontfamily="Arial" class="h-9 w-24 text-gray-600 bg-white border-2 border-white flex items-center
                                    justify-center text-center rounded-lg text-lg font-normal mr-6"
                            id="logoutBtn">Logout</button></a>
                </div>
                <div class="md:hidden flex items-center">
                    <div class="outline-none mobile-menu-button">
                        <svg id="Windframe_U0rJiH4AqgA" fill="none" strokelinecap="round" strokewidth="2"
                            viewBox="0 0 24 24" stroke="currentColor"
                            class="w-6 h-6 text-gray-500 hover:text-green-500">
                            <path id="Windframe_B88cbZI7jj9" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="hidden md:hidden md:hidden mobile-menu">
                <div>
                    <div class="flex flex-col">
                        <a href="#" fontfamily="Raleway"
                            class="text-gray-600 text-center mt-2 font-medium text-base">Product</a>
                        <a href="#" fontfamily="Raleway"
                            class="text-gray-600 text-center mt-2 font-medium text-base">Features</a>
                        <a href="#" fontfamily="Raleway"
                            class="text-gray-600 text-center mt-2 font-medium text-base">Pricing</a>
                        <button fontfamily="Arial" class="h-9 w-24 text-gray-600 bg-white border-2 border-white flex items-center
              justify-center text-center rounded-lg text-lg font-normal mt-2 mr-auto ml-auto">Sign in</button>
                        <button fontfamily="Arial" class="h-9 w-24 text-white bg-blue-700 hover:bg-blue-900 hover:border-blue-900
              border-2 flex items-center justify-center text-center border-blue-700 rounded-lg text-lg font-normal mt-2
              mr-auto ml-auto">Sign up</button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="bg-white mr-auto ml-auto pt-16 pr-4 pb-16 pl-4 sm:max-w-xl md:max-w-full md:px-24 lg:px-8 lg:py-20">
        <div rounded="md" class="shadow-xl pt-8 pr-8 pb-8 pl-8 sm:p-16">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:mb-0 lg:w-1/2 lg:pr-5 mb-6">
                    <div>
                        <p
                            class="block text-3xl font-bold tracking-tight text-gray-900 leading-6 font-sans sm:text-4xl">
                            Improve your
                            day</p>
                        <p
                            class="inline text-3xl font-bold tracking-tight text-gray-900 font-sans sm:text-4xl sm:leading-none">
                            to the
                            MAX with</p>
                        <p
                            class="inline text-blue-700 text-3xl font-bold tracking-tight font-sans sm:text-4xl sm:leading-none">
                            Gemini
                            Prompts</p>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <p class="mb-4 text-base text-left text-gray-700">Sizin için oluşturulmuş yüzlerce prompt ile direkt sohbet başlatabilirsiniz, aklınıza gelen herşeyi bulmanız mümkün.</p>
                    <a href="#kartlar" class="w-3/12 text-blue-700 text-center flex font-semibold items-center transition-colors duration-200
            hover:text-blue-900">Hemen keşfet</a>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

    </div>
    <div class="bg-white pt-4 pr-8 pb-4 pl-8">
        <nav class="w-full">
            <div class="hidden md:hidden md:hidden mobile-menu">
                <div>
                    <div class="flex flex-col">
                        <a href="#" fontfamily="Raleway"
                            class="text-gray-600 text-center mt-2 font-medium text-base">Product</a>
                        <a href="#" fontfamily="Raleway"
                            class="text-gray-600 text-center mt-2 font-medium text-base">Features</a>
                        <a href="#" fontfamily="Raleway"
                            class="text-gray-600 text-center mt-2 font-medium text-base">Pricing</a>
                        <button fontfamily="Arial" class="h-9 w-24 text-gray-600 bg-white border-2 border-white flex items-center
              justify-center text-center rounded-lg text-lg font-normal mt-2 mr-auto ml-auto">Sign in</button>
                        <button fontfamily="Arial" class="h-9 w-24 text-white bg-blue-700 hover:bg-blue-900 hover:border-blue-900
              border-2 flex items-center justify-center text-center border-blue-700 rounded-lg text-lg font-normal mt-2
              mr-auto ml-auto">Sign up</button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="flex">
        <div class="w-1/5 bg-gray-100 rounded-lg p-4 max-w-xs ">
            <div class="pb-2 mb-4 border-b border-gray-200">
                <p class="text-lg font-semibold text-gray-700">Filter By Category</p>
            </div>
            <ul class="space-y-2" id="kategoriler">

                <!-- kategori itemleri -->

            </ul>
        </div>
        <div class="w-4/5 ml-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-4 " id="kartlar">
                <!-- kart itemleri -->
            </div>
        </div>
        <script>
            const btn = document.querySelector(" .mobile-menu-button"); const
                menu = document.querySelector(".mobile-menu"); btn.addEventListener("click", () => {
                    menu.classList.toggle("hidden");
                });



            function selectCategory(button) {
                var buttons = document.querySelectorAll('.category-button');
                buttons.forEach(function (btn) {
                    btn.classList.remove('bg-blue-600', 'focus:ring-blue-600', 'focus:border-blue-600', 'text-white');
                    btn.classList.add('bg-white', 'hover:bg-gray-50', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'text-gray-700');
                });
                button.classList.remove('bg-white', 'hover:bg-gray-50', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'text-gray-700');
                button.classList.add('text-white', 'bg-blue-600', 'focus:ring-blue-600', 'focus:border-blue-600');
            }


            // Sayfa yüklendiğinde kartları ekrana ekle
            document.addEventListener("DOMContentLoaded", function () {

                kategorileriEkranaEkle();
                // kartlariEkranaEkle();

            });

            // Kategorileri alma işlemi
            fetch("api/get_categories.php")
                .then(response => response.json())
                .then(kategoriler => {
                    // Kategoriler listesini al
                    var kategoriListesi = document.getElementById("kategoriler");

                    // Her kategori için düğmeler oluştur
                    kategoriler.forEach(function (kategori) {
                        // Yeni bir düğme oluştur
                        var button = document.createElement("button");
                        button.setAttribute("onclick", "selectCategory(this)");
                        button.setAttribute("fontfamily", "Arial");
                        button.setAttribute("type", "submit");
                        button.setAttribute("class", "category-button id flex hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full text-left text-gray-700 bg-white rounded-md py-2 px-3 justify-between items-center");
                        //kategori idleri kartlara tanımla
                        button.setAttribute("id", kategori.id);
                        // Düğme metnini kategori adıyla ayarla
                        button.innerText = kategori.name;
                        // Düğmeyi bir liste öğesine ekle
                        var listItem = document.createElement("li");
                        listItem.appendChild(button);

                        // Listeye ekle
                        kategoriListesi.appendChild(listItem);
                    });
                })
                .catch(error => {
                    console.error('Hata:', error);
                    // Hata durumunda kullanıcıya bir mesaj gösterebilirsiniz
                });
            function selectCategory(button) {
                var buttons = document.querySelectorAll('.category-button');
                buttons.forEach(function (btn) {
                    btn.classList.remove('bg-blue-600', 'focus:ring-blue-600', 'focus:border-blue-600', 'text-white');
                    btn.classList.add('bg-white', 'hover:bg-gray-50', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'text-gray-700');
                });
                button.classList.remove('bg-white', 'hover:bg-gray-50', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'text-gray-700');
                button.classList.add('text-white', 'bg-blue-600', 'focus:ring-blue-600', 'focus:border-blue-600');
            }

            // Kategori seçildiğinde çağrılacak fonksiyon
            function selectCategory(button) {
                var buttons = document.querySelectorAll('.category-button');
                buttons.forEach(function (btn) {
                    btn.classList.remove('bg-blue-600', 'focus:ring-blue-600', 'focus:border-blue-600', 'text-white');
                    btn.classList.add('bg-white', 'hover:bg-gray-50', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'text-gray-700');
                });
                button.classList.remove('bg-white', 'hover:bg-gray-50', 'focus:ring-2', 'focus:ring-indigo-500', 'focus:border-indigo-500', 'text-gray-700');
                button.classList.add('text-white', 'bg-blue-600', 'focus:ring-blue-600', 'focus:border-blue-600');
                // Seçilen kategori adını alabilirsiniz
                var categoryName = button.innerText;
                console.log("Seçilen kategori: " + categoryName);
                // Diğer işlemleri burada yapabilirsiniz

            }
            // Kategorilerden kartları listeleme işlemi
            fetch("api/get_prompt_cards.php")
                .then(response => response.json())
                .then(kartlar => {
                    // Kategorilerin id'lerini al
                    var kategoriIds = kartlar.map(kart => kart.category_id);

                    // Tekrar eden kategori id'lerini kaldır
                    //var uniqueKategoriIds = [...new Set(kategoriIds)];

                    // Her bir kategori için kartları listele
                    kategoriIds.forEach(kategoriId => {
                        // Kategorinin kartlarını al
                        var kategoriKartlar = kartlar.filter(kart => kart.category_id === kategoriId);

                        // Kartları listele
                        kategoriKartlar.forEach(kart => {
                            // Kartı oluştur
                            var kartDiv = document.createElement("div");
                            kartDiv.setAttribute("class", "bg-white shadow-lg rounded-lg card m-2 p-6 transform transition duration-500 ease-in-out hover:scale-105");

                            // Kategori etiketi ekle
                            var kategoriSpan = document.createElement("span");
                            kategoriSpan.setAttribute("class", "px-2 py-0.5 text-xs bg-gray-300 text-gray-500 rounded-full badge float-right");
                            kategoriSpan.innerText = kart.category;
                            kartDiv.appendChild(kategoriSpan);

                            // Başlık ekle
                            var baslikP = document.createElement("p");
                            baslikP.setAttribute("class", "font-semibold text-blue-600 text-xl mb-3 block");
                            baslikP.innerText = kart.title;
                            kartDiv.appendChild(baslikP);

                            // İçerik ekle
                            var icerikP = document.createElement("p");
                            icerikP.setAttribute("class", "text-gray-600 mb-6");
                            icerikP.innerText = kart.description;
                            kartDiv.appendChild(icerikP);

                            // Buton ekle
                            var button = document.createElement("button");
                            button.setAttribute("fontfamily", "Arial");
                            button.setAttribute("type", "submit");
                            button.setAttribute("class", "inline-flex focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 w-full justify-center rounded-lg py-2 px-4 bg-blue-600 text-sm font-semibold text-white shadow-lg");
                            button.innerText = "Click me!";
                            // Butona tıklandığında ilgili kartın prompt'unu gösteren bir fonksiyonu çağır
                            button.addEventListener("click", function () {
                                alert(kart.prompt);
                            });
                            kartDiv.appendChild(button);

                            // Kartı sayfaya ekle
                            document.getElementById("kartlar").appendChild(kartDiv);
                        });
                    });
                })
                .catch(error => {
                    console.error('Hata:', error);
                    // Hata durumunda kullanıcıya bir mesaj gösterebilirsiniz
                });

            // JavaScript code to handle logout
            document.getElementById("logoutBtn").addEventListener("click", function (event) {
                // Prevent the default link behavior
                event.preventDefault();

                // Remove token from localStorage
                localStorage.removeItem('token');

                // Redirect to logout.php
                window.location.href = "../api/logout.php";
            });
        </script>
</body>

</html>