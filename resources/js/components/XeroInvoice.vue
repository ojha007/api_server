<template>
    <div class="box box-default box-solid" v-if="userLogged">
        <div class="box-body" >
            <div class="overlay" v-if="loading" style="padding: 5rem">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <table class="table table-responsive  table-hover" v-if="!loading && invoices.length">
                <thead>
                <tr>
                    <th style="width: 15%;">InvoiceNumber</th>
                    <th style="width: 20%">Customer Name</th>
                    <th>Line Items</th>
                    <th>AmountDue</th>
                    <th>AmountPaid</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(invoice,key) in invoices" :key="key" @click="viewInvoice(invoice.InvoiceID)" style="cursor: pointer">
                    <td>{{ invoice.InvoiceNumber }}</td>
                    <td>{{ invoice.Contact.Name }}</td>
                    <td>
                       <small v-for="(item,key) in (invoice.LineItems || []) " :key="key">
                           {{item.Description}} {{ key!== (invoice.LineItems || []).length-1 ? "|":"" }}

                       </small>
                    </td>
                    <td>{{invoice.AmountDue}}</td>
                    <td>{{invoice.AmountPaid}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix" v-if="!loading">
            <ul class="pagination pagination-lg no-margin pull-right">
                <li ><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul>
        </div>
    </div>
    <div v-else>
        <h3 class="text-center">Please login Before viewing Xero </h3>
    </div>
</template>
<script>
export default {
    name: "XeroInvoice",
    props:['logged'],
    data() {
        return {
            params: {
                page: 1,
                if_modified_since: null,
                order:'InvoiceNumber Desc',
            },
            invoices: [],
            loading: true,
            userLogged:this.logged
        }
    },
    async mounted() {
        await this.getAllInvoices();
    },
    methods: {
        viewInvoice(InvoiceId){
            confirm('Are you sure to view ?')
            window.open(window.location.href + '/invoices/'+InvoiceId, '_blank');
        },

        async getAllInvoices() {
            let response = await axios.get(`/invoices/xero`, {params: this.params});
            console.log(response);
            if (response.data.status === 201) {
                this.invoices = response.data.data;
                this.loading = false
            }
        }
    }
}
</script>
