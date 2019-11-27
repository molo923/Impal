<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-md-center flex-md-row flex-column justify-content-md-between">
            <h4 class="page-title">{{ $custom ?? $title ?? 'A Page' }}</h4>
            <div class="ml-md-auto text-md-right d-none d-md-block">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @if(!isset($nohome))
                            <li class="breadcrumb-item"><a href="{{ $url ?? url('banksampah') }}">Home</a></li>
                        @endif
                        @if(isset($extra))
                            @foreach ($extra as $e)
                                <li class="breadcrumb-item"><a href="{{ $e['url'] }}">{{ $e['name'] }}</a></li>
                            @endforeach
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'A Page' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
