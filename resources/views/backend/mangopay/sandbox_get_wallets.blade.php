<div class="form-group" style="">
    <label for="exampleInputEmail1">To Wallet:</label>
    <select name="users_wallets" class="form-control">
        <option value="">Select Wallet</option>
        @foreach($wallets as $wallet)
            <option value="{{$wallet->Id}}">{{$wallet->Id}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Amount (in cents):</label>
    <input type="text" class="form-control" id="amount_payin" name="amount_payin" aria-describedby="emailHelp" placeholder="Enter Amount" required>
</div>
<button type="submit" class="btn btn-primary">Make PayIn</button>
