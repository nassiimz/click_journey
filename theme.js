// Crée dynamiquement la balise <link> pour le thème
const themeLink = document.createElement("link");
themeLink.rel = "stylesheet";
themeLink.id = "theme-style";
document.head.appendChild(themeLink);

// Fonction pour définir le thème
function setTheme(theme) {
    document.cookie = `theme=${theme}; path=/; max-age=31536000`; // 1 an
    themeLink.href = theme === "dark" ? "theme-dark.css" : "theme-light.css";
}

// Fonction pour lire le cookie
function getThemeFromCookie() {
    const match = document.cookie.match(/theme=(dark|light)/);
    return match ? match[1] : "light";
}

// Initialisation au chargement
document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = getThemeFromCookie();
    setTheme(savedTheme);

    document.getElementById("theme-toggle").addEventListener("click", () => {
        const newTheme = themeLink.href.includes("dark") ? "light" : "dark";
        setTheme(newTheme);
    });
});

function setFontSize(size) {
    document.cookie = `fontSize=${size}; path=/; max-age=31536000`;
    document.documentElement.classList.remove("font-normal", "font-medium", "font-large");
    document.documentElement.classList.add(`font-${size}`);
}

function getFontSizeFromCookie() {
    const match = document.cookie.match(/fontSize=(normal|medium|large)/);
    return match ? match[1] : "normal";
}

document.addEventListener("DOMContentLoaded", () => {
    const savedFontSize = getFontSizeFromCookie();
    setFontSize(savedFontSize);

    const selector = document.getElementById("font-size-selector");
    if (selector) {
        selector.value = savedFontSize;
        selector.addEventListener("change", (e) => {
            setFontSize(e.target.value);
        });
    }
});

