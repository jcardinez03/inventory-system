<div class="modal fade" id="delete-product-{{ $product->id }}">
    <div class="modal-dialog border-danger">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h4 class="text-danger">
                    <i class="fas fa-trash-can"></i> Delete Product
                </h4>
            </div>
            <div class="modal-body border-danger">Are you sure you want to delete "<span class="fw-bold">{{ $product->name }}</span>"?</div>
            <div class="modal-footer border-danger border-0">
                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>