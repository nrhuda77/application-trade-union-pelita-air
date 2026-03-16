

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
                  <input type="hidden" name="id">
                  <div class="row">

                <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Nama</label>
                <input type="text" class="form-control" name="nama" />
              </div>
               </div>
              
               <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Nik</label>
                <input type="text" class="form-control" name="nik" />
              </div>
              </div>

              <div class="col-lg-4">
                <div class="mb-3">
                <label class="form-label" for="basic-default-company">Nip</label>
                <input type="text" class="form-control" name="nip" />
              </div>
              </div>
              
              <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-email">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" />
              </div>
              </div>
              
              <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-phone">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir" />
              </div>
              </div>
              
              <div class="col-lg-4">
              <div class="mb-3 ">
                <label class="form-label" for="basic-default-message">Alamat</label>
                <textarea class="form-control" name="alamat" ></textarea>
              </div>
              </div>
              
              <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-phone">No Hp</label>
                <input type="number" class="form-control" name="no_hp" />
              </div>
              </div>
              
              <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Email</label>
                <input type="email" class="form-control" name="email" />
              </div>
              </div>
             

            
            
            <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Username</label>
                <input type="text" class="form-control" name="username" />
              </div>
              </div>

              <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Password</label>
                <input type="text" class="form-control" name="password" />
              </div>
              </div>

              <div class="col-lg-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Username</label>
             <select name="status" class="form-control">
               <option value="aktif">Aktif</option>
               <option value="tidak aktif">Tidak Aktif</option>
             </select>
              </div>
              </div>
             

                   <div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Upload Foto Selfie</label>
        <input type="file" class="form-control upload_selfie" onchange="previewImage()" name="upload_selfie" />

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

<div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Upload Id Card</label>
        <input type="file" class="form-control upload_id_card" onchange="previewImage2()" name="upload_id_card" />

        <div class="image-wrapper mt-3">
            <span class="no-image-text" id="no_pic2" style="display:none;">Foto belum diupload</span>

            <img 
                src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" 
                alt="user-avatar" 
                class="mx-auto rounded img-preview"
                height="200" width="200" 
                id="pic2"
            />
        </div>
    </div>
</div>


                          {{-- <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Persetujuan Iuran</label>
                            <input type="checkbox" value="1" class="form-check-input ms-3" name="persetujuan_iuran" />
                          </div>

                          <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Persetujuan Keaktifan</label>
                            <input type="checkbox" value="1" class="form-check-input ms-3" name="persetujuan_keaktifan" />
                          </div>

                          <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Persetujuan Ketentuan</label>
                            <input type="checkbox" value="1" class="form-check-input ms-3" name="persetujuan_ketentuan" />
                          </div>

                          <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Persetujuan Potong Gaji</label>
                            <input type="checkbox" value="1" class="form-check-input ms-3" name="persetujuan_potong_gaji" />
                          </div> --}}
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


      