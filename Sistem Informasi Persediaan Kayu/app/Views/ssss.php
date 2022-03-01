 <!-- model hapus -->
 <div class="modal fade" id="hapus<?= $dump['id_detbel']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="card-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Hapus</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <!-- general form elements -->
                 <div class="card-body">
                     Anda Akan menghapus data?
                 </div>
             </div>
             <div class="modal-footer">
                 <a href="<?= $link; ?>/hapus-dump/<?= $dump['id_detbel']; ?>" class="btn btn-primary">Ya</a>
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
             </div>
         </div>
     </div>
 </div>
 <!-- end of model hapus -->
 <!-- model edit -->
 <div class="modal fade" id="edit<?= $dump['id_detbel']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="card-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Rincian</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= $link; ?>/edit-draft/<?= $dump['id_detbel']; ?>_<?= $dump['id_barang']; ?>" method="POST">
                 <div class="modal-body">
                     <!-- general form elements -->
                     <div class="card-body">
                         <div class="form-group">
                             <label for="exampleInputEmail1">Nama Barang</label>
                             <input type="text" class="form-control" name="nama" readonly value="<?= $dump['nama']; ?>" required>
                         </div>
                         <div class="form-group">
                             <label for="exampleInputEmail1">Jumlah</label>
                             <input type="number" class="form-control" id="jml" name="jumlah" value="<?= $dump['jumlah']; ?>" required>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <input type="submit" class="btn btn-primary" value='Simpan'>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">kembali</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- end of model edit -->