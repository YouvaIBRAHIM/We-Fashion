
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
                @if (!$isTrashView)
                    <form action="" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Mettre dans la corbeille</button>
                    </form>
                @else
                    <form action="" method="POST" id="definitiveDeleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
                    </form>
                @endif
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
        const deleteForm = document.querySelector('#deleteForm');
        const definitiveDeleteForm = document.querySelector('#definitiveDeleteForm');

        // récupère l'ID du produit à supprimer
        const productId = deleteButton.getAttribute('data-product-id');
        const productRef = deleteButton.getAttribute('data-product-ref');


        // met à jour l'attribut "action" du formulaire de suppression avec l'ID du produit
        if (deleteForm) {
            deleteModal.querySelector('.modal-body').innerText = `Voulez-vous vraiment mettre le produit ${productRef} dans la corbeille ?`;
            deleteForm.action = `/product/${productId}`;
        }

        if (definitiveDeleteForm) {
            deleteModal.querySelector('.modal-body').innerText = `Voulez-vous vraiment supprimer le produit ${productRef} ?`;
            definitiveDeleteForm.action = `/productsTrash/${productId}`;
        }

        // ouvre le modal de confirmation de suppression
        deleteModal.classList.add('show');
    });
</script>