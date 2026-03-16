

               <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Anggota</h4>
                      </div>
                              <form action="#" id="form" class="form-horizontal">
                  
                  @csrf
  
                    <div class="form-body">
  
                      <div class="form-group row">
                        
                        <input type="hidden" id="uuid" name="uuid">
                        <input type="hidden" id="status" name="status">
                        <input type="hidden" id="id" name="id">

                        <div class="col-lg-12">
                      <div class="card academy-content shadow-none border">
                        <div class="card-body pt-4">
                          <h5  id="judul"></h5>
                          <p class="mb-0" id="jenis_pelaporan"></p>

                             <hr class="my-6">
                            <div class="d-flex flex-wrap row-gap-2">
                            <div class="me-12">
                              <p class=" text-nowrap mb-2" id="anonim"></p>
                              <p class=" text-nowrap mb-2" id="tenggat"></p>
                              <p class=" text-nowrap mb-2" id="stts"></p>
                            </div>
                            </div>

                           <hr class="my-6">
                           <div id="lampiran-container" class="mt-3 mb-3"> </div>

                          <hr class="my-6">
                          <h5>Description</h5>
                          <p class="mb-6" id="isi"> </p>
                        </div>
                      </div>
                   </div>

                  
                            <div class="col-md-12 mt-5 mb-3">
                                <label for="email" class="form-label">Jawaban Tanggapan</label>
                                <textarea id="tanggapan" name="tanggapan" class="form-control" cols="30" rows="10"></textarea>
                              </div>
                  </div>
                  </div>
                </form>
                    </div>
                     <div class="modal-footer">
                {{-- <button type="button" onclick="proses('Diproses')" class="btn btn-info">Proses</button> --}}
              <button type="button" onclick="proses('Selesai')" class="btn btn-success">Selesai</button>
              <button type="button" onclick="proses('Pengumpulan Bukti Tambahan')" class="btn btn-warning">Perlu Bukti Baru</button>
              <button type="button"   onclick="proses('Penyelidikan Lanjut')" class="btn btn-primary">Penyelidikan</button>
                <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                
            </div>
                  </div>
                </div>
              </div>


      