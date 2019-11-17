<template>
    <div class="modal fade" id="myModal_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <slot name="header"></slot>
          </div>
          <div class="modal-body">
             <slot name="body"></slot>
          </div>
        </div>
      </div>
 </div> 
</template>