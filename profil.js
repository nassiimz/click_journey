document.addEventListener('DOMContentLoaded', function() {
        const toggleEditBtn = document.getElementById('toggle-edit-btn');
        const cancelEditBtn = document.getElementById('cancel-edit-btn');
        const editSection = document.getElementById('profile-edit-section');
        const editForm = document.querySelector('#profile-edit-section form');
        const userNameDisplay = document.querySelector('.profile-sidebar h3');
        const userEmailDisplay = document.querySelector('.profile-sidebar p');
        const profileAvatar = document.querySelector('.profile-avatar');
        
        // Stocker les valeurs originales
        let originalName = userNameDisplay.textContent;
        let originalEmail = userEmailDisplay.textContent;

        toggleEditBtn.addEventListener('click', function() {
            editSection.style.display = editSection.style.display === 'none' ? 'block' : 'none';
        });
        
        cancelEditBtn.addEventListener('click', function() {
            // Réinitialiser les valeurs
            editForm.querySelector('#nom').value = originalName;
            editForm.querySelector('#email').value = originalEmail;
            editSection.style.display = 'none';
        });
        
        // Gestion de la soumission asynchrone
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(editForm);
            formData.append('edit_profile', 'true');
            
            fetch('profil.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.startsWith('success')) {
                    // Mise à jour de l'affichage
                    const newName = editForm.querySelector('#nom').value;
                    const newEmail = editForm.querySelector('#email').value;
                    
                    userNameDisplay.textContent = newName;
                    userEmailDisplay.textContent = newEmail;
                    profileAvatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(newName)}&background=E67E22&color=fff&size=150`;
                    
                    // Mettre à jour les valeurs originales
                    originalName = newName;
                    originalEmail = newEmail;
                    
                    // Masquer le formulaire
                    editSection.style.display = 'none';
                    
                    // Afficher un message de succès
                    alert('Profil mis à jour avec succès');
                } else if (data.startsWith('error')) {
                    // Afficher les erreurs
                    alert(data.substring(6));
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de la mise à jour');
            });
        });
    });
