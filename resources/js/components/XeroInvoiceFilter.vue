<template>
    <div class="box box-solid" :class="boxState ==='fa-plus' ? 'collapsed-box' :''">
        <div class="box-header with-border"><h3 class="box-title">Advanced Filter</h3>
            <div class="box-tools pull-right">
                <button type="button" data-widget="collapse" class="btn btn-box-tool">
                    <i class="fa " :class="boxState"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-4">
                <label>Invoice Status</label>
                <select v-model="selectedStatus" class="form-control">
                    <option>------SELECT STATUS---------</option>
                    <option v-for="(status,key) in invoiceStatus" :key="key" :value="status">
                        {{ status }}
                    </option>
                </select>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-flat btn-primary" @click="filterNow"><i class="fa fa-filter"></i>
                APPLY FILTER
            </button>
            <button type="button" class="btn btn-flat btn-danger" @click="resetFilter">
                <i class="fa fa-reorder"></i> RESET FILTER
            </button>
        </div>
    </div>
</template>
<script>

export default {
    name: "XeroInvoiceFilter",
    data() {
        return {
            selectedStatus: '',
            boxState: 'fa-plus',
            invoiceStatus: ['DRAFT', 'PAID', 'AUTHORISED', 'VOIDED','DELETED'],
        }
    },
    methods: {
        async resetFilter() {
            this.selectedStatus = ''
            await this.$store.dispatch('getAllInvoices', {invoiceStatus: '', invoiceLoading: true, page: 1})

        },
        async filterNow() {
            await this.$store.dispatch('getAllInvoices', {invoiceStatus: this.selectedStatus, invoiceLoading: true})
        },
        changeBoxState() {
            this.boxState = this.boxState === 'fa-plus' ? 'fa-minus' : "fa-plus";
        }
    }
}
</script>
