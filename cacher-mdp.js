/**
 * Gestion de l'affichage/masquage des mots de passe
 * Fonctionne pour les pages de connexion et d'inscription
 */
document.addEventListener('DOMContentLoaded', function() {
    // Configuration des champs à traiter avec leurs sélecteurs
    const passwordFieldsConfig = [
        { selector: '#mot_de_passe', page: 'all' },         // Champ présent sur les deux pages
        { selector: '#confirmation', page: 'inscription' }, // Champ spécifique à l'inscription
        { selector: '#password', page: 'connexion' }        // Champ alternatif (si différent)
    ];

    // Créer un bouton toggle pour un champ donné
    function createToggleButton(targetId) {
        const button = document.createElement('span');
        button.className = 'toggle-password';
        button.setAttribute('data-target', targetId);
        button.style.cssText = `
            position: absolute;
            right: 10px;
            top: 65%;
            transform: translateY(-50%);
            cursor: pointer;
        `;
        button.title = 'Afficher / Masquer';
        button.textContent = '👁️';
        
        button.addEventListener('click', function() {
            const targetInput = document.querySelector(targetId);
            if (targetInput) {
                const type = targetInput.getAttribute('type') === 'password' ? 'text' : 'password';
                targetInput.setAttribute('type', type);
                this.textContent = type === 'password' ? '👁️' : '🔒';
            }
        });
        
        return button;
    }

    // Détecter sur quelle page nous sommes
    const currentPage = document.querySelector('form[action*="inscription"]') ? 'inscription' : 'connexion';

    // Traiter tous les champs configurés
    passwordFieldsConfig.forEach(config => {
        // Vérifier si le champ est pertinent pour la page actuelle
        if (config.page === 'all' || config.page === currentPage) {
            const inputField = document.querySelector(config.selector);
            
            if (inputField) {
                const container = inputField.parentElement;
                if (container) {
                    container.style.position = 'relative';
                    
                    // Vérifier si le bouton n'existe pas déjà
                    if (!container.querySelector('.toggle-password')) {
                        container.appendChild(createToggleButton(config.selector));
                    }
                }
            }
        }
    });

    // Fonctionnalité supplémentaire: basculer tous les mots de passe en même temps
    const toggleAllButton = document.querySelector('#toggle-all-passwords');
    if (toggleAllButton) {
        toggleAllButton.addEventListener('click', function(e) {
            e.preventDefault();
            const allPasswordFields = document.querySelectorAll('input[type="password"], input[type="text"].password-field');
            
            allPasswordFields.forEach(field => {
                const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
                field.setAttribute('type', type);
                
                // Mettre à jour les icônes correspondantes
                const toggleButton = field.parentElement.querySelector('.toggle-password');
                if (toggleButton) {
                    toggleButton.textContent = type === 'password' ? '👁️' : '🔒';
                }
            });
            
            this.textContent = this.textContent.includes('Tout') ? 'Tout masquer' : 'Tout afficher';
        });
    }
});
