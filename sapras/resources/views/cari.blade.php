@extends('vendor.pagination.default')
@section('content')
<div class="container">
    @foreach ($sarana as $s)
        {{ $s->nama_sarana }}
    @endforeach
</div>

<?php echo $sarana->render(); ?>
{{ $sarana->links() }}
@endsection