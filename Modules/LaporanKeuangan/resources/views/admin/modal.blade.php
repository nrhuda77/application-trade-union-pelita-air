
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
                          <input type="file" id="excel_keuangan" name="excel_keuangan" class="form-control" />
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