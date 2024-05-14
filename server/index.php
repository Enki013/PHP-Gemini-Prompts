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
            <div class="mt-4">
    <input type="text" id="searchInput" oninput="searchKartlar()" placeholder="Search..." class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md">
</div>
        </div>
        <div class="w-4/5 ml-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-4 " id="kartlar">
                <!-- kart itemleri -->
            </div>
        </div>
 <script>
        // Kategorilere göre kartları filtrelemek için bir obje oluştur
        const kartlarByKategori = {};
        // Tüm kartlar
        let allKartlar = [];

        // Kategorilere göre kartları filtreleme fonksiyonu
function filterKartlar(kategoriId, kartlar) {
    kartlar = kartlar || allKartlar; // Eğer kartlar parametresi belirtilmemişse, tüm kartları kullan
    // Kartları temizle
    document.getElementById("kartlar").innerHTML = "";
    // Her bir kart için HTML oluştur
    kartlar.forEach(kart => {
        if (kategoriId === 'all' || kart.category_id === kategoriId) {
            const kartHTML = `
                <div class="kategori-${kart.category_id} bg-white shadow-lg rounded-lg card m-2 p-6 transform transition duration-500 ease-in-out hover:scale-105">
                    <span class="px-2 py-0.5 text-xs bg-gray-300 text-gray-500 rounded-full badge float-right">${kategoriAdiById[kart.category_id]}</span>
                    <p class="font-semibold text-blue-600 text-xl mb-3 block">${kart.title}</p>
                    <p class="text-gray-600 mb-6">${kart.description}</p>
                    <button type="button" class="inline-flex focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 w-full justify-center rounded-lg py-2 px-4 bg-blue-600 text-sm font-semibold text-white shadow-lg" onclick="showPrompt('${kart.prompt}')">Click me!</button>
                </div>
            `;
            // Kartı sayfaya ekle
            document.getElementById("kartlar").innerHTML += kartHTML;
        }
    });
}

     // Kartları arama fonksiyonu
function searchKartlar() {
    const searchInput = document.getElementById("searchInput").value.toLowerCase();
    const filteredKartlar = allKartlar.filter(kart => {
        return kart.title.toLowerCase().includes(searchInput);
    });
    filterKartlar('all', filteredKartlar); // Tüm kartları göster ve arama sonuçlarını filtrele
}

        const kategoriAdiById = {};

        fetch("api/get_categories.php")
            .then(response => response.json())
            .then(kategoriler => {
                kategoriler.forEach(kategori => {
                    kategoriAdiById[kategori.id] = kategori.name;
                });

                const kategorilerListesi = document.getElementById("kategoriler");

                // "All" butonunu oluştur
                const allButton = document.createElement("button");
                allButton.textContent = "All";
                allButton.classList.add("category-button", "flex", "hover:bg-gray-50", "focus:outline-none", "focus:ring-2", "focus:ring-indigo-500", "focus:border-indigo-500", "w-full", "text-left", "text-gray-700", "bg-white", "rounded-md", "py-2", "px-3", "justify-between", "items-center");
                allButton.onclick = () => filterKartlar('all');
                const allListItem = document.createElement("li");
                allListItem.appendChild(allButton);
                kategorilerListesi.appendChild(allListItem);

                // Kategorileri düğmelere dönüştür
                kategoriler.forEach(kategori => {
                    const listItem = document.createElement("li");
                    const button = document.createElement("button");
                    button.textContent = kategori.name;
                    button.classList.add("category-button", "flex", "hover:bg-gray-50", "focus:outline-none", "focus:ring-2", "focus:ring-indigo-500", "focus:border-indigo-500", "w-full", "text-left", "text-gray-700", "bg-white", "rounded-md", "py-2", "px-3", "justify-between", "items-center");
                    button.onclick = () => filterKartlar(kategori.id);
                    listItem.appendChild(button);
                    kategorilerListesi.appendChild(listItem);
                });
            })
            .catch(error => {
                console.error('Kategoriler alınamadı:', error);
            });

        fetch("api/get_prompt_cards.php")
            .then(response => response.json())
            .then(kartlar => {
                allKartlar = kartlar;
                // Her bir kartı kategori ID'sine göre grupla
                kartlar.forEach(kart => {
                    if (!kartlarByKategori[kart.category_id]) {
                        kartlarByKategori[kart.category_id] = [];
                    }
                    kartlarByKategori[kart.category_id].push(kart);
                });
                // Tüm kartları göster
                filterKartlar('all');
            })
            .catch(error => {
                console.error('Kartlar alınamadı:', error);
            });

        // Prompt'u gösteren fonksiyon
        function showPrompt(prompt) {
            alert(prompt);
        }
    </script>
</body>

</html>
