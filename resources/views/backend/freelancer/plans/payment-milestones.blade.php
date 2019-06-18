<h5 class="pt-5">Milestone Payment Plan</h5>
<table id="myTable" class=" table order-list pt-3">
    <thead>
    <tr>
        <td>Name</td>
        <td colspan="2">Amount</td>
        <td>Due Date</td>
        <td>Description</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="col-sm-3 col-lg-3" style="width: 20%">
            <input type="text" name="name[]" class="form-control" />
        </td>
        <td class="col-sm-2 col-lg-2" style="width: 17%">
            <input type="number" name="amount[]"  class="form-control"/>
        </td>
        <td class="col-sm-1 col-lg-1"  style="width: 9%">
            <select name="currency[]" id="currency[]" class="form-control">
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="USD">USD</option>
            </select>
        </td>
        <td class="col-sm-2 col-lg-2" style="width: 17%">
            <input type="text" name="due_date[]"  id="due_date" class="form-control"/>
        </td>
        <td class="col-sm-2 col-lg-2" style="width: 26%">
            <textarea class="form-control" rows="3"  name="description[]"></textarea>
        </td>
        <td class="col-sm-2" style="width: 20%"><a class="deleteRow"></a>

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
