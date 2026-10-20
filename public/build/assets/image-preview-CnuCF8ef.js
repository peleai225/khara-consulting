document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll('input[type="file"][accept*="image"]').forEach(e=>{e.addEventListener("change",function(l){const r=l.target.files[0];if(r){if(!r.type.startsWith("image/")){alert("Veuillez sélectionner une image valide."),this.value="";return}const n=new FileReader;n.onload=function(s){const c=s.target.result,i=e.closest("div");if(!i)return;const o=i.querySelector(".image-preview-container");o&&o.remove();const t=document.createElement("div");t.className="image-preview-container mt-3",t.innerHTML=`
                        <div class="relative inline-block">
                            <img src="${c}" 
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
                    `,e.parentNode.insertBefore(t,e.nextSibling);const a=t.querySelector(".image-preview-remove");a&&a.addEventListener("click",function(){e.value="",t.remove()})},n.onerror=function(){alert("Erreur lors de la lecture de l'image.")},n.readAsDataURL(r)}})})});
