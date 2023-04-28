
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <form action="" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const tbody = document.querySelector('tbody');

    tbody.addEventListener('click', (event) => {

        const deleteButton = event.target.closest('#deleteButton');
        if (!deleteButton) {
            return
        }
        
        const deleteModal = document.querySelector('#deleteModal');

        // récupère l'ID du produit à supprimer
        const productId = deleteButton.getAttribute('data-product-id');
        const productRef = deleteButton.getAttribute('data-product-ref');
        deleteModal.querySelector('.modal-body').innerText = `Voulez-vous vraiment supprimer le produit ${productRef} ?`;

        // met à jour l'attribut "action" du formulaire de suppression avec l'ID du produit
        const deleteForm = document.querySelector('#deleteForm');
        deleteForm.action = `/product/${productId}`;

        // ouvre le modal de confirmation de suppression
        deleteModal.classList.add('show');
    });
</script>