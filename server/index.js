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
                onclick="showPrompt('${kart.prompt}')">
                Run Prompt
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide-icon lucide lucide-chevron-right ">
                    <path d="m9 18 6-6-6-6"></path>
                </svg>
            </button>
            <div class="flex items-center gap-2">
                <button id="copy" class="hover:yellow-500">
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
        function showPrompt(prompt) {
            alert(prompt);
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
        //mobile menu

        $(document).ready(function() {
            $(".mobile-menu-button").click(function() {
                $(".mobile-menu").toggleClass("hidden");
            });
        });
        