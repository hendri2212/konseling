<template>
    <div id="loading_modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="p-4 modal-body d-flex justify-content-center align-items-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Modal } from 'bootstrap'
export default {
    data() {
        return {
            modal: null,
        }
    },
    async mounted() {
        this.modal = new Modal(document.getElementById('loading_modal'))
    },
    methods: {
        show() {
            if (this.modal != null) {
                this.modal.hide()
                this.modal.show()
            }
        },
        hide() {
            if (this.modal != null) {
                this.modal.hide()
            }
        }
    }
}
</script>