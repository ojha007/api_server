<template>
    <form @submit.prevent="saveInvoice" method="post">
        <div class="alert alert-dismissible"
             :class="responseType=== 'success' ?'alert-success' : 'alert-danger' "
             v-if="responseType">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="hideAlert">×</button>
            <h4><i class="icon fa fa-check"></i> {{ responseType === 'success' ? 'SUCCESS!' : "FAILED" }}</h4>
            {{ serverMessage }}
        </div>

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Create New Invoice</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <div class="col-md-2">
                            <label class="control-label pull-md-right">Select Contact:</label>
                        </div>
                        <div class="col-md-10">
                            <v-select
                                placeholder="SELECT CONTACT"
                                :options="contactOptions"
                                v-model="contactId"
                                :reduce="contact => contact.value"
                            />
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="col-md-2">
                            <label class="control-label">Reference:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" v-model="reference" placeholder="ENTER REFERENCE NUMBER"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <div class="col-md-2">
                            <label class="control-label">Issue Date:</label>
                        </div>
                        <div class="col-md-10">
                            <datepicker v-model="issueDate" name="issueDate" input-class="form-control"
                                        format="yyyy-MM-dd"
                                        placeholder="SELECT ISSUE DATE"></datepicker>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="col-md-2">
                            <label class="control-label">Due Date:</label>
                        </div>
                        <div class="col-md-10">
                            <datepicker v-model="dueDate" name="dueDate" input-class="form-control"
                                        format="yyyy-MM-dd"
                                        placeholder="SELECT DUE DATE"></datepicker>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Enter the invoice items.</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th style="width: 8%;">Qty</th>
                        <th style="width: 8%;">Price</th>
                        <th style="width: 17%">Account</th>
                        <th style="width: 15%">Tax Rate</th>
                        <th style="width: 6%">Amount</th>
                        <th style="width: 6%;">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item,key) in LineItems" :key="key">
                        <td>
                            <input type="text" class="form-control" v-model="item.ItemName">
                        </td>
                        <td>
                            <textarea type="text" class="form-control" v-model="item.Description"></textarea>
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="item.Quantity" @change="updateAmount(key)">
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="item.UnitAmount"
                                   @change="updateAmount(key)">
                        </td>
                        <td>
                            <v-select
                                placeholder="SELECT ACCOUNT"
                                :options="accountOptions"
                                v-model="item.AccountCode"
                                :reduce="account => account.value"
                            />
                        </td>
                        <td>
                            <v-select
                                :options="taxRatesOptions"
                                v-model="item.TaxType"
                                :reduce="rate => rate.value"
                                placeholder="SELECT TAX RATES"/>
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="item.LineAmount" readonly>
                        </td>
                        <td>
                            <button class="btn btn-success btn-flat btn-sm" title="ADD NEW ROW" type="button"
                                    @click="addNewRow">
                                <i class="fa fa-plus"></i>
                            </button>
                            <button class="btn btn-danger btn-flat btn-sm" title="DELETE ROW" type="button"
                                    @click="removeRow(key)">
                                <i class="fa fa-times"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="row" style="display: flex;margin-top: 5em;justify-content: flex-end">
                    <div class="col-md-4 form-group">
                        <div class="col-md-2">
                            <label class="control-label pull-md-right">Total:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" readonly v-model="total">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-flat btn-primary pull-right">Save Invoice</button>
            </div>
        </div>
    </form>

</template>
<script>
import Datepicker from 'vuejs-datepicker';

export default {
    name: "XeroInvoiceCreate",
    components: {
        Datepicker
    },
    data() {
        return {
            responseType: '',
            serverMessage: null,
            contactId: null,
            reference: null,
            issueDate: null,
            dueDate: null,
            allContacts: [],
            contactOptions: [],
            LineItems: [
                {
                    ItemName: null,
                    Description: null,
                    Quantity: null,
                    UnitAmount: null,
                    AccountCode: null,
                    TaxType: null,
                    LineAmount: null

                },
            ],
            description: [],
            allTaxRates: [],
            allAccounts: [],
            taxRatesOptions: [],
            accountOptions: [],
            total: 0,
        }
    },
    async mounted() {
        await this.getTaxRates();
        await this.getAllContacts();
        await this.getAccounts();
    },
    methods: {
        hideAlert() {
            this.responseType = false;
        },
        updateAmount(key) {
            this.LineItems[key].LineAmount = this.LineItems[key].Quantity * this.LineItems[key].UnitAmount;
            this.total = this.LineItems.map(item => item.LineAmount).reduce((prev, curr) => prev + curr, 0)
        },
        setSelected(value) {
            console.log(value);
        },
        removeRow(rowId) {
            if (rowId === 0) return false;
            this.LineItems = this.LineItems.filter(function (obj, index) {
                return index !== rowId;
            });
        },
        addNewRow() {
            this.LineItems.push({
                ItemName: null,
                Description: null,
                Quantity: null,
                UnitAmount: null,
                AccountCode: null,
                TaxType: null,
                LineAmount: null
            });
            return true;
        },
        async getAllContacts() {
            let response = await axios.get('/api/manage/xero/contacts');
            if (response.data) {
                this.contactOptions = response.data.data.map(contact => {
                    return {
                        label: contact.Name,
                        value: contact.ContactID
                    }
                });
            }
        },
        async getTaxRates() {
            let response = await axios.get('/api/manage/xero/taxRates');
            if (response.data) {
                this.taxRatesOptions = response.data.data.map(tax => {
                    return {
                        label: tax.Name,
                        value: tax.TaxType
                    }
                });
            }
        },
        async getAccounts() {
            let response = await axios.get('/api/manage/xero/accounts');
            if (response.data) {
                this.accountOptions = response.data.data.map(tax => {
                    return {
                        label: tax.Name,
                        value: tax.Code
                    }
                });
            }
        },
        async saveInvoice() {
            let Invoices = {
                Contact: {
                    ContactID: this.contactId
                },
                LineItems: [...this.LineItems],
                Reference: this.reference,
                Date: new Date(this.issueDate).toLocaleDateString(),
                invoiceNumber: this.invoiceNumber,
                DueDate: new Date(this.dueDate).toLocaleDateString(),
                "Status": "AUTHORISED"
            }
            let response = await axios.post('/api/manage/xero/save-invoice', {Invoices});
            if (response.data.status === 201) {
                this.responseType = 'success';
                this.total = 0;
                this.contactId = '';
                this.reference = '';P
                this.dueDate = '';
                this.issueDate = '';
                this.LineItems = [{
                    ItemName: null,
                    Description: null,
                    Quantity: null,
                    UnitAmount: null,
                    AccountCode: null,
                    TaxType: null,
                    LineAmount: null
                }];
            } else {
                this.responseType = 'failed';
            }
            this.serverMessage = response.data.message;

        }
    }
}
</script>
