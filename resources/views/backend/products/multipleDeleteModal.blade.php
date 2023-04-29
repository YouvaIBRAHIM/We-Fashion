
<div class="modal fade" id="multipleDeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment supprimer le/les produit.s sélectionné.s ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <form method="POST" action="{{ route('product.multipleDelete') }}" id="multipleDeleteForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="productIds" id="productIds">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const multipleDeleteBtn = document.querySelector('.multipleDeleteBtn');
    const multipleDeleteModal = document.querySelector('#multipleDeleteModal');

    multipleDeleteBtn.addEventListener('click', (event) => {
        const productIds = document.querySelector('#productIds');            
        const selectedRows = document.querySelectorAll('input[type="checkbox"]:checked');

        const selectedIds = [];
        selectedRows.forEach(function(row) {
            selectedIds.push(row.value);
        });

        productIds.value = selectedIds.join(',')
        // ouvre le modal de confirmation de suppression
        multipleDeleteModal.classList.add('show');
    });


</script>