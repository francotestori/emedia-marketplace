<?php
use App\CreditPackage;

$package = CreditPackage::find($packageArray['id']);
?>
<div class="col-md-4">
    <div class="ejemplo-webs">
        <img src="{{asset('img/example-paquetes.png')}}" class="img-responsive center-block">
        <div class="ejemplo-titular">
            <hr>
        </div>
        <div>
            <p>
                <strong>{{Lang::get('forms.packages.name')}}</strong>
                {{$package->name}}
            </p>
            <p>
                <strong>{{Lang::get('forms.packages.value.emarketplace')}}</strong>
                {{Lang::get('attributes.currency').$package->amount}}
            </p>
            <p>
                <strong>{{Lang::get('forms.packages.value.price')}}</strong>
                {{Lang::get('attributes.currency').$package->cost}}
            </p>
            @if(Auth::user()->isManager())
                <a href="{{route('package.edit', ['id' => $package->id])}}" type="button" class="btn btn-info">{{Lang::get('forms.basic.edit')}} </a>
            @if($package->active())
                <a href="{{route('package.deactivate', ['id' => $package->id])}}" type="button" class="btn btn-danger">{{Lang::get('forms.packages.deactivate')}} </a>
            @else
                <a href="{{route('package.activate', ['id' => $package->id])}}" type="button" class="btn btn-success">{{Lang::get('forms.packages.activate')}} </a>
            @endif
            @elseif(Auth::user()->isAdvertiser())
            {{Form::open(['route' => 'deposit.prepare'])}}
            <input type="hidden" name="amount" value="{{(int) $package->cost}}">
            {{Form::submit(Lang::get('forms.basic.buy'), ['class' => 'btn btn-info'])}}
            {{Form::close()}}
            @endif
        </div>
    </div>
</div>
