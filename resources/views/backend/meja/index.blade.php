@extends('backend.layouts.master')

@section('content')
@livewire('meja.index')
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#modalAdd').on('shown.bs.modal', function(e) {
      $('input:text:visible:first', this).focus();
    });
  });
</script>
@endsection