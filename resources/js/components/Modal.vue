<template>
    <div class="modal fade in" id="modal-default" v-if="this.showModal" style="display: block">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">{{ this.modalTitle }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row text-center" v-if="!Object.keys(this.modalData).length">
                        <button class="btn btn-default btn-flat">
                            <i class="fa fa-refresh fa-spin"> </i> Loading.........
                        </button>
                    </div>
                    <div class="row" v-else>
                        <div class="col-xs-12" :title="this.modalData.message">
                            <div class="text-left text-bold text-black" style="padding-bottom: 10px;">
                                From: {{this.modalData.fromName}}
                                <small><{{this.modalData.fromEmail}}></small>
                            </div>
                            <div class="text-left text-bold" style="padding-bottom: 20px">
                                Subject: {{this.modalData.subject}}
                            </div>
                            <div>
                                <p style=" word-wrap: break-word">{{changeHtmlToString(this.modalData.message)}}</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal" @click="close">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Modal',
    props: {
        show: Boolean,
        modalTitle: String,
        modalData: {},
    },
    data() {
        return {
            showModal: this.show,
        }
    },
    methods: {
        close() {
            this.showModal = false
        },
        changeHtmlToString(string) {
            return string.replace(/[\r]/g, '<br/>');
        }
    },
};
</script>

