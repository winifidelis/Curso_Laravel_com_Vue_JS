@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <painel titulo='Titulo do timão' cor='success'>
                <div class="row">
                    <div class="col-md-6">
                        <painel titulo='Paulista' cor='pink'>
                            Tem um monte!
                    </div>
                    <div class="col-md-6">
                        <painel titulo='Mundiais'>
                            Tem 2
                    </div>
                </div>
            </painel>
        </div>
        <div class="col-md-6">
            <painel titulo='VIIIILAAAA' cor='danger'> 
                O maior do centro oeste!
            </painel>
        </div>
    </div>
</div>
@endsection