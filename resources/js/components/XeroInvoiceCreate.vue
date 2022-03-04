<template>
    <section>
        <div class="box box-default">
            <div class="box-header">
                <h3 class="box-title">Create New Invoice</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <div class="col-md-2">
                            <label class="control-label pull-md-right">To:</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control">
                                <option>------SELECT--------</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="col-md-2">
                            <label class="control-label">Reference:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" v-model="reference" placeholder="Enter Reference Number"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <div class="col-md-2">
                            <label class="control-label">Invoice Number:</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" v-model="invoiceNumber" placeholder="Enter Invoice Number"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="col-md-2">
                            <label class="control-label">Issue Date:</label>
                        </div>
                        <div class="col-md-10">
                            <datepicker v-model="issueDate" name="issueDate" input-class="form-control"
                                        placeholder="select issue date"></datepicker>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <div class="col-md-2">
                            <label class="control-label">Due Date:</label>
                        </div>
                        <div class="col-md-10">
                            <datepicker v-model="dueDate" name="dueDate" input-class="form-control"
                                        placeholder="select due date"></datepicker>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Account</th>
                        <th>Tax Rate</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item,key) in allItems" :key="key">

                        <td>
                            <input type="text" class="form-control" v-model="item.item">
                        </td>
                        <td>
                            <textarea type="text" class="form-control" v-model="item.description"></textarea>
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="item.qty">
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="item.price">
                        </td>
                        <td>
                            <select class="form-control" v-model="item.account">
                                <option>-----SELECT-----</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" v-model="item.taxRate">
                                <option>-----SELECT-----</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" v-model="item.amount">
                        </td>
                        <td>
                            <button class="btn btn-success btn-flat btn-sm" title="ADD NEW ROW" @click="addNewRow">
                                <i class="fa fa-plus"></i>
                            </button>
                            <button class="btn btn-danger btn-flat btn-sm" title="DELETE ROW" @click="removeRow(key)">
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
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-flat btn-primary pull-right">Save Invoice</button>
            </div>
        </div>

    </section>

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
            reference: null,
            issueDate: null,
            invoiceNumber: null,
            dueDate: null,
            allContacts: [],
            allItems: [
                {
                    item: null,
                    description: null,
                    qty: null,
                    price: null,
                    account: null,
                    taxRate: null,
                    amount: null

                },
            ],
            description: [],
            allTaxRates: [],
            allAccounts: [],
        }
    },
    async mounted() {
        await this.getAllContacts();
    },
    methods: {
        removeRow(rowId) {
            if (rowId === 0) return false;
            delete this.allItems[rowId];
            this.allItems = this.allItems.filter(function (obj,index) {
                return index !== rowId;
            });
        },
        addNewRow() {
            this.allItems.push({
                item: null,
                description: null,
                qty: null,
                price: null,
                account: null,
                taxRate: null,
                amount: null
            })
        },
        async getAllContacts() {

        }
    }
}
</script>
