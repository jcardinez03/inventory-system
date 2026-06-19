<div class="modal fade" id="add-category">
    <div class="modal-dialog border-dark">
        <div class="modal-content border-dark">
            <div class="modal-header border-dark">
                <h3>Add Category</h3>
            </div>
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                
                <div class="modal-body border-dark">
                    <input type="text" name="name" id="name" placeholder="Add category" class="form-control">
                </div>
                <div class="modal-footer border-dark border-0">
                    <button class="btn btn-sm btn-outline-dark" data-bs-dismiss="modal" type="button">Cancel</button>
                    <button type="submit" class="btn btn-dark">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>