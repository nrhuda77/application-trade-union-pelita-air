<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        
        <h3 class="modal-title">header</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          
          @csrf
          
          <div class="form-body">
            
            <div class="form-group row">
              <input type="hidden"  name="id" id="id">

             
              
              <table class="table table-bordered">
                <thead class="text-danger">
                  <tr>
          <th class="text-dark">No</th>
          <th class="text-dark">Nama</th>
          <th class="text-dark">Super Admin</th>
          <th class="text-dark">Editor</th>
          <th class="text-dark">Viewer</th>
          <th class="text-dark">Disable</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($permission as $p)
<tr>
    <td class="text-dark">{{ $loop->iteration }}</td>
    <td class="text-dark">{{ $p->name }}</td>
    <td class="text-dark">
        <input type="radio" name="roles[{{ $p->id }}]" value="Super Admin" class="form-check-input"> Superadmin
    </td>
    <td class="text-dark">
        <input type="radio" name="roles[{{ $p->id }}]" value="Editor" class="form-check-input"> Editor
    </td>
    <td class="text-dark">
        <input type="radio" name="roles[{{ $p->id }}]" value="Viewer" class="form-check-input"> Viewer
    </td>
    <td class="text-dark">
        <input type="radio" name="roles[{{ $p->id }}]" value="Disable" class="form-check-input"> Disable
    </td>
</tr>
@endforeach


        
      </tbody>
              </table>
              

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
        <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

