<?php
use App\CreditPackage;

$package = CreditPackage::find($packageArray['id']);
(Auth::user()->isManager()) ? $class="admin-panel" : $class = "";
?>
<div class="col-md-4">
    <div class="credit-package">
        <div class="box-title">
            <h3 class="{{$class}}">
                {{$package->name}}
            </h3>
            <div class="{{$class}}">
            @if(Auth::user()->isManager())
                <a href="{{route('package.edit', ['id' => $package->id])}}" type="button" class="btn-edit-action">
                    <i class="fa fa-pencil-square-o" aria-hidden=""></i> 
                </a>
            @if($package->active())
                <a href="{{route('package.deactivate', ['id' => $package->id])}}" type="button" class="btn-close-action">
                    <i class="fa fa-times-circle"></i>
                </a>
            @else
                <a href="{{route('package.activate', ['id' => $package->id])}}" type="button" class="btn-play-action">
                    <i class="fa fa-play-circle"></i>
                </a>
            @endif
            @endif
            </div>
        </div>
        <div class="credit-package-info">
            <!--<p>
                <strong>{{Lang::get('forms.packages.name')}}</strong>
                {{$package->name}}
            </p>-->
            <div class="package-emark-value">
                <h4>
                <span class="money-total">{{Lang::get('attributes.currency').$package->amount}}</span>
                </h4>
                <p>{{Lang::get('forms.packages.value.emarketplace')}}</p>
            </div>            
            <p class="package-price">
                {{Lang::get('forms.packages.value.price')}} 
                <span class="money-total">{{Lang::get('attributes.currency').$package->cost}}</span>
            </p>            
            @if(Auth::user()->isAdvertiser())
            {{Form::open(['route' => 'deposit.prepare'])}}
            <input type="hidden" name="amount" value="{{(int) $package->cost}}">
            {{Form::submit(Lang::get('forms.basic.buy'), ['class' => 'btn btn-info'])}}
            {{Form::close()}}
            @endif
        </div>
    </div>
    <!--
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
-->
</div>
