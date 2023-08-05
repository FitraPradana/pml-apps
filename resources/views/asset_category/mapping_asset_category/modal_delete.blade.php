<div id="delete_astcat" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Asset Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('map_ast_cat_delete') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="submit-section">
                        {{-- <button class="btn btn-primary submit-btn">Submit</button> --}}
                        <button onclick="return confirm('Are you sure you want to delete this?');" type="submit"
                            value="delete" class="btn btn-danger btn-xs">
                            <span>DELETE</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
