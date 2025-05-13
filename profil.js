document.addEventListener('DOMContentLoaded', function() {
    const editProfileBtn = document.getElementById('edit-profile');
    const cancelEditBtn = document.getElementById('cancel-edit');
    const saveProfileBtn = document.getElementById('save-profile');
    const editForm = document.getElementById('edit-profile-form');
    const userNameDisplay = document.getElementById('user-name');
    const userEmailDisplay = document.getElementById('user-email');
    const nameInput = document.getElementById('edit-name');
    const emailInput = document.getElementById('edit-email');

    // Afficher le formulaire d'édition
    editProfileBtn.addEventListener('click', function() {
        editForm.style.display = 'block';
        userNameDisplay.style.display = 'none';
        userEmailDisplay.style.display = 'none';
        editProfileBtn.style.display = 'none';
    });

    // Annuler l'édition
    cancelEditBtn.addEventListener('click', function() {
        editForm.style.display = 'none';
        userNameDisplay.style.display = 'block';
        userEmailDisplay.style.display = 'block';
        editProfileBtn.style.display = 'block';
    });

    // Sauvegarder les modifications
    saveProfileBtn.addEventListener('click', function() {
        const newName = nameInput.value.trim();
        const newEmail = emailInput.value.trim();

        // Validation simple
        if (!newName || !newEmail || !validateEmail(newEmail)) {
            alert('Veuillez remplir tous les champs correctement.');
            return;
        }

        // Mettre à jour l'affichage
        userNameDisplay.textContent = newName;
        userEmailDisplay.textContent = newEmail;

        // Mettre à jour l'avatar avec le nouveau nom
        const avatarImg = document.querySelector('.profile-avatar');
        avatarImg.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(newName)}&background=E67E22&color=fff&size=150`;

        // Cacher le formulaire et réafficher les infos
        editForm.style.display = 'none';
        userNameDisplay.style.display = 'block';
        userEmailDisplay.style.display = 'block';
        editProfileBtn.style.display = 'block';

        // Envoyer les données au serveur en arrière-plan
        updateProfileOnServer(newName, newEmail);
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function updateProfileOnServer(name, email) {
        // Créer un objet FormData pour envoyer les données
        const formData = new FormData();
        formData.append('nom', name);
        formData.append('email', email);
        formData.append('save-profile', 'true');

        // Envoyer les données au serveur avec fetch
        fetch('profil.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la mise à jour du profil');
            }
            return response.text();
        })
        .then(() => {
            // Mettre à jour la session côté client (optionnel)
            if (typeof updateSession === 'function') {
                updateSession(name, email);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de la mise à jour du profil.');
        });
    }
});

// Fonction optionnelle pour mettre à jour les données de session côté client
function updateSession(name, email) {
    // Cette fonction peut être utilisée si vous stockez des données dans sessionStorage
    sessionStorage.setItem('userName', name);
    sessionStorage.setItem('userEmail', email);
}