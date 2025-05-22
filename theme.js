// Gestion du thème
const themeLink = document.createElement("link");
themeLink.rel = "stylesheet";
themeLink.id = "theme-style";
document.head.appendChild(themeLink);

function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    themeLink.href = theme === "dark" ? "theme-dark.css" : "theme-light.css";
    localStorage.setItem('theme', theme);
}

// Gestion de la taille de police
function setFontSize(size) {
    document.documentElement.classList.remove('font-normal', 'font-medium', 'font-large');
    document.documentElement.classList.add(`font-${size}`);
    localStorage.setItem('fontSize', size);
}

// Initialisation au chargement
document.addEventListener("DOMContentLoaded", () => {
    // Thème
    const savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);

    document.getElementById("theme-toggle").addEventListener("click", () => {
        const currentTheme = localStorage.getItem('theme') || 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    });

    // Taille de police
    const savedFontSize = localStorage.getItem('fontSize') || 'normal';
    setFontSize(savedFontSize);

    const fontSizeSelector = document.getElementById("font-size-selector");
    if (fontSizeSelector) {
        fontSizeSelector.value = savedFontSize;
        fontSizeSelector.addEventListener("change", (e) => {
            setFontSize(e.target.value);
        });
    }
});