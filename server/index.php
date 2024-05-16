<?php
require_once("api/check_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="description" content="Your site description here">
    <meta name="keywords" content="keyword1, keyword2, keyword3">
    <meta property="og:title" content="Your Site Title">
    <meta property="og:description" content="Your site description here">
    <meta property="og:image" content="URL to image">
    <meta property="og:url" content="Your site URL">
    
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- tailwind.css -->
    <link rel="stylesheet" href="src/output.css">

    <style>
        .font-raleway {
            font-family: 'Raleway', sans-serif;
        }
    </style>
</head>

<body class="font-raleway dark:bg-gray-900 dark:text-white">
    
    <div class="bg-white dark:bg-gray-800 pt-4 pr-8 pb-4 pl-8">
        <nav class="w-full">
            <div class="flex w-full justify-between max-w-screen-2xl md:flex-row mt-auto mr-auto mb-auto ml-auto items-center">
                <div class="flex items-center">
                    <img src="https://res.cloudinary.com/speedwares/image/upload/v1659284687/windframe-logo-main_daes7r.png"
                        alt="Site Logo" class="w-12 md:w-16">
                </div>
                <div class="hidden md:flex flex-row bg-white dark:bg-gray-800 justify-between items-center mt-2 mb-2 md:m-0">
                    <a href="#" class="text-gray-600 dark:text-gray-300 text-center mr-6 font-medium text-base hover:text-blue-500 dark:hover:text-blue-400 transition-colors duration-200">Ana Sayfa</a>
                    <a href="#" class="text-gray-600 dark:text-gray-300 text-center mr-6 font-medium text-base hover:text-blue-500 dark:hover:text-blue-400 transition-colors duration-200">Özellikler</a>
                    <a href="#" class="text-gray-600 dark:text-gray-300 text-center mr-6 font-medium text-base hover:text-blue-500 dark:hover:text-blue-400 transition-colors duration-200">Ürün</a>
                    <a href="#" class="text-gray-600 dark:text-gray-300 text-center mr-6 font-medium text-base hover:text-blue-500 dark:hover:text-blue-400 transition-colors duration-200">Fiyatlandırma</a>
                </div>
               
                <div class="flex flex-col md:flex-row justify-center items-center md:order-2 space-y-2 md:space-y-0 md:space-x-4">
                    <label for="theme-toggle" class="inline-flex items-center cursor-pointer ml-2">
                        <input type="checkbox" id="theme-toggle" class="hidden" onchange="toggleTheme()">
                        <div class="relative inline-block w-14 h-8 bg-gray-400 rounded-full md:w-16 md:h-10 flex items-center">
                            <div class="absolute left-1 top-1 w-6 h-6 bg-white rounded-full transition-transform duration-300 ease-in-out transform md:w-8 md:h-8 flex items-center justify-center">
                                <svg id="sun-icon" class="w-6 h-6 text-yellow-500 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2m8-10h2M2 12H4m15.364-7.364l1.414 1.414M4.222 19.778l1.414-1.414M19.778 19.778l-1.414-1.414M4.222 4.222l1.414 1.414M12 6a6 6 0 100 12 6 6 0 000-12z"></path>
                                </svg>
                                <svg id="moon-icon" class="w-6 h-6 text-gray-700 hidden md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z"></path>
                                </svg>
                            </div>
                        </div>
                    </label>
                    <div>
                    <a href="api/logout.php" class=" md:inline-block">
                        <button aria-label="Logout" class="category-button flex hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full text-left text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-md py-2 px-3 justify-between items-center"
                            id="logoutBtn">Logout</button></a>
                </div>
                 <!-- hesap bilgileri -->
                <div class="relative">
    <button id="accountBtn" class="category-button flex hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full text-left text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-md py-2 px-3 justify-between items-center">
        Hesabım
    </button>
<div id="accountPopup" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-lg z-10">
    <div class="p-4">
        <p id="userName" class="text-gray-700 dark:text-gray-300"></p>
        <p id="userEmail" class="text-gray-500 dark:text-gray-400 text-sm"></p>

    </div>
    <div class="border-t border-gray-200 dark:border-gray-600"></div>
    <div class="p-4">
        <a href="api/logout.php" class="text-blue-700 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-600">Çıkış Yap</a>
    </div>
</div>
</div>
            </div>
        </nav>
    </div>
    <div class="bg-white dark:bg-gray-800 mr-auto ml-auto pt-16 pr-4 pb-16 pl-4 sm:max-w-xl md:max-w-full md:px-24 lg:px-8 lg:py-20">
        <div class="rounded-md shadow-xl pt-8 pr-8 pb-8 pl-8 sm:p-16">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:mb-0 lg:w-1/2 lg:pr-5 mb-6">
                    <div>
                        <p class="block text-3xl font-bold tracking-tight text-gray-900 dark:text-white leading-6 sm:text-4xl">Improve your
                            day</p>
                        <p class="inline text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl sm:leading-none">to the
                            MAX with</p>
                        <p class="inline text-blue-700 dark:text-blue-400 text-3xl font-bold tracking-tight sm:text-4xl sm:leading-none">
                            Gemini
                            Prompts</p>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <p class="mb-4 text-base text-left text-gray-700 dark:text-gray-300">"Hayal gücünüzü harekete geçirecek yüzlerce benzersiz prompt ile sohbete dalın, her konuda ilham verici fikirler ve keşfedilmemiş dünyalar sizi bekliyor."

</p>
                    <a href="#kartlar" class="w-3/12 text-blue-700 dark:text-blue-400 text-center flex font-semibold items-center transition-colors duration-200
            hover:text-blue-900 dark:hover:text-blue-600">Hemen keşfet</a>
                </div>
                 
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 pt-4 pr-8 pb-4 pl-8">
        <div class="flex items-start">
            <div class="w-1/5 bg-gray-100 dark:bg-gray-700 rounded-lg p-4 max-w-xs">
                <div class="mt-4 relative">
                    <input type="text" id="searchInput" oninput="searchKartlar()" placeholder="Search..."
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md dark:bg-gray-800 dark:text-gray-300">
                    <div class="absolute mt-1 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-lg z-10">
                        <ul id="dropdownResults" class="max-h-60 overflow-auto">
                            <!-- Dropdown items will be dynamically inserted here -->
                        </ul>
                    </div>
                </div>
                <div class="mt-6 pb-2 mb-4 border-b border-gray-200 dark:border-gray-600">
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">Filter By Category</p>
                </div>
                <ul class="space-y-2" id="kategoriler">
                    <!-- Kategori itemleri -->
                </ul>
            </div>
            <div class="w-4/5 ml-auto">
 
                <div class="flex justify-end mb-4">

                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg inline-block w-64">
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">Sort By</p>
                        <select id="sortBySelect" onchange="sortKartlar()"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md dark:bg-gray-800 dark:text-gray-300">
                            <option value="title" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-300">Title</option>
                            <option value="category" class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-300">Category</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-4" id="kartlar">
  
    <!-- Kart itemleri -->
</div>

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
                    const kartHTML = `<div
    class="bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-300 rounded-lg border border-gray-200 dark:border-gray-600 divide-gray-200 dark:divide-gray-600 flex max-w-sm flex-col p-0 transition-transform duration-300 hover:scale-105 hover:bg-gray-50 dark:hover:bg-gray-700 hover:shadow-lg">

        <div class="bg-gray-100 dark:bg-gray-700 border-b dark:border-gray-600 rounded-t-lg py-3 px-4 md:py-4 md:px-5 flex gap-2 items-center flex-wrap">
        <div
            class="border-gray-200 dark:border-gray-600 divide-gray-200 dark:divide-gray-600 font-medium inline-flex items-center justify-center px-2.5 py-0.5 text-sm bg-purple-100 dark:bg-purple-800 text-purple-800 dark:text-purple-200 rounded-full">
            ${kategoriAdiById[kart.category_id]}
        </div>
    </div>
    <div class="p-4 flex flex-col justify-between h-full">
        <h5 class="text-xl font-bold text-gray-900 dark:text-white w-full">${kart.title}</h5>
        <p class="my-4 font-normal text-gray-700 dark:text-gray-300 leading-tight ">${kart.description.length > 70 ? kart.description.substring(0, 70) + '...' : kart.description}</p>
        <div class="flex items-end justify-between">
            <button class="hover:underline text-primary-600 dark:text-primary-400 w-fit flex gap-2 items-center mt-4"
                onclick="showPrompt('${kart.prompt}', '${kart.id}')">
                Run Prompt
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide-icon lucide lucide-chevron-right ">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </button>
            <div class="flex items-center gap-2">
                <button onclick="starCard(${kart.id})" class="hover:yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-star">
                        <polygon
                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                    </svg>
                </button>
                <div></div>
            </div>
        </div>
    </div>
</div>`;
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
                allButton.classList.add("category-button", "flex", "hover:bg-gray-50", "dark:hover:bg-gray-600", "focus:outline-none", "focus:ring-2", "focus:ring-indigo-500", "focus:border-indigo-500", "w-full", "text-left", "text-gray-700", "dark:text-gray-300", "bg-white", "dark:bg-gray-800", "rounded-md", "py-2", "px-3", "justify-between", "items-center");
                allButton.onclick = () => filterKartlar('all');
                const allListItem = document.createElement("li");
                allListItem.appendChild(allButton);
                kategorilerListesi.appendChild(allListItem);

                // Kategorileri düğmelere dönüştür
                kategoriler.forEach(kategori => {
                    const listItem = document.createElement("li");
                    const button = document.createElement("button");
                    button.textContent = kategori.name;
                    button.classList.add("category-button", "flex", "hover:bg-gray-50", "dark:hover:bg-gray-600", "focus:outline-none", "focus:ring-2", "focus:ring-indigo-500", "focus:border-indigo-500", "w-full", "text-left", "text-gray-700", "dark:text-gray-300", "bg-white", "dark:bg-gray-800", "rounded-md", "py-2", "px-3", "justify-between", "items-center");
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
        function showPrompt(prompt, promptCardId) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'chat.php';

            var promptInput = document.createElement('input');
            promptInput.type = 'hidden';
            promptInput.name = 'initial_message';
            promptInput.value = prompt;
            form.appendChild(promptInput);

            var promptCardIdInput = document.createElement('input');
            promptCardIdInput.type = 'hidden';
            promptCardIdInput.name = 'prompt_card_id';
            promptCardIdInput.value = promptCardId;
            form.appendChild(promptCardIdInput);

            document.body.appendChild(form);
            form.submit();
        }

        // Kartları sıralama fonksiyonu
        function sortKartlar() {
            const sortBy = document.getElementById("sortBySelect").value;
            let sortedKartlar = [...allKartlar]; // Tüm kartların bir kopyasını al
            if (sortBy === 'title') {
                sortedKartlar.sort((a, b) => a.title.localeCompare(b.title)); // Başlığa göre sırala
            } else if (sortBy === 'category') {
                sortedKartlar.sort((a, b) => a.category_id - b.category_id); // Kategoriye göre sırala
            }
            filterKartlar('all', sortedKartlar); // Filtrelenmiş ve sıralanmış kartları göster
        }
        // Account popup
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('accountBtn').addEventListener('click', function() {
        document.getElementById('accountPopup').classList.toggle('hidden');
    });

    fetch('api/get_user_info.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('userName').textContent = data.name;
                document.getElementById('userEmail').textContent = data.email;
            
            } else {
                console.error('Kullanıcı bilgileri alınamadı:', data.error);
            }
        })
});


function starCard(cardId) {
    fetch('api/star_card.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ card_id: cardId })
    })
    .then(response => response.json()) // Yanıtı JSON olarak al
    .then(data => {
        if (data.success) {
            alert('Kart başarıyla yıldızlandı!');
        } else {
            alert('Kart yıldızlanırken bir hata oluştu: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Kart yıldızlanamadı:', error);
    });
}

    </script>
    <script src="src/app.js"></script>
</body>
</html>
