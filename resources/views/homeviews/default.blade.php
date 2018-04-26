<div class="panel panel-default">
    <div class="panel-title">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('img/avatar.png')}}" class="img-responsive img-circle">
            </div>
            <div class="col-md-10">
                <h2>{{Lang::get('titles.home.common.welcome', ['name' => $user->name])}}</h2>
                @if(Auth::user()->isAdvertiser())
                    <h4>{{Lang::get('messages.advertiser.tuft')}}</h4>
                @else
                    <h4>{{Lang::get('messages.editor.tuft')}}</h4>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-simple-emedia">
                    <i class="fa fa-question-circle-o"></i>
                    {{Lang::get('titles.home.common.how')}}
                </button>
                @if($user->isEditor())
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-book"></i>
                        {{Lang::get('titles.home.common.guide')}}
                    </button>
                @endif

            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-3 panel-heading">
            <h3>
                <i class="fa fa-envelope"></i>
                {{Lang::get('titles.messages')}}
            </h3>
        </div>
        <div class="col-md-3 col-md-offset-1 panel-heading">
            <h3>
                <i class="fa fa-line-chart"></i>
                {{Lang::get('titles.wallet.transactions.main')}}
            </h3>
        </div>
        <div class="col-md-3 col-md-offset-1 panel-heading">
            <h3>
                <i class="fa fa-money"></i>
                {{Lang::get('titles.wallet.index')}}
            </h3>
            <h4>
                <span class="money-total">{{Lang::get('attributes.currency').' '.$user->getWallet()->balance}}</span>
            </h4>
            @if($user->isEditor())
                <a href="{{route('wallet')}}" class="btn btn-block btn-emedia">{{Lang::get('forms.basic.withdraw')}}</a>
            @else
                <a href="{{route('wallet')}}" class="btn btn-block btn-emedia">{{Lang::get('forms.basic.deposit')}}</a>
            @endif
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-7 panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h3>{{Lang::get('titles.home.common.help')}}</h3>
                    <p>{{Lang::get('titles.tufts.home.help')}}</p>
                    <a href="mailto:info@emediamarket.com">info@emediamarket.com</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-md-offset-1 panel-heading">
            <div class="col-md-12">
                <h3>{{Lang::get('titles.home.common.faq')}}</h3>
                <p>{{Lang::get('titles.tufts.home.faq')}}</p>
                <a href="">{{Lang::get('titles.tufts.home.faq2')}}</a>
            </div>
        </div>
    </div>
</div>
