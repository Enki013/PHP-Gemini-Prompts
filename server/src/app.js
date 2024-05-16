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

