<?php
use App\CreditPackage;

$package = CreditPackage::find($packageArray['id']);
$package->id = $packageArray['id'];
$package->name = $packageArray['name'];
$package->cost = $packageArray['cost'];
$package->amount = $packageArray['amount'];
?>
<div class="col-md-4">
    <div class="ejemplo-webs">
        <img src="{{asset('img/example-paquetes.png')}}" class="img-responsive center-block">
        <div class="ejemplo-titular">
            <hr>
        </div>
        <div>
            <p>
                <strong>{{Lang::get('items.name')}}</strong>
                {{$package->name}}
            </p>
            <p>
                <strong>{{Lang::get('items.emarket_value')}}</strong>
                {{Lang::get('attributes.currency').$package->amount}}
            </p>
            <p>
                <strong>{{Lang::get('items.price')}}</strong>
                {{Lang::get('attributes.currency').$package->cost}}
            </p>
            {{Form::open(['route' => 'deposit.prepare'])}}
            <input type="hidden" name="amount" value="{{(int) $package->cost}}">
            {{Form::submit(Lang::get('forms.buy'), ['class' => 'btn btn-info'])}}
            {{Form::close()}}
        </div>
    </div>
</div>
