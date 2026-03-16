<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            
                <h3 class="modal-title">header</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                  
                  @csrf
  
                    <div class="form-body">
                      <input type="hidden" name="id" class="id">
                      <input type="hidden" name="uuid" id="uuid">
                     
                  
                              <div class="col-md-12 mb-3">
                                <label for="judul" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name">
                              </div>

                             
                              <div class="col-md-12 mb-3">
                                <label for="judul" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                              </div>

                             
                              <div class="col-md-12 mb-3">
                                <label for="judul" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                              </div>


                              


                              
                  </div>
                  </div>
                </form>
           
            <div class="modal-footer">
              <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                
            </div>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
