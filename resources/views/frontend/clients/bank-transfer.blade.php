<div class="col-md-12" style="padding-top:25px; padding-bottom:25px;">
   Please make your transfer to the following account:
    <br><br>

    <table style="width: 450px;">
        <tr>
            <td class="text-left">Name:</td>          <td>Trustfy Client Account</td>
        </tr>
        <tr>
            <td class="text-left">IBAN:</td>          <td>IE95 AIBK 9310 7128 1910 54</td>
        </tr>
        <tr>
            <td class="text-left">BIC:</td>           <td>AIBKIE2D</td>
        </tr>
        <tr>
            <td class="text-left">Reference:</td>     <td>C-{{$milestone->id}}-{{$milestone->projects_plans_id_fk}}</td>
        </tr>
    </table>
</div>
<div class="col-md-12 text-center">
    <button type="button" class="btn btn-secondary later"  name="{{$milestone->id}}">Remind me later</button>
    <button type="button" class="btn btn-success completed" name="{{$milestone->id}}">Transfer completed</button>
</div>
