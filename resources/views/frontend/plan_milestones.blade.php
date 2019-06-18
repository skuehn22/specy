<table id="myTable" class=" table order-list pt-3">
    <thead>
    <tr>
        <td>Name</td>
        <td colspan="2">Amount</td>
    </tr>
    </thead>
    <tbody>
    <tr id="firstline">
        <td class="col-sm-3 col-lg-3" style="width: 30%">
            <input type="text" name="name[]" class="form-control" /><br>
            Description <i class="fas fa-info-circle green" data-toggle="tooltip" data-placement="top" title="Tell your client what this payment is for."></i><br><br>
            <textarea class="form-control" rows="3"  name="description[]"></textarea>
        </td>
        <td class="col-sm-2 col-lg-2" style="width: 17%">
            <input type="number" name="amount[]"  class="form-control"/><br>
            Due Date <br><br>
            <input type="text" name="due_date[]"  id="due_date" class="form-control"/>
        </td>
        <td class="col-sm-2 col-lg-3"  style="width: 15%">
            <select name="currency[]" id="currency[]" class="form-control">
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="USD">USD</option>
            </select>
        </td>
        <td class="col-sm-2" style="width: 5%;"><a class="deleteRow"></a>

        </td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" style="text-align: left;">
            <input type="button" class="btn btn-lg add-row btn-block " id="addrow" value="Add Milestone" />
        </td>
    </tr>
    <tr>
    </tr>
    </tfoot>
</table>
