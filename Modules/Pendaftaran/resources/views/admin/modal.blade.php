  <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Pendaftar</h4>
                      </div>
                         <form action="#" id="form" class="form-horizontal">
                  
                  @csrf
  
                    <div class="form-body">
  
                      <div class="form-group row">
                        <input type="hidden" name="id" id="id_pendaftaran">
                        <input type="hidden" name="uuid" id="uuid">
                      <div class="mb-3 col-md-6">
    <div class="col-sm-12">

        <div class="image-wrapper">
            <span class="no-image-text" id="no_pics1" style="display:none;">Foto belum diupload</span>

            <img 
                src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" 
                alt="user-avatar" 
                   class="mx-auto rounded img-preview"
                height="200" 
                width="200" 
                id="uploadedAvatar"
            />
        </div>

    </div>
</div>

<div class="mb-3 col-md-6">
    <div class="col-sm-12">

        <div class="image-wrapper">
            <span class="no-image-text" id="no_pics2" style="display:none;">Foto belum diupload</span>

            <img 
                src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" 
                alt="user-avatar" 
                   class="mx-auto rounded img-preview"
                height="200" 
                width="200" 
                id="uploadedAvatara"
            />
        </div>

    </div>
</div>

                       
                            <div class="col-md-6 mb-3">
                              <label for="nama" class="form-label">Nama</label>
                              <input type="text" id="nama" class="form-control" readonly />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nik" class="form-label">Nik</label>
                                <input type="text" id="nik" class="form-control" readonly />
                              </div>

                              <div class="col-md-6 mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" readonly></textarea>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" id="email" class="form-control" readonly />
                              </div>
                  
                              <div class="col-md-12 mb-3">
                                <label for="status_pendaftaran" class="form-label">Approve Status Pendaftaran</label>
                                <select name="status_pendaftaran" class="form-select" id="status_pendaftaran">
                                    <option value="pending">pending</option>
                                    <option value="approved">approved</option>
                                    <option value="rejected">rejected</option>
                                </select>
                              </div> 
                  </div>
                  </div>
                </form>
                    </div>
                     <div class="modal-footer">
              <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                
            </div>
                  </div>
                </div>
              </div>






               <div class="modal fade" id="modal-pop2" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Pendaftar</h4>
                      </div>
                                <form action="#" id="form2" class="form-horizontal">
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
                            <label class="form-label" for="basic-default-company">Nip</label>
                            <input type="text" class="form-control" name="nip" />
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
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-phone">No Hp</label>
                            <input type="number" class="form-control" name="no_hp" />
                          </div>
                          </div>

                          <div class="col-lg-6"> 
                          <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Email</label>
                            <input type="email" class="form-control" name="email" />
                          </div>

                    </div>

                       <div class="col-lg-5">
                          <div class="mb-3 ">
                            <label class="form-label" for="basic-default-message">Alamat</label>
                            <textarea class="form-control" name="alamat" ></textarea>
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
              <button type="button"  id="btnSave2" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                
            </div>
                  </div>
                </div>
              </div>


               <div class="modal fade" id="modal-pop-excel" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                  <div class="modal-content">
                       <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    <div class="modal-body">
                     
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Excel</h4>
                      </div>
                      <form id="form3" class="row g-6" >
                        @csrf
                  

                      

                       <div class="col-12">
                          <label class="form-label" for="keterangan">Input</label>
                          <input type="file" id="excel_karyawan" name="excel_karyawan" class="form-control" />
                      </div>
                      
                           <div class="col-12" id="lod">
                
                      </div>
                        
                        <div class="col-12 text-end mt-3">
                          <button type="button" id="btnSave3" onclick="save_excel()" class="btn btn-primary me-3">Submit</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>