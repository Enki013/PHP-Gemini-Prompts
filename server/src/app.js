//ikonlar
const monIcon = document.querySelector(".mon");
const sunIcon = document.querySelector(".sun");
//tema değişkenleri
const userTheme = localStorage.getItem("theme");
const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

//icon toggling
const iconToggle = () => {
    monIcon.classList.toggle("display-none");
    sunIcon.classList.toggle("display-none");
}

//initial theme check
const themeCheck = () => {
    if (userTheme === "dark" || (!userTheme && systemTheme)) {
        document.documentElement.classList.add("dark");
        monIcon.classList.add("display-none");
        return;
    }
    sunIcon.classList.add("display-none");
}

//manuel theme check
const themeSwitch = () => {
    if (document.documentElement.classList.contains("dark")) {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("theme", "light");
    } else {
        document.documentElement.classList.add("dark");
        localStorage.setItem("theme", "dark");
    }
    iconToggle();
}

//call theme switch on clicking buttons
sunIcon.addEventListener("click", () => themeSwitch());
monIcon.addEventListener("click", () => themeSwitch());

//invoke theme check on initial load
themeCheck();

function toggleTheme() {
    const toggleThumb = document.querySelector('#theme-toggle + div > div');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
        toggleThumb.classList.remove('translate-x-full');
        toggleThumb.classList.add('translate-x-0');
        sunIcon.classList.remove('hidden');
        moonIcon.classList.add('hidden');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        toggleThumb.classList.remove('translate-x-0');
        toggleThumb.classList.add('translate-x-full');
        sunIcon.classList.add('hidden');
        moonIcon.classList.remove('hidden');
    }
}

// Sayfa yüklendiğinde tema durumunu kontrol et
document.addEventListener('DOMContentLoaded', function () {
    const toggleThumb = document.querySelector('#theme-toggle + div > div');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
        document.getElementById('theme-toggle').checked = true;
        toggleThumb.classList.add('translate-x-full');
        sunIcon.classList.add('hidden');
        moonIcon.classList.remove('hidden');
    } else {
        document.documentElement.classList.remove('dark');
        toggleThumb.classList.add('translate-x-0');
        sunIcon.classList.remove('hidden');
        moonIcon.classList.add('hidden');
    }
});
document.getElementById('accountBtn').addEventListener('click', function() {
    document.getElementById('accountPopup').classList.toggle('hidden');
});

fetch('api/get_user_info.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('userName').textContent = data.name;
        document.getElementById('userEmail').textContent = data.email;
    })
    .catch(error => console.error('Kullanıcı bilgileri alınamadı:', error));