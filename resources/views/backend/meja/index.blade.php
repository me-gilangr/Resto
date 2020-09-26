@extends('backend.layouts.master')

@section('content')
@livewire('meja.index')

<form action="#" method="post">
  <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalAddLabel"><i class="fa fa-shopping-basket text-danger"></i> &ensp; Menu Yang Akan di-Pesan.</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-sm">
          <div class="add">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="">Nomor Meja : <span class="text-danger">*</span></label>
                    <input type="text" name="FNO_MEJA" id="FNO_MEJA" class="form-control borad-0" placeholder="Masukan Nomor Meja.." maxlength="3" required>
                    <span class="invalid-feedback"></span>
                  </div>
                  <div class="form-group">
                    <label for="">Jumlah Kapasitas : <span class="text-danger">*</span></label>
                    <input type="number" name="JML_KAPASITAS" id="JML_KAPASITAS" class="form-control borad-0" placeholder="Min. 1..." min="1" required>
                    <span class="invalid-feedback"></span>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer"> 
          <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-sm btn-outline-success"><i class="fa fa-plus"></i> &ensp; Tambah Data Meja</button>
        </div>
      </div>
    </div>
  </div>
</form> 
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