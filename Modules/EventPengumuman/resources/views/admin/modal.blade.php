

               <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Detail Data</h4>
                      </div>
                          <form action="#" id="form" class="form-horizontal row">
                  @csrf

                      <input type="hidden" id="uuid" name="uuid">


                              <div class="col-md-4 mb-3">
                                <label for="alamat" class="form-label">Judul Laporan</label>
                                <input type="text" class="form-control" id="judul" name="judul"/>
                              </div>

                              <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Kategori</label>
                                 <select name="kategori" id="kategori" class="form-select">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Berita">Berita</option>
                                    <option value="Event">Event</option>
                                    <option value="Info">Info</option>
                                    <option value="Pendidikan">Pendidikan</option>
                                    <option value="Leadership">Leadership</option>
                                    <option value="Iuran">Iuran</option>
                                 </select>
                              </div>

                               <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Status</label>
                                 <select name="status" id="status" class="form-select">
                                    <option value="">Pilih Status</option>
                                    <option value="draft">Draft</option>
                                    <option value="publish">Publish</option>
                                 </select>
                              </div>

                              <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Visibilitas</label>
                                 <select name="visibilitas" id="visibilitas" class="form-select">
                                    <option value="">Pilih Visibilitas</option>
                                    <option value="private">Private</option>
                                    <option value="public">Public</option>
                                 </select>
                              </div>


                              
                              <div class="col-md-4 mb-3">
                                <label for="alamat" class="form-label">Waktu Event</label>
                                <input type="datetime-local" class="form-control" id="waktu_event" name="waktu_event"/>
                              </div>

                              <div class="col-md-4 mb-3">
                                <label for="alamat" class="form-label">Lokasi Event</label>
                                <input type="text" class="form-control" id="lokasi_event" name="lokasi_event"/>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Isi</label>
                                <textarea id="isi" class="form-control" cols="30" rows="10" name="isi"></textarea>
                              </div>
                  
                              


                             

                              
               <div class="col-lg-12">
    <div class="mb-3">
        <label class="form-label">Upload Foto Selfie</label>
        <input type="file" class="form-control upload_selfie" onchange="previewImage()" id="lampiran" name="lampiran" />

        <div class="image-wrapper mt-3">
            <span class="no-image-text" id="no_pic1" style="display:none;">Foto belum diupload</span>

            <img 
                src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" 
                alt="user-avatar" 
                class="mx-auto rounded img-preview"
                height="200" width="200" 
                id="pic"
            />
        </div>
    </div>
</div>

                              
                        
                                
                       </form>
                  
                                 
                              </div>

                                      <div class="modal-footer">
              <button type="button"  id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                 </div>
                  </div>
   
                    </div>
               
            </div>
                