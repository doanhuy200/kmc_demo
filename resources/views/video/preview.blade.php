<div id="previewModal" class="modal fade">
    <div class="modal-dialog modal-confirm modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title">Preview Video</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">ID: <span class="flavor-id"></span></label>
                </div>
                <div class="form-group">
                    <label for="">EntryID: <span class="flavor-entryId"></span></label>
                </div>
                <div class="form-group">
                    <video class="video-wrapper" id="video-wrapper" controls="controls" preload="metadata">
                        <source class="video-preview" type="video/mp4">
                    </video>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>