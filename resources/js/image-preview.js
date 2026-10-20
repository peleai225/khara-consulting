/**
 * Prévisualisation d'image lors du chargement
 */
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner tous les inputs de type file pour les images
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]');
    
    imageInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Vérifier que c'est bien une image
                if (!file.type.startsWith('image/')) {
                    alert('Veuillez sélectionner une image valide.');
                    this.value = '';
                    return;
                }
                
                // Créer un FileReader
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const result = e.target.result;
                    
                    // Trouver le conteneur parent
                    const container = input.closest('div');
                    if (!container) return;
                    
                    // Supprimer l'ancienne prévisualisation si elle existe
                    const existingPreview = container.querySelector('.image-preview-container');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Créer le conteneur de prévisualisation
                    const previewContainer = document.createElement('div');
                    previewContainer.className = 'image-preview-container mt-3';
                    previewContainer.innerHTML = `
                        <div class="relative inline-block">
                            <img src="${result}" 
                                 alt="Aperçu" 
                                 class="w-32 h-32 object-cover rounded-lg border-2 border-khara-gray-200 shadow-lg">
                            <button type="button" 
                                    class="absolute -top-2 -right-2 w-6 h-6 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors image-preview-remove"
                                    title="Supprimer l'aperçu">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-khara-gray-500 font-sans mt-2">Aperçu de l'image sélectionnée</p>
                    `;
                    
                    // Insérer après l'input
                    input.parentNode.insertBefore(previewContainer, input.nextSibling);
                    
                    // Gérer le bouton de suppression
                    const removeBtn = previewContainer.querySelector('.image-preview-remove');
                    if (removeBtn) {
                        removeBtn.addEventListener('click', function() {
                            input.value = '';
                            previewContainer.remove();
                        });
                    }
                };
                
                reader.onerror = function() {
                    alert('Erreur lors de la lecture de l\'image.');
                };
                
                // Lire le fichier
                reader.readAsDataURL(file);
            }
        });
    });
});

