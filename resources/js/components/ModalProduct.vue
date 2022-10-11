<template>
    <div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" @click="close()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Product Name:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Detail:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
</template>
<script>
    export default {

        props: {
            show: {
                type: Boolean,
                default: false
            }
        },

        data() {
            return {
                form: {
                    name: '',
                    detail: ''
                }
            }
        },

        watch: {
            show() {
                if(this.show === true) {
                    $(`#modalProduct`).modal({
                        backdrop: "static",
                        keyboard: false
                    });
                }   else {
                    $(`#modalProduct`).modal("hide");
                }
            }
        },

        methods: {
            close() {
                this.$emit('close', false);
                $(`#modalProduct`).modal("hide");
                this.downloading = false
            },
        }


        
    }
</script>
