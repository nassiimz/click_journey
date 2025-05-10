// Crée dynamiquement la balise <link> pour le thème
const themeLink = document.createElement("link");
themeLink.rel = "stylesheet";
themeLink.id = "theme-style";
document.head.appendChild(themeLink);

// --- GESTION THÈME ---
function setTheme(theme) {
    document.cookie = `theme=${theme}; path=/; max-age=31536000`; // 1 an
    themeLink.href = theme === "dark" ? "css/theme-dark.css" : "css/theme-light.css";
}

function getThemeFromCookie() {
    const match = document.cookie.match(/theme=(dark|light)/);
    return match ? match[1] : "light";
}

// --- GESTION POLICE ---
function setFontSize(size) {
    document.cookie = `fontSize=${size}; path=/; max-age=31536000`;
    document.documentElement.classList.remove("font-normal", "font-medium", "font-large");
    document.documentElement.classList.add(`font-${size}`);
}

function getFontSizeFromCookie() {
    const match = document.cookie.match(/fontSize=(normal|medium|large)/);
    return match ? match[1] : "normal";
}

// --- INITIALISATION ---
document.addEventListener("DOMContentLoaded", () => {
    // Appliquer le thème sauvegardé
    const savedTheme = getThemeFromCookie();
    setTheme(savedTheme);

    const themeBtn = document.getElementById("theme-toggle");
    if (themeBtn) {
        themeBtn.addEventListener("click", () => {
            const newTheme = themeLink.href.includes("dark") ? "light" : "dark";
            setTheme(newTheme);
        });
    }

    // Appliquer la taille de police sauvegardée
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
