

               <div class="modal fade" id="modal-pop" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Anggota</h4>
                      </div>
                          <form action="#" id="form" class="form-horizontal row">
                  @csrf

                    <input type="hidden" name="id" class="id">
                      <input type="hidden" name="uuid" id="uuid">
 
                
                    
                              <div class="col-md-4 mb-3">
                                <label for="jenis_pelaporan" class="form-label">Jenis Pelaporan</label>
                                <select name="jenis_pelaporan" class="form-select" id="jenis_pelaporan">
                                    <option value="Umum">Umum</option>
                                    <option value="Karir">Karir</option>
                                    <option value="Reward dan Punishment">Reward dan Punishment</option>
                                    <option value="Kesejahteraan">Kesejahteraan</option>
                                    <option value="Health dan Safety">Health dan Safety</option>
                                    <option value="Operation">Operation</option>
                                </select>
                              </div>
                  
                              <div class="col-md-4 mb-3">
                                <label for="judul" class="form-label">Judul Laporan</label>
                                <input type="text" class="form-control" id="judul" name="judul">
                                <span class="text-danger judul_err"></span>
                                
                              </div>
 

                            
                   <div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Lampiran Foto / Dokumen Pendukung (Wajib disertakan)</label>
            <input type="file" class="form-control" onchange="previewFile()" id="lampiran" name="lampiran" />

<div class="image-wrapper mt-3">
    <span class="no-image-text" id="no_pic1">Belum ada file</span>

    <!-- Preview Gambar -->
    <img id="previewImage" style="display:none;" width="400" height="400">

    <!-- Preview Video -->
    <video id="previewVideo" style="display:none;" width="400" height="400" controls></video>

    <!-- Preview PDF -->
    <embed id="previewPDF" style="display:none;" width="400" height="400" type="application/pdf">
</div>
    </div>
</div>


                              <div class="col-md-12 mb-3">
                                <label for="judul" class="form-label">Deskripsi</label>
                              <textarea name="isi" class="form-control" id="isi" cols="30" rows="5"></textarea>
                              <span class="text-danger isi_err"></span>
                              </div>
                           

                        
                              <div class="col-md-12 mb-3" id="annm">
                                <label for="judul" class="form-label">Anonim (Klik Untuk Sembunyikan Identitas Anda)</label>
                                <input type="checkbox" value="1" class="form-check-input" id="anonim" name="anonim">
                                
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
                



            <div class="modal fade" id="modal-pop-histori" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Histori Timeline</h4>
                      </div>
                    
                        <div class="col-xl-12 col-lg-12 col-md-12">
             
                      <ul class="timeline mb-0" id="timeline"> </ul>
                
                </div>
                
                              </div>
                <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                 </div>
                            
                  </div>
       
                    </div>
                   
            </div>
              


      

               <div class="modal fade" id="modal-pop-upload" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-simple modal-edit-user">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class=" mb-6">
                        <h4 class="mb-2 modal-title">Data Anggota</h4>
                      </div>
                          <form action="#" id="form3" class="form-horizontal row">
                  @csrf

                    <input type="hidden" name="id" class="id">
                    <input type="hidden" name="pelaporan_id" class="pelaporan_id">
                      <input type="hidden" name="uuid" id="uuid">
                            
                   <div class="col-lg-6">
    <div class="mb-3">
        <label class="form-label">Lampiran Foto / Dokumen Pendukung (Wajib disertakan)</label>
            <input type="file" class="form-control" onchange="previewFile()" id="lampiran2" name="lampiran" />

<div class="image-wrapper mt-3">
    <span class="no-image-text" id="no_pic2">Belum ada file</span>

    <!-- Preview Gambar -->
    <img id="previewImage2" style="display:none;" width="400" height="400">

    <!-- Preview Video -->
    <video id="previewVideo2" style="display:none;" width="400" height="400" controls></video>

    <!-- Preview PDF -->
    <embed id="previewPDF2" style="display:none;" width="400" height="400" type="application/pdf">
</div>
    </div>
</div>


                              <div class="col-md-12 mb-3">
                                <label for="judul" class="form-label">Deskripsi</label>
                              <textarea name="isi" class="form-control" id="isi" cols="30" rows="5"></textarea>
                              <span class="text-danger isi_err"></span>
                              </div>
                           

                        
                             
                                
              </form>
                  
                                 
                              </div>

                                      <div class="modal-footer">
              <button type="button"  id="btnSave3" onclick="save_upload()" class="btn btn-primary">Simpan</button>
                <button type="button" id="close" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                 </div>
                  </div>
   
                    </div>
               
            </div>
                