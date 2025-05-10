document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", (event) => {
            event.preventDefault(); // Empêche l'envoi immédiat du formulaire

            const button = form.querySelector("button");
            button.disabled = true; // Désactive le bouton
            button.textContent = "Traitement..."; // Change le texte du bouton

            // Simule un délai de 3 secondes
            setTimeout(() => {
                button.disabled = false; // Réactive le bouton
                button.textContent = button.classList.contains("vip") ? "VIP" :
                    button.classList.contains("ban") ? "Bannir" :
                        button.classList.contains("delete") ? "Supprimer" : "Envoyer";

                // Envoie le formulaire après le délai
                form.submit();
            }, 3000); // 3 secondes
        });
    });
});