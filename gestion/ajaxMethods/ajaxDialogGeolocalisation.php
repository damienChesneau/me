<?php include '../testPerPages.php'; ?>
</div><div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog"  style="width: 710px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Géolocalisation</h4>
            </div>
            <div class="modal-body" style="height: 550px;" >
                
                <iframe style="z-index: -1; overflow-x: hidden; overflow-y: auto; border: 0px; height: 520px; width: 650px; margin-right: auto;
                        margin-left: auto; "  src="./ajaxMethods/gmap.php"></iframe> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
