<template>

    <div class="box box-default box-solid" v-if="userLogged">
        <div class="box-body">
            <div class="overlay" v-if="this.invoice.loading" style="padding: 5rem">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <table class="table table-responsive table-bordered"
                   v-if="!this.invoice.loading && this.allInvoices.length">
                <thead>
                <tr>
                    <th style="width: 15%;">InvoiceNumber</th>
                    <th style="width: 20%">Customer Name</th>
                    <th>Line Items</th>
                    <th>Status</th>
                    <th>AmountDue</th>
                    <th>AmountPaid</th>
                    <th style="width:10%">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(data,key) in this.allInvoices" :key="key" style="cursor: pointer">
                    <td>{{ data.InvoiceNumber }}</td>
                    <td>{{ data.Contact.Name }}</td>
                    <td>
                        <p v-for="(item,key) in (data.LineItems || []) " :key="key">
                            {{ item.Description }} {{ key !== (data.LineItems || []).length - 1 ? "|" : "" }}
                        </p>
                    </td>
                    <td><span class="label btn btn-flat " :class="getSpanClass(data.Status)"
                              style="cursor: default;">{{ data.Status }}</span></td>
                    <td>{{ data.AmountDue }}</td>
                    <td>{{ data.AmountPaid }}</td>
                    <td>
                        <button
                            title="VIEW INVOICE"
                            type="button"
                            @click="viewInvoice(data.InvoiceNumber)"
                            class="btn btn-default btn-flat btn-sm">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button title="EDIT INVOICE"
                                class="btn btn-primary btn-flat btn-sm"
                                @click="editInvoice(data.InvoiceNumber)"
                                type="button">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix" v-if="!this.invoice.loading">
            <ul class="pagination pagination-lg no-margin pull-right">
                <li v-for="(value,key) in 5" :class="currentPage === value ? 'active':'' " :key="key"
                    @click="paginate(value)">
                    <a href="#">{{ value }}</a>
                </li>
            </ul>
        </div>
    </div>
    <div v-else>
        <h3 class="text-center">Please login Before viewing Xero </h3>
    </div>
</template>
<script>
import {mapActions} from "vuex";

export default {
    name: "XeroInvoice",
    props: ['logged'],
    watch: {
        invoice: function (val, old) {
            this.currentPage = val.page;
        }
    },
    computed: {
        invoice() {
            return this.$store.state.invoice;
        },
        allInvoices() {
            return this.$store.state.allInvoices
        }
    },
    data() {
        return {
            userLogged: this.logged,
            currentPage: 1
        }
    },
    async mounted() {
        await this.getAllInvoices();
    },

    methods: {
        viewInvoice(id) {
            window.location.href = '/manage/xero/invoices/' + id;
        },
        editInvoice(id) {
            window.location.href = '/manage/xero/invoices/edit' + id;
        },
        async paginate(value) {
            await this.$store.dispatch('getAllInvoices', {
                page: value,
                invoiceLoading: true,
                invoiceStatus: this.invoice.status
            })
        },
        ...mapActions(['getAllInvoices']),
        getSpanClass(status) {
            switch (status.toUpperCase()) {
                case 'DRAFT':
                    return 'bg-yellow';
                case 'PAID':
                    return 'bg-green';
                case 'VOIDED':
                    return 'bg-blue';
                default:
                    return 'bg-aqua';
            }
        },
    }
}
</script>
