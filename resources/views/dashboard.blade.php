<x-layouts.app title="Dashboard" page="Dashboard" user="{{ Auth::user()->name }}">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Dashboard') }}</h3>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
